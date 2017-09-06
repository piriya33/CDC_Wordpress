<?php
/*
  Plugin Name: CF7 Google Sheet Connector
  Plugin URI: https://wordpress.org/plugins/cf7-google-sheets-connector/
  Description: Send your Contact Form 7 data to your Google Sheets spreadsheet.
  Version: 1.7
  Author: WesternDeal
  Author URI: https://profiles.wordpress.org/westerndeal/
  Text Domain: gsconnector
 */

if ( ! defined('ABSPATH') ) {
   exit; // Exit if accessed directly
}

// Declare some global constants
define('GS_CONNECTOR_VERSION', '1.7');
define('GS_CONNECTOR_DB_VERSION', '1.7');
define('GS_CONNECTOR_ROOT', dirname(__FILE__));
define('GS_CONNECTOR_URL', plugins_url('/', __FILE__));
define('GS_CONNECTOR_BASE_FILE', basename(dirname(__FILE__)) . '/google-sheet-connector.php');
define('GS_CONNECTOR_BASE_NAME', plugin_basename(__FILE__));
define('GS_CONNECTOR_PATH', plugin_dir_path(__FILE__)); //use for include files to other files
define('GS_CONNECTOR_PRODUCT_NAME', 'Google Sheet Connector');
define('GS_CONNECTOR_CURRENT_THEME', get_stylesheet_directory());
load_plugin_textdomain('gsconnector', false, basename(dirname(__FILE__)) . '/languages');

/*
 * include utility classes
 */
if ( ! class_exists('Gs_Connector_Utility') ) {
   include( GS_CONNECTOR_ROOT . '/includes/class-gs-utility.php' );
}
if ( ! class_exists('Gs_Connector_Service') ) {
   include( GS_CONNECTOR_ROOT . '/includes/class-gs-service.php' );
}
require_once GS_CONNECTOR_ROOT . '/lib/php-google-oauth/Google_Client.php';

/*
 * Main GS connector class
 * @class Gs_Connector_Init
 * @since 1.0
 */

class Gs_Connector_Init {

   /**
    *  Set things up.
    *  @since 1.0
    */
   public function __construct() {
      //run on activation of plugin
      register_activation_hook(__FILE__, array($this, 'gs_connector_activate'));

      //run on deactivation of plugin
      register_deactivation_hook(__FILE__, array($this, 'gs_connector_deactivate'));

      //run on uninstall
      register_uninstall_hook(__FILE__, array('Gs_Connector_Init', 'gs_connector_uninstall'));

      // validate is contact form 7 plugin exist
      add_action('admin_init', array($this, 'validate_parent_plugin_exists'));

      // register admin menu under "Contact" > "Integration"
      add_action('admin_menu', array($this, 'register_gs_menu_pages'));

      // load the js and css files
      add_action('init', array($this, 'load_css_and_js_files'));

      // Add custom link for our plugin
      add_filter('plugin_action_links_' . GS_CONNECTOR_BASE_NAME, array($this, 'gs_connector_plugin_action_links'));
   }

   /**
    * Do things on plugin activation
    * @since 1.0
    */
   public function gs_connector_activate() {
      global $wpdb;
      $this->run_on_activation();
      if ( function_exists('is_multisite') && is_multisite() ) {
         // check if it is a network activation - if so, run the activation function for each blog id
         if ( $network_wide ) {
            // Get all blog ids
            $blogids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->base_prefix}blogs");
            foreach ( $blogids as $blog_id ) {
               switch_to_blog($blog_id);
               $this->run_for_site();
               restore_current_blog();
            }
            return;
         }
      }

      // for non-network sites only
      $this->run_for_site();
   }

   /**
    * deactivate the plugin
    * @since 1.0
    */
   public function gs_connector_deactivate() {
      
   }

   /**
    *  Runs on plugin uninstall.
    *  a static class method or function can be used in an uninstall hook
    *
    *  @since 1.5
    */
   public static function gs_connector_uninstall() {
      global $wpdb;
      Gs_Connector_Init::run_on_uninstall();
      if ( function_exists('is_multisite') && is_multisite() ) {
         //Get all blog ids; foreach of them call the uninstall procedure
         $blog_ids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->base_prefix}blogs");

         //Get all blog ids; foreach them and call the install procedure on each of them if the plugin table is found
         foreach ( $blog_ids as $blog_id ) {
            switch_to_blog($blog_id);
            Gs_Connector_Init::delete_for_site();
            restore_current_blog();
         }
         return;
      }
      Gs_Connector_Init::delete_for_site();
   }

   /**
    * Validate parent Plugin Contact Form 7 exist and activated
    * @access public
    * @since 1.0
    */
   public function validate_parent_plugin_exists() {
      $plugin = plugin_basename(__FILE__);
      if ( ( ! is_plugin_active('contact-form-7/wp-contact-form-7.php') ) && ( ! is_plugin_active('google-sheet-connector/google-sheet-connector') ) ) {
         add_action('admin_notices', array($this, 'contact_form_7_missing_notice'));
         add_action( 'network_admin_notices',  array( $this, 'contact_form_7_missing_notice') );
         deactivate_plugins($plugin);
         if ( isset($_GET['activate']) ) {
            // Do not sanitize it because we are destroying the variables from URL
            unset($_GET['activate']);
         }
      }
   }

   /**
    * If Contact Form 7 plugin is not installed or activated then throw the error
    *
    * @access public
    * @return mixed error_message, an array containing the error message
    *
    * @since 1.0 initial version
    */
   public function contact_form_7_missing_notice() {
      $plugin_error = Gs_Connector_Utility::instance()->admin_notice(array(
          'type' => 'error',
          'message' => 'Google Sheet Connector Add-on requires Contact Form 7 plugin to be installed and activated.'
              ));
      echo $plugin_error;
   }

   /**
    * Create/Register menu items for the plugin.
    * @since 1.0
    */
   public function register_gs_menu_pages() {
      $current_role = Gs_Connector_Utility::instance()->get_current_user_role();
      add_submenu_page('wpcf7', __('Google Sheets', 'gsconnector'), __('Google Sheets', 'gsconnector'), $current_role, 'wpcf7-google-sheet-config', array($this, 'google_sheet_config'));
   }

   /**
    * Google Sheets page action.
    * This method is called when the menu item "Google Sheets" is clicked.
    *
    * @since 1.0
    */
   public function google_sheet_config() {
      ?>
      <div class="wrap gs-form"> 
         <h1><?php echo esc_html(__('Contact Form 7 - Google Sheet Integration', 'gsconnector')); ?></h1>
         <div class="card" id="googlesheet">
            <h2 class="title"><?php echo esc_html(__('Google Sheets', 'gsconnector')); ?></h2>

            <br class="clear">

            <div class="inside">
               <p class="gs-alert"> <?php echo esc_html(__('Click "Get code" to retrieve your code from Google Drive to allow us to access your spreadsheets. And paste the code in the below textbox. ', 'gsconnector')); ?></p>
               <p>
                  <label><?php echo esc_html(__('Google Access Code', 'gsconnector')); ?></label>
                  <input type="text" name="gs-code" id="gs-code" value="" placeholder="<?php if ( get_option('gs_token') !== '' ) {
         echo esc_html(__('Currently Active', 'gsconnector'));
      } ?>"/>

                  <a href="https://accounts.google.com/o/oauth2/auth?access_type=offline&approval_prompt=force&client_id=1021473022177-agam4fkd36jkefe9ru8bvrsrara7b7s3.apps.googleusercontent.com&redirect_uri=urn%3Aietf%3Awg%3Aoauth%3A2.0%3Aoob&response_type=code&scope=https%3A%2F%2Fspreadsheets.google.com%2Ffeeds%2F" target="_blank" class="button">Get Code</a>
               </p>

               <p> <input type="button" name="save-gs-code" id="save-gs-code" value="<?php _e('Save', 'gsconnector'); ?>"
                          class="button button-primary" />
                  <span class="loading-sign">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>

               <p>
                  <label><?php echo esc_html(__('Debug Log', 'gsconnector')); ?></label>
                  <label><a href= "<?php echo plugins_url('/logs/log.txt', __FILE__); ?>" target="_blank" class="debug-view" >View</a></label>
               </p>
               <p id="gs-validation-message"></p>
               <!-- set nonce -->
               <input type="hidden" name="gs-ajax-nonce" id="gs-ajax-nonce" value="<?php echo wp_create_nonce('gs-ajax-nonce'); ?>" />

            </div>
         </div>
      </div>
      <?php
   }

   public function load_css_and_js_files() {
      add_action('admin_print_styles', array($this, 'add_css_files'));
      add_action('admin_print_scripts', array($this, 'add_js_files'));
   }

   /**
    * enqueue CSS files
    * @since 1.0
    */
   public function add_css_files() {
      if ( is_admin() && ( isset($_GET['page']) && ( ( $_GET['page'] == 'wpcf7-new' ) || ( $_GET['page'] == 'wpcf7-google-sheet-config' ) || ( $_GET['page'] == 'wpcf7' ) ) ) ) {
         wp_enqueue_style('gs-connector-css', GS_CONNECTOR_URL . 'assets/css/gs-connector.css', GS_CONNECTOR_VERSION, true);
      }
   }

   /**
    * enqueue JS files
    * @since 1.0
    */
   public function add_js_files() {
      if ( is_admin() && ( isset($_GET['page']) && ( ( $_GET['page'] == 'wpcf7-new' ) || ( $_GET['page'] == 'wpcf7-google-sheet-config' ) ) ) ) {
         wp_enqueue_script('gs-connector-js', GS_CONNECTOR_URL . 'assets/js/gs-connector.js', GS_CONNECTOR_VERSION, true);
         wp_enqueue_script('jquery-json', GS_CONNECTOR_URL . 'assets/js/jquery.json.js', '', '2.3', true);
      }
   }

   /**
    * called on upgrade. 
    * checks the current version and applies the necessary upgrades from that version onwards
    * @since 1.0
    */
   public function run_on_upgrade() {
      $plugin_options = get_site_option('google_sheet_info');

      // update the version value
      $google_sheet_info = array(
          'version' => GS_CONNECTOR_VERSION,
          'db_version' => GS_CONNECTOR_DB_VERSION
      );
      update_site_option('google_sheet_info', $google_sheet_info);
   }

   /**
    * Add custom link for the plugin beside activate/deactivate links
    * @param array $links Array of links to display below our plugin listing.
    * @return array Amended array of links.    * 
    * @since 1.5
    */
   public function gs_connector_plugin_action_links( $links ) {
      // We shouldn't encourage editing our plugin directly.
      unset($links['edit']);

      // Add our custom links to the returned array value.
      return array_merge(array(
          '<a href="' . admin_url('admin.php?page=wpcf7-google-sheet-config') . '">' . __('Settings', 'oasisworkflow') . '</a>'
              ), $links);
   }

   /**
    * Called on activation.
    * Creates the site_options (required for all the sites in a multi-site setup)
    * If the current version doesn't match the new version, runs the upgrade
    * @since 1.0
    */
   private function run_on_activation() {
      $plugin_options = get_site_option('google_sheet_info');
      if ( false === $plugin_options ) {
         $google_sheet_info = array(
             'version' => GS_CONNECTOR_VERSION,
             'db_version' => GS_CONNECTOR_DB_VERSION
         );
         update_site_option('google_sheet_info', $google_sheet_info);
      } else if ( GS_CONNECTOR_DB_VERSION != $plugin_options['version'] ) {
         $this->run_on_upgrade();
      }
   }

   /**
    * Called on activation.
    * Creates the options and DB (required by per site)
    * @since 1.0
    */
   private function run_for_site() {
      if ( ! get_option('gs_access_code') ) {
         update_option('gs_access_code', '');
      }
      if ( ! get_option('gs_verify') ) {
         update_option('gs_verify', 'invalid');
      }
      if ( ! get_option('gs_token') ) {
         update_option('gs_token', '');
      }
   }

   /**
    * Called on uninstall - deletes site_options
    *
    * @since 1.5
    */
   private static function run_on_uninstall() {
      if ( ! defined('ABSPATH') && ! defined('WP_UNINSTALL_PLUGIN') ) exit();

      delete_site_option('google_sheet_info');
   }

   /**
    * Called on uninstall - deletes site specific options
    *
    * @since 1.5
    */
   private static function delete_for_site() {
      delete_option('gs_access_code');
      delete_option('gs_verify');
      delete_option('gs_token');
      delete_post_meta_by_key( 'gs_settings' );
   }

}

// Initialize the google sheet connector class
$init = new Gs_Connector_Init();
