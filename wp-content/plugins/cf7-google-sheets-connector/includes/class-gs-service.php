<?php

/**
 * Service class for Google Sheet Connector
 * @since 1.0
 */
if ( !defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly
}

/**
 * Gs_Connector_Service Class
 *
 * @since 1.0
 */
class Gs_Connector_Service {
    /**
    *  Set things up.
    *  @since 1.0
    */
   public function __construct() { 
      add_action( 'wp_ajax_verify_gs_integation', array( $this, 'verify_gs_integation' ) );
      
      // Add new tab to contact form 7 editors panel
      add_filter( 'wpcf7_editor_panels', array( $this, 'cf7_gs_editor_panels' ) );
      
      add_action('wpcf7_after_save', array( $this, 'save_gs_settings' ) );
      add_action( 'wpcf7_mail_sent', array($this, 'cf7_save_to_google_sheets'), 1);
   }
   
   /**
    * AJAX function - verifies the token
    *
    * @since 1.0
    */
   public function verify_gs_integation() {
      // nonce check
      check_ajax_referer( 'gs-ajax-nonce', 'security' );

      /* sanitize incoming data */
      $Code = sanitize_text_field( $_POST[ "code" ] );
      
      update_option( 'gs_access_code', $Code );
      
      if ( get_option( 'gs_access_code') != '' ) {
			include_once( GS_CONNECTOR_ROOT . '/lib/google-sheets.php');
			CF7GSC_googlesheet::preauth( get_option('gs_access_code' ) );
         update_option( 'gs_verify', 'valid' );
         wp_send_json_success();
      } else {
         update_option( 'gs_verify', 'invalid' );
         wp_send_json_error();
      } 
      
   }
   
   /**
    * Add new tab to contact form 7 editors panel
    * @since 1.0
    */
   public function cf7_gs_editor_panels( $panels ) {
      $panels[ 'google_sheets' ] = array(
          'title' => __( 'Google Sheets', 'contact-form-7' ),
          'callback' => array( $this, 'cf7_editor_panel_google_sheet' )
      );

      return $panels;
   }
   
   /*
    * Set Google sheet settings with contact form
    * @since 1.0
    */
   public function save_gs_settings( $post ) {
     update_post_meta( $post->id(), 'gs_settings', $_POST['cf7-gs'] );
   }
   
   public function cf7_save_to_google_sheets($form) {

      $submission = WPCF7_Submission::get_instance();
      // get form data
      $form_id = $form->id();
      $form_data = get_post_meta( $form_id, 'gs_settings' );

      $data = array();
      // if contact form sheet name and tab name is not empty than send data to spreedsheet
      if ( $submission && ( ! empty($form_data[0]['sheet-name'] ) ) && (!empty($form_data[0]['sheet-tab-name'] ) ) ) {
         $posted_data = $submission->get_posted_data();
         // make sure the form ID matches the setting otherwise don't do anything
         try {
            include_once( GS_CONNECTOR_ROOT . "/lib/google-sheets.php" );
            $doc = new CF7GSC_googlesheet();
            $doc->auth();
            $doc->settitleSpreadsheet( $form_data[0]['sheet-name'] );
            $doc->settitleWorksheet( $form_data[0]['sheet-tab-name'] );
            $data["date"] = date_i18n( 'j F Y H:i:s', current_time('timestamp') );
            foreach ( $posted_data as $key => $value ) {
               // exclude the default wpcf7 fields in object
               if ( strpos($key, '_wpcf7') !== false || strpos($key, '_wpnonce') !== false ) {
                  // do nothing
               } else {
                  // handle strings and array elements
                  if ( is_array($value) ) {
                     $data[$key] = implode( ', ', $value );
                  } else {
                     $data[$key] = $value;
                  }
               }
            }
            $doc->add_row($data);
         } catch (Exception $e) {
            $data['ERROR_MSG'] = $e->getMessage();
            $data['TRACE_STK'] = $e->getTraceAsString();
            Gs_Connector_Utility::gs_debug_log($data);
         }
      }
   }

   /*
    * Google sheet settings page  
    * @since 1.0
    */
   public function cf7_editor_panel_google_sheet( $post ) { 
         $form_id = sanitize_text_field( $_GET['post'] ); 
         $form_data = get_post_meta( $form_id, 'gs_settings' );
      ?>
<form method="post">
         <div class="gs-fields">
            <h2><span><?php echo esc_html( __( 'Google Sheet Settings', 'gsconnector' ) ); ?></span></h2>
            <p>
               <label><?php echo esc_html( __( 'Google Sheet Name', 'gsconnector' ) ); ?></label>
               <input type="text" name="cf7-gs[sheet-name]" id="gs-sheet-name" 
                      value="<?php echo ( isset ( $form_data[0]['sheet-name'] ) ) ? esc_attr( $form_data[0]['sheet-name'] ) : ''; ?>"/>
               <a href="" class=" gs-name help-link"><?php echo esc_html( __('Where do i get Google Sheet Name ?', 'gsconnector' ) ); ?><span class='hover-data'><?php echo esc_html( __( 'Go to your google account and click on"Google apps" icon and than click "Sheets". Select the name of the appropriate sheet you want to link your contact form or create new sheet.', 'gsconnector') ); ?> </span></a>
            </p>
             <p>
               <label><?php echo esc_html( __( 'Google Sheet Tab Name', 'gsconnector' ) ); ?></label>
               <input type="text" name="cf7-gs[sheet-tab-name]" id="gs-sheet-tab-name"
                      value="<?php echo ( isset ( $form_data[0]['sheet-tab-name'] ) ) ? esc_attr( $form_data[0]['sheet-tab-name'] ) : ''; ?>"/>
               <a href="" class=" gs-name help-link"><?php echo esc_html( __('Where do i get Google Sheet Tab Name ?', 'gsconnector' ) ); ?><span class='hover-data'><?php echo esc_html( __('Open your Google Sheet with which you want to link your contact form . You will notice a tab names at bottom of the screen. Copy the tab name where you want to have an entry of contact form.', 'gsconnector') ); ?></span></a>
            </p>
         </div>
      </form>
   <?php }
      
}

$gs_connector_service = new Gs_Connector_Service();


