<?php
/**
 * Blocks Initializer
 * 
 * @package Video gallery and Player
 * @since 2.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wp_html5vp_register_guten_block() {

	wp_register_script( 'wp-html5vp-block-js', WP_HTML5VP_URL.'assets/js/blocks.build.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ), WP_HTML5VP_VERSION, true );
	wp_localize_script( 'wp-html5vp-block-js', 'WP_Html5Vp_Block', array(
															'pro_demo_link' 	=> 'https://demo.wponlinesupport.com/prodemo/video-gallery-and-player-pro-demo/',
															'free_demo_link' 	=> 'https://demo.wponlinesupport.com/video-gallery-and-player-demo/',
															'pro_link' 			=> WP_HTML5VP_PLUGIN_LINK,
														));

	// Register block and explicit attributes for video grid
	register_block_type( 'wp-html5vp/video-grid', array(
		'attributes' => array(
			'grid' => array(
							'type'		=> 'number',
							'default'	=> 1,
						),
			'popup_fix' => array(
							'type'		=> 'string',
							'default'	=> 'false',
						),
			'limit' => array(
							'type'		=> 'number',
							'default'	=> -1,
						),
			'category' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'post' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'align' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'className' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
		),
		'render_callback' => 'sp_html5video_shortcode',
	));

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'wp-html5vp-block-js', 'html5-videogallery-plus-player', WP_HTML5VP_DIR . '/languages' );
	}

}
add_action( 'init', 'wp_html5vp_register_guten_block' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * 
 * @package Video gallery and Player
 * @since 2.5
 */
function wp_html5vp_editor_assets() {	

	// Block Editor CSS
	if( ! wp_style_is( 'wpos-guten-block-css', 'registered' ) ) {
		wp_register_style( 'wpos-guten-block-css', WP_HTML5VP_URL.'assets/css/blocks.editor.build.css', array( 'wp-edit-blocks' ), WP_HTML5VP_VERSION );
	}

	// Block Editor Script
	wp_enqueue_style( 'wpos-guten-block-css' );
	wp_enqueue_script( 'wp-html5vp-block-js' );
}
add_action( 'enqueue_block_editor_assets', 'wp_html5vp_editor_assets' );

/**
 * Adds an extra category to the block inserter
 *
 * @package Video gallery and Player
 * @since 2.5
 */
function wp_html5vp_add_block_category( $categories ) {

	$guten_cats = wp_list_pluck( $categories, 'slug' );

	if( ! in_array( 'wpos_guten_block', $guten_cats ) ) {
		$categories[] = array(
							'slug'	=> 'wpos_guten_block',
							'title'	=> __('WPOS Blocks', 'html5-videogallery-plus-player'),
							'icon'	=> null,
						);
	}

	return $categories;
}
add_filter( 'block_categories', 'wp_html5vp_add_block_category' );