<?php
/**
 * Common class.
 *
 * @since 2.2.0
 *
 * @package Soliloquy_Schedule
 * @author  Tim Carr
 */
class Soliloquy_Schedule_Common {

    /**
     * Holds the class object.
     *
     * @since 2.2.0
     *
     * @var object
     */
    public static $instance;

    /**
     * Path to the file.
     *
     * @since 2.2.0
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Holds the base class object.
     *
     * @since 2.2.0
     *
     * @var object
     */
    public $base;

    /**
     * Primary class constructor.
     *
     * @since 2.1.9
     */
    public function __construct() {

        add_filter( 'soliloquy_defaults', array( $this, 'defaults' ), 10, 2 );
        add_filter( 'soliloquy_meta_defaults', array( $this, 'meta_defaults' ), 10, 3 );

    }
    
    /**
     * Applies a default to the addon setting.
     *
     * @since 1.0.0
     *
     * @param array $defaults  Array of default config values.
     * @param int $post_id     The current post ID.
     * @return array $defaults Amended array of default config values.
     */
    public function defaults( $defaults, $post_id ) {

        // Schedule addon defaults.
        $defaults['schedule']               = 0;
        $defaults['schedule_start']         = '';
        $defaults['schedule_end']           = '';

        // Featured Content Addon
        $defaults['fc_start_date']       = '';
        $defaults['fc_end_date']         = '';
        $defaults['fc_age']              = '';

        return $defaults;

    }

    /**
     * Applies a default to the addon meta settings.
     *
     * @since 1.0.0
     *
     * @param array $defaults  Array of default config values.
     * @param int $post_id     The current post ID.
     * @param int $attach_id   The current attachment ID.
     * @return array $defaults Amended array of default config values.
     */
    public function meta_defaults( $defaults, $post_id, $attach_id ) {

        // Schedule addon meta defaults.
        $defaults['schedule_meta']       = 0;
        $defaults['schedule_meta_start'] = '';
        $defaults['schedule_meta_end']   = '';
        $defaults['schedule_ignore_date']= 0;

        return $defaults;

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 2.2.0
     *
     * @return object The Soliloquy_Schedule_Common object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Schedule_Common ) ) {
            self::$instance = new Soliloquy_Schedule_Common();
        }

        return self::$instance;

    }

}

// Load the common class.
$soliloquy_schedule_common = Soliloquy_Schedule_Common::get_instance();