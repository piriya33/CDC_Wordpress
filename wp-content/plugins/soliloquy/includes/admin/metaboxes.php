<?php
/**
 * Metabox class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy
 * @author  Thomas Griffin
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists( 'Soliloquy_Metaboxes' ) ):

	class Soliloquy_Metaboxes{

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
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		function __construct(){

			$this->base = Soliloquy::get_instance();

			//Fix Plugin JS conflicts
			add_action( 'admin_enqueue_scripts', array( $this, 'fix_plugin_js_conflicts' ), 100 );

	        // Load metabox assets.
	        add_action( 'admin_enqueue_scripts', array( $this, 'metabox_styles' ) );
	        add_action( 'admin_enqueue_scripts', array( $this, 'metabox_scripts' ) );

	        // Load the metabox hooks and filters.
			add_action('edit_form_after_title', array( $this, 'uploader_html' ), 10 );
			add_action('edit_form_after_title', array( $this, 'settings_html' ), 11 );
	        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 100 );

			// Modals
			add_filter( 'media_view_strings', array( $this, 'media_view_strings' ) );

	        // Load all tabs.
	        add_action( 'soliloquy_tab_slider', array( $this, 'images_tab' ) );
	        add_action( 'soliloquy_tab_config', array( $this, 'config_tab' ) );
	        add_action( 'soliloquy_tab_mobile', array( $this, 'mobile_tab' ) );
	        add_action( 'soliloquy_tab_misc', array( $this, 'misc_tab' ) );

	        // Add action to save metabox config options.
	        add_action( 'save_post', array( $this, 'save_meta_boxes' ), 10, 2 );

		}

	    /**
	    * Changes strings in the modal image selector if we're editing an Soliloquy
	    *
	    * @since 2.5
	    *
	    * @param    array   $strings    Media View Strings
	    * @return   array               Media View Strings
	    */
	    public function media_view_strings( $strings ) {

	        // Check if we can get a current screen
	        // If not, we're not on an Soliloquy screen so we can bail
	        if ( ! function_exists( 'get_current_screen' ) ) {
	            return $strings;
	        }

	        // Get the current screen
	        $screen = get_current_screen();

	        // Check we're editing an Soliloquy CPT
	        if ( ! $screen ) {
	            return $strings;
	        }
	        if ( $screen->post_type != 'soliloquy' ) {
	            return $strings;
	        }

	        // If here, we're editing an Soliloquy CPT
	        // Modify some of the media view's strings
	        $strings['insertIntoPost'] = esc_attr__( 'Insert into Slider', 'soliloquy' );
	        $strings['inserting'] = esc_attr__( 'Inserting...', 'soliloquy' );
			$strings['insertHTML'] = esc_attr__( 'Insert HTML Slide', 'soliloquy' );
			$strings['soliloquyVideosTitle']             = esc_attr__( 'Insert Video Slide', 'soliloquy' );
			$strings['soliloquyVideosValidationError']   = esc_attr__( 'Please ensure all required fields are specified for each video you want to add to the Slider.', 'soliloquy' );
			$strings['SoliloquyHTMLTitle']             = esc_attr__( 'Insert HTML Slide', 'soliloquy' );
			$strings['SoliloquyHTMLValidationError']   = esc_attr__( 'Please ensure all required fields are specified for each video you want to add to the Slider.', 'soliloquy' );

	        // Allow addons to filter strings
	        $strings = apply_filters( 'soliloquy_media_view_strings', $strings, $screen );

	        // Return
	        return $strings;

	    }

		/**
		 * metabox_styles function.
		 *
		 * @access public
		 * @return void
		 */
		public function metabox_styles(){

	        if ( isset( get_current_screen()->base ) && 'post' !== get_current_screen()->base ) {
	            return;
	        }

	        if ( isset( get_current_screen()->post_type ) && in_array( get_current_screen()->post_type, $this->get_skipped_posttypes() ) ) {
	            return;
	        }

	        // Load necessary metabox styles.
	        wp_register_style( $this->base->plugin_slug . '-metabox-style', plugins_url( 'assets/css/metabox.css', $this->base->file ), array(), $this->base->version );
	        wp_enqueue_style( $this->base->plugin_slug . '-metabox-style' );

	        wp_register_style( $this->base->plugin_slug . '-codemirror', plugins_url( 'assets/css/codemirror.css', $this->base->file ), array(), $this->base->version );
	        wp_enqueue_style( $this->base->plugin_slug . '-codemirror' );
			wp_enqueue_style( 'editor-button-css' );
	        // Fire a hook to load in custom metabox styles.
	        do_action( 'soliloquy_metabox_styles' );

		}

		/**
		 * metabox_scripts function.
		 *
		 * @access public
		 * @return void
		 */
		public function metabox_scripts( $hook ){

	        global $id, $post;

	        if ( isset( get_current_screen()->base ) && 'post' !== get_current_screen()->base ) {
	            return;
	        }

	        if ( isset( get_current_screen()->post_type ) && in_array( get_current_screen()->post_type, $this->get_skipped_posttypes() ) ) {
	            return;
	        }

	        // Set the post_id for localization.
	        $post_id = isset( $post->ID ) ? $post->ID : (int) $id;

	        // Sortables
	        wp_enqueue_script( 'jquery-ui-sortable' );

			//Chosen JS
			wp_register_script( $this->base->plugin_slug . '-chosen', plugins_url( 'assets/js/min/chosen.jquery-min.js', $this->base->file ), array( 'jquery' ), $this->base->version, true );
			wp_enqueue_script( $this->base->plugin_slug . '-chosen' );

	        // Image Uploader
	        wp_enqueue_media( array(
	            'post' => $post_id,
	        ) );
	        add_filter( 'plupload_init', array( $this, 'plupload_init' ) );
	        wp_register_script( $this->base->plugin_slug . '-media-upload', plugins_url( 'assets/js/media-upload.js', $this->base->file ), array( 'jquery' ), $this->base->version, true );
	        wp_enqueue_script( $this->base->plugin_slug . '-media-upload' );
	        wp_localize_script(
	            $this->base->plugin_slug . '-media-upload',
	            'soliloquy_media_uploader',
	            array(
	                'ajax'           => admin_url( 'admin-ajax.php' ),
	                'id'             => $post_id,
	                'uploader_files_computer'	=> esc_attr__( 'Select Files from Your Computer', 'soliloquy' ),
	                'uploader_info_text'		=> esc_attr__( 'Drag and Drop Files to Upload', 'soliloquy' ),
	                'load_image'     => wp_create_nonce( 'soliloquy-load-image' ),
	                'media_position' => get_option( 'soliloquy_slide_position' ),
	            )
	        );

	        // Load necessary metabox scripts.
	        wp_enqueue_script( 'plupload-handlers' );

	        //Load Code Mirror
	        wp_register_script( $this->base->plugin_slug . '-codemirror', plugins_url( 'assets/js/lib/codemirror.js', $this->base->file ), array(), $this->base->version, true );
	        wp_enqueue_script( $this->base->plugin_slug . '-codemirror' );

			//Load Clipboard
	        wp_register_script( $this->base->plugin_slug . '-clipboard', plugins_url( 'assets/js/min/clipboard-min.js', $this->base->file ), array( 'jquery' ), $this->base->version, true );
		    wp_enqueue_script( $this->base->plugin_slug . '-clipboard' );

	        //Load Chosen
	        wp_register_script( $this->base->plugin_slug . '-chosen', plugins_url( 'assets/js/min/chosen.jquery-min.js', $this->base->file ), array(), $this->base->version, true );
		    wp_enqueue_script( $this->base->plugin_slug . '-chosen' );

	        // Form Conditionals
	        wp_register_script( 'jquery-form-conditionals', plugins_url( 'assets/js/min/jquery.form-conditionals-min.js', $this->base->file ), array( 'jquery', 'plupload-handlers', 'quicktags', 'jquery-ui-sortable', $this->base->plugin_slug . '-codemirror' ), $this->base->version, true );
	        wp_enqueue_script( 'jquery-form-conditionals' );

	        wp_register_script( $this->base->plugin_slug . '-metabox-script', plugins_url( 'assets/js/min/metabox-min.js', $this->base->file ), array( 'jquery', 'plupload-handlers', 'quicktags', 'jquery-ui-sortable', $this->base->plugin_slug . '-codemirror' ), $this->base->version, true );
	        wp_enqueue_script( $this->base->plugin_slug . '-metabox-script' );
	        wp_localize_script(
	            $this->base->plugin_slug . '-metabox-script',
	            'soliloquy_metabox',
	            array(
	                'ajax'           			=> admin_url( 'admin-ajax.php' ),
	                'change_nonce'   			=> wp_create_nonce( 'soliloquy-change-type' ),
	                'id'             			=> $post_id,
	                'slide_width'          		=> Soliloquy_Common::get_instance()->get_config_default( 'slider_width' ),
	                'slide_height'         		=> Soliloquy_Common::get_instance()->get_config_default( 'slider_height' ),
	                'htmlcode'       			=> esc_attr__( 'HTML Slide Code', 'soliloquy' ),
	                'htmlslide'      			=> esc_attr__( 'HTML Slide Title', 'soliloquy' ),
	                'htmlplace'      			=> esc_attr__( 'Enter HTML slide title here...', 'soliloquy' ),
	                'htmlstart'      			=> esc_attr__( '<!-- Enter your HTML code here for this slide (you can delete this line). -->', 'soliloquy' ),
	                'htmluse'        			=> esc_attr__( 'Select Thumbnail', 'soliloquy' ),
	                'import'         			=> esc_attr__( 'You must select a file to import before continuing.', 'soliloquy' ),
	                'insert_nonce'   			=> wp_create_nonce( 'soliloquy-insert-images' ),
	                'inserting'      			=> esc_attr__( 'Inserting...', 'soliloquy' ),
	                'library_search' 			=> wp_create_nonce( 'soliloquy-library-search' ),
	                'load_slider'    			=> wp_create_nonce( 'soliloquy-load-slider' ),
	                'path'           			=> plugin_dir_path( 'assets' ),
	                'hosted_nonce'  			=> wp_create_nonce( 'soliloquy-is-hosted' ),
	                'refresh_nonce'  			=> wp_create_nonce( 'soliloquy-refresh' ),
	                'remove'         			=> esc_attr__( 'Are you sure you want to remove this slide from the slider?', 'soliloquy' ),
	                'remove_multiple'			=> esc_attr__( 'Are you sure you want to remove these slides from the slider?', 'soliloquy' ),
	                'remove_nonce'   			=> wp_create_nonce( 'soliloquy-remove-slide' ),
	                'removeslide'    			=> esc_attr__( 'Remove', 'soliloquy' ),
	                'save_nonce'     			=> wp_create_nonce( 'soliloquy-save-meta' ),
	                'saving'         			=> esc_attr__( 'Saving...', 'soliloquy' ),
	                'sort'           			=> wp_create_nonce( 'soliloquy-sort' ),
	                'videocaption'   			=> esc_attr__( 'Video Slide Caption', 'soliloquy' ),
	                'videoslide'     			=> esc_attr__( 'Video Slide Title', 'soliloquy' ),
	                'videoplace'     			=> esc_attr__( 'Enter video slide title here...', 'soliloquy' ),
	                'videotitle'    			=> esc_attr__( 'Video Slide URL', 'soliloquy' ),
	                'videothumb'    			=> esc_attr__( 'Video Slide Placeholder Image', 'soliloquy' ),
	                'videosrc'     				=> esc_attr__( 'Enter your video placeholder image URL here (or leave blank to pull from video itself)...', 'soliloquy' ),
	                'videoselect'   			=> esc_attr__( 'Choose Video Placeholder Image', 'soliloquy' ),
	                'videodelete'    			=> esc_attr__( 'Remove Video Placeholder Image', 'soliloquy' ),
	                'videooutput'    			=> esc_attr__( 'Enter your video URL here...', 'soliloquy' ),
	                'videoframe'    			=> esc_attr__( 'Choose a Video Placeholder Image', 'soliloquy' ),
	                'videouse'       			=> esc_attr__( 'Select Placeholder Image', 'soliloquy' ),
	                'selected'					=> esc_attr__( 'Selected', 'soliloquy' ),
	                'select_all'				=> esc_attr__( 'Select All', 'soliloquy' ),
	                'insert_placeholder'		=> esc_attr__( 'Insert Placeholder', 'soliloquy' ),
	                'insert_video'				=> esc_attr__( 'Insert Video', 'soliloquy' ),
	                'expand'					=> esc_attr__( 'Expand', 'soliloquy' ),
	                'collapse'					=> esc_attr__( 'Collapse', 'soliloquy' ),
	                'active'					=> esc_attr__( 'Active', 'soliloquy' ),
	                'draft'						=> esc_attr__( 'Draft', 'soliloquy' ),
	            )
	        );

            wp_register_script( $this->base->plugin_slug . '-media-insert-third-party', plugins_url( 'assets/js/media-insert-third-party.js', $this->base->file ), array( 'jquery' ), $this->base->version, true );
            wp_enqueue_script( $this->base->plugin_slug . '-media-insert-third-party' );
            wp_localize_script(
                $this->base->plugin_slug . '-media-insert-third-party',
                'soliloquy_media_insert',
                array(
                    'nonce'     => wp_create_nonce( 'soliloquy-media-insert' ),
                    'post_id'   => $post_id,

                    // Addons must add their slug/base key/value pair to this array to appear within the "Insert from Other Sources" modal
                    'addons'    => apply_filters( 'soliloquy_media_insert_third_party_sources', array(), $post_id ),
                )
            );

	        // If on an Soliloquy post type, add custom CSS for hiding specific things.
	        add_action( 'admin_head', array( $this, 'meta_box_css' ) );

	        // Fire a hook to load custom metabox scripts.
	        do_action( 'soliloquy_metabox_scripts' );

		}
		/**
		 * Remove plugins scripts that break Envira's admin.
		 *
		 * @access public
		 * @return void
		 */
		public function fix_plugin_js_conflicts(){

	        global $id, $post;

	        // Get current screen.
	        $screen = get_current_screen();

	        // Bail if we're not on the Envira Post Type screen.
	        if ( 'envira' !== $screen->post_type ) {
	            return;
	        }

			wp_dequeue_script( 'ngg-igw' );

		}
	    /**
	    * Amends the default Plupload parameters for initialising the Media Uploader, to ensure
	    * the uploaded image is attached to our Soliloquy CPT
	    *
	    * @since 1.0.0
	    *
	    * @param array $params Params
	    * @return array Params
	    */
	    public function plupload_init( $params ) {

	        global $post_ID;

	        // Define the Soliloquy ID, so Plupload attaches the uploaded images
	        // to this Slider
	        $params['multipart_params']['post_id'] = $post_ID;

	        // Build an array of supported file types for Plupload
	        $supported_file_types = Soliloquy_Common::get_instance()->get_supported_filetypes();

	        // Assign supported file types and return
	        $params['filters']['mime_types'] = $supported_file_types;

	        // Return and apply a custom filter to our init data.
	        $params = apply_filters( 'soliloquy_plupload_init', $params, $post_ID );
	        return $params;

	    }

    	/**
	     * Hides unnecessary meta box items on Soliloquy post type screens.
	     *
	     * @since 1.0.0
	     */
	    public function meta_box_css() {

	        ?>
	        <style type="text/css">.misc-pub-section:not(.misc-pub-post-status) { display: none; }</style>
	        <?php

	        // Fire action for CSS on Soliloquy post type screens.
	        do_action( 'soliloquy_admin_css' );

	    }

	    /**
	     * Creates metaboxes for handling and managing sliders.
	     *
	     * @since 1.0.0
	     */
	    public function add_meta_boxes() {

        	global $post;
	        // Check we're on an Soliloquy
	        if ( 'soliloquy' != $post->post_type ) {
	            return;
	        }

	        // Let's remove all of those dumb metaboxes from our post type screen to control the experience.
	        $this->remove_all_the_metaboxes();

	        // Get all public post types.
	        $post_types = get_post_types( array( 'public' => true ) );
			$custom = array(
				get_option( 'soliloquy_dynamic' ),
				get_option( 'soliloquy_default_slider' ),
			);
	        // Splice the soliloquy post type since it is not visible to the public by default.
	        $post_types[] = 'soliloquy';

	        // Loops through the post types and add the metaboxes.
	        foreach ( (array) $post_types as $post_type ) {
	            // Don't output boxes on these post types.
	            if ( in_array( $post_type, $this->get_skipped_posttypes() ) ) {
	                continue;
	            }
				if ( ! in_array( $post->ID, $custom)){


	            add_meta_box( 'soliloquy-codepanel', esc_attr__( 'Soliloquy Slider Code', 'soliloquy' ), array( $this, 'code_panel' ), $post_type, 'side', apply_filters( 'soliloquy_metabox_priority', 'low' ) );

	            }

	        }
	        // Output 'Select Files from Other Sources' button on the media uploader form
	        add_action( 'post-plupload-upload-ui', array( $this, 'append_media_upload_form' ), 1 );
	        add_action( 'post-html-upload-ui', array( $this, 'append_media_upload_form' ), 1 );
	    }

		/**
		 * Renders the Uploader HTML
		 *
		 * @access public
		 * @param mixed $post
		 * @return void
		 * @since 2.5
		 */
		public function uploader_html( $post ){

			global $id, $post;

	        if ( isset( get_current_screen()->base ) && 'post' !== get_current_screen()->base ) {
	            return;
	        }

	        if ( isset( get_current_screen()->post_type ) && in_array( get_current_screen()->post_type, $this->get_skipped_posttypes() ) ) {
	            return;
	        }


	        $dynamic = get_option( 'soliloquy_dynamic' );
			$default = get_option( 'soliloquy_default_slider' );

			//Dont show upload box for Dynamic or Default Sliders
	        if ( $post->ID === $dynamic || $post->ID === $default ){
		        return;
	        }


	        // Load view
	        $this->base->load_admin_partial( 'metabox-slider-type.php', array(
	            'post'      => $post,
	            'types'     => $this->get_soliloquy_types( $post ),
	            'instance'  => $this,
	        ) );

		}
	    /**
	     * Appends the "Select Files From Other Sources" button to the Media Uploader, which is called using WordPress'
	     * media_upload_form() function
	     *
	     * CSS positions this button to improve the layout.
	     *
	     * @since 2.5.0
	     */
	    public function append_media_upload_form() {

	        ?>
		    <!-- Add from Media Library -->
		    <a href="#" class="soliloquy-media-library button"  title="<?php esc_attr_e( 'Click Here to Insert from Other Image Sources', 'soliloquy' ); ?>" style="vertical-align: baseline;">
				<?php esc_html_e( 'Select Files from Other Sources', 'soliloquy' ); ?>
			</a>
	        <?php

	    }
		/**
		 * settings_html function.
		 *
		 * @access public
		 * @param mixed $post
		 * @return void
		 */
		public function settings_html( $post ){

	        if ( isset( get_current_screen()->base ) && 'post' !== get_current_screen()->base ) {
	            return;
	        }

	        if ( isset( get_current_screen()->post_type ) && in_array( get_current_screen()->post_type, $this->get_skipped_posttypes() ) ) {
	            return;
	        }

			// Keep security first.
			wp_nonce_field( 'soliloquy', 'soliloquy' );

			// Check for our meta overlay helper.
        	$slider_data = get_post_meta( $post->ID, '_sol_slider_data', true );
			$helper      = get_post_meta( $post->ID, '_sol_just_published', true );
			?>

			<div id="soliloquy-slider-settings">

	            <ul id="soliloquy-settings-tabs" class="soliloquy-tabs-nav soliloquy-clear" data-update-hashbang="1">

	                <?php $i = 0; foreach ( (array) $this->get_soliloquy_tab_nav() as $id => $title ) :

		            	$class = 0 === $i ? 'soliloquy-tab-nav-active' : ''; ?>

	                    <li id="soliloquy-tab-nav-<?php echo $id; ?>" data-soliloquy-tab class="soliloquy-setting-tab <?php echo $class; ?>" data-tab-id="soliloquy-tab-<?php echo $id; ?>"><a href="#soliloquy-tab-<?php echo $id; ?>" title="<?php echo $title; ?>"><span><?php echo $title; ?></span></a></li>

	                <?php $i++; endforeach; ?>

	            </ul>

				<div id="soliloquy-settings-content" class="soliloquy-clear">

	            <?php $i = 0; foreach ( (array) $this->get_soliloquy_tab_nav() as $id => $title ) :

		        	$class = 0 === $i ? 'soliloquy-tab-active' : ''; ?>

	                <div id="soliloquy-tab-<?php echo $id; ?>" class="soliloquy-tab soliloquy-clear <?php echo $class; ?>">

	                    <?php do_action( 'soliloquy_tab_' . $id, $post ); ?>

	                </div>

	            <?php $i++; endforeach; ?>

	        	</div>

				<div class="soliloquy-clearfix"></div>

			</div>

			<?php

		}

		/**
		 * sidebar_html function.
		 *
		 * @access public
		 * @return void
		 */
		public function code_panel( $post ){

        	$slider_data = get_post_meta( $post->ID, '_sol_slider_data', true );

			if ( isset( $post->post_status ) && 'auto-draft' == $post->post_status ) {
            	return;
			}

			// Check for our meta overlay helper.
			$helper = get_post_meta( $post->ID, '_sol_just_published', true );
			$class  = '';
			if ( $helper ) {
        	    $class = 'soliloquy-helper-active';
				delete_post_meta( $post->ID, '_sol_just_published' );
			}
			?>

			<p><?php esc_html_e( 'You can place this slider into your posts, pages, custom post types or widgets using the shortcode below:','soliloquy' ); ?></p>
                <code id="soliloquy-shortcode" class="soliloquy-code"><?php echo '[soliloquy id="' . $post->ID . '"]'; ?></code>
      			<a href="#" class="soliloquy-clipboard" data-clipboard-target="#soliloquy-shortcode"><?php esc_html_e( 'Copy to Clipboard', 'soliloquy' ); ?></a>

                <?php if ( ! empty( $slider_data['config']['slug'] ) ) : ?>
                    <br><code id="soliloquy-slug-shortcode" class="soliloquy-code"><?php echo '[soliloquy slug="' . $slider_data['config']['slug'] . '"]'; ?></code>
        			<a href="#" class="soliloquy-clipboard" data-clipboard-target="#soliloquy-slug-shortcode"><?php esc_html_e( 'Copy to Clipboard', 'soliloquy' ); ?></a>

                <?php endif; ?>


			<p><?php esc_html_e( "You can place this slider into your theme's template files by using the template tag below:", 'soliloquy' ); ?></p>
                <code id="soliloquy-template-tag" class="soliloquy-code"><?php echo 'if ( function_exists( \'soliloquy\' ) ) { soliloquy( \'' . $post->ID . '\' ); }'; ?></code>
			 <a href="#" class="soliloquy-clipboard" data-clipboard-target="#soliloquy-template-tag"><?php esc_html_e( 'Copy to Clipboard', 'soliloquy' ); ?></a>

                <?php if ( ! empty( $slider_data['config']['slug'] ) ) : ?>

                    <br><code id="soliloquy-slug-tag" class="soliloquy-code"><?php echo 'if ( function_exists( \'soliloquy\' ) ) { soliloquy( \'' . $slider_data['config']['slug'] . '\', \'slug\' ); }'; ?></code>
                   <a href="#" class="soliloquy-clipboard" data-clipboard-target="#soliloquy-slug-tag"><?php esc_html_e( 'Copy to Clipboard', 'soliloquy' ); ?></a>

                <?php endif; ?>

			<h2><?php esc_html_e( 'Need Help?', 'soliloquy' ); ?></h2>
			<div class="soliloquy-yt">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/wMDtHKJ-TsQ" frameborder="0" allowfullscreen></iframe>
			</div>
			<?php

		}

	    /**
	     * Callback for getting all of the tabs for Soliloquy sliders.
	     *
	     * @since 1.0.0
	     *
	     * @return array Array of tab information.
	     */
	    public function get_soliloquy_tab_nav() {

	        $tabs = array(
	            'slider'     => esc_attr__( 'Slider', 'soliloquy' ),
	            'config'     => esc_attr__( 'Config', 'soliloquy' ),
	            'mobile'     => esc_attr__( 'Mobile', 'soliloquy' ),
	        );
	        $tabs = apply_filters( 'soliloquy_tab_nav', $tabs );

	        // "Misc" tab is required.
	        $tabs['misc'] = esc_attr__( 'Misc', 'soliloquy' );

	        return $tabs;

	    }

	    /**
	     * Callback for displaying the UI for main images tab.
	     *
	     * @since 1.0.0
	     *
	     * @param object $post The current post object.
	     */
	    public function images_tab( $post ) {

	        // Output a notice if missing cropping extensions because Soliloquy needs them.

	        if ( ! $this->has_gd_extension() && ! $this->has_imagick_extension() ) {
	            ?>
	            <div class="error below-h2">
	                <p><strong><?php _e( 'The GD or Imagick libraries are not installed on your server. Soliloquy requires at least one (preferably Imagick) in order to crop images and may not work properly without it. Please contact your webhost and ask them to compile GD or Imagick for your PHP install.', 'soliloquy' ); ?></strong></p>
	            </div>
	            <?php
	        }

	        // Output the slider type selection items.
	        ?>

	        <?php

	        // Output the display based on the type of slider being created.
	        echo '<div id="soliloquy-slider-main" class="soliloquy-clear">';

	            $this->images_display( $this->get_config( 'type', $this->get_config_default( 'type' ) ), $post );

	        echo '</div>';

	    }

	    /**
	     * Returns the types of sliders available.
	     *
	     * @since 1.0.0
	     *
	     * @param object $post The current post object.
	     * @return array       Array of slider types to choose.
	     */
	    public function get_soliloquy_types( $post ) {

	        $types = array(
            	'default' => esc_attr__( 'Default', 'soliloquy' )
	        );

	        return apply_filters( 'soliloquy_slider_types', $types, $post );

	    }

	    /**
	     * Determines the Images tab display based on the type of slider selected.
	     *
	     * @since 1.0.0
	     *
	     * @param string $type The type of display to output.
	     * @param object $post The current post object.
	     */
	    public function images_display( $type = 'default', $post ) {

	        // Output a unique hidden field for settings save testing for each type of slider.
	        echo '<input type="hidden" name="_soliloquy[type_' . $type . ']" value="1" />';

	        // Output the display based on the type of slider available.
	        switch ( $type ) {
	            case 'default' :
	                $this->do_default_display( $post );
	                break;
	            default:
	                do_action( 'soliloquy_display_' . $type, $post );
	                break;
	        }

	    }

	    /**
	     * Callback for displaying the default slider UI.
	     *
	     * @since 1.0.0
	     *
	     * @param object $post The current post object.
	     */
	    public function do_default_display( $post ) {

			$common = Soliloquy_Common::get_instance();

	        // Prepare output data.
	        $slider_data = get_post_meta( $post->ID, '_sol_slider_data', true );
	        //Check if any old Lite sliders are missing data

	        if ( !empty( $slider_data ) && ! empty( $slider_data['slider'] ) && is_array( $slider_data['slider'] ) ) {

				$maybe_update = $this->maybe_update_slides( $slider_data['slider'] );

		        if ( $maybe_update == false ) {

		    		$slider_data = $this->update_slides( $post->ID );

		    	}

	        }

	        //Check if slider has an admin view set
			if ( isset( $slider_data['admin_view'] ) && $slider_data['admin_view'] != '' ){

				$slide_view =  $slider_data['admin_view'] ;

			}else{

				$slide_view = get_option( 'soliloquy_slide_view' );

			}

			$is_sortable =  $this->get_config( 'sort_order', $this->get_config_default( 'sort_order' ) ) == 'manual' ? 1 : 0;

			//Get View from settings
			$default_view =  $slide_view === 'grid' ? 'soliloquy-grid' : 'soliloquy-list';
			//Show/Hide stuff
			$visible = empty( $slider_data['slider'] ) ? ' soliloquy-hidden' : '';
			$notvisible = !empty( $slider_data['slider'] ) ? ' soliloquy-hidden' : 'soliloquy-show';

	        ?>
	        <div id="soliloquy-empty-slider" class="<?php echo $notvisible; ?>">
		        <div>
		        <img class="soliloquy-item-img" src="<?php echo plugins_url( 'assets/images/logo-color.png', $this->base->file ); ?>" />
				<h3><?php esc_html_e( 'Create your slider by adding your media files above.', 'soliloquy' ); ?></h3>
				<p class="soliloquy-help-text"><?php esc_html_e( 'Need some help?', 'soliloquy' ); ?> <a href="http://soliloquywp.com/docs/creating-your-first-slider/" target="_blank"><?php esc_html_e( 'Watch a video how to add media and create a slider', 'soliloquy' ); ?></a></p>
		        </div>
	        </div>

	        <div class="soliloquy-slide-header<?php echo $visible; ?>">

	        	<h2 class="soliloquy-intro"><?php esc_html_e('Currently in Your Slider', 'soliloquy' ); ?></h2>

				<ul class="soliloquy-list-inline soliloquy-display-toggle">
					<li class="helper" data-soliloquy-tooltip="<?php esc_attr_e( 'Changes Slide Order.', 'soliloquy' ); ?>"><span class="dashicons dashicons-editor-help"></span></li>
					<li class="soliloquy-select">

	                            <select id="soliloquy-config-slide-sort" name="_soliloquy[sort_order]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                                <?php foreach ( (array) $this->get_slider_sort() as $i => $data ) : ?>
	                                    <option value="<?php echo $data['value']; ?>"<?php selected( $data['value'], $this->get_config( 'sort_order', $this->get_config_default( 'sort_order' ) ) ); ?>><?php echo $data['name']; ?></option>
	                                <?php endforeach; ?>
	                            </select>
	        		<li><a href="#" class="soliloquy-display-grid soliloquy-display<?php echo $slide_view == 'grid' ? ' active-display' : ''; ?>" data-soliloquy-display="grid"><i class="soliloquy-icon-grid"></i></a></li>
					<li><a href="#" class="soliloquy-display-list soliloquy-display<?php echo $slide_view == 'list' ? ' active-display' : ''; ?>" data-soliloquy-display="list"><i class="soliloquy-icon-list"></i></a></li>
				</ul>

				<label>

					<input class="soliloquy-select-all" type="checkbox">

					<span class="select-all"><?php esc_html_e( 'Select All', 'soliloquy' ); ?></span> (<span class="soliloquy-count">0</span>)
					<a href="#" class="soliloquy-clear-selected"><?php esc_html_e( 'Clear Selected' , 'soliloquy' ); ?></a>
				</label>

	        </div>

       		<div class="soliloquy-bulk-actions">

				<a href="#" class="button button-soliloquy-delete soliloquy-slides-delete"><?php esc_html_e( 'Delete selected files from slider', 'soliloquy' ); ?></a>
				<a href="#" class="button button-soliloquy-secondary soliloquy-slides-edit"><?php esc_html_e( 'Edit Selected Slides', 'soliloquy' ); ?></a>

			</div>

	        <ul id="soliloquy-output" class="<?php echo $default_view; ?> soliloquy-clear" data-view="<?php echo $slide_view; ?>" data-sortable="<?php echo $is_sortable; ?>">

	            <?php if ( ! empty( $slider_data['slider'] ) ) : ?>

	                <?php foreach ( $slider_data['slider'] as $id => $data ) : ?>

	                    <?php  echo $this->get_slider_item( $id, $data, ( ! empty( $data['type'] ) ? $data['type'] : 'image' ), $post->ID ); ?>

	                <?php endforeach; ?>

	            <?php endif; ?>

	        </ul>

			<div class="soliloquy-bulk-actions">

				<a href="#" class="button button-soliloquy-delete soliloquy-slides-delete"><?php esc_html_e( 'Delete selected files from slider', 'soliloquy' ); ?></a>
				<a href="#" class="button button-soliloquy-secondary soliloquy-slides-edit"><?php esc_html_e( 'Edit Selected Slides', 'soliloquy' ); ?></a>

			</div>
		<?php

	    }

	    /**
	     * Callback for displaying the UI for setting slider config options.
	     *
	     * @since 1.0.0
	     *
	     * @param object $post The current post object.
	     */
	    public function config_tab( $post ) {

	        ?>
	        <div id="soliloquy-config">
		        <div class="soliloquy-config-header">
					<h2 class="soliloquy-intro"><?php esc_html_e( 'The settings below adjust the basic configuration options for the slider display.', 'soliloquy' ); ?></h2>
					<p class="soliloquy-help"><?php esc_html_e( 'Need some help?', 'soliloquy' ); ?><a href="http://soliloquywp.com/docs/configuring-your-slider/" target="_blank"><?php esc_html_e( ' Watch a video on how to setup your slider configuration', 'soliloquy' ); ?></a></p>
		        </div>

	            <table class="form-table">

	                <tbody>

	                    <tr id="soliloquy-config-slider-theme-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-slider-theme"><?php esc_html_e( 'Slider Theme', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
		                        <div class="soliloquy-select">
		                            <select id="soliloquy-config-slider-theme" name="_soliloquy[slider_theme]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
		                                <?php foreach ( (array) $this->get_slider_themes() as $i => $data ) : ?>
		                                    <option value="<?php echo $data['value']; ?>"<?php selected( $data['value'], $this->get_config( 'slider_theme', $this->get_config_default( 'slider_theme' ) ) ); ?>><?php echo $data['name']; ?></option>
		                                <?php endforeach; ?>
		                            </select>
		                        </div>
	                            <p class="description"><?php esc_html_e( 'Sets the theme for the slider display.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-image-size-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-slider-width"><?php esc_html_e( 'Image Size', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
		                        <div class="soliloquy-select">

	                            <select id="soliloquy-config-slider-size" name="_soliloquy[slider_size]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                                <?php foreach ( (array) $this->get_slider_sizes() as $i => $data ) : ?>
	                                    <option value="<?php echo $data['value']; ?>" data-soliloquy-width="<?php echo $data['width']; ?>" data-soliloquy-height="<?php echo $data['height']; ?>"<?php selected( $data['value'], $this->get_config( 'slider_size', $this->get_config_default( 'slider_size' ) ) ); ?>><?php echo $data['name']; ?></option>
	                                <?php endforeach; ?>
	                            </select>

	                            </div>

	                            <p class="description"><?php esc_html_e( 'Define the maximum image size for the slider. Default will use the below Image Dimensions.', 'soliloquy' ); ?></p>

	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-slider-size-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-slider-width"><?php esc_html_e( 'Slider Dimensions', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-slider-width" type="number" name="_soliloquy[slider_width]" value="<?php echo absint( $this->get_config( 'slider_width', $this->get_config_default( 'slider_width' ) ) ); ?>" /> &#215; <input id="soliloquy-config-slider-height" type="number" name="_soliloquy[slider_height]" value="<?php echo absint( $this->get_config( 'slider_height', $this->get_config_default( 'slider_height' ) ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy' ); ?></span>
	                            <p class="description"><?php esc_html_e( 'Sets the width and height dimensions for the slider.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-dimensions-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-dimensions"><?php esc_html_e( 'Set Dimensions on Images?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-dimensions" type="checkbox" name="_soliloquy[dimensions]" value="<?php echo $this->get_config( 'dimensions', $this->get_config_default( 'dimensions' ) ); ?>" <?php checked( $this->get_config( 'dimensions', $this->get_config_default( 'dimensions' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables the width and height attributes on the img element. Only needs to be enabled if you need to meet Google Pagespeeds requirements, or if you\'re using Photon CDN and having issues with slider images displaying.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-crop-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-slider"><?php esc_html_e( 'Crop Images in Slider?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-slider" type="checkbox" name="_soliloquy[slider]" value="<?php echo $this->get_config( 'slider', $this->get_config_default( 'slider' ) ); ?>" <?php checked( $this->get_config( 'slider', $this->get_config_default( 'slider' ) ), 1 ); ?> />
	                            <span class="description"><?php _e( 'Enables or disables image cropping based on slider dimensions <strong>(recommended)</strong>.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-smooth-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-smooth"><?php esc_html_e( 'Use Adaptive Height?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-smooth" type="checkbox" name="_soliloquy[smooth]" value="<?php echo $this->get_config( 'smooth', $this->get_config_default( 'smooth' ) ); ?>" <?php checked( $this->get_config( 'smooth', $this->get_config_default( 'smooth' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Allows the slider to adapt smoothly to slides with different sizes.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-position-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-position"><?php esc_html_e( 'Slider Position', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
		                        <div class="soliloquy-select">

	                            <select id="soliloquy-config-position" name="_soliloquy[position]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                                <?php foreach ( (array) $this->get_slider_positions() as $i => $data ) : ?>
	                                    <option value="<?php echo $data['value']; ?>"<?php selected( $data['value'], $this->get_config( 'position', $this->get_config_default( 'position' ) ) ); ?>><?php echo $data['name']; ?></option>
	                                <?php endforeach; ?>
	                            </select>
		                        </div>
	                            <p class="description"><?php esc_html_e( 'Sets the position of the slider on the page.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-caption-position-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-position-delay"><?php esc_html_e( 'Caption Position', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
		                        <div class="soliloquy-select">

	                            <select id="soliloquy-caption-position" name="_soliloquy[caption_position]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                                <?php foreach ( (array) $this->get_caption_positions() as $i => $data ) : ?>
	                                    <option value="<?php echo $data['value']; ?>"<?php selected( $data['value'], $this->get_config( 'caption_position', $this->get_config_default( 'caption_position' ) ) ); ?>><?php echo $data['name']; ?></option>
	                                <?php endforeach; ?>
	                            </select>
		                        </div>
	                            <p class="description"><?php esc_html_e( 'The position of the caption for each slide, if specified.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-gutter-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-gutter"><?php esc_html_e( 'Slider Gutter', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-gutter" type="number" name="_soliloquy[gutter]" value="<?php echo absint( $this->get_config( 'gutter', $this->get_config_default( 'gutter' ) ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy' ); ?></span>
	                            <p class="description"><?php esc_html_e( 'Sets the gutter between the slider and your content based on slider position.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-arrows-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-arrows"><?php esc_html_e( 'Show Slider Arrows?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-arrows" type="checkbox" name="_soliloquy[arrows]" value="<?php echo $this->get_config( 'arrows', $this->get_config_default( 'arrows' ) ); ?>" <?php checked( $this->get_config( 'arrows', $this->get_config_default( 'arrows' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables slider navigation arrows.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-control-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-control"><?php esc_html_e( 'Show Slider Control Nav?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-control" type="checkbox" name="_soliloquy[control]" value="<?php echo $this->get_config( 'control', $this->get_config_default( 'control' ) ); ?>" <?php checked( $this->get_config( 'control', $this->get_config_default( 'control' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables slider control (typically circles) navigation.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-pauseplay-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-pauseplay"><?php esc_html_e( 'Show Pause/Play Controls?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-pauseplay" type="checkbox" name="_soliloquy[pauseplay]" value="<?php echo $this->get_config( 'pauseplay', $this->get_config_default( 'pauseplay' ) ); ?>" <?php checked( $this->get_config( 'pauseplay', $this->get_config_default( 'pauseplay' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables slider pause/play elements.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-keyboard-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-keyboard"><?php esc_html_e( 'Enable Keyboard Navigation?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-keyboard" type="checkbox" name="_soliloquy[keyboard]" value="<?php echo $this->get_config( 'keyboard', $this->get_config_default( 'keyboard' ) ); ?>" <?php checked( $this->get_config( 'keyboard', $this->get_config_default( 'keyboard' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables keyboard navigation for the slider.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-mousewheel-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-mousewheel"><?php esc_html_e( 'Enable Mousewheel Navigation?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-mousewheel" type="checkbox" name="_soliloquy[mousewheel]" value="<?php echo $this->get_config( 'mousewheel', $this->get_config_default( 'mousewheel' ) ); ?>" <?php checked( $this->get_config( 'mousewheel', $this->get_config_default( 'mousewheel' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables mousewheel navigation in the slider.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-loop-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-loop"><?php esc_html_e( 'Loop Slider?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-loop" type="checkbox" name="_soliloquy[loop]" value="<?php echo $this->get_config( 'loop', $this->get_config_default( 'loop' ) ); ?>" <?php checked( $this->get_config( 'loop', $this->get_config_default( 'loop' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables slider looping.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-random-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-random"><?php esc_html_e( 'Randomize Slider?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-random" type="checkbox" name="_soliloquy[random]" value="<?php echo $this->get_config( 'random', $this->get_config_default( 'random' ) ); ?>" <?php checked( $this->get_config( 'random', $this->get_config_default( 'random' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Randomizes slides in the slider.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-auto-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-auto"><?php esc_html_e( 'Autostart Slider?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-auto" type="checkbox" name="_soliloquy[auto]" value="<?php echo $this->get_config( 'auto', $this->get_config_default( 'auto' ) ); ?>" <?php checked( $this->get_config( 'auto', $this->get_config_default( 'auto' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'If disabled, visitors will need to manually progress through the slider.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-delay-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-delay"><?php esc_html_e( 'Slider Delay', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-delay" type="number" name="_soliloquy[delay]" value="<?php echo absint( $this->get_config( 'delay', $this->get_config_default( 'delay' ) ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'ms', 'soliloquy' ); ?></span>
	                            <p class="description"><?php _e( 'If autostarting, this sets a delay before the slider should begin transitioning <strong>(in milliseconds)</strong>.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-start-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-start"><?php esc_html_e( 'Start On Slide', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-start" type="number" name="_soliloquy[start]" value="<?php echo absint( $this->get_config( 'start', $this->get_config_default( 'start' ) ) ); ?>" />
	                            <p class="description"><?php esc_html_e( 'The starting slide number (index based, starts at 0).', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-transition-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-transition"><?php esc_html_e( 'Slider Transition', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>

		                       	<div class="soliloquy-select">

	                            <select id="soliloquy-config-transition" name="_soliloquy[transition]" data-conditional="soliloquy-config-slider-speed-box,soliloquy-config-caption-delay-box,soliloquy-config-auto-box,soliloquy-config-arrows-box,soliloquy-config-control-box,soliloquy-config-pauseplay-box,soliloquy-config-loop-box,soliloquy-config-keyboard-box,soliloquy-config-css-box,soliloquy-config-delay-box,soliloquy-config-start-box" data-conditional-value="ticker" data-conditional-display="false" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                                <?php foreach ( (array) $this->get_slider_transitions() as $i => $data ) : ?>
	                                    <option value="<?php echo $data['value']; ?>"<?php selected( $data['value'], $this->get_config( 'transition', $this->get_config_default( 'transition' ) ) ); ?>><?php echo $data['name']; ?></option>
	                                <?php endforeach; ?>
	                            </select>
		                        </div>
	                            <p class="description"><?php esc_html_e( 'Sets the type of transition for the slider. Note: The Ticker transition is designed for image slides only, and does not provide interactive functionality (thumbnails, navigation arrows etc). It\'s designed as a basic, continuous scrolling slideshow.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-slider-duration-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-duration"><?php esc_html_e( 'Slider Transition Duration', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-duration" type="number" name="_soliloquy[duration]" value="<?php echo absint( $this->get_config( 'duration', $this->get_config_default( 'duration' ) ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'ms', 'soliloquy' ); ?></span>
	                            <p class="description"><?php _e( 'Sets the amount of time between each slide transition <strong>(in milliseconds)</strong>.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-slider-speed-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-speed"><?php esc_html_e( 'Slider Transition Speed', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-speed" type="number" name="_soliloquy[speed]" value="<?php echo absint( $this->get_config( 'speed', $this->get_config_default( 'speed' ) ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'ms', 'soliloquy' ); ?></span>
	                            <p class="description"><?php _e( 'Sets the transition speed when moving from one slide to the next <strong>(in milliseconds)</strong>.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-caption-delay-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-caption-delay"><?php esc_html_e( 'Caption Transition Delay', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-caption-delay" type="number" name="_soliloquy[caption_delay]" value="<?php echo absint( $this->get_config( 'caption_delay', $this->get_config_default( 'caption_delay' ) ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'ms', 'soliloquy' ); ?></span>
	                            <p class="description"><?php _e( 'The amount of time to delay displaying the caption after the slide has appeared <strong>(in milliseconds)</strong>. Set to zero for caption to display immediately.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-hover-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-hover"><?php esc_html_e( 'Pause on Hover?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-hover" type="checkbox" name="_soliloquy[hover]" value="<?php echo $this->get_config( 'hover', $this->get_config_default( 'hover' ) ); ?>" <?php checked( $this->get_config( 'hover', $this->get_config_default( 'hover' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Pauses the slider (if set to autostart) when a visitor hovers over the slider.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-resume-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-pause"><?php esc_html_e( 'Pause on Navigation?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-pause" type="checkbox" name="_soliloquy[pause]" value="<?php echo $this->get_config( 'pause', $this->get_config_default( 'pause' ) ); ?>" <?php checked( $this->get_config( 'pause', $this->get_config_default( 'pause' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'To resume autoplay after arrows/control nav are used, disable this option.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-autoplay-video-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-autoplay-video"><?php esc_html_e( 'Autoplay Video?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-autoplay-video" type="checkbox" name="_soliloquy[autoplay_video]" value="<?php echo $this->get_config( 'autoplay_video', $this->get_config_default( 'autoplay_video' ) ); ?>" <?php checked( $this->get_config( 'autoplay_video', $this->get_config_default( 'autoplay_video' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables autoplay on videos.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-css-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-css"><?php esc_html_e( 'Use CSS Transitions?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-css" type="checkbox" name="_soliloquy[css]" value="<?php echo $this->get_config( 'css', $this->get_config_default( 'css' ) ); ?>" <?php checked( $this->get_config( 'css', $this->get_config_default( 'css' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables hardware accelerated transitions via CSS.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-aria-live-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-aria-live"><?php esc_html_e( 'ARIA Live Value', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
		                    	<div class="soliloquy-select">

	                            <select id="soliloquy-config-aria-live" name="_soliloquy[aria_live]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                                <?php foreach ( (array) $this->get_aria_live_values() as $i => $data ) : ?>
	                                    <option value="<?php echo $data['value']; ?>"<?php selected( $data['value'], $this->get_config( 'aria_live', $this->get_config_default( 'aria_live' ) ) ); ?>><?php echo $data['name']; ?></option>
	                                <?php endforeach; ?>
	                            </select>

		                    	</div>

	                            <p class="description"><?php esc_html_e( 'Accessibility: Defines the priority with which screen readers should treat updates to this slider.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <?php do_action( 'soliloquy_config_box', $post ); ?>

	                </tbody>

	            </table>

	        </div>

	        <?php

	    }

	    /**
	     * Callback for displaying the UI for setting slider mobile options.
	     *
	     * @since 1.0.0
	     *
	     * @param object $post The current post object.
	     */
	    public function mobile_tab( $post ) {

	    ?>

	    	<div id="soliloquy-config">
		    	<div class="soliloquy-config-header">

	            <h2 class="soliloquy-intro"><?php esc_html_e( 'The settings below adjust configuration options for the slider display when viewed on a mobile device.', 'soliloquy' ); ?></h2>
	            <p class="soliloquy-help"><?php esc_html_e( 'Need some help?', 'soliloquy' ); ?><a href="http://soliloquywp.com/docs/configuring-your-slider/#mobile" target="_blank"><?php esc_html_e( ' Watch a video on how to setup your slider configuration', 'soliloquy' ); ?></a></p>
	            </div>
	            <table class="form-table">
	                <tbody>
	                    <tr id="soliloquy-config-mobile-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-mobile"><?php esc_html_e( 'Create Mobile Slider Images?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-mobile" type="checkbox" name="_soliloquy[mobile]" value="<?php echo $this->get_config( 'mobile', $this->get_config_default( 'mobile' ) ); ?>" <?php checked( $this->get_config( 'mobile', $this->get_config_default( 'mobile' ) ), 1 ); ?> data-conditional="soliloquy-config-mobile-size-box" />
	                            <span class="description"><?php esc_html_e( 'Enables or disables creating specific images for mobile devices.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>
	                    <tr id="soliloquy-config-mobile-size-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-mobile-width"><?php esc_html_e( 'Mobile Dimensions', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-mobile-width" type="number" name="_soliloquy[mobile_width]" value="<?php echo absint( $this->get_config( 'mobile_width', $this->get_config_default( 'mobile_width' ) ) ); ?>" /> &#215; <input id="soliloquy-config-mobile-height" type="number" name="_soliloquy[mobile_height]" value="<?php echo absint( $this->get_config( 'mobile_height', $this->get_config_default( 'mobile_height' ) ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy' ); ?></span>
	                            <p class="description"><?php esc_html_e( 'These will be the sizes used for images displayed on mobile devices.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>
	                    <tr id="soliloquy-config-mobile-caption-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-mobile-caption"><?php esc_html_e( 'Show Captions on Mobile?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-mobile-caption" type="checkbox" name="_soliloquy[mobile_caption]" value="<?php echo $this->get_config( 'mobile_caption', $this->get_config_default( 'mobile_caption' ) ); ?>" <?php checked( $this->get_config( 'mobile_caption', $this->get_config_default( 'mobile_caption' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables captions to be displayed on mobile.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <?php do_action( 'soliloquy_mobile_box', $post ); ?>

	                </tbody>
	            </table>
	        </div>

	    <?php

	    }

	    /**
	     * Callback for displaying the UI for setting slider miscellaneous options.
	     *
	     * @since 1.0.0
	     *
	     * @param object $post The current post object.
	     */
	    public function misc_tab( $post ) {

	    ?>
			<div id="soliloquy-misc">
		        <div class="soliloquy-config-header">

	 	           <h2 class="soliloquy-intro"><?php esc_html_e( 'The settings below adjust the miscellaneous settings for the slider display.', 'soliloquy' ); ?></h2>
	 			   <p class="soliloquy-help"><?php esc_html_e( 'Need some help?', 'soliloquy' ); ?><a href="http://soliloquywp.com/docs/configuring-your-slider/#misc" target="_blank"><?php esc_html_e( ' Watch a video on how to setup your slider configuration', 'soliloquy' ); ?></a></p>
		        </div>
	            <table class="form-table">

	                <tbody>

		                <?php do_action( 'soliloquy_misc_box_before', $post ); ?>

	                    <tr id="soliloquy-config-rtl-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-rtl"><?php esc_html_e( 'Enable RTL Support?', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-rtl" type="checkbox" name="_soliloquy[rtl]" value="<?php echo $this->get_config( 'rtl', $this->get_config_default( 'rtl' ) ); ?>" <?php checked( $this->get_config( 'rtl', $this->get_config_default( 'rtl' ) ), 1 ); ?> />
	                            <span class="description"><?php esc_html_e( 'Enables or disables RTL support in Soliloquy for right-to-left languages.', 'soliloquy' ); ?></span>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-classes-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-classes"><?php esc_html_e( 'Custom Slider Classes', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <textarea id="soliloquy-config-classes" rows="5" cols="75" name="_soliloquy[classes]" placeholder="<?php esc_html_e( 'Enter custom slider CSS classes here, one per line.', 'soliloquy' ); ?>"><?php echo implode( "\n", (array) $this->get_config( 'classes', $this->get_config_default( 'classes' ) ) ); ?></textarea>
	                            <p class="description"><?php esc_html_e( 'Adds custom CSS classes to this slider. Enter one class per line.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-import-export-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-import-slider"><?php esc_html_e( 'Import/Export Slider', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <form></form>
	                            <?php
	                            $import_url = 'auto-draft' == $post->post_status ? add_query_arg( array( 'post' => $post->ID, 'action' => 'edit', 'soliloquy-imported' => true ), admin_url( 'post.php' ) ) : add_query_arg( 'soliloquy-imported', true );
	                            $import_url = esc_url( $import_url );
	                            ?>
	                            <form action="<?php echo $import_url; ?>" id="soliloquy-config-import-slider-form" class="soliloquy-import-form" method="post" enctype="multipart/form-data">
	                                <input id="soliloquy-config-import-slider" type="file" name="soliloquy_import_slider" />
	                                <input type="hidden" name="soliloquy_import" value="1" />
	                                <input type="hidden" name="soliloquy_post_id" value="<?php echo $post->ID; ?>" />
	                                <?php wp_nonce_field( 'soliloquy-import', 'soliloquy-import' ); ?>
	                                <?php submit_button( esc_attr__( 'Import Slider', 'soliloquy' ), 'button-soliloquy-secondary', 'soliloquy-import-submit', false ); ?>
	                                <span class="spinner soliloquy-spinner"></span>
	                            </form>
	                            <form id="soliloquy-config-export-slider-form" method="post">
	                                <input type="hidden" name="soliloquy_export" value="1" />
	                                <input type="hidden" name="soliloquy_post_id" value="<?php echo $post->ID; ?>" />
	                                <?php wp_nonce_field( 'soliloquy-export', 'soliloquy-export' ); ?>
	                                <?php submit_button( esc_attr__( 'Export Slider', 'soliloquy' ), 'button-soliloquy-secondary', 'soliloquy-export-submit', false ); ?>
	                            </form>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-title-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-title"><?php esc_html_e( 'Slider Title', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-title" type="text" name="_soliloquy[title]" value="<?php echo $this->get_config( 'title', $this->get_config_default( 'title' ) ); ?>" />
	                            <p class="description"><?php esc_html_e( 'Internal slider title for identification in the admin.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <tr id="soliloquy-config-slug-box">
	                        <th scope="row">
	                            <label for="soliloquy-config-slug"><?php esc_html_e( 'Slider Slug', 'soliloquy' ); ?></label>
	                        </th>
	                        <td>
	                            <input id="soliloquy-config-slug" type="text" name="_soliloquy[slug]" value="<?php echo $this->get_config( 'slug', $this->get_config_default( 'slug' ) ); ?>" />
	                            <p class="description"><?php _e( '<strong>Unique</strong> internal slider slug for identification and advanced slider queries.', 'soliloquy' ); ?></p>
	                        </td>
	                    </tr>

	                    <?php do_action( 'soliloquy_misc_box', $post ); ?>

	                </tbody>

	            </table>

	        </div>

	    <?php

	    }

	    /**
	     * Callback for saving values from Soliloquy metaboxes.
	     *
	     * @since 1.0.0
	     *
	     * @param int $post_id The current post ID.
	     * @param object $post The current post object.
	     */
	    public function save_meta_boxes( $post_id, $post ) {


	        // Bail out if we fail a security check.
	        if ( ! isset( $_POST['soliloquy'] ) || ! wp_verify_nonce( $_POST['soliloquy'], 'soliloquy' ) || ! isset( $_POST['_soliloquy'] ) ) {
	            return;
	        }

	        // Bail out if running an autosave, ajax, cron or revision.
	        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	            return;
	        }

	        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

		        // Check if this is a Quick Edit request
		        if ( isset( $_POST['_inline_edit'] ) ) {

			        // Just update specific fields in the Quick Edit screen

			        // Get settings
			        $settings = get_post_meta( $post_id, '_sol_slider_data', true );
			        if ( empty( $settings ) ) {
				        return;
			        }

					// Update Settings
	                $settings['config']['slider_theme'] = preg_replace( '#[^a-z0-9-_]#', '', $_POST['_soliloquy']['slider_theme'] );

			        // Provide a filter to override settings.
					$settings = apply_filters( 'soliloquy_quick_edit_save_settings', $settings, $post_id, $post );

					// Update the post meta.
					update_post_meta( $post_id, '_sol_slider_data', $settings );

					// Finally, flush all gallery caches to ensure everything is up to date.
	                Soliloquy_Common::get_instance()->flush_slider_caches( $post_id, $settings['config']['slug'] );

		        }

				return;

            }

	        if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
	            return;
	        }

	        if ( wp_is_post_revision( $post_id ) ) {
	            return;
	        }

	        // Bail if this is not the correct post type.
	        if ( isset( $post->post_type ) && in_array( $post->post_type, array_keys( $this->get_skipped_posttypes() ) ) ) {
	            return;
	        }

	        // Bail out if the user doesn't have the correct permissions to update the slider.
	        if ( ! current_user_can( 'edit_post', $post_id ) ) {
	            return;
	        }

	        // Sanitize all user inputs.
	        $settings = get_post_meta( $post_id, '_sol_slider_data', true );
	        if ( empty( $settings ) ) {
	            $settings = array();
	        }
	        // Force slider ID to match Post ID. This is deliberate; if a slide is duplicated (either using a duplication)
	        // plugin or WPML, the ID remains as the original slider ID, which breaks things for translations etc.
	        $settings['id'] = $post_id;

	        // Save the config settings.
	        $settings['config']['type']         	= isset( $_POST['_soliloquy']['type'] ) ? $_POST['_soliloquy']['type'] : $this->get_config_default( 'type' );
	        $settings['config']['slider_size']  	= esc_attr( $_POST['_soliloquy']['slider_size'] );
	        $settings['config']['slider_theme'] 	= esc_attr( $_POST['_soliloquy']['slider_theme'] );
	        $settings['config']['slider_width'] 	= absint( $_POST['_soliloquy']['slider_width'] );
	        $settings['config']['slider_height']	= absint( $_POST['_soliloquy']['slider_height'] );
	        $settings['config']['position']     	= esc_attr( $_POST['_soliloquy']['position'] );
	        $settings['config']['transition']   	= esc_attr( $_POST['_soliloquy']['transition'] );
	        $settings['config']['duration']     	= absint( $_POST['_soliloquy']['duration'] );
	        $settings['config']['speed']        	= absint( $_POST['_soliloquy']['speed'] );
	        $settings['config']['caption_position'] = esc_attr( $_POST['_soliloquy']['caption_position'] );
	        $settings['config']['caption_delay'] 	= absint( $_POST['_soliloquy']['caption_delay'] );
	        $settings['config']['gutter']        	= absint( $_POST['_soliloquy']['gutter'] );
	        $settings['config']['auto']          	= isset( $_POST['_soliloquy']['auto'] ) ? 1 : 0;
	        $settings['config']['smooth']        	= isset( $_POST['_soliloquy']['smooth'] ) ? 1 : 0;
	        $settings['config']['dimensions']    	= isset( $_POST['_soliloquy']['dimensions'] ) ? 1 : 0;
	        $settings['config']['arrows']        	= isset( $_POST['_soliloquy']['arrows'] ) ? 1 : 0;
	        $settings['config']['control']       	= isset( $_POST['_soliloquy']['control'] ) ? 1 : 0;
	        $settings['config']['pauseplay']     	= isset( $_POST['_soliloquy']['pauseplay'] ) ? 1 : 0;
	        $settings['config']['mobile_caption']	= isset( $_POST['_soliloquy']['mobile_caption'] ) ? 1 : 0;
	        $settings['config']['hover']         	= isset( $_POST['_soliloquy']['hover'] ) ? 1 : 0;
	        $settings['config']['pause']        	= isset( $_POST['_soliloquy']['pause'] ) ? 1 : 0;
	        $settings['config']['mousewheel']   	= isset( $_POST['_soliloquy']['mousewheel'] ) ? 1 : 0;
	        $settings['config']['slider']        	= isset( $_POST['_soliloquy']['slider'] ) ? 1 : 0;
	        $settings['config']['mobile']        	= isset( $_POST['_soliloquy']['mobile'] ) ? 1 : 0;
	        $settings['config']['mobile_width']  	= absint( $_POST['_soliloquy']['mobile_width'] );
	        $settings['config']['mobile_height'] 	= absint( $_POST['_soliloquy']['mobile_height'] );
	        $settings['config']['keyboard']      	= isset( $_POST['_soliloquy']['keyboard'] ) ? 1 : 0;
	        $settings['config']['css']           	= isset( $_POST['_soliloquy']['css'] ) ? 1 : 0;
	        $settings['config']['loop']          	= isset( $_POST['_soliloquy']['loop'] ) ? 1 : 0;
	        $settings['config']['random']        	= isset( $_POST['_soliloquy']['random'] ) ? 1 : 0;
	        $settings['config']['delay']         	= absint( $_POST['_soliloquy']['delay'] );
	        $settings['config']['start']         	= absint( $_POST['_soliloquy']['start'] );
	        $settings['config']['autoplay_video']  = isset( $_POST['_soliloquy']['autoplay_video'] ) ? 1 : 0;
	        $settings['config']['aria_live']     	= esc_attr( $_POST['_soliloquy']['aria_live'] );
	        $settings['config']['sort_order']     	= isset( $_POST['_soliloquy']['sort_order'] ) ? esc_attr( $_POST['_soliloquy']['sort_order'] ) : 'manual';

	        // Misc
	        $settings['config']['classes']       = explode( "\n", $_POST['_soliloquy']['classes'] );
	        $settings['config']['title']         = sanitize_text_field( esc_attr(  $_POST['_soliloquy']['title'] ) );
	        $settings['config']['slug']          = sanitize_text_field( esc_attr(  $_POST['_soliloquy']['slug'] ) );
	        $settings['config']['rtl']           = ( isset( $_POST['_soliloquy']['rtl'] ) ? 1 : 0 );

	        // If on an soliloquy post type, map the title and slug of the post object to the custom fields if no value exists yet.
	        if ( isset( $post->post_type ) && 'soliloquy' == $post->post_type ) {
	            if ( empty( $settings['config']['title'] ) ) {
	                $settings['config']['title'] = trim( strip_tags( $post->post_title ) );
	            }

	            if ( empty( $settings['config']['slug'] ) ) {
	                $settings['config']['slug'] = sanitize_text_field( $post->post_name );
	            }
	        }

	        // Get publish/draft status from Post
	        $settings['status'] = $post->post_status;

	        // Provide a filter to override settings.
	        $settings = apply_filters( 'soliloquy_save_settings', $settings, $post_id, $post );

	        // Update the post meta.
	        update_post_meta( $post_id, '_sol_slider_data', $settings );

	        // If the post has just been published for the first time
	        // 1. set meta field for the slider meta overlay helper.
	        // 2. mark all slides as published
	        if ( isset( $post->post_date ) && isset( $post->post_modified ) && $post->post_date === $post->post_modified ) {
	            update_post_meta( $post_id, '_sol_just_published', true );
	            $settings = $this->change_slider_states( $post_id );
	        }

	        // If the crop option is checked, crop images accordingly.
	        if ( isset( $settings['config']['slider'] ) && $settings['config']['slider'] ) {
	            $args = array(
	                'position' => 'c',
	                'width'    => $this->get_config( 'slider_width', $this->get_config_default( 'slider_width' ) ),
	                'height'   => $this->get_config( 'slider_height', $this->get_config_default( 'slider_height' ) ),
	                'quality'  => 100,
	                'retina'   => false
	            );
	            $args = apply_filters( 'soliloquy_crop_image_args', $args );
	            $this->crop_images( $args, $post_id );
	        }

	        // If the mobile option is checked, crop images for mobile accordingly.
	        if ( isset( $settings['config']['slider'] ) && $settings['config']['slider'] ) {
	            if ( isset( $settings['config']['mobile'] ) && $settings['config']['mobile'] ) {
	                $args = array(
	                    'position' => 'c',
	                    'width'    => $this->get_config( 'mobile_width', $this->get_config_default( 'mobile_width' ) ),
	                    'height'   => $this->get_config( 'mobile_height', $this->get_config_default( 'mobile_height' ) ),
	                    'quality'  => 100,
	                    'retina'   => false
	                );
	                $args = apply_filters( 'soliloquy_crop_image_args', $args );
	                $this->crop_images( $args, $post_id );
	            }
	        }

	        // Fire a hook for addons that need to utilize the cropping feature.
	        // (i.e. crops images for thumbnails if thumbnails addon active)
	        do_action( 'soliloquy_saved_settings', $settings, $post_id, $post );

	        // Finally, flush all slider caches to ensure everything is up to date.
	        $this->flush_slider_caches( $post_id, $settings['config']['slug'] );

	    }

	    /**
	     * Removes all the metaboxes except the ones I want on MY POST TYPE. RAGE.
	     *
	     * @since 1.0.0
	     *
	     * @global array $wp_meta_boxes Array of registered metaboxes.
	     * @return smile $for_my_buyers Happy customers with no spammy metaboxes!
	     */
	    public function remove_all_the_metaboxes() {

	        global $wp_meta_boxes;

	        // This is the post type you want to target. Adjust it to match yours.
	        $post_type  = 'soliloquy';

	        // These are the metabox IDs you want to pass over. They don't have to match exactly. preg_match will be run on them.
	        $pass_over  = array( 'submitdiv', 'soliloquy' );

	        // All the metabox contexts you want to check.
	        $contexts   = array( 'normal', 'advanced', 'side' );

	        // All the priorities you want to check.
	        $priorities = array( 'high', 'core', 'default', 'low' );

	        // Loop through and target each context.
	        foreach ( $contexts as $context ) {
	            // Now loop through each priority and start the purging process.
	            foreach ( $priorities as $priority ) {
	                if ( isset( $wp_meta_boxes[$post_type][$context][$priority] ) ) {
	                    foreach ( (array) $wp_meta_boxes[$post_type][$context][$priority] as $id => $metabox_data ) {
	                        // If the metabox ID to pass over matches the ID given, remove it from the array and continue.
	                        if ( in_array( $id, $pass_over ) ) {
	                            unset( $pass_over[$id] );
	                            continue;
	                        }

	                        // Otherwise, loop through the pass_over IDs and if we have a match, continue.
	                        foreach ( $pass_over as $to_pass ) {
	                            if ( preg_match( '#^' . $id . '#i', $to_pass ) ) {
	                                continue;
	                            }
	                        }

	                        // If we reach this point, remove the metabox completely.
	                        unset( $wp_meta_boxes[$post_type][$context][$priority][$id] );
	                    }
	                }
	            }
	        }

	    }
	    /**
	     * Helper method for retrieving the slider layout for an item in the admin.
	     *
	     * @since 1.0.0
	     *
	     * @param int $id The  ID of the item to retrieve.
	     * @param array $data  Array of data for the item.
	     * @param string $type The type of slide to retrieve.
	     * @param int $post_id The current post ID.
	     * @return string The  HTML output for the slider item.
	     */
	    public function get_slider_item( $id, $data, $type, $post_id = 0 ) {

	        switch ( $type ) {
	            case 'image' :
	                $item = $this->get_slider_image( $id, $data, $post_id );
	                break;
	            case 'video' :
	                $item = $this->get_slider_video( $id, $data, $post_id );
	                break;
	            case 'html' :
	                $item = $this->get_slider_html( $id, $data, $post_id );
	                break;
	        }

	        return apply_filters( 'soliloquy_slide_item', $item, $id, $data, $type, $post_id );

	    }
	   /**
	     * Helper method for retrieving the slider image layout in the admin.
	     *
	     * @since 1.0.0
	     *
	     * @param int $id The  ID of the item to retrieve.
	     * @param array $data  Array of data for the item.
	     * @param int $post_id The current post ID.
	     * @return string The  HTML output for the slider item.
	     */
	    public function get_slider_image( $id, $data, $post_id = 0 ) {

	        $thumbnail = wp_get_attachment_image_src( $id, 'thumbnail' );
	        $json = version_compare( PHP_VERSION, '5.3.0') >= 0  ? json_encode( $data, JSON_HEX_APOS ) : json_encode( $data );

	        ob_start(); ?>
	        <li id="<?php echo $id; ?>" class="soliloquy-slide soliloquy-image soliloquy-status-<?php echo $data['status']; ?>" data-soliloquy-slide="<?php echo $id; ?>" data-soliloquy-image-model='<?php echo htmlspecialchars ( $json, ENT_QUOTES, 'UTF-8'); ?>'>
				<a href="#" class="check"><div class="media-modal-icon"></div></a>

	            <a href="#" class="soliloquy-remove-slide" title="<?php esc_attr_e( 'Remove Image Slide from Slider?', 'soliloquy' ); ?>"><i class="soliloquy-icon-close"></i></a>

	            <a href="#" class="soliloquy-modify-slide" title="<?php esc_attr_e( 'Modify Image Slide', 'soliloquy' ); ?>"><i class="soliloquy-icon-pencil"></i></a>

	            <?php if ( $data['status'] == 'active' ): ?>

					<a href="#" class="soliloquy-active-slide soliloquy-slide-status grid-status" data-status="active" data-soliloquy-tooltip="<?php esc_attr_e( 'Active', 'soliloquy' ); ?>" data-id="<?php echo $id; ?>" title="<?php esc_attr_e( 'Status: Published', 'soliloquy' ); ?>"><span class="dashicons dashicons-visibility"></span></a>

	           	<?php else: ?>

	            	<a href="#" class="soliloquy-draft-slide soliloquy-slide-status grid-status" data-status="draft" data-soliloquy-tooltip="<?php esc_attr_e( 'Draft', 'soliloquy' ); ?>" data-id="<?php echo $id; ?>"  title="<?php esc_attr_e( 'Status: Draft', 'soliloquy' ); ?>"><span class="dashicons dashicons-hidden"></span></a>

	           	<?php endif; ?>
	           	<div class="soliloquy-item-content">
	            <img class="soliloquy-item-img" src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php esc_attr_e( $data['alt'] ); ?>" />

	            <div class="soliloquy-item-info">

	            <h3 class="soliloquy-item-title"><?php echo get_the_title( $id ); ?></h3>
	            <?php if ( $data['status'] == 'active' ): ?>

					<a href="#" class="soliloquy-active-slide list-status soliloquy-slide-status" data-status="active" data-id="<?php echo $id; ?>"  title="<?php esc_attr_e( 'Status: Published', 'soliloquy' ); ?>"><?php esc_attr_e( 'Status:', 'soliloquy' ); ?><span class="status-text"><?php esc_attr_e( 'Active', 'soliloquy' ); ?></span></a>

	           	<?php else: ?>

	            	<a href="#" class="soliloquy-draft-slide list-status soliloquy-slide-status" data-status="draft" data-id="<?php echo $id; ?>"  title="<?php esc_attr_e( 'Status: Draft', 'soliloquy' ); ?>"><?php esc_attr_e( 'Status:', 'soliloquy' ); ?><span class="status-text"><?php esc_attr_e( 'Draft', 'soliloquy' ); ?></span></a>

	           	<?php endif; ?>

	           	</div>
	           	</div>

	        </li>

	        <?php
	        return ob_get_clean();

	    }

	    /**
	     * Helper method for retrieving the slider video layout in the admin.
	     *
	     * @since 1.0.0
	     *
	     * @param int $id The  ID of the item to retrieve.
	     * @param array $data  Array of data for the item.
	     * @param int $post_id The current post ID.
	     * @return string The  HTML output for the slider item.
	     */
	    public function get_slider_video( $id, $data, $post_id = 0 ) {
			$common = Soliloquy_Common::get_instance();

			$video_type = $common->get_video_type( $data['url'], $data['id'], $data, $type_only = true );
	        $json = version_compare( PHP_VERSION, '5.3.0') >= 0  ? json_encode( $data, JSON_HEX_APOS ) : json_encode( $data );

	        ob_start(); ?>
	        <li id="<?php echo $id; ?>" class="soliloquy-slide soliloquy-video soliloquy-status-<?php echo $data['status']; ?>" data-soliloquy-slide="<?php echo $id; ?>" data-soliloquy-image-model='<?php echo htmlspecialchars ( $json, ENT_QUOTES, 'UTF-8'); ; ?>'>
	          	<?php // If thumbnail exists, display it
				if ( isset( $data['src'] ) AND !empty( $data['src']) ) { ?>

	            	<span class="overlay"><?php esc_html_e( 'Video', 'soliloquy' ); ?></span>

	            <?php }  ?>
	          	<a href="#" class="check"><div class="media-modal-icon"></div></a>
	            <a href="#" class="soliloquy-remove-slide" title="<?php esc_attr_e( 'Remove Video Slide from Slider?', 'soliloquy' ); ?>"><i class="soliloquy-icon-close"></i></a>
	            <a href="#" class="soliloquy-modify-slide" title="<?php esc_attr_e( 'Modify Video Slide', 'soliloquy' ); ?>"><i class="soliloquy-icon-pencil"></i></a>
	            <?php if ( $data['status'] == 'active' ): ?>

					<a href="#" class="soliloquy-active-slide soliloquy-slide-status grid-status" data-status="active" data-soliloquy-tooltip="<?php esc_attr_e( 'Active', 'soliloquy' ); ?>" data-id="<?php echo $id; ?>" title="<?php esc_attr_e( 'Status: Published', 'soliloquy' ); ?>"><span class="dashicons dashicons-visibility"></span></a>

	           	<?php else: ?>

	            	<a href="#" class="soliloquy-draft-slide soliloquy-slide-status grid-status" data-status="draft" data-soliloquy-tooltip="<?php esc_attr_e( 'Draft', 'soliloquy' ); ?>" data-id="<?php echo $id; ?>"  title="<?php esc_attr_e( 'Status: Draft', 'soliloquy' ); ?>"><span class="dashicons dashicons-hidden"></span></a>

	           	<?php endif; ?>
	           	<div class="soliloquy-item-content">

	            <div class="soliloquy-video-wrap">

	                <div class="soliloquy-video-inside">

	                    <div class="soliloquy-video-table">
	                        <?php
	                        // If thumbnail exists, display it
	                        if ( isset( $data['src'] ) AND !empty( $data['src']) ) {
	                            ?>
	                            <img class="soliloquy-item-img" src="<?php echo esc_url( $data['src'] ); ?>" />
	                            <?php
	                        } else{ ?>
		                        <img class="soliloquy-item-img" src="<?php echo plugins_url( 'assets/images/video.png', $this->base->file ); ?>" />
	                        <?php }

	                        ?>
	                    </div>
	                </div>
	            </div>
	            <div class="soliloquy-item-info">
	            <?php
		            switch( $video_type ){

			        	case 'youtube':
			        	echo '<img src="'. plugins_url( 'assets/images/youtube.png', $this->base->file ) .'" />';
			        	break;
			        	case 'vimeo':
			        	echo '<img src="'. plugins_url( 'assets/images/vimeo.png', $this->base->file ) .'" />';
			        	break;
			        	case 'wistia':
			        	echo '<img src="'. plugins_url( 'assets/images/wistia.png', $this->base->file ) .'" />';
			        	break;
			        	default:
			        	case 'local':
			        	echo '<img src="'. plugins_url( 'assets/images/local.png', $this->base->file ) .'" />';
			        	break;
			        }

		            ?>

	            <h3 class="soliloquy-item-title"><?php echo $data['title']; ?></h3>
	            <?php if ( $data['status'] == 'active' ): ?>

					<a href="#" class="soliloquy-active-slide list-status soliloquy-slide-status" data-status="active" data-id="<?php echo $id; ?>" data-soliloquy-tooltip="<?php esc_attr_e( 'Active', 'soliloquy' ); ?>" title="<?php esc_attr_e( 'Status: Published', 'soliloquy' ); ?>"><?php esc_attr_e( 'Status:', 'soliloquy' ); ?><span class="status-text"><?php esc_attr_e( 'Active', 'soliloquy' ); ?></span></a>

	           	<?php else: ?>

	            	<a href="#" class="soliloquy-draft-slide list-status soliloquy-slide-status" data-status="draft" data-id="<?php echo $id; ?>" data-soliloquy-tooltip="<?php esc_attr_e( 'Draft', 'soliloquy' ); ?>" title="<?php esc_attr_e( 'Status: Draft', 'soliloquy' ); ?>"><?php esc_attr_e( 'Status:', 'soliloquy' ); ?><span class="status-text"><?php esc_attr_e( 'Draft', 'soliloquy' ); ?></span></a>

	           	<?php endif; ?>
	            </div>
	           	</div>
	        </li>
	        <?php
	        return ob_get_clean();

	    }

	    /**
	     * Helper method for retrieving the slider HTML layout in the admin.
	     *
	     * @since 1.0.0
	     *
	     * @param int $id The  ID of the item to retrieve.
	     * @param array $data  Array of data for the item.
	     * @param int $post_id The current post ID.
	     * @return string The  HTML output for the slider item.
	     */
	    public function get_slider_html( $id, $data, $post_id = 0 ) {
	        $json = version_compare( PHP_VERSION, '5.3.0') >= 0  ? json_encode( $data, JSON_HEX_APOS ) : json_encode( $data );

	        ob_start(); ?>
	        <li id="<?php echo $id; ?>" class="soliloquy-slide soliloquy-html soliloquy-status-<?php echo $data['status']; ?>" data-soliloquy-slide="<?php echo $id; ?>" data-soliloquy-image-model='<?php echo htmlspecialchars ( $json, ENT_QUOTES, 'UTF-8'); ; ?>'>

	          	<a href="#" class="check"><div class="media-modal-icon"></div></a>
	            <a href="#" class="soliloquy-remove-slide" title="<?php esc_attr_e( 'Remove HTML Slide from Slider?', 'soliloquy' ); ?>"><i class="soliloquy-icon-close"></i></a>
	            <a href="#" class="soliloquy-modify-slide" title="<?php esc_attr_e( 'Modify HTML Slide', 'soliloquy' ); ?>"><i class="soliloquy-icon-pencil"></i></a>
	            <?php if ( $data['status'] == 'active' ): ?>

					<a href="#" class="soliloquy-active-slide soliloquy-slide-status grid-status" data-status="active" data-id="<?php echo $id; ?>" title="<?php esc_attr_e( 'Status: Published', 'soliloquy' ); ?>"><span class="dashicons dashicons-visibility"></span></a>

	           	<?php else: ?>

	            	<a href="#" class="soliloquy-draft-slide soliloquy-slide-status grid-status" data-status="draft" data-id="<?php echo $id; ?>"  title="<?php esc_attr_e( 'Status: Draft', 'soliloquy' ); ?>"><span class="dashicons dashicons-hidden"></span></a>

	           	<?php endif; ?>
	           	<div class="soliloquy-item-content">

	            <div class="soliloquy-html-wrap">
	                <div class="soliloquy-html-inside">
	                    <div class="soliloquy-html-table">

		                	<img class="soliloquy-item-img" src="<?php echo plugins_url( 'assets/images/html.png', $this->base->file ); ?>" />

	                    </div>
	                </div>
	            </div>
	            <div class="soliloquy-item-info">

	            <h3 class="soliloquy-item-title"><?php echo $data['title']; ?></h3>
	            <?php if ( $data['status'] == 'active' ): ?>

					<a href="#" class="soliloquy-active-slide list-status soliloquy-slide-status" data-status="active" data-id="<?php echo $id; ?>"  title="<?php esc_attr_e( 'Status: Published', 'soliloquy' ); ?>"><?php esc_attr_e( 'Status:', 'soliloquy' ); ?><span class="status-text"><?php esc_attr_e( 'Active', 'soliloquy' ); ?></span></a>

	           	<?php else: ?>

	            	<a href="#" class="soliloquy-draft-slide list-status soliloquy-slide-status" data-status="draft" data-id="<?php echo $id; ?>"  title="<?php esc_attr_e( 'Status: Draft', 'soliloquy' ); ?>"><?php esc_attr_e( 'Status:', 'soliloquy' ); ?><span class="status-text"><?php esc_attr_e( 'Draft', 'soliloquy' ); ?></span></a>

	           	<?php endif; ?>
	            </div>
	           	</div>
	        </li>
	        <?php
	        return ob_get_clean();

	    }

	    /**
	     * Helper method to change a slider state from pending to active. This is done
	     * automatically on post save. For previewing sliders before publishing,
	     * simply click the "Preview" button and Soliloquy will load all the images present
	     * in the slider at that time.
	     *
	     * @since 1.0.0
	     *
	     * @param int $id The current post ID.
	     * @return array Slider
	     */
	    public function change_slider_states( $post_id ) {

	        $slider_data = get_post_meta( $post_id, '_sol_slider_data', true );
	        if ( ! empty( $slider_data['slider'] ) ) {
	            foreach ( (array) $slider_data['slider'] as $id => $item ) {
	                $slider_data['slider'][$id]['status'] = 'active';
	            }
	        }

	        update_post_meta( $post_id, '_sol_slider_data', $slider_data );

	        return $slider_data;

	    }

	    /**
	     * Helper method to crop slider images to the specified sizes.
	     *
	     * @since 1.0.0
	     *
	     * @param array $args  Array of args used when cropping the images.
	     * @param int $post_id The current post ID.
	     */
	    public function crop_images( $args, $post_id ) {

	        // Gather all available images to crop.
	        $slider_data = get_post_meta( $post_id, '_sol_slider_data', true );
	        $images      = ! empty( $slider_data['slider'] ) ? $slider_data['slider'] : false;
	        $common      = Soliloquy_Common::get_instance();

	        // Loop through the images and crop them.
	        if ( $images ) {
	            // Increase the time limit to account for large image sets and suspend cache invalidations.
	            set_time_limit( Soliloquy_Common::get_instance()->get_max_execution_time() );
	            wp_suspend_cache_invalidation( true );

	            foreach ( $images as $id => $item ) {
	                // Get the full image attachment. If it does not return the data we need, skip over it.
	                $image = wp_get_attachment_image_src( $id, 'full' );
	                if ( ! is_array( $image ) ) {
	                    // Check for video/HTML slide and possibly use a thumbnail instead.
	                    if ( ( isset( $item['type'] ) && 'video' == $item['type'] || isset( $item['type'] ) && 'html' == $item['type'] ) && ! empty( $item['thumb'] ) ) {
	                        $image = $item['thumb'];
	                    } else {
	                        continue;
	                    }
	                } else {
	                    $image = $image[0];
	                }

	                // Allow image to be filtered to use a different thumbnail than the main image.
	                $image = apply_filters( 'soliloquy_cropped_image', $image, $id, $item, $args, $post_id );

	                // Generate the cropped image.
	                $cropped_image = $common->resize_image( $image, $args['width'], $args['height'], true, $args['position'], $args['quality'], $args['retina'], $slider_data );

	                // If there is an error, possibly output error message, otherwise woot!
	                if ( is_wp_error( $cropped_image ) ) {
	                    // If debugging is defined, print out the error.
	                    if ( defined( 'SOLILOQUY_CROP_DEBUG' ) && SOLILOQUY_CROP_DEBUG ) {
	                        echo '<pre>' . var_export( $cropped_image->get_error_message(), true ) . '</pre>';
	                    }
	                }
	            }

	            // Turn off cache suspension and flush the cache to remove any cache inconsistencies.
	            wp_suspend_cache_invalidation( false );
	            wp_cache_flush();
	        }

	    }

	    /**
	     * Helper method to flush slider caches once a slider is updated.
	     *
	     * @since 1.0.0
	     *
	     * @param int $post_id The current post ID.
	     * @param string $slug The unique slider slug.
	     */
	    public function flush_slider_caches( $post_id, $slug ) {

	        Soliloquy_Common::get_instance()->flush_slider_caches( $post_id, $slug );

	    }

	    /**
	     * Helper method for retrieving config values.
	     *
	     * @since 1.0.0
	     *
	     * @global int $id        The current post ID.
	     * @global object $post   The current post object.
	     * @param string $key     The config key to retrieve.
	     * @param string $default A default value to use.
	     * @return string         Key value on success, empty string on failure.
	     */
	    public function get_config( $key, $default = false ) {

	        global $id, $post;

	        // Get the current post ID. If ajax, grab it from the $_POST variable.
	        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	            $post_id = absint( $_POST['post_id'] );
	        } else {
	            $post_id = isset( $post->ID ) ? $post->ID : (int) $id;
	        }

	        $settings = get_post_meta( $post_id, '_sol_slider_data', true );
	        if ( isset( $settings['config'][$key] ) ) {
	            return $settings['config'][$key];
	        } else {
	            return $default ? $default : '';
	        }

	    }

	    /**
	     * Helper method for setting default config values.
	     *
	     * @since 1.0.0
	     *
	     * @param string $key The default config key to retrieve.
	     * @return string Key value on success, false on failure.
	     */
	    public function get_config_default( $key ) {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_config_default( $key );

	    }

	    /**
	     * Helper method for retrieving slide meta values.
	     *
	     * @since 1.0.0
	     *
	     * @global int $id        The current post ID.
	     * @global object $post   The current post object.
	     * @param string $key     The config key to retrieve.
	     * @param int $attach_id  The attachment ID to target.
	     * @param string $default A default value to use.
	     * @return string         Key value on success, empty string on failure.
	     */
	    public function get_meta( $key, $attach_id, $default = false ) {

	        global $id, $post;

	        // Get the current post ID. If ajax, grab it from the $_POST variable.
	        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	            $post_id = absint( $_POST['post_id'] );
	        } else {
	            $post_id = isset( $post->ID ) ? $post->ID : (int) $id;
	        }

	        $settings = get_post_meta( $post_id, '_sol_slider_data', true );
	        if ( isset( $settings['slider'][$attach_id][$key] ) ) {
	            return $settings['slider'][$attach_id][$key];
	        } else {
	            return $default ? $default : '';
	        }

	    }

	    /**
	     * Helper method for setting default meta values.
	     *
	     * @since 1.0.0
	     *
	     * @param string $key    The default meta key to retrieve.
	     * @param int $attach_id The attachment ID to target.
	     * @return string        Key value on success, false on failure.
	     */
	    public function get_meta_default( $key, $attach_id ) {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_meta_default( $key, $attach_id );

	    }

	    /**
	     * Helper method for retrieving slider sizes.
	     *
	     * @since 1.0.0
	     *
	     * @return array Array of slider size data.
	     */
	    public function get_slider_sizes() {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_slider_sizes();

	    }

	    /**
	     * Helper method for retrieving slider themes.
	     *
	     * @since 1.0.0
	     *
	     * @return array Array of slider theme data.
	     */
	    public function get_slider_themes() {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_slider_themes();

	    }

	    /**
	     * Helper method for retrieving slider transitions.
	     *
	     * @since 1.0.0
	     *
	     * @return array Array of thumbnail transition data.
	     */
	    public function get_slider_transitions() {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_slider_transitions();

	    }

	    /**
	     * Helper method for retrieving slider positions.
	     *
	     * @since 1.0.0
	     *
	     * @return array Array of thumbnail position data.
	     */
	    public function get_slider_positions() {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_slider_positions();

	    }
	    /**
	     * Helper method for retrieving slider sort options.
	     *
	     * @since 1.0.0
	     *
	     * @return array Array of thumbnail sort data.
	     */
	    public function get_slider_sort() {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_slider_sort();

	    }

	    /**
	     * Helper method for retrieving caption positions.
	     *
	     * @since 2.4.1.1
	     *
	     * @return array Array of caption position data.
	     */
	    public function get_caption_positions() {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_caption_positions();

	    }

	    /**
	     * Helper method for retrieving aria-live priorities
	     *
	     * @since 2.4.0.9
	     *
	     * @return array Array of aria-live priorities
	     */
	    public function get_aria_live_values() {

	        $instance = Soliloquy_Common::get_instance();
	        return $instance->get_aria_live_values();

	    }

	    /**
	     * Returns the post types to skip for loading Soliloquy metaboxes.
	     *
	     * @since 1.0.0
	     *
	     * @param bool $soliloquy Whether or not to include the Soliloquy post type.
	     * @return array Array of skipped posttypes.
	     */
	    public function get_skipped_posttypes( $soliloquy = false ) {

	        $post_types = get_post_types();
	        if ( ! $soliloquy ) {
	            unset( $post_types['soliloquy'] );
	        }
	        return apply_filters( 'soliloquy_skipped_posttypes', $post_types );

	    }

	    /**
	     * Flag to determine if the GD library has been compiled.
	     *
	     * @since 1.0.0
	     *
	     * @return bool True if has proper extension, false otherwise.
	     */
	    public function has_gd_extension() {

	        return extension_loaded( 'gd' ) && function_exists( 'gd_info' );

	    }

	    /**
	     * Flag to determine if the Imagick library has been compiled.
	     *
	     * @since 1.0.0
	     *
	     * @return bool True if has proper extension, false otherwise.
	     */
	    public function has_imagick_extension() {

	        return extension_loaded( 'imagick' );

	    }
	    /**
	     * Run through the array and check if ID or attachment_id is set.
	     *
	     * @access public
	     * @param mixed $array
	     * @return void
	     */
	    function maybe_update_slides( $array ){

		    foreach ( $array as $id => $data ){

				if ( !array_key_exists('id', $data ) || !array_key_exists( 'attachment_id', $data ) ){

					return false;

				} else{

					continue;

				}

		    }

			return true;

	    }

		/**
		 * Update Soliloquy Lite slides to include ID and Attachemnt ID.
		 *
		 * @access public
		 * @param mixed $post_id
		 * @return void
		 */
		function update_slides( $post_id ){

		    // Grab and update any slider data if necessary.
		    $in_slider = get_post_meta( $post_id, '_sol_in_slider', true );
		    if ( empty( $in_slider ) ) {
		        $in_slider = array();
		    }

		    // Set data and order of image in slider.
		    $slider_data = get_post_meta( $post_id, '_sol_slider_data', true );

		    if ( empty( $slider_data ) ) {
		        $slider_data = array();
		    }

		    // If no slider ID has been set, set it now.
		    if ( empty( $slider_data['id'] ) ) {
		        $slider_data['id'] = $post_id;
		    }

		    foreach ( $slider_data['slider'] as $id => $data ) {

			    	if ( !array_key_exists('id', $data ) || !array_key_exists('attachment_id', $data ) ){

			            $slide = array(
			                'status'  		=> isset( $data['status'] ) ? $data['status'] : 'published',
			                'id'      		=> $id,
			                'attachment_id' => $id,
			            );

					   $slide = wp_parse_args( $slide, $data );

				   	}else{

			            $slide = array(
			                'status'  		=> isset( $data['status'] ) ? $data['status'] : 'published' ,
			                'id'      		=> isset( $data['id']) ? $data['id'] : $id ,
			            );

			           $slide = wp_parse_args( $slide, $data );

				   	}

					$slider_data['slider'][ $id ] = $slide;
					$in_slider[] = $id;

		    }
		    // Update the slider data.
		   // update_post_meta( $post_id, '_sol_in_slider', $in_slider );
		    update_post_meta( $post_id, '_sol_slider_data', $slider_data );

			Soliloquy_Common::get_instance()->flush_slider_caches( $post_id );

			return $slider_data;

		}
	    /**
	     * Returns the singleton instance of the class.
	     *
	     * @since 1.0.0
	     *
	     * @return object The Soliloquy_Metaboxes object.
	     */
	    public static function get_instance() {

	        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Metaboxes ) ) {
	            self::$instance = new Soliloquy_Metaboxes();
	        }

	        return self::$instance;

	    }
	}

	// Load the metabox class.
	$soliloquy_metaboxes = Soliloquy_Metaboxes::get_instance();

endif;