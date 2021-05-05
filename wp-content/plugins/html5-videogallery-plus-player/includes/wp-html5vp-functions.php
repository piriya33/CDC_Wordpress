<?php
/**
 * Plugin generic functions file
 *
 * @package Video gallery and Player
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Function to get unique number
 * 
 * @package Video gallery and Player
 * @since 2.0.0
 */ 
 function wp_html5vp_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @package Video gallery and Player
 * @since 2.5
 */
function wp_html5vp_clean_number( $var, $fallback = null, $type = 'int' ) {

    if ( $type == 'number' ) {
        $data = intval( $var );
    } else {
        $data = absint( $var );
    }

    return ( empty($data) && isset($fallback) ) ? $fallback : $data;
}

/**
 * Function to add array after specific key
 * 
 * @package Video gallery and Player
 * @since 2.0.0
 */
function wp_html5vp_add_array(&$array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    return $array;
}

/**
 * Function to get grid column based on grid
 * 
 * @package Video gallery and Player
 * @since 1.0.0
 */
function wp_html5vp_grid_column( $grid = '' ) {

    if($grid == '2') {
        $grid_clmn = '6';
    } else if($grid == '3') {
        $grid_clmn = '4';
    } else if($grid == '4') {
        $grid_clmn = '3';
    } else if ($grid == '1') {
        $grid_clmn = '12';
    } else {
        $grid_clmn = '12';
    }
    return $grid_clmn;
}

/**
 * Sanitize Multiple HTML class
 * 
 * @package Video gallery and Player
 * @since 2.5
 */
function wp_html5vp_get_sanitize_html_classes($classes, $sep = " ") {
    $return = "";

    if( !is_array($classes) ) {
        $classes = explode($sep, $classes);
    }

    if( !empty($classes) ) {
        foreach($classes as $class){
            $return .= sanitize_html_class($class) . " ";
        }
        $return = trim( $return );
    }

    return $return;
}