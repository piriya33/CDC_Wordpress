<?php
/**
 * Common class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy_Defaults
 * @author  Tim Carr
 */
class Soliloquy_Defaults_Metaboxes {

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
     * Holds the base class object.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public $base;
    
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

		// Load the base class object.
        $this->base = Soliloquy_Defaults::get_instance();
        
        // Get Soliloquy Slider Default ID
        $this->slider_default_id = get_option( 'soliloquy_default_slider' );

        // Actions and Filters
        add_filter( 'soliloquy_slider_types', array( $this, 'add_default_type' ), 9999, 2 );
        add_action( 'soliloquy_display_defaults', array( $this, 'images_display' ) );
        
    }
    
    /**
	 * Changes the available Slider Type to Default if the user is editing
	 * the Slider Default Post
	 *
	 * @since 1.0.0
	 *
	 * @param array $types Slider Types
	 * @param WP_Post $post WordPress Post
	 * @return array Slider Types
	 */
    public function add_default_type( $types, $post ) {
	    
	    // Check Post = Default
        if ( get_post_type( $post ) != 'soliloquy' ) {
            return $types;
        }
        if ( $post->ID != $this->slider_default_id) {
            return $types;
        }

	    // Change Types = Default only
	    $types = array(
		    'defaults' => esc_attr__( 'Default Settings', 'soliloquy-defaults' ),
	    );
	    
	    return $types;
	    
    }
    
    /**
	 * Display output for the Images Tab
	 *
	 * @since 1.0.0
	 * @param WP_Post $post WordPress Post
	 */
    public function images_display( $post ) {
		
		?>
		<div id="soliloquy-defaults">
			<h3><?php esc_html_e( 'Default Slider Settings', 'soliloquy-defaults' ); ?></h3>
        	<p class="soliloquy-intro">
	        	<?php esc_html_e( 'This slider and its settings will be used as defaults for any new sliders you create on this site. Any of these settings can be overwritten on an individual slider basis via template tag arguments or shortcode parameters.', 'soliloquy-defaults' ); 
				?>
	        </p>
	       <div class="soliloquy-help-video"> 
		       <div class="soliloquy-yt">
			   <iframe width="560" height="315" src="https://www.youtube.com/embed/HYs7-48Ru4k" frameborder="0" allowfullscreen></iframe>
		       </div>
	       </div>
	        <a href="http://soliloquywp.com/docs/defaults-addon/" class="button button-soliloquy" target="_blank"><?php esc_html_e( 'Click here for Defaults Addon documentation.', 'soliloquy-defaults' ); ?></a>
	        
    	</div>
    	<?php
		    
    }
    
    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_Defaults_Metaboxes object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Defaults_Metaboxes ) ) {
            self::$instance = new Soliloquy_Defaults_Metaboxes();
        }

        return self::$instance;

    }

}

// Load the metaboxes class.
$soliloquy_defaults_metaboxes = Soliloquy_Defaults_Metaboxes::get_instance();