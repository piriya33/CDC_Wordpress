<?php
/**
 * Register Post type functionality
 *
 * @package Video gallery and Player
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to register post type
 * 
 * @package Video gallery and Player
 * @since 1.0.0
 */
function wp_html5video_setup_post_types() {

	$html5video_labels =  apply_filters( 'sp_html5video_labels', array(
		'name'                => __( 'Video Gallery', 'html5-videogallery-plus-player' ),
		'singular_name'       => __( 'Video Gallery', 'html5-videogallery-plus-player' ),
		'add_new'             => __( 'Add New', 'html5-videogallery-plus-player' ),
		'add_new_item'        => __( 'Add New Video', 'html5-videogallery-plus-player' ),
		'edit_item'           => __( 'Edit Video', 'html5-videogallery-plus-player' ),
		'new_item'            => __( 'New Video', 'html5-videogallery-plus-player' ),
		'all_items'           => __( 'All Videos', 'html5-videogallery-plus-player' ),
		'view_item'           => __( 'View Video Gallery', 'html5-videogallery-plus-player' ),
		'search_items'        => __( 'Search Video Gallery', 'html5-videogallery-plus-player' ),
		'not_found'           => __( 'No Videos Gallery found', 'html5-videogallery-plus-player' ),
		'not_found_in_trash'  => __( 'No Videos Gallery found in Trash', 'html5-videogallery-plus-player' ),
		'parent_item_colon'   => '',
		'menu_name'           => __( 'Video Gallery', 'html5-videogallery-plus-player' ),
		'exclude_from_search' => true
	) );

	$html5video_args = array(
		'labels' 			=> $html5video_labels,
		'public' 			=> false,
		'publicly_queryable'=> false,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'query_var' 		=> false,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'menu_icon'   		=> 'dashicons-format-video',
		'hierarchical' 		=> false,
		'supports' => array('title','thumbnail')
	);
	register_post_type( 'sp_html5video', apply_filters( 'sp_html5video_post_type_args', $html5video_args ) );
}

// Action to register post type
add_action('init', 'wp_html5video_setup_post_types');

/**
 * Function to register taxonomy
 * 
 * @package Video gallery and Player
 * @since 1.0.0
 */
function wp_html5video_taxonomies() {
	$labels = array(
		'name'              => _x( 'Category', 'html5-videogallery-plus-player' ),
		'singular_name'     => _x( 'Category', 'html5-videogallery-plus-player' ),
		'search_items'      => __( 'Search Category', 'html5-videogallery-plus-player' ),
		'all_items'         => __( 'All Category', 'html5-videogallery-plus-player' ),
		'parent_item'       => __( 'Parent Category', 'html5-videogallery-plus-player' ),
		'parent_item_colon' => __( 'Parent Category:', 'html5-videogallery-plus-player' ),
		'edit_item'         => __( 'Edit Category', 'html5-videogallery-plus-player' ),
		'update_item'       => __( 'Update Category', 'html5-videogallery-plus-player' ),
		'add_new_item'      => __( 'Add New Category', 'html5-videogallery-plus-player' ),
		'new_item_name'     => __( 'New Category Name', 'html5-videogallery-plus-player' ),
		'menu_name'         => __( 'Video Category', 'html5-videogallery-plus-player' ),
	);

	$args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => false,
	);

	register_taxonomy( 'video-category', array( 'sp_html5video' ), $args );
}

// Action to Register Taxonomy 
add_action( 'init', 'wp_html5video_taxonomies');

/**
 * Function to update post messages
 * 
 * @package Video gallery and Player
 * @since 1.0.0
 */
function wp_html5video_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[WP_HTML5VP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Video updated.', 'html5-videogallery-plus-player' ) ),
		2 => __( 'Custom field updated.', 'html5-videogallery-plus-player' ),
		3 => __( 'Custom field deleted.', 'html5-videogallery-plus-player' ),
		4 => __( 'Video updated.', 'html5-videogallery-plus-player' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Video restored to revision from %s', 'html5-videogallery-plus-player' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Video published.', 'html5-videogallery-plus-player' ) ),
		7 => __( 'Video saved.', 'html5-videogallery-plus-player' ),
		8 => sprintf( __( 'Video submitted.', 'html5-videogallery-plus-player' ) ),
		9 => sprintf( __( 'Video scheduled for: <strong>%1$s</strong>.', 'html5-videogallery-plus-player' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Video draft updated.', 'html5-videogallery-plus-player' ) ),
	);

	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wp_html5video_post_updated_messages' );