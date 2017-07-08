<?php

if (!defined('ABSPATH')) exit;

function gdbbx_enqueue_files_force() {
    gdbbx_loader()->main_enqueue();
}

function gdbbx_render_signature_editor($content) {
    gdbbx_loader()->modules['signature']->generate_editor($content);
}

function gdbbx_signature_editor_class($extra_class = '') {
    $class = 'gdbbx-signature-form gdbbx-editor-';

    if (gdbbx_loader()->modules['signature']->tinymce) {
        $class.= 'tinymce';
    } else {
        $class.= gdbbx_loader()->modules['signature']->editor;
    }

    if (!empty($extra_class)) {
        $class.= ' '.$extra_class;
    }

    return apply_filters('gdbbx_signature_editor_class', $class);
}

function gdbbx_widget_render_header($instance, $base_class = '') {
    $class = array('d4p-bbw-widget', $base_class);

    if ($instance['_class'] != '') {
        $class[] = $instance['_class'];
    }

    $render = '<div class="'.join(' ', $class).'">'.D4P_EOL;

    if ($instance['before'] != '') {
        $render.= '<div class="bbx-before">'.$instance['before'].'</div>';
    }

    echo $render;
}

function gdbbx_widget_render_footer($instance) {
    $render = '';

    if ($instance['after'] != '') {
        $render.= '<div class="bbx-after">'.$instance['after'].'</div>';
    }

    $render.= '</div>';

    echo $render;
}

function gdbbx_get_template_part($name) {
    $stack = bbp_get_template_stack();

    $found = false;
    foreach ($stack as $path) {
        if (file_exists(trailingslashit($path).$name)) {
            $found = trailingslashit($path).$name;
            break;
        }
    }

    if ($found === false) {
        $found = GDBBX_PATH.'theme/'.$name;
    }

    return $found;
}

function gdbbx_get_user_roles() {
    $roles = array();

    $dynamic_roles = bbp_get_dynamic_roles();

    foreach ($dynamic_roles as $role => $obj) {
        $roles[$role] = $obj['name'];
    }

    return $roles;
}

function gdbbx_get_new_topics($timestamp, $offset = 0, $limit = 1000) {
    require_once(GDBBX_PATH.'core/functions/posts.php');

    $topics = array();
    $list = gdbbx_get_new_posts(array('timestamp' => $timestamp, 'offset' => $offset, 'limit' => $limit));

    foreach ($list as $item) {
        $topics[] = $item['type'] == bbp_get_topic_post_type() ? $item['id'] : $item['parent'];
    }

    return $topics;
}

function gdbbx_get_post_attachments($post_id) {
    $args = apply_filters('gdbbx_get_post_attachments_args', array(
        'post_type' => 'attachment', 
        'numberposts' => -1, 
        'post_status' => null, 
        'post_parent' => $post_id,
        'orderby' => 'ID',
        'order' => 'ASC'
    ));

    return get_posts($args);
}

function gdbbx_attachment_handle_upload_error(&$file, $message) {
    return new WP_Error("wp_upload_error", $message);
}

function gdbbx_mime_types_list() {
    $list = get_allowed_mime_types();

    $show = array();

    foreach ($list as $mime => $type) {
        $show[$mime] = '<span title="'.$type.'">'.$mime.'</span>';
    }

    return $show;
}

function gdbbx_default_forum_settings() {
    return array(
        'attachments_status' => 'inherit',
        'attachments_hide_from_visitors' => 'inherit',

        'attachments_max_file_size_override' => 'inherit',
        'attachments_max_file_size' => 512,

        'attachments_max_to_upload_override' => 'inherit',
        'attachments_max_to_upload' => 4,

        'attachments_mime_types_list_override' => 'inherit',
        'attachments_mime_types_list' => array(),

        'privacy_lock_topic_form' => 'inherit',
        'privacy_lock_reply_form' => 'inherit',

        'privacy_enable_topic_private' => 'inherit',
        'privacy_enable_reply_private' => 'inherit'
    );
}

function gdbbx_get_topic_footer_links($args = array()) {
    $r = bbp_parse_args($args, array (
        'id'     => bbp_get_topic_id(),
        'before' => '<span class="bbp-admin-links">',
        'after'  => '</span>',
        'sep'    => ' | ',
        'links'  => array()
    ), 'get_topic_footer_links');

    if (empty($r['links'])) {
        $r['links'] = apply_filters('gdbbx_topic_footer_links', array(), $r['id']);
    }

    if (empty($r['links'])) {
        return '';
    }
    
    $links  = implode($r['sep'], array_filter($r['links']));
    $retval = $r['before'].$links.$r['after'];

    return apply_filters('gdbbx_get_topic_footer_links', $retval, $r, $args);
}

function gdbbx_get_reply_footer_links($args = array()) {
    $r = bbp_parse_args($args, array(
            'id'     => 0,
            'before' => '<span class="bbp-admin-links">',
            'after'  => '</span>',
            'sep'    => ' | ',
            'links'  => array()
    ), 'get_reply_footer_links');

    $r['id'] = bbp_get_reply_id((int)$r['id']);

    if (bbp_is_topic($r['id'])) {
        return gdbbx_get_topic_footer_links($args);
    }

    if (!bbp_is_reply($r['id'])) {
        return;
    }

    if (bbp_is_topic_trash(bbp_get_reply_topic_id($r['id']))) {
        return;
    }

    if (empty( $r['links'])) {
        $r['links'] = apply_filters('gdbbx_reply_footer_links', array(), $r['id']);
    }

    if (empty($r['links'])) {
        return '';
    }

    $links  = implode($r['sep'], array_filter($r['links']));
    $retval = $r['before'].$links.$r['after'];

    return apply_filters('gdbbx_get_reply_footer_links', $retval, $r, $args);
}

function gdbbx_get_online_users_list($limit = 0, $avatar = true, $show = 'profile_link', $before = '<span class="gdbbx-online-user">', $after = '</span>') {
    $online = gdbbx_module_tracking()->online();

    $_users = array();
    foreach ($online['roles'] as $role => $users) {
        if (!empty($users) && $limit > 0) {
            $users = array_slice($users, 0, $limit);
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                $item = '';

                switch ($show) {
                    default:
                    case 'profile_link':
                        $item = bbp_get_user_profile_link($user);
                        break;
                    case 'display_name':
                        $u = get_userdata($user);
                        $item = $u->display_name;
                        break;
                }

                if ($avatar) {
                    $item = get_avatar($user, '16').' '.$item;
                }

                $_users[$role][] = $before.$item.$after;
            }
        }
    }

    return $_users;
}

function gdbbx_update_shorthand_bbcodes($content) {
    $bbcodes = array('quote', 'topic', 'reply', 'url', 'email', 'size', 'color', 'area', 'anchor', 'hide', 'img', 'embed', 'youtube', 'vimeo');

    foreach ($bbcodes as $bbc) {
        if (strpos($content, '['.$bbc.'=') !== false) {
            $content = str_replace('['.$bbc.'=', '['.$bbc.' '.$bbc.'=', $content);
        }
    }

    return $content;
}

function gdbbx_list_of_statistics_elements() {
    return array(
        'user_count' => __("Users", "gd-bbpress-toolbox"),
        'forum_count' => __("Forums", "gd-bbpress-toolbox"),
        'topic_count' => __("Topics", "gd-bbpress-toolbox"),
        'topic_count_open' => __("Open Topics", "gd-bbpress-toolbox"),
        'topic_count_hidden' => __("Hidden Topics", "gd-bbpress-toolbox"),
        'topic_count_closed' => __("Closed Topics", "gd-bbpress-toolbox"),
        'post_count' => __("Posts", "gd-bbpress-toolbox"),
        'reply_count' => __("Replies", "gd-bbpress-toolbox"),
        'reply_count_hidden' => __("Hidden Replies", "gd-bbpress-toolbox"),
        'topic_tag_count' => __("Topic Tags", "gd-bbpress-toolbox"),
        'empty_topic_tag_count' => __("Empty Topic Tags", "gd-bbpress-toolbox")
    );
}

function gdbbx_get_forum_children_ids($forum_id) {
    $ids = gdbbx_db()->get_forum_children($forum_id);

    if (!empty($ids)) {
        $children = array();

        foreach ($ids as $id) {
            if ($list = gdbbx_get_forum_children_ids($id)) {
                $children = array_merge($children, $list);
            }
        }

        $ids = array_merge($ids, $children);
    }

    return $ids;
}

function gdbbx_get_keymasters() {
    $users = get_users( array(
        'role__in' => bbp_get_keymaster_role()
    ));

    return apply_filters('gdbbx_get_keymasters', $users);
}

function gdbbx_get_moderators() {
    $users = get_users( array(
        'role__in' => bbp_get_moderator_role()
    ));

    return apply_filters('gdbbx_get_moderators', $users);
}
