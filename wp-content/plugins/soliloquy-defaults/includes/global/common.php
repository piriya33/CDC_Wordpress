<?php
/**
 * Common class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy_Defaults
 * @author  Tim Carr
 */
class Soliloquy_Defaults_Common {

    /**
     * Holds the class object.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public static $instance;

    /**
     * Path to the file.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Holds the Soliloquy Default ID.
     *
     * @since 1.0.0
     *
     * @var int
     */
    public $slider_default_id;

    /**
     * Primary class constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        
        // Get Soliloquy Default ID
        $this->slider_default_id = get_option( 'soliloquy_default_slider' );

        // Filters
        add_filter( 'soliloquy_defaults', array( $this, 'get_config_defaults' ), 99, 2 );

    }
    
    /**
	 * Retrieves the defaults slider ID for holding default settings.
	 *
	 * @since 1.0.0
	 *
	 * @return int The post ID for the default settings.
	 */
	function get_slider_default_id() {
	
	    return get_option( 'soliloquy_default_slider' );
	
	}

    /**
     * Overrides Soliloquy config defaults with those stored in the Soliloquy Default Post
     *
     * @since 1.0.0
     *
     * @param array $defaults Defaults
     * @param int $post_id Post ID
     * @return array Defaults
     */
    function get_config_defaults( $defaults, $post_id ) {

        // If the request includes an soliloquy_defaults_config_id, inherit
        // the configuration from that
        if ( function_exists( 'get_current_screen' ) ) {
            $screen = get_current_screen();
            if ( is_object( $screen ) && $screen->action == 'add' && $screen->post_type == 'soliloquy' && isset( $_REQUEST['soliloquy_defaults_config_id'] ) ) {
                $this->slider_default_id = absint( $_REQUEST['soliloquy_defaults_config_id'] );
            }   
        } 

        // Check Slider Post exists
        if ( ! $this->slider_default_id ) {
            return $defaults;
        }

        // Check we are not editing the Soliloquy Slider Defaults Post
        // If we are, we don't want to do anything right now
        if ( $this->slider_default_id == $post_id ) {
            return $defaults;
        }

        $default_slider = Soliloquy::get_instance()->get_slider( $this->slider_default_id );
        if ( ! $default_slider ) {
            return $defaults;
        }

        // Default Slider exists - map its settings onto our defaults
        $new_defaults = $default_slider['config'];

        // Map the type back, so we don't end up creating another 'defaults' Slider type 
        $new_defaults['type'] = $defaults['type'];

        // Unset some defaults that we don't want to copy to the new slider, as these will break things
        unset( $new_defaults['title'] );
        unset( $new_defaults['slug'] );
        
        // Return
        return $new_defaults;

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_Defaults_Common object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Defaults_Common ) ) {
            self::$instance = new Soliloquy_Defaults_Common();
        }

        return self::$instance;

    }

}

// Load the common class.
$soliloquy_defaults_common = Soliloquy_Defaults_Common::get_instance();