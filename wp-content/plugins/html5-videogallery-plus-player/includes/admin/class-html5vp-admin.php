<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Video gallery and Player
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Html5vp_Admin {

	function __construct() {		
		
		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'html5vp_register_menu'), 12 );

		// Admin Prior Processes
		add_action( 'admin_init', array($this, 'html5vp_admin_init_process') );

		// Filter to add row data
		add_filter( 'post_row_actions', array( $this, 'html5vp_add_post_row_data' ), 10, 2 );

		// Filter Custom Coluum 
		add_filter("manage_video-category_custom_column", array($this, 'html5vp_video_category_columns'), 10, 3);
		add_filter("manage_edit-video-category_columns", array($this, 'html5vp_video_category_manage_columns'));
	}
	
	/**
	 * Function to add menu
	 * 
	 * @package Video gallery and Player
	 * @since 1.0.0
	 */
	function html5vp_register_menu() {

		// How It Work Page
		add_submenu_page( 'edit.php?post_type='.WP_HTML5VP_POST_TYPE, __('How it works, our plugins and offers', 'html5-videogallery-plus-player'), __('How It Works', 'html5-videogallery-plus-player'), 'manage_options', 'vgap-designs', array($this, 'vgap_designs_page') );

		// Register plugin premium page
		add_submenu_page( 'edit.php?post_type='.WP_HTML5VP_POST_TYPE, __('Upgrade to PRO - Video gallery and Player', 'html5-videogallery-plus-player'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'html5-videogallery-plus-player').'</span>', 'manage_options', 'html5vp-premium', array($this, 'html5vp_premium_page') );
	}

	/**
	 * How It Work Page HTML
	 * 
	 * @package Video gallery and Player
	 * @since 1.0.0
	 */
	function vgap_designs_page() {
		include_once( WP_HTML5VP_DIR . '/includes/admin/wp-html5vp-how-it-work.php' );
	}

	/**
	 * Premium Feature Page HTML
	 * 
	 * @package Video gallery and Player
	 * @since 1.0.0
	 */
	function html5vp_premium_page() {
		include_once( WP_HTML5VP_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Admin Prior Process
	 * 
	 * @package Video gallery and Player
	 * @since 2.2.3
	 */
	function html5vp_admin_init_process() {
		// If plugin notice is dismissed
	    if( isset($_GET['message']) && $_GET['message'] == 'wp-html5vp-plugin-notice' ) {
	    	set_transient( 'wp_html5vp_install_notice', true, 604800 );
	    }
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package Video gallery and Player
	 * @since 2.5
	 */
	function html5vp_add_post_row_data( $actions, $post ) {

		if( $post->post_type == WP_HTML5VP_POST_TYPE ) {
			return array_merge( array( 'wpos_id' => 'ID: ' . $post->ID ), $actions );
		}

		return $actions;
	}

	/**
	 * function for category columns manage
	 * 
	 * @package Video gallery and Player
	 * @since 2.5
	 */
	function html5vp_video_category_manage_columns($columns) {
	   
		$new_columns['video_shortcode'] = __( 'Category Shortcode', 'html5-videogallery-plus-player' );
		
		$columns = wp_html5vp_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * function for category columns
	 * 
	 * @package Video gallery and Player
	 * @since 2.5
	 */
	function html5vp_video_category_columns($out, $column_name, $theme_id) {
		
		switch ($column_name) {
			case 'video_shortcode':
				echo '[sp_html5video category="' . $theme_id. '"]';
				break;
		}
		return $out;
	}
}

$html5vp_admin = new Html5vp_Admin();