jQuery(document).ready(function () {

   /**
    * verify the api code
    * @since 1.0
    */
   jQuery(document).on('click', '#save-wpform-gs-code', function (event) {
      event.preventDefault();
      jQuery(".loading-sign-btn").addClass("loading");
      var data = {
         action: 'verify_wpform_gs_integation',
         code: jQuery('#wpforms-setting-google-access-code').val(),
         security: jQuery('#gs-ajax-nonce').val()
      };
      jQuery.post(ajaxurl, data, function (response) {
         if (!response.success) {
            //alert('kk');
            jQuery(".loading-sign-btn").removeClass("loading");
            jQuery("#wp-validation-message").empty();
            jQuery("<span class='error-message'>Access code Can't be blank</span>").appendTo('#wp-validation-message');
         } else {
            jQuery(".loading-sign-btn").removeClass("loading");
            jQuery("#wp-validation-message").empty();
            jQuery("<span class='wp-valid-message'>Access Code Saved. But do check the debug log for invalid access code.</span>").appendTo('#wp-validation-message');
         }
      });

   });

   function html_decode(input) {
      var doc = new DOMParser().parseFromString(input, "text/html");
      return doc.documentElement.textContent;
   }


   jQuery('#wpforms_select').change(function (e) {
      e.preventDefault();
      var FormId = jQuery(this).val();
      jQuery(".loading-sign-select").addClass("loading-select");
      jQuery.ajax({
         type: "POST",
         url: ajaxurl,
         dataType: "json",
         data: {
            action: 'get_wpforms',
            wpformsId: FormId,
            security: jQuery('#wp-ajax-nonce').val(),
         },
         cache: false,
         success: function (data) {
            //alert(data.success);           
            if (data['data_result'] == '') {
               return;
            }
            else {
               jQuery("#inside").empty();
               jQuery("#inside").append(html_decode(data.data));
               jQuery(".loading-sign-select").removeClass("loading-select");
            }
         }
      });
   });

   jQuery(document).on('click', '#wpforms-gs-sync', function () {
      jQuery(this).parent().children(".loading-sign").addClass("loading");
      var integration = jQuery(this).data("init");
      var data = {
         action: 'sync_all_google_accounts',
         isajax: 'yes',
         isinit: integration,
         security: jQuery('#gs-ajax-nonce').val()
      };

      jQuery.post(ajaxurl, data, function (response) {
         if (response == -1) {
            return false; // Invalid nonce
         }

         if (response.data.success == "yes") {
            jQuery(".loading-sign").removeClass("loading");
            jQuery("#wpf-validation-message").empty();
            jQuery("<span class='wpf-valid-message'>Fetched latest sheet names and tab names.</span>").appendTo('#wpf-validation-message');
         } else {
            jQuery(".loading-sign").removeClass("loading");
            jQuery("#wpf-validation-message").empty();
            jQuery("<span class='wpf-valid-message'>Fetched latest sheet names and tab names.</span>").appendTo('#wpf-validation-message');
            setTimeout(function () {
               location.reload();
            }, 5000);
            //location.reload(); // simply reload the page
         }
      });
   });

   /** 
    * Get tab name list 
    */
   jQuery(document).on("change", "#wpforms-gs-sheet-name", function () {
      var sheetname = jQuery(this).val();
      jQuery(this).parent().children(".loading-sign").addClass("loading");
      var data = {
         action: 'get_sheet_tab_list',
         sheetname: sheetname,
         security: jQuery('#gs-ajax-nonce').val()
      };

      jQuery.post(ajaxurl, data, function (response) {
         if (response == -1) {
            return false; // Invalid nonce
         }
         if (response.success) {
            jQuery('#wpforms-gs-sheet-tab-name').html(html_decode(response.data));
            jQuery(".loading-sign").removeClass("loading");
         }
      });
   });


   // TODO : Combine into one
   jQuery(document).on("change", "#wpforms-gs-sheet-name", function () {
      var sheetname = jQuery(this).val();
      jQuery(this).parent().children(".loading-sign").addClass("loading");
      var data = {
         action: 'get_sheetId',
         sheetname: sheetname,
         security: jQuery('#gs-ajax-nonce').val()
      };

      jQuery.post(ajaxurl, data, function (response) {
         if (response == -1) {
            return false; // Invalid nonce
         }

         if (response.success) {
            jQuery('#sheet-url').html(html_decode(response.data));
            jQuery(".loading-sign").removeClass("loading");
         }
      });
   });


   /**
    * Clear debug
    */
   jQuery(document).on('click', '.debug-clear-kk', function () {
      jQuery(".clear-loading-sign").addClass("loading");
      var data = {
         action: 'wpform_clear_log',
         security: jQuery('#gs-ajax-nonce').val()
      };
      jQuery.post(ajaxurl, data, function (response) {
         if (response.success) {
            jQuery(".clear-loading-sign").removeClass("loading");
            jQuery("#wp-validation-message").empty();
            jQuery("<span class='wp-valid-message'>Logs are cleared.</span>").appendTo('#wp-validation-message');
         }
      });
   });
});
