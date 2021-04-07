<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Ticker Ultimate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wptu_Script {

	function __construct() {
		
 		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wptu_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wptu_front_script') );
	}

	/**
	 * Function to register admin scripts and styles
	 * 
	 * @package Ticker Ultimate Pro
	 * @since 1.4
	 */
	function wptu_register_admin_assets() {

		/* Styles */
		// Registring admin css
		wp_register_style( 'wptu-admin-css', WPTU_URL.'assets/css/wptu-admin.css', array(), WPTU_VERSION );

		/* Scripts */
		// Registring admin script
		wp_register_script( 'wptu-admin-js', WPTU_URL.'assets/js/wptu-admin.js', array('jquery'), WPTU_VERSION, true );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Ticker Ultimate
 	 * @since 1.0.0
	 */
	function wptu_front_style() {

		// Registring public style
		wp_register_style( 'wptu-front-style', WPTU_URL.'assets/css/wptu-front.css', array(), WPTU_VERSION );
		wp_enqueue_style('wptu-front-style');
	}
 
	/**
	 * Function to add script at front side
	 * 
	 * @package Ticker Ultimate
	 * @since 1.0.0
	 */
	function wptu_front_script() {

		global $post;

		// Registring ticker script
		if( ! wp_script_is( 'wptu-ticker-script', 'registered' ) ) {
			wp_register_script( 'wptu-ticker-script', WPTU_URL . 'assets/js/breaking-news-ticker.min.js', array('jquery'), WPTU_VERSION, true );
		}

		// Register Elementor script
		wp_register_script( 'wptu-elementor-js', WPTU_URL.'assets/js/elementor/wptu-elementor.js', array('jquery'), WPTU_VERSION, true );

		// Registring public script
		wp_register_script( 'wptu-public-js', WPTU_URL . 'assets/js/wptu-public.js', array('jquery'), WPTU_VERSION, true );

		// Enqueue Script for Elementor Preview
		if ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post->ID == (int) $_GET['elementor-preview'] ) {

			wp_enqueue_script( 'wptu-ticker-script' );
			wp_enqueue_script( 'wptu-public-js' );
			wp_enqueue_script( 'wptu-elementor-js' );
		}

		// Enqueue Style & Script for Beaver Builder
		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

			$this->wptu_register_admin_assets();

			wp_enqueue_style( 'wptu-admin-css');
			wp_enqueue_script( 'wptu-ticker-script' );
			wp_enqueue_script( 'wptu-admin-js' );
			wp_enqueue_script( 'wptu-public-js' );
		}

		// Enqueue Admin Style & Script for Divi Page Builder
		if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_GET['et_fb'] ) && $_GET['et_fb'] == 1 ) {
			$this->wptu_register_admin_assets();

			wp_enqueue_style( 'wptu-admin-css');
		}

		// Enqueue Admin Style for Fusion Page Builder
		if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) ) ) {
			$this->wptu_register_admin_assets();

			wp_enqueue_style( 'wptu-admin-css');
		}
	}
}

$wptu_script = new Wptu_Script();