<?php
/**
 * Common class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy_Defaults
 * @author  Tim Carr
 */
class Soliloquy_Defaults_Table {

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
        add_action( 'admin_enqueue_scripts', array( $this, 'styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
        add_action( 'admin_head', array( $this, 'remove_checkbox' ) );
        add_filter( 'page_row_actions', array( $this, 'remove_row_actions' ), 10, 2 );
        add_filter( 'post_row_actions', array( $this, 'remove_row_actions' ), 10, 2 );

    }

    /**
    * Register and enqueue styles for the Admin UI
    *
    * @since 2.0.1
    */
    public function styles() {

        wp_enqueue_style( 'thickbox' );

    }

    /** 
    * Register and enqueue scripts for the Admin UI
    *
    * @since 2.0.1
    */
    public function scripts() {

        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( $this->base->plugin_slug . '-admin', plugins_url( 'assets/js/min/admin-min.js', $this->base->file ), array( 'jquery' ), $this->base->version, true ); 
        wp_localize_script( 
            $this->base->plugin_slug . '-admin',
            'soliloquy_defaults',
            array(
                'modal_title'=> esc_attr__( 'Create a new Slider', 'soliloquy-defaults' ),
                'modal_url'  => add_query_arg( array(
                    'action' => 'soliloquy_defaults_config_modal',
                    'width'  => 500,
                    'height' => 100,
                ), admin_url( 'admin-ajax.php' ) ),
            )
        );

    }
    
    /**
	 * Removes the Checkbox from the Soliloquy Default Post
	 * This prevents accidental trashing of the Post
	 *
	 * @since 1.0.0
	 * 
	 */
	public function remove_checkbox() {

		if ( isset( get_current_screen()->post_type ) && 'soliloquy' == get_current_screen()->post_type ) {
	        ?>
	        <script type="text/javascript">
	            jQuery(document).ready(function($){
	                $('#post-<?php echo $this->slider_default_id; ?> .check-column, #post-<?php echo $this->slider_default_id; ?> .column-shortcode, #post-<?php echo $this->slider_default_id; ?> .column-template, #post-<?php echo $this->slider_default_id; ?> .column-images').empty();
	            });
	        </script>
	        <?php
	    }
	    
	}
   
	/**
	 * Removes Trash and View actions from the Soliloquy Default Slide Post
	 *
	 * @since 1.0.0
	 *
	 * @param array $actions Post Row Actions
	 * @param WP_Post $post WordPress Post
	 * @return array Post Row Actions
	 */
	public function remove_row_actions( $actions, $post ) {
		
		// Check Post = Soliloquy Default Post
		if ( get_post_type( $post ) != 'soliloquy' ) {
			return $actions;
		}
		if ( $post->ID != $this->slider_default_id ) {
			return $actions;
		}
		
		// If here, this is the Soliloquy Default Post
		// Remove View + Trash Actions
		unset( $actions['trash'], $actions['view'] );
		
		return $actions;
		
	}  
    
    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_Defaults_Table object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Defaults_Table ) ) {
            self::$instance = new Soliloquy_Defaults_Table();
        }

        return self::$instance;

    }

}

// Load the table class.
$soliloquy_defaults_table = Soliloquy_Defaults_Table::get_instance();