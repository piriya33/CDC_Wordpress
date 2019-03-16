<?php
/**
 * Settings class for License settings
 * @since 1.0
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
   exit;
}

/**
 * WPF_License_Settings Class
 * @since 1.0
 */
class WPF_License_Settings {

   // GS Connector license key option name
   protected $wp_license_key_option_name = "wpf_license_key";
   // GS Connector license status option name
   protected $wp_license_status_option_name = "wpf_license_status";

   /**
    * Set things up.
    * @since 1.0
    */
   public function __construct() {
      add_action('admin_init', array($this, 'init_settings'));
   }

   // White list our options using the Settings API
   public function init_settings() {
      register_setting('wpf-settings-license', $this->wp_license_key_option_name, array($this, 'validate_wpf_license_key'));
   }

   /**
    * sanitize and validate the input (if required)
    * @since 1.0
    */
   public function validate_wpf_license_key($license_key) {
      $license_key = sanitize_text_field($license_key);
      $wp_license_service = new WPF_License_Service();

      if (isset($_POST['wpf_license_deactivate'])) { // user is trying to deactivate the license
         $status = $wp_license_service->deactivate_license($license_key, $this->wp_license_status_option_name, WPFORMS_GOOGLESHEET_PRO_PRODUCT_NAME);

         if ($status == WPF_License_Service::FAILED) {
            add_settings_error(
                    'wpf-settings-license', 'wpf-settings-license-gs-license-key', "WPForms Google Sheet Connector Pro " . __("License cannot be deactivated. Either the license key is invalid or the licensing server cannot be reached.", "gsheetconnector-wpforms"), 'error'
            );
            // since there was an error, revert to the license key to the value from the DB
            $license_key = trim(get_option($this->wp_license_key_option_name));
         } else { // looks like we have a successful de-activation, so let's clear the license key
            $license_key = "";
         }
      } elseif (!empty($license_key)) { // user is trying to activate the license
         $status = $wp_license_service->activate_license($license_key, $this->wp_license_status_option_name, WPFORMS_GOOGLESHEET_PRO_PRODUCT_NAME);

         if ($status == WPF_License_Service::INVALID) {
            add_settings_error(
                    'wpf-settings-license', 'wpf-settings-license-gs-license-key', "WPForms Google Sheet Connector Pro " . __("License cannot be activated. Either the license key is invalid or your activation limit is reached.", "gsheetconnector-wpforms"), 'error'
            );
         }
      }

      return $license_key;
   }

   /*
    * generate the page
    *
    * @since 2.0
    */

   public function add_settings_pages() {
      $wp_license_key = get_option($this->wp_license_key_option_name);
      $wp_license_status = get_option($this->wp_license_status_option_name);
      ?>
      <form id="gs_settings_form" method="post" action="options.php">
      <?php
      // adds nonce and option_page fields for the settings page
      settings_fields('wpf-settings-license');
      settings_errors();
      ?>
         <div class="wrap gs-form">
            <div class="card" id="googlesheet">
               <div class="select-info full-width">
                  <div class="gs-margin-top">
                     <label class="settings-title" for="wpf_license_key"><?php echo("WPForms Google Sheet Connector Pro "); ?><?php _e('license key', "gsheetconnector-wpforms"); ?>:</label>
                  </div>
                  <div class="gs-margin-top">
                     <input type="password" class="regular-text" name="<?php echo $this->wp_license_key_option_name; ?>" value="<?php echo $wp_license_key; ?>" />
         <?php if ($wp_license_status !== false && $wp_license_status == 'valid') { ?>
                        <input type="submit" class="button-secondary" name="wpf_license_deactivate" value="<?php _e('Deactivate License', "gsheetconnector-wpforms"); ?>"/>
         <?php } ?>
                  </div>
                  <br class="clear">
               </div>					
               <div class="select-info full-width">
                  <input type="submit" class="button button-primary button-large" name="wpf_license_activate" value="<?php echo __("Save", "gsheetconnector-wpforms"); ?>"/>
               </div>
               <br class="clear">
            </div>
         </div>
                     <?php wp_nonce_field('wpf_license_nonce', 'wpf_license_nonce'); ?>
      </form>
      <?php
   }

}

$wpf_license_settings = new WPF_License_Settings();
?>