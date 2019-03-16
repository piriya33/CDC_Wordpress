=== GsheetConnector WPForms Pro ===
Contributors: westerndeal
Author URL: https://www.gsheetconnector.com/
Tags: WPForms, Wpforms Google Sheet Integrations, Wpforms sheet Integrations, Google Sheets Connector, Google Sheets, WPForm GSheets Connector, Google, Sheets, WPForms pro.
Requires at least: 3.6
Tested up to: 5.0.3
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Send your Wpform data directly to your Google Sheets spreadsheet.

= Description =

This plugin is a bridge between your WPForms ( Lite and pro ) and Google Sheet. 

When a visitor submits his/her data on your website via WPForms, upon form submission, such data are also sent to Google Sheets.

= How to Use this Plugin =

*In Google Sheets*  
* Log into your Google Account and visit Google Sheets.  
* Create a new Sheet and name it.  
* Rename the tab on which you want to capture the data. 

*In WordPress Admin*  
* Now create or edit WPForms form which you want to capture data from. Set up the form as usual in the Form and Mail etc tabs. Save the settings.
* Thereafter, go to the new tab " Google Sheet " link in WPForms panel.  
* Activate your license using your provided license key.
* Then on "google Sheet > Intigration" tab authenticate with google account and authorize the plugin to connect to your Google Sheets.
* Then in "google Sheet > Form settings" tab select your form name that you want to capture data to google sheet.
* On selecting form name you will find fields name and sheet data on selection.
* Select Google Sheets sheet name and tab name, Add custom column names for all the form fields if needed custom name then check the field you want to populate in Google sheet column and finally hit "Submit Data".
* You can see the custom columns name to your sheet as header.

*Lastly*   
* Test your form submit and verify that the data shows up in your Google Sheet.

* You must pay very careful attention to your naming. This plugin will have unpredictable results if names and special characters like "/","\","_" etc are been used while creating sheet fields and adding custom field name in sheet.
* Also while inputing the WPForm field label to google sheet if there is any empty space between the label name it will not sent the WPForm data to Google Sheet.


== Installation ==

1. Upload `gsheetconnector-wpforms-pro` to the `/wp-content/plugins/` directory`.  
2. Activate the plugin through the 'Plugins' screen in WordPress.  
3. Use the `Admin Panel > WPForms > Settings > Google Sheet` screen to connect to `Google Sheets` by entering the Access Code. You can get the Access Code by clicking the "Get Code" button. 
Enjoy!

= How do I get the Google Access Code required in step 3 of Installation? =

* On the `Admin Panel > WPForms > Google Sheets > Integration ` screen, click the "Get Code" button.
* In a popup Google will ask you to authorize the plugin to connect to your Google Sheets. Authorize it - you may have to log in to your Google account if you aren't already logged in. 
* On the next screen, you should receive the Access Code. Copy the code. 
* Now you can paste this code back on the `Admin Panel > WPForms > Settings > Google Sheets` screen. 

== Changelog ==

= 1.0 =
* First public release
* Integrated WPForms with Google sheets.