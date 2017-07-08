<?php

if (!defined('ABSPATH')) exit;

function gdbbx_get_active_bbcodes($what = 'codes', $return = 'active', $class = 'all') {
    global $gdbx_core;

    if ($return == 'active') {
        if (isset($gdbx_core->mod['bbcodes'])) {
            $list = $gdbx_core->mod['bbcodes']->get_active_bbcodes();

            switch ($what) {
                default:
                case 'codes':
                    return $list;
                case 'array':
                    require_once(GDBBX_PATH.'core/functions/bbcodes.php');
                    $output = array();

                    foreach ($list as $code) {
                        $_list = gdbbx_get_bbcodes_list();
                        $output[$code] = $_list[$code];
                    }

                    return $output;
            }
        } else {
            return array();
        }
    } else {
        require_once(GDBBX_PATH.'core/functions/bbcodes.php');

        if ($class == 'all') {
            switch ($what) {
                default:
                case 'codes':
                    return array_keys(gdbbx_get_bbcodes_list());
                case 'array':
                    return gdbbx_get_bbcodes_list();
            }
        } else {
            $output = array();

            foreach (gdbbx_get_bbcodes_list() as $code => $data) {
                if (($class == 'standard' && !isset($data['class'])) || ($class == 'advanced' && isset($data['class']) && $data['class'] == 'advanced') || ($class == 'restricted' && isset($data['class']) && $data['class'] == 'restricted')) {
                    switch ($what) {
                        default:
                        case 'codes':
                            $output[] = $code;
                            break;
                        case 'array':
                            $output[$code] = $data;
                            break;
                    }
                }
            }

            return $output;
        }
    }
}

function gdbbx_get_attachment($file, $post = 0) {
    if (is_numeric($file)) {
        return intval($file);
    } else {
        $args = array('fields' => 'ids', 
            'post_type' => 'attachment',
            'posts_per_page' => -1);

        if ($post > 0) {
            $args['post_parent'] = $post;
        }

        $attachments = get_posts($args);
        
        $file_sanitized = strtolower(sanitize_file_name($file));

        foreach ($attachments as $id) {
            $att = get_post_meta($id, '_bbp_attachment_name', true);

            if ($att == $file) {
                return $id;
            }

            $path = get_post_meta($id, '_wp_attached_file', true);

            if (strtolower(basename($path)) == $file_sanitized) {
                return $id;
            }
        }
    }

    return 0;
}

function gdbbx_attachments_display_disable() {
    if (isset(gdbbx_loader()->modules['attachments'])) {
        gdbbx_attachments()->front->remove_content_filters();
    }
}

function gdbbx_attachments_display_enable() {
    if (isset(gdbbx_loader()->modules['signature'])) {
        gdbbx_attachments()->front->add_content_filters();
    }
}

function gdbbx_signature_display_disable() {
    if (isset(gdbbx_loader()->modules['signature'])) {
        gdbbx_loader()->modules['signature']->remove_content_filters();
    }
}

function gdbbx_signature_display_enable() {
    if (isset(gdbbx_loader()->modules['signature'])) {
        gdbbx_loader()->modules['signature']->add_content_filters();
    }
}

function gdbbx_can_user_moderate() {
    $roles = apply_filters('gdbbx_moderation_roles', array('bbp_keymaster', 'bbp_moderator'));

    if (is_user_logged_in()) {
        if (is_super_admin()) {
            return true;
        } else {
            global $current_user;

            if (is_array($current_user->roles)) {
                $matched = array_intersect($current_user->roles, $roles);
                return !empty($matched);
            }
        }
    }

    return false;
}

function gdbbx_current_user_can_moderate() {
    return current_user_can('moderate');
}

function gdbbx_is_current_user_bbp_moderator() {
    return d4p_is_current_user_roles(bbp_get_moderator_role());
}

function gdbbx_is_current_user_bbp_keymaster() {
    return d4p_is_current_user_roles(bbp_get_keymaster_role());
}

function gdbbx_check_if_user_replied_to_topic($topic_id = 0, $user_id = 0) {
    return gdbbx_db()->user_replied_to_topic($topic_id, $user_id);
}

function gdbbx_check_if_user_said_thanks_to_topic($topic_id = 0, $user_id = 0) {
    return gdbbx_db()->thanks_given($topic_id, $user_id);
}

function gdbbx_get_topic_id_from_slug($slug) {
    $slug = esc_sql($slug);
    $slug = sanitize_title_for_query($slug);

    $post_type = bbp_get_topic_post_type();

    $sql = "SELECT ID FROM ".gdbbx_db()->wpdb()->posts." 
            WHERE post_name = '$slug' AND post_type = '$post_type'";

    $pages = gdbbx_db()->get_results($sql);

    if (count($pages) == 1) {
        return $pages[0]->ID;
    }

    return null;
}

function gdbbx_get_topic_last_reply_time($topic_id = 0, $format = 'G') {
    $topic_id = bbp_get_topic_id($topic_id);
    $reply_id = bbp_get_topic_last_reply_id($topic_id);

    $active = !empty($reply_id) ? get_post_field('post_date_gmt', $reply_id) : get_post_field('post_date_gmt', $topic_id);

    return mysql2date($format, $active);
}

function gdbbx_get_topic_post_time($topic_id = 0, $format = 'G') {
    $topic_id = bbp_get_topic_id($topic_id);

    $active = get_post_field('post_date_gmt', $topic_id);

    return mysql2date($format, $active);
}

function gdbbx_get_user_display_name($user_id = 0) {
    if ($user_id == 0) {
        $user_id = bbp_get_current_user_id();

        if ($user_id > 0) {
            $author_name = get_the_author_meta('display_name', $user_id);

            if (empty($author_name)) {
                $author_name = get_the_author_meta('user_login', $user_id);
            }

            return $author_name;
        }
    }

    return '';
}
