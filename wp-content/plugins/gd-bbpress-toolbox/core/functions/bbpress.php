<?php

if (!defined('ABSPATH')) exit;

function gdbbx_has_bbpress() {
    if (function_exists('bbp_version')) {
        $version = bbp_get_version();
        $version = intval(substr(str_replace('.', '', $version), 0, 2));

        return $version > 24;
    } else {
        return false;
    }
}

function gdbbx_bbpress_version($ret = 'code') {
    if (!gdbbx_has_bbpress()) {
        return null;
    }

    $version = bbp_get_version();

    if (isset($version)) {
        if ($ret == 'code') {
            return substr(str_replace('.', '', $version), 0, 2);
        } else {
            return $version;
        }
    }

    return null;
}

function gdbbx_is_bbpress() {
    $is = gdbbx_has_bbpress() ? is_bbpress() : false;

    return apply_filters('gdbbx_is_bbpress', $is);
}

function bbp_form_reply_title() {
    echo bbp_get_form_reply_title();
}

function bbp_get_form_reply_title() {
    $reply_title = '';

    if (bbp_is_post_request() && isset($_POST['bbp_reply_title'])) {
        $reply_title = $_POST['bbp_reply_title'];
    } elseif (bbp_is_reply_edit()) {
        $reply_title = bbp_get_global_post_field('post_title', 'raw');
    }

    return apply_filters('bbp_get_form_reply_title', esc_attr($reply_title));
}

function gdbbx_has_buddypress() {
    if (d4p_is_plugin_active('buddypress/bp-loader.php')) {
        $version = bp_get_version();
        $version = intval(substr(str_replace('.', '', $version), 0, 2));

        return $version > 26;
    } else {
        return false;
    }
}
