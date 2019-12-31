=== GsheetConnector Wpforms Pro ===
Contributors: westerndeal
Donate link: https://www.paypal.me/WesternDeal
Author URL: https://www.gsheetconnector.com/
Tags: WPForms, Wpforms Google Sheet Integrations, Wpforms sheet Integrations, Google Sheets Connector, Google Sheets, WPForm GSheets Connector, Google, Sheets, WPForms pro.
Requires at least: 3.6
Tested up to: 5.1.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Send your Wpform data directly to your Google Sheets spreadsheet.

= Description =

This plugin is a bridge between your [WordPress](https://wordpress.org/) [WPForms](https://wordpress.org/plugins/wpforms-lite/) forms and [Google Sheets](https://www.google.com/sheets/about/).

When a visitor submits his/her data on your website via a Contact Form 7 form, upon form submission, such data are also sent to WPForms.

= How to Use this Plugin =

*In Google Sheets*  
* Log into your Google Account and visit Google Sheets.  
* Create a new Sheet and name it.  
* Rename the tab on which you want to capture the data. 
* If you already have sheet created in google account use that. 

*In WordPress Admin*  
* Now create or edit WPForms form which you want to capture data from. Set up the form as usual in the Form and Mail etc tabs. Save the settings.
* Thereafter, go to the new tab " Google Sheet " link in WPForms panel.  
* Activate your license using your provided license key.
* Then on "google Sheet > Intigration" tab authenticate with google account and authorize the plugin to connect to your Google Sheets.
* And then in "google Sheet > Form settings" tab select your form name that you want to capture data.
* On selecting form name you will find fields name and sheet data on selection.
* Select Google Sheets sheet name and tab name, Add custom column names for all the form fields if needed custom name then check the field you want to populate in Google sheet columnb and finall hit "Submit Data".
* You can see the custom columns name to your sheet as header.

*Lastly*   
* Test your form submit and verify that the data shows up in your Google Sheet.

* You must pay very careful attention to your naming. This plugin will have unpredictable results if names and special characters like "/","\","_" etc are been used while creating sheet fields and adding custom field name in sheet.
* Also while inputing the WPForm field lable to google sheet if there is any empty space between the lable name it will not sent the WPForm data to Google Sheet.


== Installation ==

1. Upload `gsheetconnector-wpforms-pro` to the `/wp-content/plugins/` directory, OR `Site Admin > Plugins > New > Search > GsheetConnector Wpforms Pro > Install`.  
2. Activate the plugin through the 'Plugins' screen in WordPress.  
3. Use the `Admin Panel > WPForms > Settings > Google Sheet` screen to connect to `Google Sheets` by entering the Access Code. You can get the Access Code by clicking the "Get Code" button. 
Enjoy!

== Screenshots ==

1. Installation step 3 - Google Sheets Connect Page.  
2. Edit form - WPForms Gsheet tab. 

= How do I get the Google Access Code required in step 3 of Installation? =

* On the `Admin Panel > WPForms > Google Sheets > Integration ` screen, click the "Get Code" button.
* In a popup Google will ask you to authorize the plugin to connect to your Google Sheets. Authorize it - you may have to log in to your Google account if you aren't already logged in. 
* On the next screen, you should receive the Access Code. Copy the code. 
* Now you can paste this code back on the `Admin Panel > WPForms > Settings > Google Sheets` screen. 

== Changelog ==

= 1.1 =
* Fixed 500 error while fetching Google Sheet Details
* Fixed displaying empty fields at Google Sheet -> Form Settings -> Field List

= 1.0 =
* First public release
* Integrated WPForms with Google sheets.