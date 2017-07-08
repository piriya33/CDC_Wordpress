<?php

if (!defined('ABSPATH')) exit;

if (!function_exists('gdbbx_user_signature')) {
    function gdbbx_user_signature($user_id, $args = array()) {
        $defaults = array(
            'echo' => true,
            'before' => '<div class="bbp-signature">',
            'after' => '</div>',
            'smilies' => gdbbx()->get('signature_process_smilies', 'tools'),
            'chars' => gdbbx()->get('signature_process_chars', 'tools'),
            'autop' => gdbbx()->get('signature_process_autop', 'tools')
        );

        $args = wp_parse_args($args, $defaults);

        $signature = get_user_meta($user_id, 'signature', true);

        $sig = gdbbx_update_shorthand_bbcodes($signature);

        if ($sig != $signature) {
            update_user_meta($user_id, 'signature', $sig, $signature);
        }

        if ($sig != '') {
            if ($args['smilies']) {
                $sig = convert_smilies($sig);
            }

            if ($args['chars']) {
                $sig = convert_chars($sig);
            }

            if ($args['autop']) {
                $sig = wpautop($sig);
                $sig = shortcode_unautop($sig);
            }

            $sig = do_shortcode($sig);
        }

        $sig = apply_filters('gdbbx_signature_for_display', $sig, $signature, $user_id);

        if ($sig != '') {
            $sig = $args['before'].$sig.$args['after'];
        }

        if ($args['echo']) {
            echo $sig;
        } else {
            return $sig;
        }
    }
}
