<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Lock {
    public function __construct() {
        add_action('gdbbx_template', array($this, 'loader'));

        if (!is_admin() && !is_user_logged_in() && gdbbx()->get('redirect_for_visitors', 'lock')) {
            add_action('bbp_head', array($this, 'redirect'));
        }

        if (gdbbx()->get('redirect_blocked_users', 'lock')) {
            remove_action('bbp_template_redirect', 'bbp_forum_enforce_blocked', 1);
            add_action('bbp_template_redirect', 'gdbbx_forum_enforce_blocked', 1);
        }

        if (gdbbx()->get('redirect_hidden_forums', 'lock')) {
            remove_action('bbp_template_redirect', 'bbp_forum_enforce_hidden', 1);
            add_action('bbp_template_redirect', 'gdbbx_forum_enforce_hidden', 1);
        }

        if (gdbbx()->get('redirect_private_forums', 'lock')) {
            remove_action('bbp_template_redirect', 'bbp_forum_enforce_private', 1);
            add_action('bbp_template_redirect', 'gdbbx_forum_enforce_private', 1);
        }
    }

    public function redirect_to_key($key) {
        $url = gdbbx()->get($key, 'lock');

        if (empty($url)) {
            $url = get_site_url();
        }

        wp_redirect($url);
        exit;
    }

    public function redirect() {
        if (gdbbx_is_bbpress()) {
            $this->redirect_to_key('redirect_for_visitors_url');
        }
    }

    public function loader() {
        if ($this->is_topic_locked() && !gdbbx()->allowed('topic_form_allow', 'lock')) {
            $this->forum_lock_topic_form();
        }

        if ($this->is_reply_locked() && !gdbbx()->allowed('reply_form_allow', 'lock')) {
            $this->forum_lock_reply_form();
        }

        if (!$this->is_topic_locked()) {
            if (gdbbx_current_user_can_moderate() && gdbbx()->get('button_topic_lock_active', 'lock')) {
                add_action('bbp_get_request_lock', array($this, 'process_lock'));
                add_action('bbp_get_request_unlock', array($this, 'process_lock'));

                if (gdbbx()->get('button_topic_lock_location', 'lock') == 'header') {
                    add_filter('bbp_topic_admin_links', array($this, 'lock_link'), 20, 2);
                }

                if (gdbbx()->get('button_topic_lock_location', 'lock') == 'footer') {
                    add_filter('gdbbx_topic_footer_links', array($this, 'lock_link'), 20, 2);
                }
            } else {
                if (get_post_meta(bbp_get_topic_id(), '_gdbbx_temp_lock', true) == 'locked') {
                    $this->topic_lock_topic_form();
                }
            }

            add_filter('bbp_get_reply_class', array($this, 'topic_post_class'), 10, 2);
            add_filter('bbp_get_topic_class', array($this, 'topic_post_class'), 10, 2);
        }
    }

    public function topic_post_class($classes, $topic_id) {
        $locked = get_post_meta($topic_id, '_gdbbx_temp_lock', true);

        if ($locked == 'locked') {
            $classes[] = 'locked-topic';
        }

        return $classes;
    }

    public function process_lock() {
        $post_id = intval($_GET['id']);
        $action = $_GET['action'];

        if (!gdbbx_current_user_can_moderate()) {
            bbp_add_error('bgdbx_lock_not_moderator', __("<strong>ERROR</strong>: You can't lock topics.", "gd-bbpress-toolbox"));
        }

        if (!bbp_verify_nonce_request('gdbbx_lock_'.$post_id)) {
            bbp_add_error('bgdbx_lock_nonce', __("<strong>ERROR</strong>: Are you sure you wanted to do that?", "gd-bbpress-toolbox"));
        }

        if (bbp_has_errors()) {
            return;
        }

        delete_post_meta($post_id, '_gdbbx_temp_lock');

        if ($action == 'lock') {
            add_post_meta($post_id, '_gdbbx_temp_lock', 'locked', true);
        }

        $url = remove_query_arg(array('_wpnonce', 'id', 'action'));

        wp_redirect($url);
        exit;
    }

    public function lock_link($links, $id) { 
        $locked = get_post_meta($id, '_gdbbx_temp_lock', true);

        $url = bbp_get_topic_permalink($id);
        $url = add_query_arg('id', $id, $url);
        $url = add_query_arg('_wpnonce', wp_create_nonce('gdbbx_lock_'.$id), $url);

        if ($locked == 'locked') {
            $url = add_query_arg('action', 'unlock', $url);

            $links['gdbbx_lock'] = '<a href="'.$url.'" class="d4p-bbt-lock-link">'.__("Unlock", "gd-bbpress-toolbox").'</a>';
        } else {
            $url = add_query_arg('action', 'lock', $url);

            $links['gdbbx_lock'] = '<a href="'.$url.'" class="d4p-bbt-lock-link">'.__("Lock", "gd-bbpress-toolbox").'</a>';
        }

        return $links;
    }

    public function is_topic_temp_locked($topic_id = 0) {
        $topic_id = bbp_get_topic_id($topic_id);

        return get_post_meta($topic_id, '_gdbbx_temp_lock', true) === 'locked';
    }

    public function is_topic_locked($topic_id = 0) {
        $forum_id = $topic_id > 0 ? bbp_get_topic_forum_id($topic_id) : 0;

        $forum = gdbbx_obj_forums()->forum($forum_id)->privacy()->get('lock_topic_form');

        $active = false;
        if ($forum == 'default') {
            $active = gdbbx()->get('topic_form_locked', 'lock');
        } else if ($forum == 'yes') {
            $active = true;
        } else if ($forum == 'no') {
            $active = false;
        }

        return apply_filters('gdbbx_privacy_is_topic_locked', $active, $topic_id, $forum_id);
    }

    public function is_reply_locked($reply_id = 0) {
        $forum_id = $reply_id > 0 ? bbp_get_reply_forum_id($reply_id) : 0;

        $forum = gdbbx_obj_forums()->forum($forum_id)->privacy()->get('lock_reply_form');

        $active = false;
        if ($forum == 'default') {
            $active = gdbbx()->get('reply_form_locked', 'lock');
        } else if ($forum == 'yes') {
            $active = true;
        } else if ($forum == 'no') {
            $active = false;
        }

        return apply_filters('gdbbx_privacy_is_reply_locked', $active, $reply_id, $forum_id);
    }

    public function topic_lock_topic_form() {
        add_filter('bbp_get_template_part', array($this, 'replace_topic_reply_form'), 100000, 3);
    }

    public function forum_lock_topic_form() {
        add_filter('bbp_get_template_part', array($this, 'replace_forum_topic_form'), 100000, 3);
    }

    public function forum_lock_reply_form() {
        add_filter('bbp_get_template_part', array($this, 'replace_forum_reply_form'), 100000, 3);
    }

    public function replace_topic_reply_form($templates, $slug, $name) {
        if ($slug == 'form' && $name == 'reply' && !bbp_is_reply_edit()) {
            $templates = array('gdbbx-form-lock.php');
        }

        return $templates;
    }

    public function replace_forum_topic_form($templates, $slug, $name) {
        if ($slug == 'form' && $name == 'topic') {
            $templates = array('gdbbx-form-topic-locked.php');
        }

        return $templates;
    }

    public function replace_forum_reply_form($templates, $slug, $name) {
        if (gdbbx_is_user_allowed_to_topic()) {
            if ($slug == 'form' && $name == 'reply') {
                $templates = array('gdbbx-form-reply-locked.php');
            }
        }

        return $templates;
    }
}

/** @return gdbbxMod_Lock */
function gdbbx_module_lock() {
    return gdbbx_loader()->modules['lock'];
}
