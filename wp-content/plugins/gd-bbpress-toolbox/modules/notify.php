<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Notify {
    public function __construct() {
        require_once(GDBBX_PATH.'core/functions/notify.php');

        if (gdbbx()->get('notify_subscribers_sender_active', 'bbpress')) {
            add_action('bbp_pre_notify_subscribers', array($this, 'subscription_notify_hook_sender'));
            add_action('bbp_pre_notify_forum_subscribers', array($this, 'subscription_notify_hook_sender'));
            add_action('bbp_pre_notify_topic_edit_subscribers', array($this, 'subscription_notify_hook_sender'));
            add_action('bbp_pre_notify_reply_edit_subscribers', array($this, 'subscription_notify_hook_sender'));
            add_action('bbp_pre_notify_new_topic_moderators', array($this, 'subscription_notify_hook_sender'));

            add_action('bbp_post_notify_subscribers', array($this, 'subscription_notify_unhook_sender'));
            add_action('bbp_post_notify_forum_subscribers', array($this, 'subscription_notify_unhook_sender'));
            add_action('bbp_post_notify_topic_edit_subscribers', array($this, 'subscription_notify_unhook_sender'));
            add_action('bbp_post_notify_reply_edit_subscribers', array($this, 'subscription_notify_unhook_sender'));
            add_action('bbp_post_notify_new_topic_moderators', array($this, 'subscription_notify_unhook_sender'));
        }

        if (gdbbx()->get('notify_moderators_topic_active', 'bbpress')) {
            add_filter('bbp_new_topic_moderators_mail_message', array($this, 'new_topic_moderators_mail_message'), 10, 3);
            add_filter('bbp_new_topic_moderators_mail_title', array($this, 'new_topic_moderators_mail_title'), 10, 3);
        }

        if (gdbbx()->get('notify_subscribers_reply_edit_active', 'bbpress')) {
            add_filter('bbp_reply_edit_subscription_mail_message', array($this, 'subscription_reply_edit_mail_message'), 10, 2);
            add_filter('bbp_reply_edit_subscription_mail_title', array($this, 'subscription_reply_edit_mail_title'), 10, 2);
        }

        if (gdbbx()->get('notify_subscribers_edit_active', 'bbpress')) {
            add_filter('bbp_topic_edit_subscription_mail_message', array($this, 'subscription_topic_edit_mail_message'), 10, 2);
            add_filter('bbp_topic_edit_subscription_mail_title', array($this, 'subscription_topic_edit_mail_title'), 10, 2);
        }

        if (gdbbx()->get('notify_subscribers_forum_override_active', 'bbpress')) {
            add_filter('bbp_forum_subscription_mail_message', array($this, 'subscription_forum_mail_message'), 10, 3);
            add_filter('bbp_forum_subscription_mail_title', array($this, 'subscription_forum_mail_title'), 10, 3);
        }

        if (gdbbx()->get('notify_subscribers_override_active', 'bbpress')) {
            add_filter('bbp_subscription_mail_message', array($this, 'subscription_mail_message'), 10, 3);
            add_filter('bbp_subscription_mail_title', array($this, 'subscription_mail_title'), 10, 3);
        }

        if (gdbbx()->get('topic_notification_on_edit', 'bbpress')) {
            add_action('bbp_edit_topic_post_extras', 'gdbbx_notify_topic_subscribers_on_edit');
            add_action('bbp_theme_before_topic_form_submit_wrapper', array($this, 'topic_notify_on_update_checkbox'));
        }

        if (gdbbx()->get('reply_notification_on_edit', 'bbpress')) {
            add_action('bbp_edit_reply_post_extras', 'gdbbx_notify_reply_subscribers_on_edit');
            add_action('bbp_theme_before_reply_form_submit_wrapper', array($this, 'reply_notify_on_update_checkbox'));
        }

        if (gdbbx()->get('new_topic_notification_keymaster', 'bbpress') || gdbbx()->get('new_topic_notification_moderator', 'bbpress')) {
            add_action('bbp_new_topic', 'gdbbx_notify_moderators_on_new_topic', 15, 2);
        }
    }

    public function subscription_notify_hook_sender() {
        add_filter('wp_mail_from', array($this, 'mail_from_email'), 10000000);
        add_filter('wp_mail_from_name', array($this, 'mail_from_name'), 10000000);
    }

    public function subscription_notify_unhook_sender() {
        remove_filter('wp_mail_from', array($this, 'mail_from_email'), 10000000);
        remove_filter('wp_mail_from_name', array($this, 'mail_from_name'), 10000000);
    }

    public function mail_from_email($email) {
        $start = gdbbx()->get('notify_subscribers_sender_email', 'bbpress');

        if ($start != '') {
            $email = $start;
        }

        return $email;
    }

    public function mail_from_name($name) {
        $start = gdbbx()->get('notify_subscribers_sender_name', 'bbpress');

        if ($start != '') {
            $name = $start;
        }

        return $name;
    }

    public function subscription_reply_edit_mail_message($message, $reply_id) {
        $start = gdbbx()->get('notify_subscribers_reply_edit_content', 'bbpress');

        if ($start != '') {
            $topic_id = bbp_get_reply_topic_id();

            $tags = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'TOPIC_TITLE' => strip_tags(bbp_get_topic_title($topic_id)),
                'REPLY_TITLE' => strip_tags(bbp_get_reply_title($reply_id)),
                'REPLY_LINK' => bbp_get_reply_url($reply_id),
                'REPLY_EDITOR' => gdbbx_get_user_display_name(),
                'REPLY_AUTHOR' => bbp_get_reply_author_display_name($reply_id),
                'REPLY_CONTENT' => strip_tags(bbp_get_reply_content($reply_id)),
                'REPLY_EDIT' => $this->reply_revision_log($reply_id)
            );

            if (gdbbx()->get('notify_subscribers_reply_edit_shortcodes', 'bbpress')) {
                $start = do_shortcode($start);
            }

            $message = d4p_replace_tags_in_content($start, $tags);
        }

        return $message;
    }

    public function subscription_reply_edit_mail_title($title, $reply_id) {
        $start = gdbbx()->get('notify_subscribers_reply_edit_subject', 'bbpress');

        if ($start != '') {
            $topic_id = bbp_get_reply_topic_id();

            $title = str_replace('%BLOG_NAME%', wp_specialchars_decode(get_option('blogname'), ENT_QUOTES), $start);
            $title = str_replace('%TOPIC_TITLE%', strip_tags(bbp_get_topic_title($topic_id)), $title);
            $title = str_replace('%REPLY_TITLE%', strip_tags(bbp_get_reply_title($reply_id)), $title);
        }

        return $title;
    }

    public function subscription_topic_edit_mail_message($message, $topic_id) {
        $start = gdbbx()->get('notify_subscribers_edit_content', 'bbpress');

        if ($start != '') {
             $tags = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'TOPIC_TITLE' => strip_tags(bbp_get_topic_title($topic_id)),
                'TOPIC_LINK' => get_permalink($topic_id),
                'TOPIC_EDITOR' => gdbbx_get_user_display_name(),
                'TOPIC_AUTHOR' => bbp_get_topic_author_display_name($topic_id),
                'TOPIC_CONTENT' => strip_tags(bbp_get_topic_content($topic_id)),
                'TOPIC_EDIT' => $this->topic_revision_log($topic_id)
            );

            if (gdbbx()->get('notify_subscribers_edit_shortcodes', 'bbpress')) {
                $start = do_shortcode($start);
            }

            $message = d4p_replace_tags_in_content($start, $tags);
        }

        return $message;
    }

    public function subscription_topic_edit_mail_title($title, $topic_id) {
        $start = gdbbx()->get('notify_subscribers_edit_subject', 'bbpress');

        if ($start != '') {
            $title = str_replace('%BLOG_NAME%', wp_specialchars_decode(get_option('blogname'), ENT_QUOTES), $start);
            $title = str_replace('%TOPIC_TITLE%', strip_tags(bbp_get_topic_title($topic_id)), $title);
        }

        return $title;
    }

    public function subscription_mail_message($message, $reply_id, $topic_id) {
        $start = gdbbx()->get('notify_subscribers_override_content', 'bbpress');

        if ($start != '') {
            $tags = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'TOPIC_TITLE' => strip_tags(bbp_get_topic_title($topic_id)),
                'TOPIC_LINK' => get_permalink($topic_id),
                'TOPIC_AUTHOR' => bbp_get_topic_author_display_name($topic_id),
                'REPLY_LINK' => bbp_get_reply_url($reply_id),
                'REPLY_AUTHOR' => bbp_get_reply_author_display_name($reply_id),
                'REPLY_CONTENT' => strip_tags(bbp_get_reply_content($reply_id))
            );

            if (gdbbx()->get('notify_subscribers_override_shortcodes', 'bbpress')) {
                $start = do_shortcode($start);
            }

            $message = d4p_replace_tags_in_content($start, $tags);
        }

        return $message;
    }

    public function subscription_mail_title($title, $reply_id, $topic_id) {
        $start = gdbbx()->get('notify_subscribers_override_subject', 'bbpress');

        if ($start != '') {
            $title = str_replace('%BLOG_NAME%', wp_specialchars_decode(get_option('blogname'), ENT_QUOTES), $start);
            $title = str_replace('%TOPIC_TITLE%', strip_tags(bbp_get_topic_title($topic_id)), $title);
        }

        return $title;
    }

    public function subscription_forum_mail_message($message, $topic_id, $forum_id) {
        $start = gdbbx()->get('notify_subscribers_forum_override_content', 'bbpress');

        if ($start != '') {
            $tags = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'TOPIC_TITLE' => strip_tags(bbp_get_topic_title($topic_id)),
                'TOPIC_LINK' => get_permalink($topic_id),
                'TOPIC_AUTHOR' => bbp_get_topic_author_display_name($topic_id),
                'TOPIC_CONTENT' => strip_tags(bbp_get_topic_content($topic_id)),
                'FORUM_LINK' => bbp_get_forum_permalink($forum_id),
                'FORUM_TITLE' => strip_tags(bbp_get_forum_title($forum_id))
            );

            if (gdbbx()->get('notify_subscribers_forum_override_shortcodes', 'bbpress')) {
                $start = do_shortcode($start);
            }

            $message = d4p_replace_tags_in_content($start, $tags);
        }

        return $message;
    }

    public function subscription_forum_mail_title($title, $topic_id, $forum_id) {
        $start = gdbbx()->get('notify_subscribers_forum_override_subject', 'bbpress');

        if ($start != '') {
            $title = str_replace('%BLOG_NAME%', wp_specialchars_decode(get_option('blogname'), ENT_QUOTES), $start);
            $title = str_replace('%TOPIC_TITLE%', strip_tags(bbp_get_topic_title($topic_id)), $title);
            $title = str_replace('%FORUM_TITLE%', strip_tags(bbp_get_forum_title($forum_id)), $title);
        }

        return $title;
    }

    public function new_topic_moderators_mail_message($message, $topic_id, $forum_id) {
        $start = gdbbx()->get('notify_moderators_topic_content', 'bbpress');

        if ($start != '') {
             $tags = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'TOPIC_TITLE' => strip_tags(bbp_get_topic_title($topic_id)),
                'TOPIC_LINK' => get_permalink($topic_id),
                'TOPIC_AUTHOR' => bbp_get_topic_author_display_name($topic_id),
                'TOPIC_CONTENT' => strip_tags(bbp_get_topic_content($topic_id)),
                'FORUM_TITLE' => strip_tags(bbp_get_forum_title($forum_id)),
                'FORUM_LINK' => get_permalink($forum_id)
            );

            if (gdbbx()->get('notify_moderators_topic_shortcodes', 'bbpress')) {
                $start = do_shortcode($start);
            }

            $message = d4p_replace_tags_in_content($start, $tags);
        }

        return $message;
    }

    public function new_topic_moderators_mail_title($title, $topic_id, $forum_id) {
        $start = gdbbx()->get('notify_moderators_topic_subject', 'bbpress');

        if ($start != '') {
            $title = str_replace('%BLOG_NAME%', wp_specialchars_decode(get_option('blogname'), ENT_QUOTES), $start);
            $title = str_replace('%TOPIC_TITLE%', strip_tags(bbp_get_topic_title($topic_id)), $title);
            $title = str_replace('%FORUM_TITLE%', strip_tags(bbp_get_forum_title($forum_id)), $title);
        }

        return $title;
    }

    public function topic_revision_log($topic_id = 0) {
        $topic_id = bbp_get_topic_id($topic_id);
        $revision_log = bbp_get_topic_raw_revision_log($topic_id);

        if (empty($topic_id) || empty($revision_log) || !is_array($revision_log)) {
            return __("No log saved.", "gd-bbpress-toolbox");
        }

        $revisions = bbp_get_topic_revisions($topic_id);
        if (empty($revisions)) {
            return __("No log saved.", "gd-bbpress-toolbox");
        }

        $r = '';

        foreach ((array)$revisions as $revision) {
            if (empty($revision_log[$revision->ID])) {
                $author_id = $revision->post_author;
                $reason    = '';
            } else {
                $author_id = $revision_log[$revision->ID]['author'];
                $reason    = $revision_log[$revision->ID]['reason'];
            }

            $author = bbp_get_topic_author_display_name($revision->ID);

            if (!empty($reason)) {
                $r.= sprintf(__("This topic was modified by %s. Reason: %s", "gd-bbpress-toolbox"), $author, esc_html($reason))."\n";
            }
        }

        if (empty($r)) {
            return __("No log saved.", "gd-bbpress-toolbox");
        }

        return $r;
    }

    public function reply_revision_log($reply_id = 0) {
        $reply_id = bbp_get_reply_id($reply_id);
        $revision_log = bbp_get_reply_raw_revision_log($reply_id);

        if (empty($reply_id) || empty($revision_log) || !is_array($revision_log)) {
            return __("No log saved.", "gd-bbpress-toolbox");
        }

        $revisions = bbp_get_reply_revisions($reply_id);
        if (empty($revisions)) {
            return __("No log saved.", "gd-bbpress-toolbox");
        }

        $r = '';

        foreach ((array)$revisions as $revision) {
            if (empty($revision_log[$revision->ID])) {
                $author_id = $revision->post_author;
                $reason    = '';
            } else {
                $author_id = $revision_log[$revision->ID]['author'];
                $reason    = $revision_log[$revision->ID]['reason'];
            }

            $author = bbp_get_reply_author_display_name($revision->ID);

            if (!empty($reason)) {
                $r.= sprintf(__("This reply was modified by %s. Reason: %s", "gd-bbpress-toolbox"), $author, esc_html($reason))."\n";
            }
        }

        if (empty($r)) {
            return __("No log saved.", "gd-bbpress-toolbox");
        }

        return $r;
    }

    public function topic_notify_on_update_checkbox() {
        if (bbp_is_topic_edit()) {
            include(gdbbx_get_template_part('gdbbx-form-notify-on-topic-edit.php'));
        }
    }

    public function reply_notify_on_update_checkbox() {
        if (bbp_is_reply_edit()) {
            include(gdbbx_get_template_part('gdbbx-form-notify-on-reply-edit.php'));
        }
    }
}
