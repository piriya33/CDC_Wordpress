<?php
/**
 * Functions.php
 *
 * @package  Theme_Customisations
 * @author   WooThemes
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * functions.php
 * Add PHP snippets here
 */

/* Enable shortcodes in text widgets 
add_filter('widget_text','do_shortcode');
*/

/* 
 * Add TinyMCE support
 */

function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    $args['teeny'] = false;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );

//** Force Paste as plain text as default to avoid breaking the site */

function bbp_tinymce_paste_plain_text( $plugins = array() ) {
    $plugins[] = 'paste';
    return $plugins;
}
add_filter( 'bbp_get_tiny_mce_plugins', 'bbp_tinymce_paste_plain_text' );


// Add user status aware user control menu //
/* This part adds user account control menu to ALL menu EXCEPT the primary menu 
 * IE: !== 'primary' 
 * When user is logged in, menu will show My account / Edit Profile and Log Out links
 * When user is logged out, menu will show Login and Register Link
 */

add_filter( 'wp_nav_menu_items', 'user_aware_menu_item',10,2);

function user_aware_menu_item ( $items, $args ) {
	if (is_user_logged_in() && $args-> theme_location !== 'primary') {
		$current_user = wp_get_current_user();
        	$user=$current_user->user_nicename ;
		$profilelink = '<li><a href="/forums/users/' . $user . '/edit">Edit Profile</a></li>';
		$items .= '<li><a href="'. site_url('my-account/') .'">My Account</a></li>';
		$items .= $profilelink;
		$items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
			}
	elseif (!is_user_logged_in() && $args-> theme_location !== 'primary') {
		$items .= '<li><a href="'. wp_login_url() .'">Log In</a></li>';
		$items .= '<li><a href="'. wp_registration_url() .'">Register</a></li>';
	}
	return $items;
}

add_action( 'init', 'jk_remove_storefront_header_search' );
function jk_remove_storefront_header_search() {
remove_action( 'storefront_header', 'storefront_product_search', 40 );
}


