<?php
/**
 * AJAX class.
 *
 * @since 2.0.1
 *
 * @package Soliloquy_Defaults
 * @author  Tim Carr
 */
class Soliloquy_Defaults_Ajax {

    /**
     * Holds the class object.
     *
     * @since 2.0.1
     *
     * @var object
     */
    public static $instance;

    /**
     * Path to the file.
     *
     * @since 2.0.1
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Holds the base class object.
     *
     * @since 2.0.1
     *
     * @var object
     */
    public $base;

    /**
     * Primary class constructor.
     *
     * @since 2.0.1
     */
    public function __construct() {

        // Actions
        add_action( 'wp_ajax_soliloquy_defaults_config_modal', array( $this, 'config_modal' ) );

    }

    /**
    * The markup to display in the Thickbox modal when a user clicks 'Add New'
    * Allows the user to choose which Slider, if any, to inherit the configuration from
    * when creating a new Slider.
    *
    * @since 2.0.1
    */
    public function config_modal() {

        // Get instances
        $base = Soliloquy::get_instance();
        
        // Get sliders
        $sliders = $base->get_sliders();
        ?>
        <div class="wrap">
            <form action="" method="get" id="soliloquy-defaults-config">
                <label for="slider_id"><?php esc_html_e( 'Inherit Config from:', 'soliloquy-defaults' ); ?></label>
                <select name="slider_id" size="1" id="slider_id">
                    <option value=""><?php esc_html_e( '(Use Soliloquy Default Settings)', 'soliloquy-defaults' ); ?></option>
                    <?php
                    foreach ( (array) $sliders as $slider ) {
                        // Get title
                        $title = $slider['config']['title'];
                        ?>
                        <option value="<?php echo $slider['id']; ?>"><?php echo $title; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input type="submit" name="submit" value="<?php esc_html_e( 'Create Slideshow', 'soliloquy-defaults' ); ?>" class="button button-primary" />
            </form>
        </div>
        <?php

        die();

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 2.0.1
     *
     * @return object The Soliloquy_Defaults_Ajax object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Defaults_Ajax ) ) {
            self::$instance = new Soliloquy_Defaults_Ajax();
        }

        return self::$instance;

    }

}

// Load the AJAX class.
$soliloquy_defaults_ajax = Soliloquy_Defaults_Ajax::get_instance();