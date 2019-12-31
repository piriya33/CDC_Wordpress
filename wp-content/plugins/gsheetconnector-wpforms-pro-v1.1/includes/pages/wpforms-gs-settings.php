<?php
/*
 * Wpforms configuration and Intigration page
 * @since 1.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
   exit();
}

$active_tab = ( isset($_GET['tab']) && sanitize_text_field($_GET["tab"])) ? sanitize_text_field($_GET['tab']) : 'integration';

// if the license info is incomplete or license status is invalid, go to the license tab
$license = get_option('wpf_license_key');
$status = get_option('wpf_license_status');

if (empty($license) || $status == 'invalid') {
   $active_tab = 'license_settings';
}
?>

<div class="wrap">
   <?php
   $tabs = array(
       'license_settings' => __('License', 'gsheetconnector-wpforms'),
	   'integration' => __('Integration', 'gsheetconnector-wpforms'),
       'settings' => __('Form Settings', 'gsheetconnector-wpforms'),
   );
   echo '<div id="icon-themes" class="icon32"><br></div>';
   echo '<h2 class="nav-tab-wrapper">';
   foreach ($tabs as $tab => $name) {
      $class = ( $tab == $active_tab ) ? ' nav-tab-active' : '';
      echo "<a class='nav-tab$class' href='?page=wpform-google-sheet-config&tab=$tab'>$name</a>";
   }
   echo '</h2>';
   switch ($active_tab) {
      case 'settings' :
         $wpform_settings = new WPforms_Googlesheet_Services();
         $wpform_settings->add_settings_page();
         break;
      case 'license_settings' :
         $wpf_license_settings = new WPF_License_Settings();
         $wpf_license_settings->add_settings_pages();
         break;
	  case 'integration' :
         $wpform_integration = new WPforms_Googlesheet_Services();
         $wpform_integration->save_btn();
         break;
   }
   ?>
</div>

