<?php

if (!defined('ABSPATH')) exit;

class gdbbx_ajax_core {
    public function __construct() {
        add_action('wp_ajax_gdbbx_report_post', array($this, 'report_post'));
        add_action('wp_ajax_gdbbx_say_thanks', array($this, 'say_thanks'));
    }

    public function report_post() {
        if (is_user_logged_in()) {
            $nonce = d4p_sanitize_basic($_REQUEST['nonce']);

            $report = isset($_REQUEST['report']) ? d4p_sanitize_basic($_REQUEST['report']) : '';

            $post_id = absint($_REQUEST['post']);
            $user_id = bbp_get_current_user_id();

            if (wp_verify_nonce($nonce, 'gdbbx-report-'.$post_id) !== false) {
                if (!gdbbx_db()->report_given($post_id, $user_id)) {
                    gdbbx_db()->report_add($post_id, $user_id, $report);

                    gdbbx_module_report()->notify($user_id, $post_id, $report);
                }
            }
        }
    }

    public function say_thanks() {
        if (is_user_logged_in()) {
            $nonce = d4p_sanitize_basic($_REQUEST['nonce']);
            $action = d4p_sanitize_basic($_REQUEST['say']);
            $post_id = absint($_REQUEST['id']);
            $user_id = bbp_get_current_user_id();

            if (wp_verify_nonce($nonce, 'gdbbx-thanks-'.$post_id) !== false) {
                gdbbx_loader()->load_module_thanks();

                gdbbx_module_thanks()->save_thanks($action, $post_id, $user_id);

                $type = bbp_is_reply($post_id) ? 'reply' : 'topic';

                $render = gdbbx_module_thanks()->display_ajax($post_id, $type);

                die($render);
            }
        }
    }
}

global $_gdbbx_core_ajax;
$_gdbbx_core_ajax = new gdbbx_ajax_core();

function gdbbx_ajax() {
    global $_gdbbx_core_ajax;
    return $_gdbbx_core_ajax;
}
