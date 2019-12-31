<?php

/**
 *  Plugin Name: 	GsheetConnector Wpforms Pro
 *  Description: 	Send your WPForms data to your Google spreadsheet.
 *  Author:       WesternDeal
 *  Version:     	1.1 
 *  Text Domain: 	gsheetconnector-wpforms
 *  Domain Path: 	languages

 */
// Exit if accessed directly.
if (!defined('ABSPATH')) {
   exit;
}
define('WPFORMS_GOOGLESHEET_PRO_VERSION', '1.1');
define('WPFORMS_GOOGLESHEET_PRO_DB_VERSION', '1.1');
define('WPFORMS_GOOGLESHEET_PRO_ROOT', dirname(__FILE__));
define('WPFORMS_GOOGLESHEET_PRO_URL', plugins_url('/', __FILE__));
define('WPFORMS_GOOGLESHEET_PRO_BASE_FILE', basename(dirname(__FILE__)) . '/gsheetconnector-wpforms-pro.php');
define('WPFORMS_GOOGLESHEET_PRO_BASE_NAME', plugin_basename(__FILE__));
define('WPFORMS_GOOGLESHEET_PRO_PATH', plugin_dir_path(__FILE__)); //use for include files to other files
define('WPFORMS_GOOGLESHEET_PRO_PRODUCT_NAME', 'WPForms Google Sheet Connector Pro');
define('WPFORMS_GOOGLESHEET_PRO_CURRENT_THEME', get_stylesheet_directory());
define('WPFORMS_GOOGLESHEET_PRO_STORE_URL', 'https://gsheetconnector.com');
load_plugin_textdomain('gsheetconnector-wpforms', false, basename(dirname(__FILE__)) . '/languages');

/*
 * include utility classes
 */
if (!class_exists('Wpform_gs_Connector_Utility')) {
   include( WPFORMS_GOOGLESHEET_PRO_ROOT . '/includes/class-wpform-utility.php' );
}

require_once WPFORMS_GOOGLESHEET_PRO_ROOT . '/lib/php-google-oauth/Google_Client.php';

function wpforms_Googlesheet_integration() {

   // WPForms is required.
   if (!class_exists('WPForms', true)) {
      return;
   }
   require_once plugin_dir_path(__FILE__) . 'includes/class-wpforms-integration.php';
}

add_action('wpforms_loaded', 'wpforms_Googlesheet_integration');

class WPforms_Gsheet_Connector_Init {

   public function __construct() {

      //run on activation of plugin
      register_activation_hook(__FILE__, array($this, 'wpform_gs_connector_activate'));

      //run on deactivation of plugin
      register_deactivation_hook(__FILE__, array($this, 'wpform_gs_connector_deactivate'));

      //run on uninstall
      register_uninstall_hook(__FILE__, array('WPforms_Gsheet_Connector_Init', 'wpform_gs_connector_uninstall'));

      // load the js and css files
      add_action('init', array($this, 'load_css_and_js_files'));

      // validate is wpforms plugin exist
      add_action('admin_init', array($this, 'validate_parent_plugin_exists'));

      // Display widget to dashboard
      add_action('wp_dashboard_setup', array($this, 'add_wpform_gs_connector_summary_widget'));

      // register admin menu under "Google Sheet" > "Integration"
      add_action('admin_menu', array($this, 'register_wpform_menu_pages'));

      // load the classes files
      add_action('init', array($this, 'load_all_classes'));

      add_filter('plugin_action_links_' . WPFORMS_GOOGLESHEET_PRO_BASE_NAME, array($this, 'wpform_gs_connector_plugin_action_links'));
   }

   /**
    * Do things on plugin activation
    * @since 1.0
    */
   public function wpform_gs_connector_activate() {
      global $wpdb;
      $this->run_on_activation();
      if (function_exists('is_multisite') && is_multisite()) {
         // check if it is a network activation - if so, run the activation function for each blog id
         if ($network_wide) {
            // Get all blog ids
            $blogids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->base_prefix}blogs");
            foreach ($blogids as $blog_id) {
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
   public function wpform_gs_connector_deactivate() {
      
   }

   /**
    *  Runs on plugin uninstall.
    *  a static class method or function can be used in an uninstall hook
    *
    *  @since 1.0
    */
   public static function wpform_gs_connector_uninstall() {
      global $wpdb;
      WPforms_Gsheet_Connector_Init::run_on_uninstall();
      if (function_exists('is_multisite') && is_multisite()) {
         //Get all blog ids; foreach of them call the uninstall procedure
         $blog_ids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->base_prefix}blogs");

         //Get all blog ids; foreach them and call the install procedure on each of them if the plugin table is found
         foreach ($blog_ids as $blog_id) {
            switch_to_blog($blog_id);
            WPforms_Gsheet_Connector_Init::delete_for_site();
            restore_current_blog();
         }
         return;
      }
      WPforms_Gsheet_Connector_Init::delete_for_site();
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
      if (is_admin() && ( isset($_GET['page']) && ( ( $_GET['page'] == 'wpforms-settings' ) || ($_GET['page'] == 'wpforms-builder' ) || ($_GET['page'] == 'wpform-google-sheet-config' ) ) )) {
         wp_enqueue_style('wpform-gs-connector-css', WPFORMS_GOOGLESHEET_PRO_URL . 'assets/css/wpform-gs-connector.css', WPFORMS_GOOGLESHEET_PRO_VERSION, true);
      }
   }

   /**
    * enqueue JS files
    * @since 1.0
    */
   public function add_js_files() {
      if (is_admin() && ( isset($_GET['page']) && ( ( $_GET['page'] == 'wpforms-settings' ) || ($_GET['page'] == 'wpforms-builder' ) || ($_GET['page'] == 'wpform-google-sheet-config' )) )) {
         wp_enqueue_script('wpform-gs-connector-js', WPFORMS_GOOGLESHEET_PRO_URL . 'assets/js/wpform-gs-connector.js', WPFORMS_GOOGLESHEET_PRO_VERSION, true);
      }
   }

   /**
    * If WPForms plugin is not installed or activated then throw the error
    *
    * @access public
    * @return mixed error_message, an array containing the error message
    *
    * @since 1.0 initial version
    */
   public function wpforms_missing_notice() {
      $plugin_error = Wpform_gs_Connector_Utility::instance()->admin_notice(array(
          'type' => 'error',
          'message' => 'Wpforms Google Sheet Connector Add-on requires Wpforms plugin to be installed and activated.'
      ));
      echo $plugin_error;
   }

   /**
    * Called on activation.
    * Creates the site_options (required for all the sites in a multi-site setup)
    * If the current version doesn't match the new version, runs the upgrade
    * @since 1.0
    */
   private function run_on_activation() {
      $plugin_options = get_site_option('wpform_GS_info');
      if (false === $plugin_options) {
         $wpform_GS_info = array(
             'version' => WPFORMS_GOOGLESHEET_PRO_VERSION,
             'db_version' => WPFORMS_GOOGLESHEET_PRO_DB_VERSION
         );
         update_site_option('wpform_GS_info', $wpform_GS_info);
      } else if (WPFORMS_GOOGLESHEET_PRO_DB_VERSION != $plugin_options['version']) {
         $this->run_on_upgrade();
      }
   }

   /**
    * called on upgrade. 
    * checks the current version and applies the necessary upgrades from that version onwards
    * @since 1.0
    */
   public function run_on_upgrade() {
      $plugin_options = get_site_option('wpform_GS_info');

      // update the version value
      $wpform_GS_info = array(
          'version' => WPFORMS_GOOGLESHEET_PRO_VERSION,
          'db_version' => WPFORMS_GOOGLESHEET_PRO_DB_VERSION
      );
      update_site_option('wpform_GS_info', $wpform_GS_info);
   }

   /**
    * Called on activation.
    * Creates the options and DB (required by per site)
    * @since 1.0
    */
   private function run_for_site() {
      if (!get_option('wpform_gs_access_code')) {
         update_option('wpform_gs_access_code', '');
      }
      if (!get_option('wpform_gs_verify')) {
         update_option('wpform_gs_verify', 'invalid');
      }
      if (!get_option('wpform_gs_token')) {
         update_option('wpform_gs_token', '');
      }
      if (!get_option('wpforms_gs_feeds')) {
         update_option('wpforms_gs_feeds', '');
      }
      if (!get_option('wpforms_gs_sheetId')) {
         update_option('wpforms_gs_sheetId', '');
      }
   }

   /**
    * Validate parent Plugin wpform exist and activated
    * @access public
    * @since 1.0
    */
   public function validate_parent_plugin_exists() {
      $plugin = plugin_basename(__FILE__);
      if ((!is_plugin_active('wpforms-lite/wpforms.php') ) && (!is_plugin_active('wpforms/wpforms.php') )) {
         add_action('admin_notices', array($this, 'wpforms_missing_notice'));
         add_action('network_admin_notices', array($this, 'wpforms_missing_notice'));
         deactivate_plugins($plugin);
         if (isset($_GET['activate'])) {
            // Do not sanitize it because we are destroying the variables from URL
            unset($_GET['activate']);
         }
      }
   }

   /**
    * Load all the classes - as part of init action hook
    * @since 1.0
    */
   public function load_all_classes() {
      if (!class_exists('WPF_License_Service')) {
         include( WPFORMS_GOOGLESHEET_PRO_PATH . 'includes/class-wpform-license-service.php' );
      }
      if (!class_exists('WPF_License_Settings')) {
         include( WPFORMS_GOOGLESHEET_PRO_PATH . 'includes/class-wpform-license-settings.php' );
      }
   }

   /**
    * Called on uninstall - deletes site_options
    *
    * @since 1.0
    */
   private static function run_on_uninstall() {
      if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN'))
         exit();

      delete_site_option('wpform_GS_info');
   }

   /**
    * Called on uninstall - deletes site specific options
    *
    * @since 1.0
    */
   private static function delete_for_site() {

      // deactivate the license
      $license = trim(get_option('wpf_license_key'));

      // data to send in our API request
      $api_params = array(
          'edd_action' => 'deactivate_license',
          'license' => $license,
          'item_name' => urlencode(WPFORMS_GOOGLESHEET_PRO_PRODUCT_NAME), // the name of our product in EDD
          'url' => home_url()
      );

      // Call the custom API.
      $response = wp_remote_post(WPFORMS_GOOGLESHEET_PRO_STORE_URL, array('timeout' => 15, 'body' => $api_params));

      delete_option('wpf_license_status');
      delete_option('wpf_license_key');

      delete_option('wpform_gs_access_code');
      delete_option('wpform_gs_verify');
      delete_option('wpform_gs_token');
      delete_option('wpforms_gs_feeds');
      delete_option('wpforms_gs_sheetId');
      delete_post_meta_by_key('wpform_gs_settings');
      delete_post_meta_by_key('wpform_fields_data');
   }
   
   /**
    * Create/Register menu items for the plugin.
    * @since 1.0
    */
   public function register_wpform_menu_pages() {
      $current_role = Wpform_gs_Connector_Utility::instance()->get_current_user_role();
      add_submenu_page('wpforms-overview', __('Google Sheet', 'gsheetconnector-wpforms'), __('Google Sheet', 'gsheetconnector-wpforms'), $current_role, 'wpform-google-sheet-config', array($this, 'wpforms_google_sheet_config'));
   }

   /**
    * Google Sheets page action.
    * This method is called when the menu item "Google Sheets" is clicked.
    * @since 1.0
    */
   public function wpforms_google_sheet_config() {
      include( WPFORMS_GOOGLESHEET_PRO_PATH . "includes/pages/wpforms-gs-settings.php" );
   }

   /**
    * Add custom link for the plugin beside activate/deactivate links
    * @param array $links Array of links to display below our plugin listing.
    * @return array Amended array of links.    * 
    * @since 1.0
    */
   public function wpform_gs_connector_plugin_action_links($links) {
      // We shouldn't encourage editing our plugin directly.
      unset($links['edit']);

      // Add our custom links to the returned array value.
      return array_merge(array(
          '<a href="' . admin_url('admin.php?page=wpform-google-sheet-config&tab=integration') . '">' . __('Settings', 'gsheetconnector-wpforms') . '</a>'
              ), $links);
   }

   /**
    * Add widget to the dashboard
    * @since 1.0
    */
   public function add_wpform_gs_connector_summary_widget() {
      wp_add_dashboard_widget('wpform_gs_dashboard', __('Google Sheet Connector Wpforms', 'gsheetconnector-wpforms'), array($this, 'wpform_gs_connector_summary_dashboard'));
   }

   /**
    * Display widget conetents
    * @since 1.0
    */
   public function wpform_gs_connector_summary_dashboard() {
      include_once( WPFORMS_GOOGLESHEET_PRO_ROOT . '/includes/pages/wpform-dashboard-widget.php' );
   }

   /**
    * Plugin Update notifier
    */
   public function wpf_plugin_updater() {
      if (!class_exists('WPF_Plugin_Updater')) {
         include( WPFORMS_GOOGLESHEET_PRO_PATH . "includes/class-wpform-plugin-updater.php" );

         // setup the plugin updater
         $edd_updater = new WPF_Plugin_Updater(WPFORMS_GOOGLESHEET_PRO_STORE_URL, __FILE__, array(
             'version' => WPFORMS_GOOGLESHEET_PRO_VERSION, // current version number
             'license' => trim(get_option('wpf_license_key')), // license key (used get_option above to retrieve from DB)
             'item_name' => WPFORMS_GOOGLESHEET_PRO_PRODUCT_NAME, // name of this plugin
             'author' => 'WesternDeal' // author of this plugin
                 )
         );
      }
   }

}

// Initialize the wpform google sheet connector class
$init = new WPforms_Gsheet_Connector_Init();
add_action('admin_init', array($init, 'wpf_plugin_updater'));
