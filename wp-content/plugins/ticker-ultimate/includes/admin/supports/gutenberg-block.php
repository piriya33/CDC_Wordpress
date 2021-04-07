<?php
/**
 * Blocks Initializer
 * 
 * @package Ticker Ultimate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wptu_register_guten_block() {

	// Some Variables
	$shrt_gen_link = add_query_arg( array( 'post_type' => WPTU_POST_TYPE, 'page' => 'wptu-shrt-mapper' ), admin_url('edit.php') );

	// Block Editor Script
	wp_register_script( 'wptu-block-js', WPTU_URL.'assets/js/blocks.build.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ), WPTU_VERSION, true );
	wp_localize_script( 'wptu-block-js', 'WptuG_Block', array(
																'pro_demo_link'		=> 'https://demo.wponlinesupport.com/prodemo/ticker-ultimate-pro/',
																'free_demo_link'	=> 'https://demo.wponlinesupport.com/ticker-ultimate/',
																'pro_link'			=> WPTU_PLUGIN_LINK,
															));

	// Register block and explicit attributes for grid
	register_block_type( 'wptu/ticker', array(
		'attributes' => array(
			'limit' => array(
							'type'		=> 'number',
							'default'	=> 15,
						),
			'category' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'ticker_title' => array(
							'type'		=> 'string',
							'default'	=> 'Latest News',
						),
			'posts' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'color' => array(
							'type'		=> 'string',
							'default'	=> '#000',
						),
			'background_color' => array(
							'type'		=> 'string',
							'default'	=> '#2096CD',
						),
			'effect' => array(
							'type'		=> 'string',
							'default'	=> 'fade',
						),
			'fontstyle' => array(
							'type'		=> 'string',
							'default'	=> 'normal',
						),
			'autoplay' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'timer' => array(
							'type'		=> 'number',
							'default'	=> 4000,
						),
			'title_color' => array(
							'type'		=> 'string',
							'default'	=> '#fff',
						),
			'border' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'post_type' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'post_cat' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'link' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'link_target' => array(
							'type'		=> 'string',
							'default'	=> 'self',
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
		'render_callback' => 'wptu_ticker',
	));

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'wptu-block-js', 'ticker-ultimate', WPTU_DIR . '/languages' );
	}
}

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * 
 * @package Ticket Ultimate
 * @since 1.0.0
 */
function wptu_editor_assets() {

	// Block Editor CSS
	if( ! wp_style_is( 'wpos-guten-block-css', 'registered' ) ) {
		wp_register_style( 'wpos-guten-block-css', WPTU_URL.'assets/css/blocks.editor.build.css', array( 'wp-edit-blocks' ), WPTU_VERSION );
	}
	
	// Block Editor Script - Style
	wp_enqueue_style( 'wpos-guten-block-css' );
	wp_enqueue_script( 'wptu-block-js' );
}
add_action( 'enqueue_block_editor_assets', 'wptu_editor_assets' );

add_action( 'init', 'wptu_register_guten_block' );

/**
 * Adds an extra category to the block inserter
 *
 * @package Ticker Ultimate
 * @since 1.0.0
 */
function wptu_add_block_category( $categories ) {

	$guten_cats = wp_list_pluck( $categories, 'slug' );

	if( ! in_array( 'wpos_guten_block', $guten_cats ) ) {
		$categories[] = array(
							'slug'	=> 'wpos_guten_block',
							'title'	=> esc_html__('WPOS Blocks', 'ticker-ultimate'),
							'icon'	=> null,
						);
	}

	return $categories;
}
add_filter( 'block_categories', 'wptu_add_block_category' );