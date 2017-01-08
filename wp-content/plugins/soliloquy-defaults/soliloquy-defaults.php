<?php
/**
 * Plugin Name: Soliloquy - Defaults Addon
 * Plugin URI:  https://soliloquywp.com
 * Description: Enables defaults to be set and inherited by new Soliloquy sliders.
 * Author:      Soliloquy Teams
 * Author URI:  https://soliloquywp.com
 * Version:     2.1.2
 * Text Domain: soliloquy-defaults
 * Domain Path: languages
 *
 * Soliloquy is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Soliloquy is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Soliloquy. If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main plugin class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy_Defaults
 * @author  Tim Carr
 */
class Soliloquy_Defaults {

    /**
     * Holds the class object.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public static $instance;

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $version = '2.1.2';

    /**
     * The name of the plugin.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $plugin_name = 'Soliloquy Defaults';

    /**
     * Unique plugin slug identifier.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $plugin_slug = 'soliloquy-defaults';

    /**
     * Plugin file.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Primary class constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {

        // Load the plugin textdomain.
        add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

        // Load the plugin.
        add_action( 'soliloquy_init', array( $this, 'init' ), 99 );

    }

    /**
     * Loads the plugin textdomain for translation.
     *
     * @since 1.0.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain( $this->plugin_slug, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

    }

    /**
     * Fired when the plugin is activated.
     *
     * @since 1.0.0
     *
     * @global object $wpdb         The WordPress database object.
     * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false otherwise.
     */
    public function activate( $network_wide = false ) {

        // Bail if the main class does not exist.
        if ( ! class_exists( 'Soliloquy' ) ) {
            return;
        }

        // Check if we are on a multisite install, activating network wide, or a single install
        if ( is_multisite() && $network_wide ) {
            // Multisite network wide activation
            // Iterate through each blog in multisite, creating a default slider if needed
            $sites = wp_get_sites( array(
                'limit' => 0,
            ) );
            if ( is_array( $sites ) && count( $sites ) > 0 ) {
                foreach ( $sites as $site ) {
                    switch_to_blog( $site['blog_id'] );
                    $this->generate_default_slider();
                    restore_current_blog();
                }
            }
        } else {
            // Single Site - create a default slider if needed
            $this->generate_default_slider();
        }

    }

    /**
    * Checks if a Default Slider already exists. If not, a default slider is created.
    *
    * @since 1.0.0.
    */
    public function generate_default_slider() {

        global $wpdb;

        $fields = array();

        // Get Soliloquy Instance
        $instance = Soliloquy_Common::get_instance();

        // Generate the custom gallery options holder for default galleries if it does not exist.
        $query = $wpdb->prepare( "SELECT ID FROM " . $wpdb->posts . " WHERE post_name = '%s' AND post_type = '%s' LIMIT 1",
                                 'soliloquy-default-slider',
                                 'soliloquy' );
        $exists = $wpdb->get_var( $query );
        if ( !is_null( $exists ) ) {
            return;
        }

        // Default gallery does not exist - create it
        $args = array(
            'post_type'   => 'soliloquy',
            'post_name'   => 'soliloquy-default-slider',
            'post_title'  => esc_attr__( 'Soliloquy Default Settings', 'soliloquy-defaults' ),
            'post_status' => 'publish'
        );
        $default_id = wp_insert_post( $args );

        // If successful, update our option so that we can know which gallery is default.
        if ( $default_id ) {

            update_option( 'soliloquy_default_slider', $default_id );

            // Loop through the defaults and prepare them to be stored.
            $defaults = $instance->get_config_defaults( $default_id );
            foreach ( $defaults as $key => $default ) {
                $fields['config'][$key] = $default;
            }

			//Update Fields
			$fields['id'] = $default_id;
			$fields['config']['title'] = esc_attr__( 'Soliloquy Default Settings', 'soliloquy-defaults' );
            $fields['config']['slug'] = 'soliloquy-default-slider';
            $fields['config']['classes'] = array( 'soliloquy-default-slider' );
            $fields['config']['type']	= 'defaults';
			$fields['slider']  = array();

            // Update the meta field.
            update_post_meta( $default_id, '_sol_slider_data', $fields );
        }

    }

    /**
     * Fired when the plugin is uninstalled.
     *
     * @since 1.0.0
     *
     * @global object $wpdb The WordPress database object.
     */
    function deactivate() {

        // Bail if the main class does not exist.
        if ( ! class_exists( 'Soliloquy' ) ) {
            return;
        }

        // Check if we are on a multisite install, activating network wide, or a single install
        if ( is_multisite() ) {
 			if ( is_plugin_active_for_network( 'soliloquy-defaults/soliloquy-defaults.php' ) ) {

            // Multisite network wide activation
            // Iterate through each blog in multisite, removing the default slider if needed
            $sites = wp_get_sites( array(
                'limit' => 0,
            ) );
            if ( is_array( $sites ) && count( $sites ) > 0 ) {
                foreach ( $sites as $site ) {
                    switch_to_blog( $site['blog_id'] );
                    $this->remove_default_slider();
                    restore_current_blog();
                }
            }
            }else{

	            $current_blog = get_current_blog_id();

	            switch_to_blog( $current_blog );

	            $this->remove_default_slider();

	            restore_current_blog();
            }

        } else {
            // Single Site - remove default slider if needed
            $this->remove_default_slider();
        }

    }

    /**
    * Removes the default gallery
    *
    * @since 1.0.0
    */
    public function remove_default_slider() {

        // Grab the default gallery ID and use that to delete the gallery.
        $default_id = get_option( 'soliloquy_default_slider' );
        if ( $default_id ) {
            wp_delete_post( $default_id, true );
        }

        // Delete the option.
        delete_option( 'soliloquy_default_slider' );

    }

    /**
     * Loads the plugin into WordPress.
     *
     * @since 1.0.0
     */
    public function init() {

        // Load global components.
        $this->require_global();

        // Load admin only components.
        if ( is_admin() ) {
            $this->require_admin();
        }

        // Load the updater
        add_action( 'soliloquy_updater', array( $this, 'updater' ) );

    }

    /**
     * Loads all admin related files into scope.
     *
     * @since 1.0.0
     */
    public function require_admin() {

        require plugin_dir_path( __FILE__ ) . 'includes/admin/ajax.php';
        require plugin_dir_path( __FILE__ ) . 'includes/admin/metaboxes.php';
        require plugin_dir_path( __FILE__ ) . 'includes/admin/table.php';

    }

    /**
     * Initializes the addon updater.
     *
     * @since 1.0.0
     *
     * @param string $key The user license key.
     */
    function updater( $key ) {

        $args = array(
            'plugin_name' => $this->plugin_name,
            'plugin_slug' => $this->plugin_slug,
            'plugin_path' => plugin_basename( __FILE__ ),
            'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . $this->plugin_slug,
            'remote_url'  => 'http://soliloquywp.com/',
            'version'     => $this->version,
            'key'         => $key,
        );
        $this->soliloquy_defaults_updater = new Soliloquy_Updater( $args );

    }

    /**
     * Loads all global files into scope.
     *
     * @since 1.0.0
     */
    public function require_global() {

        require plugin_dir_path( __FILE__ ) . 'includes/global/common.php';

    }

     /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_Defaults object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Defaults ) ) {
            self::$instance = new Soliloquy_Defaults();
        }

        return self::$instance;

    }

}

// Load the main plugin class.
$soliloquy_defaults = Soliloquy_Defaults::get_instance();

// Register activation and deactivation hooks
register_activation_hook( __FILE__, array( &$soliloquy_defaults, 'activate' ) );
register_deactivation_hook( __FILE__, array( &$soliloquy_defaults, 'deactivate' ) );
add_action( 'activate_wpmu_site', array( &$soliloquy_defaults, 'activate' ) );