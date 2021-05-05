<?php
/**
 * Plugin Name: Video gallery and Player
 * Plugin URI: https://www.wponlinesupport.com/plugins/
 * Text Domain: html5-videogallery-plus-player
 * Domain Path: /languages/
 * Description: Easy to add and display your HTML5, YouTube, Vimeo vedio gallery with Magnific Popup to your website. Also work with Gutenberg shortcode block.
 * Author: WP OnlineSupport
 * Version: 2.5
 * Author URI: https://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author WP OnlineSupport
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! defined( 'WP_HTML5VP_VERSION' ) ) {
	define( 'WP_HTML5VP_VERSION', '2.5' ); // Version of plugin
}
if( ! defined( 'WP_HTML5VP_DIR' ) ) {
	define( 'WP_HTML5VP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'WP_HTML5VP_URL' ) ) {
	define( 'WP_HTML5VP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( ! defined( 'WP_HTML5VP_POST_TYPE' ) ) {
	define( 'WP_HTML5VP_POST_TYPE', 'sp_html5video' ); // Plugin post type name
}
if( ! defined( 'WP_HTML5VP_PLUGIN_LINK' ) ) {
    define( 'WP_HTML5VP_PLUGIN_LINK', 'https://www.wponlinesupport.com/wp-plugin/video-gallery-player/?utm_source=WP&utm_medium=video-gallery&utm_campaign=Features-PRO' ); // Plugin link
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Video gallery and Player
 * @since 1.0.0
 */
function wp_html5video_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$wp_html5vp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wp_html5vp_lang_dir = apply_filters( 'wp_html5vp_languages_directory', $wp_html5vp_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'html5-videogallery-plus-player' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'html5-videogallery-plus-player', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_HTML5VP_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'html5-videogallery-plus-player', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'html5-videogallery-plus-player', false, $wp_html5vp_lang_dir );
	}
}

// Action for Plugins Load
add_action('plugins_loaded', 'wp_html5video_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Video gallery and Player
 * @since 2.5
 */
register_activation_hook( __FILE__, 'sp_html5video_rewrite_flush' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Video gallery and Player
 * @since 2.5
 */
register_deactivation_hook( __FILE__, 'sp_html5video_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Video gallery and Player
 * @since 2.5
 */
function sp_html5video_rewrite_flush() {  
	wp_html5video_setup_post_types();  
	flush_rewrite_rules();

	// Deactivate pro version
	if( is_plugin_active('videogallery-plus-player-pro/video-gallery.php') ) {
		add_action('update_option_active_plugins', 'wp_html5vp_deactivate_pro_version');
	}
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package Video gallery and Player
 * @since 2.5
 */
function sp_html5video_uninstall() {

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();
}

/**
 * Deactivate pro plugin
 * 
 * @package Video gallery and Player
 * @since 2.0.0
 */
function wp_html5vp_deactivate_pro_version() {
	deactivate_plugins('videogallery-plus-player-pro/video-gallery.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Video gallery and Player
 * @since 2.0.0
 */
function wp_html5vp_admin_notice() {
	
	$dir = ABSPATH . 'wp-content/plugins/videogallery-plus-player-pro/video-gallery.php';
	
	// If FREE plugin is active and PRO plugin exist
	if( is_plugin_active( 'html5-videogallery-plus-player/html5video.php' ) && file_exists($dir) ) {
		
		global $pagenow;
		$notice_link        = add_query_arg( array('message' => 'wp-html5vp-plugin-notice'), admin_url('plugins.php') );
		$notice_transient   = get_transient( 'wp_html5vp_install_notice' );
		
		if( $notice_transient == false && $pagenow == 'plugins.php' && file_exists( $dir ) && current_user_can( 'install_plugins' ) ) {
			  echo '<div class="updated notice" style="position:relative;">
					<p>
						<strong>'.sprintf( __('Thank you for activating %s', 'html5-videogallery-plus-player'), 'Video gallery and Player').'</strong>.<br/>
						'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'html5-videogallery-plus-player'), '<strong>(<em>Video gallery and Player PRO</em>)</strong>' ).'
					</p>
					<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
				</div>';
		}
	}
}

// Action to display notice
add_action( 'admin_notices', 'wp_html5vp_admin_notice');

// Admin File
require_once( WP_HTML5VP_DIR . '/includes/admin/class-html5vp-admin.php' );

// Functions File
require_once( WP_HTML5VP_DIR . '/includes/wp-html5vp-functions.php' );

// Post Type File
require_once( WP_HTML5VP_DIR . '/includes/wp-html5vp-post-types.php' );

// Script File
require_once( WP_HTML5VP_DIR . '/includes/class-wp-html5vp-script.php' );

// Shortcode File
require_once( WP_HTML5VP_DIR . '/includes/shortcode/class_shortcode.php' );

// Admin Matabox File
require_once( WP_HTML5VP_DIR . '/includes/admin/metabox/class_admin_metabox.php' );

// Gutenberg Block Initializer
if ( function_exists( 'register_block_type' ) ) {
	require_once ( WP_HTML5VP_DIR . '/includes/admin/supports/gutenberg-block.php' );
}

/* Recommended Plugins Starts */
if ( is_admin() ) {
	require_once( WP_HTML5VP_DIR . '/wpos-plugins/wpos-recommendation.php' );

	wpos_espbw_init_module( array(
							'prefix'	=> 'wp-html5vp',
							'menu'		=> 'edit.php?post_type='.WP_HTML5VP_POST_TYPE,
							'position'	=> 3,
						));
}
/* Recommended Plugins Ends */

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl37_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'            => 37,
							'file'          => plugin_basename( __FILE__ ),
							'name'          => 'Video gallery and Player',
							'slug'          => 'video-gallery-and-player',
							'type'          => 'plugin',
							'menu'          => 'edit.php?post_type=sp_html5video',
							'text_domain'   => 'html5-videogallery-plus-player',							
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl37_load();
/* Plugin Wpos Analytics Data Ends */