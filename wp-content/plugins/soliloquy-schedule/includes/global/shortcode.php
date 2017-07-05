<?php
/**
 * Shortcode class.
 *
 * @since 2.2.0
 *
 * @package Soliloquy_Schedule
 * @author  Tim Carr
 */
class Soliloquy_Schedule_Shortcode {

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

        // Frontend
        add_filter( 'soliloquy_pre_data', array( $this, 'pre_data' ), 10, 2 );
        add_filter( 'soliloquy_fc_query_args', array( $this, 'featured_content_data' ), 10, 3 );

    }

    /**
     * Removes a slider if it is scheduled and not during the proper time window.
     *
     * @since 1.0.0
     *
     * @param array $data      Array of slider data.
     * @param mixed $slider_id The current slider ID.
     * @return array $data     Amended array of slider data.
     */
    public function pre_data( $data, $slider_id ) {

        /**
        * current_time() will return an incorrect date/time if the server or another script sets a non-UTC timezone
        * (e.g. if server timezone set to LA, current_time() will take another 8 hours off the already adjusted datetime)
        * Therefore we force UTC time, then get current_time()
        */
        $existing_timezone = date_default_timezone_get();
        date_default_timezone_set( 'UTC' );

        // Time variables.
        $instance   = Soliloquy_Shortcode::get_instance();
        $time_now   = current_time( 'timestamp' );
        $schedule   = $instance->get_config( 'schedule', $data );
        $begin_date = strtotime( $instance->get_config( 'schedule_start', $data ) );
        $end_date   = strtotime( $instance->get_config( 'schedule_end', $data ) );

        // Check to see if a slider is scheduled. If it is and it is not the correct time, return the data.
        if ( $schedule ) {
            if ( ( '' != $begin_date && $begin_date > $time_now ) || ( '' != $end_date && $end_date < $time_now ) ) {
                return false;
            }
        }
        //FC & Woo dont hold slides so just return
		if ( !isset($data['slider'])){
       		return apply_filters( 'soliloquy_schedule_data', $data, $slider_id );
		}
        // Now check to see if a slide is scheduled. If it is and is not the right time, remove it from display.
        foreach ( (array) $data['slider'] as $id => $slide ) {
            // Check scheduling is enabled for this slide
            // If not, allow this slide to be included and move into the next slide
            $meta_sched         = isset( $slide['schedule_meta'] ) ? $slide['schedule_meta'] : 0;
            if ( ! $meta_sched ) {
                continue;
            }

            $meta_ignore_date   = isset( $slide['schedule_meta_ignore_date'] ) ? $slide['schedule_meta_ignore_date'] : 0;
            $meta_ignore_year   = isset( $slide['schedule_meta_ignore_year'] ) ? $slide['schedule_meta_ignore_year'] : 0;
            $start_date         = isset( $slide['schedule_meta_start'] ) ? strtotime( $slide['schedule_meta_start'] ) : '';
            $end_date           = isset( $slide['schedule_meta_end'] ) ? strtotime( $slide['schedule_meta_end'] ) : '';

            // If we are ignoring the date component, just get the time
            if ( $meta_ignore_date ) {
                // Get start and end time for slide
                $start_time = date( 'H:i:s', $start_date );
                $end_time = date( 'H:i:s', $end_date );
                $time_now_time_only = date( 'H:i:s', $time_now);

                // Check if start time is in the future, or end time is before current time
                // If so, remove slide
                if ( ( '' != $start_time && $start_time > $time_now_time_only ) ) {
                    unset( $data['slider'][ $id ] );
                } elseif ( ( '' != $end_time && $end_time < $time_now_time_only ) ) {
                    unset( $data['slider'][ $id ] );
                }
            } elseif ( $meta_ignore_year ) {
                // Modify the start date to be based on this year
                if ( ! empty( $start_date ) ) {
                    $start_date_ymd = date( 'Y-m-d', $start_date );
                    $start_date_parts = explode( '-', $start_date_ymd );
                    $start_date = strtotime( date( 'Y' ) . '-' . $start_date_parts[1] . '-' . $start_date_parts[2] );
                    
                    // If the start date is still after the current date/time, don't display the slide
                    if ( $start_date > $time_now ) {
                        unset( $data['slider'][ $id ] );
                    }
                }
                
                // Modify the end date to be based on this year
                if ( ! empty( $end_date ) ) {
                    $end_date_ymd = date( 'Y-m-d', $end_date );
                    $end_date_parts = explode( '-', $end_date_ymd );
                    $end_date = strtotime( date( 'Y' ) . '-' . $end_date_parts[1] . '-' . $end_date_parts[2] );

                    // If the end date is still before the current date/time, don't display the slide
                    if ( $end_date < $time_now ) {
                        unset( $data['slider'][ $id ] );
                    }
                }
            } else {
                // Check if start date is in the future, or end date is before current date/time
                // If so, remove slide
                if ( ( '' != $start_date && $start_date > $time_now ) ) {
                    unset( $data['slider'][ $id ] );
                } elseif ( ( '' != $end_date && $end_date < $time_now ) ) {
                    unset( $data['slider'][ $id ] );
                }
            }
        }

        /**
        * Put timezone back in case other scripts rely on it
        */
        date_default_timezone_set( $existing_timezone );

        return apply_filters( 'soliloquy_schedule_data', $data, $slider_id );

    }

    /**
     * Adds query arguments to the main WP_Query for the Featured Content Addon,
     * if any time based constraints have been specified on the Featured Content slider
     *
     * @since 2.0.7
     *
     * @param array $query_args     WP_Query query arguments
     * @param int   $id             Slider ID
     * @param array $data           Slider Data
     * @return array                WP_Query query arguments
     */
    public function featured_content_data( $query_args, $id, $data ) {

         // Get instances
        $instance = Soliloquy_Shortcode::get_instance();

        // Check if start/end date/times or hours have been specified
        $start  = $instance->get_config( 'fc_start_date', $data );
        $end    = $instance->get_config( 'fc_end_date', $data );
        $age    = $instance->get_config( 'fc_age', $data );
        if ( empty( $start ) && empty( $end ) && empty( $age ) ) {
            return $query_args;
        }

        // Check for dates
        if ( ! empty( $start ) || ! empty( $end ) ) {
            // Restrict Posts by date
            $dates = array();
            if ( ! empty( $start ) ) {
                $dates['after'] = date( 'Y-m-d H:i:s', strtotime( $start ) );
            }
            if ( ! empty( $end ) ) {
                $dates['before'] = date( 'Y-m-d H:i:s', strtotime( $end ) );
            }

            // Add to query args
            $query_args['date_query'] = array(
                $dates
            );
        }

        // Check for age
        if ( ! empty( $age ) ) {
            // Restrict Posts by age
            $query_args['date_query'] = array(
                array( 
                    'after'     => $age . ' hours ago',
                    'inclusive' => true,
                ),
            );
        }

        return $query_args;

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 2.2.0
     *
     * @return object The Soliloquy_Schedule_Shortcode object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Schedule_Shortcode ) ) {
            self::$instance = new Soliloquy_Schedule_Shortcode();
        }

        return self::$instance;

    }

}

// Load the shortcode class.
$soliloquy_schedule_shortcode = Soliloquy_Schedule_Shortcode::get_instance();