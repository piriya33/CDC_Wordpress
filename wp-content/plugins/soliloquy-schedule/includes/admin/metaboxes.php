<?php
/**
 * Metabox class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy
 * @author  Thomas Griffin
 */
class Soliloquy_Schedule_Metaboxes {

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
     * Primary class constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {

        // Load the base class object.
        $this->base = Soliloquy_Schedule::get_instance();

        // CSS + JS
        add_action( 'soliloquy_metabox_styles', array( $this, 'styles' ) );
        add_action( 'soliloquy_metabox_scripts', array( $this, 'scripts' ) );

        // Addon Settings
        add_filter( 'soliloquy_tab_nav', array( $this, 'tab_nav' ) );
        add_action( 'soliloquy_tab_schedule', array( $this, 'settings' ) );
        add_filter( 'soliloquy_save_settings', array( $this, 'settings_save' ), 10, 2 );
        add_filter( 'soliloquy_ajax_save_meta', array( $this, 'meta_save' ), 10, 4 );
        add_filter( 'soliloquy_ajax_save_bulk_meta', array( $this, 'meta_save' ), 10, 4 );

        // Featured Content Settings
        add_action( 'soliloquy_fc_box', array( $this, 'featured_content_settings' ) );
        add_filter( 'soliloquy_fc_save', array( $this, 'featured_content_settings_save' ), 10, 2 );

        // Individual Image Settings
        add_action( 'print_media_templates', array( $this, 'meta_settings' ), 10, 3 );
    }

    /**
     * Loads styles for our metaboxes.
     *
     * @since 1.0.0
     */
    public function styles() {

        wp_enqueue_style( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' );

    }

    /**
     * Loads scripts for our metaboxes.
     *
     * @since 1.0.0
     */
    public function scripts() {

        // Enqueue jQuery UI core and Datepicker
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-datepicker' );

         wp_enqueue_script( $this->base->plugin_slug . '-media', plugins_url( 'assets/js/media-edit.js', $this->base->file ), array( 'jquery' ), $this->base->version , true );

        // Enqueue jQuery Timepicker Addon and main Addon script
        wp_enqueue_script( $this->base->plugin_slug . '-timepicker', plugins_url( 'assets/js/jquery.ui-timepicker-addon.js', $this->base->file ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ), $this->base->version, true );
        wp_enqueue_script( $this->base->plugin_slug . '-script', plugins_url( 'assets/js/jquery.schedule.js', $this->base->file ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ), $this->base->version, true );

        // Localize the script with date and time formats
        wp_localize_script( $this->base->plugin_slug . '-script', 'soliloquy_schedule', array(
            'date_format' => 'F j, Y',
            'time_format' => 'g:i a',
        ) );

    }

    /**
     * Filters in a new tab for the addon.
     *
     * @since 1.0.0
     *
     * @param array $tabs  Array of default tab values.
     * @return array $tabs Amended array of default tab values.
     */
    public function tab_nav( $tabs ) {

        $tabs['schedule'] = esc_attr__(  'Schedule', 'soliloquy-schedule' );
        return $tabs;

    }

    /**
     * Callback for displaying the UI for setting schedule options.
     *
     * @since 1.0.0
     *
     * @param object $post The current post object.
     */
    public function settings( $post ) {

        $instance = Soliloquy_Metaboxes::get_instance();
        ?>
        <div id="soliloquy-schedule">
		    <div class="soliloquy-config-header">
	        	<h2 class="soliloquy-intro"><?php esc_html_e( 'The settings below adjust the Schedule settings for the slider.', 'soliloquy-schedule' ); ?></h2>
				<p class="soliloquy-help"><?php esc_html_e( 'Need some help?', 'soliloquy-thumbnails' ); ?><a href="http://soliloquywp.com/docs/schedule-addon/" target="_blank"><?php esc_html_e( ' Watch a video on how to setup your slider configuration', 'soliloquy-schedule' ); ?></a></p>
			</div>
            <table class="form-table">
                <tbody>
                    <tr id="soliloquy-config-schedule-box">
                        <th scope="row">
                            <label for="soliloquy-config-schedule"><?php esc_html_e( 'Enable Scheduling?', 'soliloquy-schedule' ); ?></label>
                        </th>
                        <td>
                            <input id="soliloquy-config-schedule" type="checkbox" name="_soliloquy[schedule]" value="<?php echo $instance->get_config( 'schedule', $instance->get_config_default( 'schedule' ) ); ?>" <?php checked( $instance->get_config( 'schedule', $instance->get_config_default( 'schedule' ) ), 1 ); ?> data-conditional="soliloquy-config-schedule-start-box,soliloquy-config-schedule-end-box" />
                            <span class="description"><?php esc_html_e( 'Enables or disables scheduling for the slider.', 'soliloquy-schedule' ); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e( 'Current Server Time', 'soliloquy-schedule' ); ?></label>
                        </th>
                        <td>
                            <strong>
                                <?php
                                echo date_i18n( 'F j, Y g:i a' );
                                ?>
                            </strong>
                            <p class="description">
                                <strong><?php esc_html_e( 'NOTE: ', 'soliloquy-schedule' ); ?></strong>
                                <?php esc_html_e( 'The Start Date / Time and End Date / Time are compared to the above Current Server Time.  If your Current Server Time is incorrect, please ensure WordPress is set up with the correct timezone (Settings - General), and that your PHP installation and server both report an accurate time (i.e. not a time that is several minutes off).', 'soliloquy-schedule' ); ?>
                            </p>
                        </td>
                    </tr>
                    <tr id="soliloquy-config-schedule-start-box">
                        <th scope="row">
                            <label for="soliloquy-config-schedule-start"><?php esc_html_e( 'Start Date', 'soliloquy-schedule' ); ?></label>
                        </th>
                        <td>
                            <input id="soliloquy-config-schedule-start" class="soliloquy-date" type="text" name="_soliloquy[schedule_start]" value="<?php echo $instance->get_config( 'schedule_start', $instance->get_config_default( 'schedule_start' ) ); ?>" />
                            <p class="description"><?php esc_html_e( 'Sets the start date for the slider.', 'soliloquy-schedule' ); ?></p>
                        </td>
                    </tr>
                    <tr id="soliloquy-config-schedule-end-box">
                        <th scope="row">
                            <label for="soliloquy-config-schedule-end"><?php esc_html_e( 'End Date', 'soliloquy-schedule' ); ?></label>
                        </th>
                        <td>
                            <input id="soliloquy-config-schedule-end" class="soliloquy-date" type="text" name="_soliloquy[schedule_end]" value="<?php echo $instance->get_config( 'schedule_end', $instance->get_config_default( 'schedule_end' ) ); ?>" />
                            <p class="description"><?php esc_html_e( 'Sets the end date for the slider.', 'soliloquy-schedule' ); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php

    }

    /**
     * Saves the addon setting.
     *
     * @since 1.0.0
     *
     * @param array $settings  Array of settings to be saved.
     * @param int $post_id     The current post ID.
     * @return array $settings Amended array of settings to be saved.
     */
    public function settings_save( $settings, $post_id ) {

        $settings['config']['schedule']       = isset( $_POST['_soliloquy']['schedule'] ) ? 1 : 0;
        $settings['config']['schedule_start'] = esc_attr( $_POST['_soliloquy']['schedule_start'] );
        $settings['config']['schedule_end']   = esc_attr( $_POST['_soliloquy']['schedule_end'] );

        return $settings;

    }

    /**
     * Outputs Schedule options for the Featured Content Addon
     *
     * @since 2.0.7
     *
     * @param obj $post Slider Post Object
     */
    public function featured_content_settings( $post ) {

        $instance = Soliloquy_Metaboxes::get_instance();
        ?>
        <tr id="soliloquy-config-fc-start-date-box">
            <th scope="row">
                <label for="soliloquy-config-fc-start-date"><?php esc_html_e( 'Post Start Date', 'soliloquy-fc' ); ?></label>
            </th>
            <td>
                <input id="soliloquy-config-fc-start-date" class="soliloquy-date" type="text" name="_soliloquy[fc_start_date]" value="<?php echo $instance->get_config( 'fc_start_date', $instance->get_config_default( 'fc_start_date' ) ); ?>" />
                <p class="description"><?php esc_html_e( 'Optionally define a start date and time. Posts must be published on or after this date and time for inclusion in the slider.', 'soliloquy-schedule' ); ?></p>
            </td>
        </tr>
        <tr id="soliloquy-config-fc-end-date-box">
            <th scope="row">
                <label for="soliloquy-config-fc-end-date"><?php esc_html_e( 'Post End Date', 'soliloquy-fc' ); ?></label>
            </th>
            <td>
                <input id="soliloquy-config-fc-end-date" class="soliloquy-date" type="text" name="_soliloquy[fc_end_date]" value="<?php echo $instance->get_config( 'fc_end_date', $instance->get_config_default( 'fc_end_date' ) ); ?>" />
                 <p class="description"><?php esc_html_e( 'Optionally define an end date and time. Posts must be published on or before this date and time for inclusion in the slider.', 'soliloquy-schedule' ); ?></p>
            </td>
        </tr>
        <tr id="soliloquy-config-fc-age-box">
            <th scope="row">
                <label for="soliloquy-config-fc-age"><?php esc_html_e( 'Post Age (Hours)', 'soliloquy-fc' ); ?></label>
            </th>
            <td>
                <input id="soliloquy-config-fc-age" type="number" min="0" max="999" step="1" name="_soliloquy[fc_age]" value="<?php echo $instance->get_config( 'fc_age', $instance->get_config_default( 'fc_age' ) ); ?>" />
                 <p class="description"><?php esc_html_e( 'Optionally define the maximum age of Posts, in hours. Posts must not be older than the given number of hours to be included in the slider.', 'soliloquy-schedule' ); ?></p>
            </td>
        </tr>
        <?php

    }

    /**
     * Save Featured Content Addon settings
     *
     * @since 2.0.7
     *
     * @param array $settings   Settings
     * @param int $post_id      Slider ID
     */
    public function featured_content_settings_save( $settings, $post_id ) {

        $settings['config']['fc_start_date']    = esc_attr( $_POST['_soliloquy']['fc_start_date'] );
        $settings['config']['fc_end_date']      = esc_attr( $_POST['_soliloquy']['fc_end_date'] );
        $settings['config']['fc_age']           = esc_attr( $_POST['_soliloquy']['fc_age'] );

        return $settings;

    }

    /**
     * Outputs the schedule meta fields.
     *
     * @since 1.0.0
     *
     * @param int $attach_id The current attachment ID.
     * @param array $data    Array of attachment data.
     * @param int $post_id   The current post ID.
     */
    public function meta( $attach_id, $data, $post_id ) {

        $instance = Soliloquy_Metaboxes::get_instance();

        // Backwards compatibility support for the free Soliloquy schedule addon.
        $image_start = get_post_meta( $post_id, '_soliloquy_image_begin', true );
        $image_end   = get_post_meta( $post_id, '_soliloquy_image_end', true );
        $enable      = false;
        if ( '' != $image_start || '' != $image_end ) {
            $enable  = true;
        }

        ?>
        <label class="setting">
            <span class="name"><?php esc_html_e( 'Schedule Slide?', 'soliloquy-schedule' ); ?></span>
            <input id="soliloquy-schedule-enable-<?php echo $attach_id; ?>" class="soliloquy-schedule-enable" type="checkbox" name="_soliloquy[schedule_meta]" data-soliloquy-meta="schedule_meta" value="<?php echo ( $enable ? $enable : $instance->get_meta( 'schedule_meta', $attach_id, $instance->get_meta_default( 'schedule_meta', $attach_id ) ) ); ?>"<?php checked( ( $enable ? $enable : $instance->get_meta( 'schedule_meta', $attach_id, $instance->get_meta_default( 'schedule_meta', $attach_id ) ) ), 1 ); ?> />
        </label>

        <label class="setting">
            <span class="name"><?php esc_html_e( 'Start Date', 'soliloquy-schedule' ); ?></span>
            <input id="soliloquy-schedule-start-<?php echo $attach_id; ?>" class="soliloquy-schedule-start soliloquy-date soliloquy-time" type="text" name="_soliloquy[schedule_meta_start]" data-soliloquy-meta="schedule_meta_start" value="<?php echo ( $image_start ? $image_start : $instance->get_meta( 'schedule_meta_start', $attach_id, $instance->get_meta_default( 'schedule_meta_start', $attach_id ) ) ); ?>"<?php checked( ( $image_start ? $image_start : $instance->get_meta( 'schedule_meta_start', $attach_id, $instance->get_meta_default( 'schedule_meta_start', $attach_id ) ) ), 1 ); ?> />
        </label>

        <label class="setting">
            <span class="name"><?php esc_html_e( 'End Date', 'soliloquy-schedule' ); ?></span>
            <input id="soliloquy-schedule-end-<?php echo $attach_id; ?>" class="soliloquy-schedule-end soliloquy-date soliloquy-time" type="text" name="_soliloquy[schedule_meta_end]" data-soliloquy-meta="schedule_meta_end" value="<?php echo ( $image_end ? $image_end : $instance->get_meta( 'schedule_meta_end', $attach_id, $instance->get_meta_default( 'schedule_meta_end', $attach_id ) ) ); ?>"<?php checked( ( $image_end ? $image_end : $instance->get_meta( 'schedule_meta_end', $attach_id, $instance->get_meta_default( 'schedule_meta_end', $attach_id ) ) ), 1 ); ?> />
        </label>

        <label class="setting">
            <span class="name"><?php esc_html_e( 'Ignore Date?', 'soliloquy-schedule' ); ?></span>
            <input id="soliloquy-schedule-ignore-date-<?php echo $attach_id; ?>" class="soliloquy-schedule-ignore-date" type="checkbox" name="_soliloquy[schedule_meta_ignore_date]" data-soliloquy-meta="schedule_meta_ignore_date" value="1" <?php checked( $instance->get_meta( 'schedule_meta_ignore_date', $attach_id, $instance->get_meta_default( 'schedule_meta_ignore_date', $attach_id ) ), 1 ); ?> />
        </label>

        <label class="setting">
            <span class="name"><?php esc_html_e( 'Ignore Year?', 'soliloquy-schedule' ); ?></span>
            <input id="soliloquy-schedule-ignore-year-<?php echo $attach_id; ?>" class="soliloquy-schedule-ignore-year" type="checkbox" name="_soliloquy[schedule_meta_ignore_year]" data-soliloquy-meta="schedule_meta_ignore_year" value="1" <?php checked( $instance->get_meta( 'schedule_meta_ignore_year', $attach_id, $instance->get_meta_default( 'schedule_meta_ignore_year', $attach_id ) ), 1 ); ?> />
        </label>
        <?php

    }
    /**
     * Outputs fields in the modal window when editing an existing image,
     * allowing the user to choose whether to display the video
     * in the gallery view.
     *
     * @since 1.1.6
     *
     * @param int $id      The ID of the item to retrieve.
     * @param array $data  Array of data for the item.
     * @param int $post_id The current post ID.
     */
    public function meta_settings( $post_id ) {

        // Soliloquy Meta Editor
        // Use: wp.media.template( 'soliloquy-meta-editor-schedule' )
        ?>
        <script type="text/html" id="tmpl-soliloquy-meta-editor-schedule">

			<div class="soliloquy-meta">

		        <label class="setting">
		            <span class="name"><?php esc_html_e( 'Schedule Slide?', 'soliloquy-schedule' ); ?></span>
		            <input class="soliloquy-schedule-enable" type="checkbox" name="schedule_meta" data-soliloquy-meta="schedule_meta" value="1" <# if ( data.schedule_meta == '1' ) { #> checked <# } #>/>
					<span class="check-label"><?php esc_html_e( 'Enables or disables scheduling for this slide.', 'soliloquy-schedule' ) ?></span>
		        </label>

		        <label class="setting">
		            <span class="name"><?php esc_html_e( 'Start Date', 'soliloquy-schedule' ); ?></span>
		            <input class="soliloquy-schedule-start soliloquy-date soliloquy-time" type="text" name="schedule_meta_start" data-soliloquy-meta="schedule_meta_start" value="{{ data.schedule_meta_start }}" />
					<span class="check-label"><?php esc_html_e( 'Date this slide should begin displaying within the slider.', 'soliloquy-schedule' ) ?></span>
		        </label>

		        <label class="setting">
		            <span class="name"><?php esc_html_e( 'End Date', 'soliloquy-schedule' ); ?></span>
		            <input class="soliloquy-schedule-end soliloquy-date soliloquy-time" type="text" name="schedule_meta_end" data-soliloquy-meta="schedule_meta_end" value="{{ data.schedule_meta_end }}" />
					<span class="check-label"><?php esc_html_e( 'Date this slide should stop displaying within the slider.', 'soliloquy-schedule' ) ?></span>
		        </label>

		        <label class="setting">
		            <span class="name"><?php esc_html_e( 'Ignore Date?', 'soliloquy-schedule' ); ?></span>
		            <input class="soliloquy-schedule-ignore-date" type="checkbox" name="schedule_meta_ignore_date" data-soliloquy-meta="schedule_meta_ignore_date" value="1"<# if ( data.schedule_meta_ignore_date == '1' ) { #> checked <# } #> />
		            <span class="check-label"><?php esc_html_e( 'If enabled, schedule Start and End Dates will ignore the date and default to the time specified. Enable this option to display slide at a recurring time each day.', 'soliloquy-schedule' ) ?></span>

		        </label>

		        <label class="setting">
		            <span class="name"><?php esc_html_e( 'Ignore Year?', 'soliloquy-schedule' ); ?></span>
		            <input class="soliloquy-schedule-ignore-year" type="checkbox" name="schedule_meta_ignore_year" data-soliloquy-meta="schedule_meta_ignore_year" value="1"<# if ( data.schedule_meta_ignore_year == '1' ) { #> checked <# } #> />
		            <span class="check-label"><?php esc_html_e( 'If enabled, schedule Start and End Dates will ignore the year and default to the date and time specified. Enable this option to display slide at a recurring date / time each year.', 'soliloquy-schedule' ) ?></span>

		        </label>

	        </div>

        </script>
        <?php

    }
    /**
     * Saves the addon meta settings.
     *
     * @since 1.0.0
     *
     * @param array $settings  Array of settings to be saved.
     * @param array $meta      Array of slide meta to use for saving.
     * @param int $attach_id   The current attachment ID.
     * @param int $post_id     The current post ID.
     * @return array $settings Amended array of settings to be saved.
     */
    public function meta_save( $settings, $meta, $attach_id, $post_id ) {

        $settings['slider'][ $attach_id ]['schedule_meta']            = isset( $meta['schedule_meta'] ) && $meta['schedule_meta'] ? 1 : 0;
        $settings['slider'][ $attach_id ]['schedule_meta_start']      = isset( $meta['schedule_meta_start'] ) && $meta['schedule_meta_start'] ? esc_attr( $meta['schedule_meta_start'] ) : '';
        $settings['slider'][ $attach_id ]['schedule_meta_end']        = isset( $meta['schedule_meta_end'] ) && $meta['schedule_meta_end'] ? esc_attr( $meta['schedule_meta_end'] ) : '';
        $settings['slider'][ $attach_id ]['schedule_meta_ignore_date']= isset( $meta['schedule_meta_ignore_date'] ) && $meta['schedule_meta_ignore_date'] ? 1 : 0;
        $settings['slider'][ $attach_id ]['schedule_meta_ignore_year']= isset( $meta['schedule_meta_ignore_year'] ) && $meta['schedule_meta_ignore_year'] ? 1 : 0;

        return $settings;

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 2.2.0
     *
     * @return object The Soliloquy_Schedule_Metaboxes object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Schedule_Metaboxes ) ) {
            self::$instance = new Soliloquy_Schedule_Metaboxes();
        }

        return self::$instance;

    }

}

// Load the metabox class.
$soliloquy_schedule_metaboxes = Soliloquy_Schedule_Metaboxes::get_instance();