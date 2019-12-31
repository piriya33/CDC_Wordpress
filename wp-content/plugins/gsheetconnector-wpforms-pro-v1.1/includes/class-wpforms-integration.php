<?php
/**
 * service class for Wpform Google Sheet Connector Pro
 * @since 1.0
 */
if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly
}

/**
 * WPforms_Googlesheet_Services Class
 *
 * @since 1.0
 */
class WPforms_Googlesheet_Services {

   /**
    *  Set things up.
    *  @since 1.0
    */
   public function __construct() {

      // save entry with posted data
      add_action('wpforms_process_entry_save', array($this, 'entry_save'), 10, 4);

      // get with all data and display form
      add_action('wp_ajax_get_wpforms', array($this, 'display_wpforms_data'));

      // get sheet name and tab name
      add_action('wp_ajax_sync_all_google_accounts', array($this, 'sync_all_google_accounts'));

      // get sheet id from api
      add_action('wp_ajax_get_sheetId', array($this, 'get_Google_sheetId_by_sheetname'));

      // clear dibug log data
      add_action('wp_ajax_wpform_clear_log', array($this, 'wpform_clear_logs'));

      // get sheet names
      add_action('wp_ajax_get_sheet_tab_list', array($this, 'get_google_tab_list_by_sheetname'));

      // get all form data
      add_action('admin_init', array($this, 'execute_post_data'));

      // verify the spreadsheet connection
      add_action('wp_ajax_verify_wpform_gs_integation', array($this, 'verify_wpform_gs_integation'));
   }

   /**
    * function to get all the custom posted header fields
    *
    * @since 1.0
    */
   
   public function execute_post_data() {
      if (isset($_POST ['wp-save-btn'])) {
         $wpform_tags = array();
         $form_id = $_POST['form-id'];
         update_post_meta($form_id, 'wpform_gs_settings', $_POST['wpform-gs']);
         $gs_sheet_name = $_POST['wpform-gs']['sheet-name'];
         $gs_tab_name = $_POST['wpform-gs']['sheet-tab-name'];

         // Save all wpform tags
         $form_tag = isset($_POST['wp-custom-ck']) ? $_POST['wp-custom-ck'] : array();
         $form_tag_key = $_POST['wp-custom-header-key'];
         $form_tag_placeholder = $_POST['wp-custom-header-placeholder'];
         $form_tag_column = $_POST['wp-custom-header'];
         $form_tag_array = array();
         if (!empty($form_tag)) {
            foreach ($form_tag as $key => $value) {
               $wpf_key = $form_tag_key[$key];
               $wpf_val = (!empty($form_tag_column[$key]) ) ? $form_tag_column[$key] : $form_tag_placeholder[$key];
               if ($wpf_val !== "") {
                  $form_tag_array[$wpf_key] = $wpf_val;
                  $wpform_tags[] = $wpf_val;
               }
            }
         }
         update_post_meta($form_id, 'wpform_fields_data', $form_tag_array);

         try {
            include_once( WPFORMS_GOOGLESHEET_PRO_ROOT . "/lib/google-sheets.php" );
            $doc = new WPFGSC_googlesheet();
            $doc->auth();
            $doc->add_header($gs_sheet_name, $gs_tab_name, $wpform_tags);
         } catch (Exception $e) {
            $data['ERROR_MSG'] = $e->getMessage();
            $data['TRACE_STK'] = $e->getTraceAsString();
            Wpform_gs_Connector_Utility::wpform_debug_log($data);
         }
      }
   }

   /**
    * AJAX function - verifies the token
    *
    * @since 1.0
    */
   public function verify_wpform_gs_integation() {
      // nonce checksave_gs_settings
      check_ajax_referer('gs-ajax-nonce', 'security');

      /* sanitize incoming data */
      $Code = sanitize_text_field($_POST["code"]);

      if (!empty($Code)) {
         update_option('wpform_gs_access_code', $Code);
      } else {
         return;
      }

      if (get_option('wpform_gs_access_code') != '') {
         include_once( WPFORMS_GOOGLESHEET_PRO_ROOT . '/lib/google-sheets.php');
         WPFGSC_googlesheet::preauth(get_option('wpform_gs_access_code'));
         update_option('wpform_gs_verify', 'valid');
         wp_send_json_success();
      } else {
         update_option('wpform_gs_verify', 'invalid');
         wp_send_json_error();
      }
   }

   /**
    * AJAX function - clear log file
    * @since 1.0
    */
   public function wpform_clear_logs() {
      // nonce check
      check_ajax_referer('gs-ajax-nonce', 'security');

      $handle = fopen(WPFORMS_GOOGLESHEET_PRO_PATH . 'includes/logs/log.txt', 'w');
      fclose($handle);

      wp_send_json_success();
   }

   /**
    * AJAX function - Fetch tab list by sheet name
    * @since 1.0
    */
   public function get_google_tab_list_by_sheetname() {
      // nonce check
      check_ajax_referer('gs-ajax-nonce', 'security');

      $sheetname = sanitize_text_field($_POST['sheetname']);
      $sheet_data = get_option('wpforms_gs_feeds');
      $html = "";
      $tablist = "";
      if (!empty($sheet_data) && array_key_exists($sheetname, $sheet_data)) {
         $tablist = $sheet_data[$sheetname];
      }

      if (!empty($tablist)) {
         $html = '<option value="">' . __("Select", "gsconnector") . '</option>';
         foreach ($tablist as $tab) {
            $html .= '<option value="' . $tab . '">' . $tab . '</option>';
         }
      }
      wp_send_json_success(htmlentities($html));
   }

   /**
    * AJAX function - Fetch sheet URL
    * @since 1.0
    */
   public function get_Google_sheetId_by_sheetname() {
      // nonce check
      check_ajax_referer('gs-ajax-nonce', 'security');

      $sheetname = sanitize_text_field($_POST['sheetname']);
      $sheetId_data = get_option('wpforms_gs_sheetId');
      $html = "";

      if ($sheetId_data) {
         foreach ($sheetId_data as $key => $tab) {
            if ($key == $sheetname) {
               $html .= '<label> Google Sheet URL</label> <a href="https://docs.google.com/spreadsheets/d/' . $tab . '/edit#gid=0" target="_blank">Sheet URL</a>
                <input type="hidden" name="gsheet_id" value="' . $tab . '">';
            }
         }
         wp_send_json_success(htmlentities($html));
      }
   }

   /**
    * Function - sync with google account to fetch sheet and tab name
    * @since 1.0
    */
   public function sync_all_google_accounts() {
      $return_ajax = false;

      if (isset($_POST['isajax']) && $_POST['isajax'] == 'yes') {
         // nonce check
         check_ajax_referer('gs-ajax-nonce', 'security');
         $init = sanitize_text_field($_POST['isinit']);
         $return_ajax = true;
      }

      include_once( WPFORMS_GOOGLESHEET_PRO_ROOT . '/lib/google-sheets.php');
      $sheetdata = array();
      $doc = new WPFGSC_googlesheet();
      $doc->auth();
      $spreadsheetService = new Google\Spreadsheet\SpreadsheetService();

      // Get all spreadsheets
      $spreadsheetFeed = $spreadsheetService->getSpreadsheets();
      foreach ($spreadsheetFeed as $sheetfeeds) {
         $link = $sheetfeeds->getId();
         $getid = substr($link, 64);

         $sheetname = $sheetfeeds->getTitle();
         $sheetId[$sheetname] = $getid;

         $tablist = $spreadsheetFeed->getByTitle($sheetname);
         // If worksheet is shared don't fetch ( TODO: yet to get proper solution )
         try {
            $worksheets = $tablist->getWorksheets();
         } catch( Exception $e ) {
            // do nothing
            continue;
         } 
         foreach ($worksheets as $worksheetfeeds) {
            $worksheetname = $worksheetfeeds->getTitle();
            $worksheet_array[] = $worksheetname;
         }
         $sheetdata[$sheetname] = $worksheet_array;
         unset($worksheet_array);
      }
      update_option('wpforms_gs_feeds', $sheetdata);
      update_option('wpforms_gs_sheetId', $sheetId);

      if ($return_ajax == true) {
         if ($init == 'yes') {
            wp_send_json_success(array("success" => 'yes'));
         } else {
            wp_send_json_success(array("success" => 'no'));
         }
      }
   }

   /**
    * AJAX function - get wpforms details with sheet data
    * @since 1.0
    */
   function display_wpforms_data() {

      // nonce check
      check_ajax_referer('wp-ajax-nonce', 'security');

      $form = get_post($_POST['wpformsId']);
      $form_id = $_POST['wpformsId'];

      ob_start();
      $this->wpforms_googlesheet_settings_content($form_id);
      $this->display_wpform_fields($form_id);
      $result = ob_get_contents();
      ob_get_clean();
      wp_send_json_success(htmlentities($result));
   }

   /**
    * get form data on ajax fire inside div
    * @since 1.0
    */
   public function add_settings_page() {
      $forms = get_posts(array(
          'post_type' => 'wpforms',
          'showposts' => 10
              ));
      ?>
      <div class="wp-formSelect">
         <h3><?php echo __('Select form', 'gsheetconnector-wpforms');?></h3>
      </div>
      <div class="wp-select">
         <select id="wpforms_select" name="wpforms">
            <option value="">Select Form</option>
      <?php foreach ($forms as $form) { ?>
               <option value="<?php echo $form->ID; ?>"><?php echo $form->post_title; ?></option> 
      <?php } ?>
         </select>
      </div>
      <span class="loading-sign-select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
      <input type="hidden" name="wp-ajax-nonce" id="wp-ajax-nonce" value="<?php echo wp_create_nonce('wp-ajax-nonce'); ?>" />
      <div class="wrap gs-form">
         <form method="post">
            <div class="card" id="wpform-gs">
               <h2 class="title"><?php echo __('WPForms - Google Sheet Integration', 'gsheetconnector-wpforms'); ?></h2>
               <hr class="divide">
               <br class="clear">

               <div id="inside">

               </div>
               <p class="gs-sync-row"><?php echo __('Not showing Sheet Name and Tab Name and Sheet URL in the Form Dropdown list ? <a id="wpforms-gs-sync" data-init="no">Click here </a> to fetch it.', 'gsheetconnector-wpforms'); ?>
                  <span class="loading-sign">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
               </p>
               <input type="hidden" name="gs-ajax-nonce" id="gs-ajax-nonce" value="<?php echo wp_create_nonce('gs-ajax-nonce'); ?>" />
               <p id="wpf-validation-message"></p>
            </div>
         </form>
      </div>
      <?php
   }

   /**
    * fatch field list of wpforms created
    * @since 1.0
    */
   function display_wpform_fields($form_id) {
      $form_id;
      $meta = get_post_field('post_content', $form_id);
      $get_data = json_decode($meta);
      $field_list = $get_data->fields;
      ?>
      <hr class="divider">
      <div class="field-list">
         <span class="wp-title"><?php echo esc_html(__('Field List ', 'gsheetconnector-wpforms')); ?></span>
         <span class="wp-info"><?php echo esc_html(__('( Map form fields to google sheet with custom header name. ) ', 'gsheetconnector-wpforms')); ?></span>
         </br>
      </div>
      <table class="wp-field-list">
      <?php
      // fetch saved fields
      $forms_tags = get_post_meta($form_id, 'wpform_fields_data');
      $count = 0;
      foreach ($field_list as $key => $value) {
         $key_value = $key;
         $get_field = $value;
         
         if( $get_field->type == "divider" || $get_field->type == "pagebreak" || $get_field->type == "html" ) {
            continue;
         }
         
         $fields = $get_field->label;
         $text = preg_replace('/[\\_]|\\s+/', '-', $fields);
         $txt_replace = str_replace('/', '-', $text);
         $field_value = strtolower($txt_replace);
         $saved_val = "";
         $checked = "";
         if (!empty($forms_tags) && array_key_exists($field_value, $forms_tags[0])) :
            $saved_val = $forms_tags[0][$field_value];
            $checked = "checked";
         endif;
         $arr_replace = str_replace('/', '-', $field_value);
         $placeholder = preg_replace('/[\\_]|\\s+/', '-', $arr_replace);
         ?>
            <tr>
               <td><input type="checkbox" class="fieldchkBoxClass" name="wp-custom-ck[<?php echo $count; ?>]" value="1" <?php echo $checked; ?>></td>
               <td><?php echo $fields; ?> : </td>
               <td>
                  <input type="hidden" value="<?php echo $placeholder; ?>" name="wp-custom-header-key[<?php echo $count; ?>]">
                  <input type="hidden" value="<?php echo $placeholder; ?>" name="wp-custom-header-placeholder[<?php echo $count; ?>]">
                  <input type="text" name="wp-custom-header[<?php echo $count; ?>]" value="<?php echo $saved_val; ?>" placeholder="<?php echo $placeholder; ?>">
               </td>
            </tr>
         <?php
         $count++;
      }
      ?>
      </table>
      <input type="submit" align="middle" value="Submit Data" id="wp-save-btn" class="wp-save-btn" name="wp-save-btn">
      <input type="hidden" name="form-id" id="form-id" value="<?php echo $form_id; ?>">
      <span class="loading-sign-btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
      <p id="wp-validation-message"></p>
      <input type="hidden" name="wp-save-ajax-nonce" id="wp-save-ajax-nonce" value="<?php echo wp_create_nonce('wp-save-ajax-nonce'); ?>" />
   <?php
   }

   /**
    * Function - fetch contant form list that is connected with google sheet
    * @since 1.0
    */
   public function get_forms_connected_to_sheet() {
      global $wpdb;
      $query = $wpdb->get_results("SELECT ID,post_title,meta_value from " . $wpdb->prefix . "posts as p JOIN " . $wpdb->prefix . "postmeta as pm on p.ID = pm.post_id where pm.meta_key='wpform_gs_settings' AND p.post_type='wpforms' ORDER BY p.ID");
      return $query;
   }

   /**
    * Function - save the setting data of google sheet
    * @since 1.0
    */
   public function save_btn() {
      if (!empty($_GET['tab']) && $_GET['tab'] == "integration") {
         ?>
		 <div class="card-getcode">
         <span class="wpforms-setting-field log-setting">

            <p class="wpform-gs-alert-kk"> <?php echo esc_html(__('Click "Get code" to retrieve your code from Google Drive to allow us to access your spreadsheets. And paste the code in the below textbox. ', 'gsheetconnector-wpforms')); ?></p>
            <p>
               <label><?php echo esc_html(__('Google Access Code', 'gsheetconnector-wpforms')); ?></label>
               <input type="text" name="google-access-code" id="wpforms-setting-google-access-code" value="" placeholder="<?php if (get_option('wpform_gs_access_code') != '') {
            echo esc_html(__('Currently Active', 'gsheetconnector-wpforms'));
         } else {
            echo 'Enter value';
         }
         ?>"/>   
               <a class="wpforms-btn wpforms-btn-md wpforms-btn-light-grey" target="_blank" href="https://accounts.google.com/o/oauth2/auth?access_type=offline&approval_prompt=force&client_id=72852350417-qhe1lu8kvarpncrt8nahdu3ams9hdu7o.apps.googleusercontent.com&redirect_uri=urn:ietf:wg:oauth:2.0:oob&response_type=code&scope=https%3A%2F%2Fspreadsheets.google.com%2Ffeeds%2F">Get Code</a>
            </p>
            <label><?php echo esc_html(__('Debug Log ->', 'gsheetconnector-wpforms')); ?></label>
            <label><a href="<?php echo plugins_url('/logs/log.txt', __FILE__); ?>" target="_blank" class="wpform-debug-view" >View</a></label>
            <label><a class="debug-clear-kk" ><?php echo esc_html( __( 'Clear', 'gsheetconnector-wpforms' )); ?></a></label>
            <span class="clear-loading-sign">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <p id="wp-validation-message"></p>

            <div class="gs-fields">
               <p class="wp-sync-row"><?php echo __('Not showing Sheet Name and Tab Name and Sheet URL in the Form Dropdown list ? <a id="wpforms-gs-sync" data-init="yes">Click here </a> to fetch it.', 'gsheetconnector-wpforms'); ?>
                  <span class="loading-sign">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
               <p id="wpf-validation-message"></p>
            </div>
         </span>
			
			
         <!-- set nonce -->
         <input type="hidden" name="gs-ajax-nonce" id="gs-ajax-nonce" value="<?php echo wp_create_nonce('gs-ajax-nonce'); ?>" />
         <input type="submit" name="save-gs" class="wpforms-btn wpforms-btn-md wpforms-btn-orange" id="save-wpform-gs-code" value="Save & Authenticate">
         <span class="loading-sign-btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		 </div>
         <?php
      }
   }

   /**
    * Function - save the setting data of google sheet with sheet name and tab name
    * @since 1.0
    */
   public function wpforms_googlesheet_settings_content($form_id) {

      $get_data = get_post_meta($form_id, 'wpform_gs_settings');

      $saved_sheet_name = isset($get_data[0]['sheet-name']) ? $get_data[0]['sheet-name'] : "";
      $saved_tab_name = isset($get_data[0]['sheet-tab-name']) ? $get_data[0]['sheet-tab-name'] : "";

      $sheet_data = get_option('wpforms_gs_feeds');

      echo '<div class="wpforms-panel-content-section-googlesheet-tab">';

      echo '<div class="wpforms-panel-content-section-title">';
      ?>
      <h3><?php esc_html_e('Google Sheet Settings', 'gsheetconnector-wpforms'); ?></h3>
      <?php echo '</div>'; ?>
      <div class="wpforms-gs-fields">
         <p>
            <label><?php echo esc_html(__('Google Sheet Name', 'gsheetconnector-wpforms')); ?></label>
            <select name="wpform-gs[sheet-name]" id="wpforms-gs-sheet-name" >
               <option value=""><?php echo __('Select', 'gsheetconnector-wpforms'); ?></option>
               <?php
               if (!empty($sheet_data)) {
                  foreach ($sheet_data as $key => $value) {
                     $selected = "";
                     if ($saved_sheet_name !== "" && $key == $saved_sheet_name) {
                        $selected = "selected";
                     }
                     ?>
                     <option value="<?php echo $key; ?>" <?php echo $selected; ?> ><?php echo $key; ?></option>
                     <?php
                  }
               }
               ?>
            </select>
            <span class="loading-sign">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input type="hidden" name="gs-ajax-nonce" id="gs-ajax-nonce" value="<?php echo wp_create_nonce('gs-ajax-nonce'); ?>" />
         </p>
         <p>
            <label><?php echo esc_html(__('Google Sheet Tab Name', 'gsheetconnector-wpforms')); ?></label>

            <select name="wpform-gs[sheet-tab-name]" id="wpforms-gs-sheet-tab-name" >
               <?php
               if ($saved_sheet_name !== "") {
                  $selected_tabs = $sheet_data[$saved_sheet_name];
                  if (!empty($selected_tabs)) {
                     foreach ($selected_tabs as $tab) {
                        $selected = "";
                        if ($saved_tab_name !== "" && $tab == $saved_tab_name) {
                           $selected = "selected";
                        }
                        ?>
                        <option value="<?php echo $tab; ?>" <?php echo $selected; ?> ><?php echo $tab; ?></option>
                        <?php
                     }
                  }
               }
               ?>
            </select>
         </p>
         <p class="sheet-url" id="sheet-url">
            <?php
            $getsheets_id = get_option('wpforms_gs_sheetId');
            foreach ($getsheets_id as $key => $val) {
               if ($key == $saved_sheet_name) {
                  ?>
                  <label><?php echo __('Google Sheet URL','gsheetconnector-wpforms'); ?> </label> <a href="https://docs.google.com/spreadsheets/d/<?php echo $val; ?>/edit#gid=0" target="_blank">Sheet URL</a>
               <?php
               }
            }
            ?>
         </p>

      </div>
      </div>
      <?php
   }

   /**
    * Function - To send wpform data to google spreadsheet
    * @since 1.0
    */
   public function entry_save($fields, $entry, $form_id, $form_data = '') {

      // get form data
      $form_data_get = get_post_meta($form_id, 'wpform_gs_settings');
      $form_tags = get_post_meta($form_id, 'wpform_fields_data');
      $data = array();
      $sheet_name = $form_data_get[0]['sheet-name'];
      $sheet_tab_name = $form_data_get[0]['sheet-tab-name'];

      if ((!empty($sheet_name) ) && (!empty($sheet_tab_name) )) {
         try {
            include_once( WPFORMS_GOOGLESHEET_PRO_ROOT . "/lib/google-sheets.php" );
            $doc = new WPFGSC_googlesheet();
            $doc->auth();
            $doc->settitleSpreadsheet($sheet_name);
            $doc->settitleWorksheet($sheet_tab_name);
            foreach ($fields as $k => $v) {
               $get_field = $fields[$k];
               $arr = $get_field['name'];
               $arr_replace = str_replace('/', '-', $arr);
               $special_character = preg_replace('/[\\_]|\\s+/', '-', $arr_replace);
               $key_value = strtolower($special_character);
               $value = $get_field['value'];
               if (array_key_exists($key_value, $form_tags[0])) {
                  $key = $form_tags[0][$key_value];
                  $data[$key] = $value;
               }
            }
            $doc->add_row($data);
         } catch (Exception $e) {
            $data['ERROR_MSG'] = $e->getMessage();
            $data['TRACE_STK'] = $e->getTraceAsString();
            Wpform_gs_Connector_Utility::wpform_debug_log($data);
         }
      }
   }

}

$wpforms_service = new WPforms_Googlesheet_Services();
