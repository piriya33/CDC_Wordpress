<?php
require_once plugin_dir_path(__FILE__).'php-google-oauth/Google_Client.php';
include_once ( plugin_dir_path(__FILE__) . 'autoload.php' );
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;


class WPFGSC_googlesheet {
	private $token;
	private $spreadsheet;
	private $worksheet;
	const clientId = '72852350417-qhe1lu8kvarpncrt8nahdu3ams9hdu7o.apps.googleusercontent.com';
	const clientSecret = 'mq7swoj19WZMtLhY1kIvq7F1';
	const redirect = 'urn:ietf:wg:oauth:2.0:oob';

	public function __construct() {
	}

	//constructed on call
	public static function preauth($access_code){
		$client = new WPFGSC_Google_Client();
		$client->setClientId(WPFGSC_googlesheet::clientId);
		$client->setClientSecret(WPFGSC_googlesheet::clientSecret);
		$client->setRedirectUri(WPFGSC_googlesheet::redirect);
		$client->setScopes(array('https://spreadsheets.google.com/feeds'));
		
		$results = $client->authenticate($access_code);
		
		$tokenData = json_decode($client->getAccessToken(), true);
		WPFGSC_googlesheet::updateToken($tokenData);
	}
	
	public static function updateToken($tokenData){
		$tokenData['expire'] = time() + intval($tokenData['expires_in']);
		try{
			$tokenJson = json_encode($tokenData);
			update_option('wpform_gs_token', $tokenJson);
		} catch (Exception $e) {
			Wpform_gs_Connector_Utility::wpform_debug_log("Token write fail! - ".$e->getMessage());
		}
	}
	
	public function auth(){
		$tokenData = json_decode(get_option('wpform_gs_token'), true);
		
		if(time() > $tokenData['expire']){
			$client = new WPFGSC_Google_Client();
			$client->setClientId(WPFGSC_googlesheet::clientId);
			$client->setClientSecret(WPFGSC_googlesheet::clientSecret);
			$client->refreshToken($tokenData['refresh_token']);
			$tokenData = array_merge($tokenData, json_decode($client->getAccessToken(), true));
			WPFGSC_googlesheet::updateToken($tokenData);
		}
		
		/* this is needed */
		$serviceRequest = new DefaultServiceRequest($tokenData['access_token']);
		ServiceRequestFactory::setInstance($serviceRequest);
	}

	//preg_match is a key of error handle in this case
	public function settitleSpreadsheet($title) {
		$this -> spreadsheet = $title;
	}

	//finished setting the title
	public function settitleWorksheet($title) {
		$this -> worksheet = $title;
	}
	
	public function getSpreadsheetId() {
		return $this -> spreadsheet;
	}

	//choosing the worksheet
	public function add_row($data) {
    	$spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
		$spreadsheetFeed = $spreadsheetService->getSpreadsheets();
		$spreadsheet = $spreadsheetFeed->getByTitle($this->spreadsheet);
		$worksheetFeed = $spreadsheet->getWorksheets();
		$worksheet = $worksheetFeed->getByTitle($this->worksheet);
      // if worksheet feeds data is not empty
      if ( ! empty( $worksheet ) ) {
         $listFeed = $worksheet->getListFeed();
         $listFeed->insert( $data );
      }
   }
   
   /**
    * Function - Adding custom column header to the sheet
    * @param string $sheet_name
    * @param string $tab_name
    * @param array $gs_map_tags 
    * @since 1.0
    */
   public function add_header( $sheet_name, $tab_name, $gs_map_tags ) {      
      $spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
      $spreadsheetFeed = $spreadsheetService->getSpreadsheets();
      $spreadsheet = $spreadsheetFeed->getByTitle( $sheet_name );
      $worksheetFeed = $spreadsheet->getWorksheets();
      $worksheet = $worksheetFeed->getByTitle( $tab_name );
      $cellFeed = $worksheet->getCellFeed();
      
      $count = 1;
      foreach( $gs_map_tags as $column_name ) {
         $cellFeed->editCell( 1, $count, $column_name );
         $count++;
      }
   }


}
?>