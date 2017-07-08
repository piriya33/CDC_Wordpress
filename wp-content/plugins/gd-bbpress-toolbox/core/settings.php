<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_settings {
    public $info;
    public $temp = array();
    public $current = array();
    public $settings = array(
        'core' => array(
            'wp44_update' => false,
            'notice_gdtox_hide' => false,
            'notice_gdpol_hide' => false,
            'unread_cutoff' => 0
        ),
        'settings' => array(
            'load_own_css' => true,
            'load_own_css_widgets' => true,
            'load_own_js' => true,
            'load_fontawesome' => true,
            'load_always' => false,
            'load_fitvids' => true,
            'fontawesome_source' => 'maxcdn'
        ),
        'buddypress' => array(
            'xprofile_support' => false,
            'xprofile_signature_field_id' => 0,
            'xprofile_signature_field_add' => false,
            'disable_profile_override' => false,
            'disable_favorites_override' => false,
            'disable_subscriptions_override' => false,
        ),
        'thanks' => array(
            'active' => false,
            'removal' => false,
            'topic' => true,
            'reply' => false,
            'location' => 'footer',
            'allow_super_admin' => true,
            'allow_roles' => null,
            'limit_display' => 20,
            'notify_active' => false,
            'notify_shortcodes' => true,
            'notify_content' => '',
            'notify_subject' => '[%BLOG_NAME%] Thanks received: %POST_TITLE%'
        ),
        'disable_rss' => array(
            'active' => false,
            'view_feed' => false,
            'view_feed_redirect' => 'parent',
            'forum_feed' => false,
            'forum_feed_redirect' => 'parent',
            'topic_feed' => false,
            'topic_feed_redirect' => 'parent',
            'reply_feed' => false,
            'reply_feed_redirect' => 'forums'
        ),
        'report' => array(
            'active' => false,
            'location' => 'footer',
            'allow_roles' => null,
            'notify_active' => true,
            'report_mode' => 'form',
            'scroll_form' => true,
            'show_report_status' => false,
            'notify_keymasters' => true,
            'notify_moderators' => true,
            'notify_shortcodes' => true,
            'notify_content' => '',
            'notify_subject' => '[%BLOG_NAME%] Post reported: %REPORT_TITLE%'
        ),
        'online' => array(
            'active' => true,
            'window' => 180,
            'track_users' => true,
            'track_guests' => true,
            'users' => array(),
            'guests' => array(),
            'dashboard_widget' => true,
            'users_stats' => false,
            'max_users_count' => 0,
            'max_users_timestamp' => 0,
            'max_guests_count' => 0,
            'max_guests_timestamp' => 0,
            'max_total_count' => 0,
            'max_total_timestamp' => 0
        ),
        'canned' => array(
            'active' => false,
            'post_type_singular' => 'Canned Reply',
            'post_type_plural' => 'Canned Replies',
            'use_taxonomy' => false,
            'taxonomy_singular' => 'Category',
            'taxonomy_plural' => 'Categories',
            'auto_close_on_insert' => true
        ),
        'attachments' => array(
            'attachments_active' => true,
            'validation_active' => true,
            'insert_into_content' => true,
            'form_position_topic' => 'bbp_theme_before_topic_form_submit_wrapper',
            'form_position_reply' => 'bbp_theme_before_reply_form_submit_wrapper',
            'files_list_position' => 'content',
            'mime_types_limit_active' => false,
            'mime_types_limit_display' => false,
            'mime_types_list' => array(),
            'extra_mime_types' => array(
                'txt' => 'text/plain'
            ),
            'topic_featured_image' => false,
            'reply_featured_image' => false,
            'grid_topic_counter' => true,
            'grid_reply_counter' => true,
            'delete_method' => 'default',
            'delete_attachments' => 'detach',
            'hide_from_visitors' => true,
            'max_file_size' => 512,
            'max_to_upload' => 4,
            'file_target_blank' => false,
            'roles_to_upload' => null,
            'roles_no_limit' => array('bbp_keymaster'),
            'attachment_icon' => true,
            'attachment_icons' => true,
            'icons_mode' => 'font',
            'download_link_attribute' => true,
            'image_thumbnail_active' => true,
            'image_thumbnail_inline' => true,
            'image_thumbnail_caption' => true,
            'image_thumbnail_rel' => 'lightbox',
            'image_thumbnail_css' => '',
            'image_thumbnail_size' => '128x72',
            'log_upload_errors' => true,
            'errors_visible_to_admins' => true,
            'errors_visible_to_moderators' => true,
            'errors_visible_to_author' => true,
            'delete_visible_to_admins' => 'both',
            'delete_visible_to_moderators' => 'no',
            'delete_visible_to_author' => 'no'
        ),
        'seo' => array(
            'override_forum_title_replace' => false,
            'override_forum_title_text' => 'Forum: %FORUM_TITLE%',
            'override_topic_title_replace' => false,
            'override_topic_title_text' => '%FORUM_TITLE% - Topic: %TOPIC_TITLE%',
            'override_reply_title_replace' => false,
            'override_reply_title_text' => '%REPLY_TITLE%',
            'override_forum_excerpt' => false,
            'override_topic_excerpt' => false,
            'override_topic_length' => 150,
            'private_topic_excerpt_replace' => true,
            'private_topic_excerpt_text' => "Topic '%TOPIC_TITLE%' is marked as private.",
            'override_reply_excerpt' => false,
            'override_reply_length' => 150,
            'private_reply_excerpt_replace' => true,
            'private_reply_excerpt_text' => "Reply to topic '%TOPIC_TITLE%' is marked as private.",
            'meta_description_forum' => false,
            'meta_description_topic' => false,
            'meta_description_reply' => false,
            'noindex_private_topic' => true,
            'noindex_private_reply' => true,
            'rich_snippet_breadcrumbs' => true
        ),
        'bbpress' => array(
            'tags_in_reply_form_only_for_author' => false,
            'roles_gdbbx_moderation' => false,
            'apply_fitvids_to_content' => true,
            'topic_single_copy_active' => true,
            'topic_single_copy_location' => 'footer',
            'topic_thread_copy_active' => true,
            'topic_thread_copy_location' => 'footer',
            'disable_make_clickable_topic' => false,
            'disable_make_clickable_reply' => false,
            'disable_mention_filter_topic' => false,
            'disable_mention_filter_reply' => false,
            'new_topic_notification_keymaster' => false,
            'new_topic_notification_moderator' => false,
            'topic_notification_on_edit' => false,
            'reply_notification_on_edit' => false,
            'forum_list_topic_thumbnail' => false,

            'forum_load_welcome_front' => false,
            'forum_load_welcome_filter' => 'before',
            'forum_load_welcome_front_roles' => null,
            'forum_load_welcome_show_links' => true,
            'forum_load_statistics_front' => false,
            'forum_load_statistics_filter' => 'after',
            'forum_load_statistics_front_roles' => null,
            'forum_load_statistics_front_visitor' => false,
            'forum_load_statistics_show_online' => true,
            'forum_load_statistics_show_online_overview' => true,
            'forum_load_statistics_show_online_top' => true,
            'forum_load_statistics_show_users' => 0, //30m, 60m, 24h, 7d
            'forum_load_statistics_show_users_colors' => false,
            'forum_load_statistics_show_users_avatars' => false,
            'forum_load_statistics_show_users_links' => false,
            'forum_load_statistics_show_users_limit' => 32,
            'forum_load_statistics_show_legend' => false,
            'forum_load_statistics_show_statistics' => true,
            'forum_load_statistics_show_statistics_totals' => true,
            'forum_load_statistics_show_statistics_newest_user' => false,

            'new_topic_minmax_active' => false,
            'new_topic_min_title_length' => 0,
            'new_topic_min_content_length' => 0,
            'new_topic_max_title_length' => 0,
            'new_topic_max_content_length' => 0,
            'new_reply_minmax_active' => false,
            'new_reply_min_title_length' => 0,
            'new_reply_min_content_length' => 0,
            'new_reply_max_title_length' => 0,
            'new_reply_max_content_length' => 0,
            'participant_media_library_upload' => false,
            'fix_404_headers_error' => true,
            'navmenu_metabox_extras' => true,
            'navmenu_metabox_views' => true,
            'topic_links_remove_merge' => false,
            'reply_links_remove_split' => false,
            'topic_links_edit_footer' => false,
            'topic_links_reply_footer' => false,
            'reply_links_edit_footer' => false,
            'reply_links_reply_footer' => false,
            'reply_close_topic_checkbox_active' => false,
            'reply_close_topic_checkbox_topic_author' => true,
            'reply_close_topic_checkbox_super_admin' => true,
            'reply_close_topic_checkbox_roles' => array('bbp_keymaster'),
            'reply_close_topic_checkbox_form_position' => 'bbp_theme_before_reply_form_submit_wrapper',
            'forum_mark_replied' => true,
            'forum_mark_stick' => true,
            'forum_mark_lock' => true,
            'title_length_override' => false,
            'title_length_value' => 80,
            'reply_titles' => false,
            'private_topic_form_position' => 'bbp_theme_before_topic_form_submit_wrapper',
            'private_reply_form_position' => 'bbp_theme_before_reply_form_submit_wrapper',
            'private_topics' => false,
            'private_topics_super_admin' => true,
            'private_topics_roles' => null,
            'private_topics_visitor' => false,
            'private_topics_default' => 'unchecked',
            'private_topics_icon' => true,
            'private_replies' => false,
            'private_replies_threaded' => true,
            'private_replies_super_admin' => true,
            'private_replies_roles' => null,
            'private_replies_visitor' => false,
            'private_replies_default' => 'unchecked',
            'private_replies_css_hide' => false,
            'enable_lead_topic' => false,
            'enable_topic_reversed_replies' => false,
            'kses_allowed_override' => 'bbpress',
            'allowed_tags_div' => true,
            'kses_img_class' => false,
            'disable_bbpress_breadcrumbs' => false,
            'revisions_reply_protection_active' => false,
            'revisions_reply_protection_author' => true,
            'revisions_reply_protection_topic_author' => true,
            'revisions_reply_protection_super_admin' => true,
            'revisions_reply_protection_roles' => null,
            'revisions_reply_protection_visitor' => false,
            'notify_subscribers_override_active' => false,
            'notify_subscribers_override_shortcodes' => true,
            'notify_subscribers_override_content' => '',
            'notify_subscribers_override_subject' => '[%BLOG_NAME%] New reply for: %TOPIC_TITLE%',
            'notify_subscribers_forum_override_active' => false,
            'notify_subscribers_forum_override_shortcodes' => true,
            'notify_subscribers_forum_override_content' => '',
            'notify_subscribers_forum_override_subject' => '[%BLOG_NAME%] New topic in forum %FORUM_TITLE%: %TOPIC_TITLE%',
            'notify_subscribers_edit_active' => false,
            'notify_subscribers_edit_shortcodes' => true,
            'notify_subscribers_edit_content' => '',
            'notify_subscribers_edit_subject' => '[%BLOG_NAME%] Topic edited: %TOPIC_TITLE%',
            'notify_subscribers_reply_edit_active' => false,
            'notify_subscribers_reply_edit_shortcodes' => true,
            'notify_subscribers_reply_edit_content' => '',
            'notify_subscribers_reply_edit_subject' => '[%BLOG_NAME%] Reply edited: %REPLY_TITLE%',
            'notify_moderators_topic_active' => false,
            'notify_moderators_topic_shortcodes' => true,
            'notify_moderators_topic_content' => '',
            'notify_moderators_topic_subject' => '[%BLOG_NAME%] New topic in forum %FORUM_TITLE%: %TOPIC_TITLE%',
            'notify_subscribers_sender_active' => false,
            'notify_subscribers_sender_name' => '',
            'notify_subscribers_sender_email' => '',
            'nofollow_topic_content' => true,
            'nofollow_reply_content' => true,
            'nofollow_topic_author' => true,
            'nofollow_reply_author' => true
        ),
        'lock' => array(
            'redirect_for_visitors' => false,
            'redirect_for_visitors_url' => '',

            'redirect_hidden_forums' => false,
            'redirect_hidden_forums_url' => '',
            'redirect_private_forums' => false,
            'redirect_private_forums_url' => '',
            'redirect_blocked_users' => false,
            'redirect_blocked_users_url' => '',

            'topic_form_locked' => false,
            'topic_form_allow_super_admin' => true,
            'topic_form_allow_roles' => array('bbp_keymaster'),
            'topic_form_message' => 'Forums are currently locked.',
            'reply_form_locked' => false,
            'reply_form_allow_super_admin' => true,
            'reply_form_allow_roles' => array('bbp_keymaster'),
            'reply_form_message' => 'Forums are currently locked.',
            'button_topic_lock_active' => true,
            'button_topic_lock_location' => 'footer'
        ),
        'tools' => array(
            'users_stats_active' => true,
            'users_stats_super_admin' => true,
            'users_stats_visitor' => false,
            'users_stats_roles' => null,
            'users_stats_show_registration_date' => false,
            'users_stats_show_topics' => true,
            'users_stats_show_replies' => true,
            'users_stats_show_thanks_given' => false,
            'users_stats_show_thanks_received' => false,

            'latest_track_users_topic' => true,
            'latest_use_cutoff_timestamp' => true,
            'latest_topic_new_replies_mark' => true,
            'latest_topic_new_replies_strong_title' => true,
            'latest_topic_new_replies_in_thread' => true,
            'latest_topic_new_topic_badge' => true,
            'latest_topic_new_topic_strong_title' => true,
            'latest_topic_unread_topic_badge' => true,
            'latest_topic_unread_topic_strong_title' => true,

            'latest_forum_new_posts_badge' => true,
            'latest_forum_new_posts_strong_title' => false,
            'latest_forum_unread_forum_badge' => false,
            'latest_forum_unread_forum_strong_title' => false,

            'track_last_activity_active' => true,
            'track_current_session_cookie_expiration' => 60,
            'track_basic_cookie_expiration' => 365,
            'topic_columns_attachments' => true,
            'topic_columns_private' => true,
            'reply_columns_attachments' => true,
            'reply_columns_private' => true,
            'user_columns_topics_replies' => true,
            'user_columns_last_activity' => true,
            'dashboard_widget_activity' => true,
            'dashboard_widget_remove' => false,
            'extra_mime_types' => array(),
            'add_forum_features' => array(),
            'add_topic_features' => array(),
            'add_reply_features' => array(),
            'shortcodes_general_active' => true,
            'shortcodes_general_super_admin' => true,
            'shortcodes_general_visitor' => false,
            'shortcodes_general_roles' => null,
            'shortcodes_bbpress_active' => true,
            'shortcodes_bbpress_super_admin' => true,
            'shortcodes_bbpress_visitor' => false,
            'shortcodes_bbpress_roles' => null,
            'editor_topic_active' => false,
            'editor_topic_tinymce' => false,
            'editor_topic_teeny' => false,
            'editor_topic_media_buttons' => false,
            'editor_topic_wpautop' => true,
            'editor_topic_quicktags' => true,
            'editor_topic_textarea_rows' => 12,
            'editor_reply_active' => false,
            'editor_reply_tinymce' => false,
            'editor_reply_teeny' => false,
            'editor_reply_media_buttons' => false,
            'editor_reply_wpautop' => true,
            'editor_reply_quicktags' => true,
            'editor_reply_textarea_rows' => 12,
            'toolbar_active' => true,
            'toolbar_super_admin' => true,
            'toolbar_visitor' => true,
            'toolbar_roles' => null,
            'toolbar_title' => 'Forums',
            'toolbar_information' => true,
            'admin_disable_active' => false,
            'admin_disable_super_admin' => true,
            'admin_disable_roles' => null,
            'quote_active' => true,
            'quote_location' => 'footer',
            'quote_method' => 'bbcode',
            'quote_super_admin' => true,
            'quote_roles' => null,
            'bbcodes_toolbar_active' => true,
            'bbcodes_toolbar_size' => 'small',
            'bbcodes_toolbar_hide_image' => false,
            'bbcodes_toolbar_hide_video' => false,
            'bbcodes_toolbar_hide_rare' => true,
            'bbcodes_toolbar_hide_media' => true,
            'bbcodes_toolbar_hide_restricted' => true,
            'bbcodes_toolbar_show_available_only' => true,
            'bbcodes_toolbar_editor_fix' => true,
            'bbcodes_active' => true,
            'bbcodes_notice' => true,
            'bbcodes_bbpress_only' => false,
            'bbcodes_special_super_admin' => true,
            'bbcodes_special_roles' => null,
            'bbcodes_special_visitor' => false,
            'bbcodes_special_action' => 'info',
            'bbcodes_restricted_super_admin' => true,
            'bbcodes_restricted_administrator' => false,
            'bbcodes_deactivated' => array(),
            'bbcodes_hide_title' => 'Hidden Content',
            'bbcodes_hide_content_normal' => 'You must be logged in to see hidden content.',
            'bbcodes_hide_content_count' => 'You must be logged in and have at least %post_count% posts on this website.',
            'bbcodes_hide_content_reply' => 'You must reply before you can see hidden content.',
            'bbcodes_hide_content_thanks' => 'You must say thanks to topic author before you can see hidden content.',
            'bbcodes_spoiler_color' => '#111111',
            'bbcodes_spoiler_hover' => '#eeeeee',
            'bbcodes_scode_theme' => 'Default',
            'bbcodes_highlight_color' => '#222222',
            'bbcodes_highlight_background' => '#ffffb0',
            'bbcodes_heading_size' => 3,
            'signature_active' => true,
            'signature_limiter' => true,
            'signature_length' => 512,
            'signature_super_admin' => true,
            'signature_roles' => null,
            'signature_edit_super_admin' => true,
            'signature_edit_roles' => null,
            'signature_editor' => 'textarea',
            'signature_enhanced_active' => true,
            'signature_enhanced_method' => 'html',
            'signature_enhanced_super_admin' => true,
            'signature_enhanced_roles' => null,
            'signature_process_smilies' => true,
            'signature_process_chars' => true,
            'signature_process_autop' => true,
            'views_hide_log_required' => true,
            'view_newposts_active' => true,
            'view_newposts_slug' => 'new-posts-last-visits',
            'view_newposts_title' => 'New posts since last visit',
            'view_topicsfresh_active' => true,
            'view_topicsfresh_slug' => 'topics-freshness',
            'view_topicsfresh_title' => 'Topics Freshness',
            'view_newposts24h_active' => true,
            'view_newposts24h_slug' => 'new-posts-last-day',
            'view_newposts24h_title' => 'New posts: Last day',
            'view_newposts3dy_active' => true,
            'view_newposts3dy_slug' => 'new-posts-last-three-days',
            'view_newposts3dy_title' => 'New posts: Last three days',
            'view_newposts7dy_active' => true,
            'view_newposts7dy_slug' => 'new-posts-last-week',
            'view_newposts7dy_title' => 'New posts: Last week',
            'view_newposts1mn_active' => true,
            'view_newposts1mn_slug' => 'new-posts-last-month',
            'view_newposts1mn_title' => 'New posts: Last month',
            'view_mostreplies_active' => true,
            'view_mostreplies_slug' => 'most-replies',
            'view_mostreplies_title' => 'Topics with most replies',
            'view_latesttopics_active' => true,
            'view_latesttopics_slug' => 'latest-topics',
            'view_latesttopics_title' => 'Latest topics',
            'view_mostthanked_active' => false,
            'view_mostthanked_slug' => 'most-thanked-topics',
            'view_mostthanked_title' => 'Most thanked topics',
            'view_myactive_active' => false,
            'view_myactive_slug' => 'my-active-topics',
            'view_myactive_title' => 'My active topics',
            'view_mytopics_active' => false,
            'view_mytopics_slug' => 'my-topics',
            'view_mytopics_title' => 'All my topics',
            'view_myreply_active' => false,
            'view_myreply_slug' => 'with-my-reply',
            'view_myreply_title' => 'Topics with my reply',
            'view_mynoreplies_active' => false,
            'view_mynoreplies_slug' => 'my-topics-no-replies',
            'view_mynoreplies_title' => 'My topics with no replies',
            'view_mymostreplies_active' => true,
            'view_mymostreplies_slug' => 'my-topics-most-replies',
            'view_mymostreplies_title' => 'My topics with most replies',
            'view_mymostthanked_active' => false,
            'view_mymostthanked_slug' => 'my-most-thanked-topics',
            'view_mymostthanked_title' => 'My most thanked topics',
            'view_myfavorite_active' => true,
            'view_myfavorite_slug' => 'my-favorite-topics',
            'view_myfavorite_title' => 'My favorite topics',
            'view_mysubscribed_active' => true,
            'view_mysubscribed_slug' => 'my-subscribed-topics',
            'view_mysubscribed_title' => 'My subscribed topics'
        ),
        'widgets' => array(
            'default_disable_recenttopics' => false,
            'default_disable_recentreplies' => false,
            'default_disable_topicviewslist' => false,
            'default_disable_login' => false,
            'default_disable_stats' => false,
            'widget_topicinfo' => true,
            'widget_statistics' => true,
            'widget_onlineusers' => true,
            'widget_topicsviews' => true,
            'widget_newposts' => true,
            'widget_userprofile' => true
        )
    );

    public function __construct() {
        $this->info = new gdbbx_core_info();

        add_action('gdbbx_plugin_core_ready', array($this, 'init'));
        add_filter('gdbbx_settings_get', array($this, 'override_get'), 10, 3);
    }

    public function __get($name) {
        $get = explode('_', $name, 2);

        return $this->get($get[1], $get[0]);
    }
    
    private function _name($name) {
        return 'dev4press_'.$this->info->code.'_'.$name;
    }

    private function _install() {
        $this->current = $this->_merge();
        $this->current['info'] = $this->info->to_array();
        $this->current['info']['install'] = true;
        $this->current['info']['update'] = false;

        foreach ($this->current as $key => $data) {
            update_option($this->_name($key), $data);
        }

        $this->_db();
    }

    private function _update() {
        $old_build = $this->current['info']['build'];
        $this->current['info'] = $this->info->to_array();
        $this->current['info']['install'] = false;
        $this->current['info']['update'] = true;
        $this->current['info']['previous'] = $old_build;

        update_option($this->_name('info'), $this->current['info']);

        $settings = $this->_merge();

        foreach ($settings as $key => $data) {
            $now = get_option($this->_name($key));

            $this->temp[$key] = $now;

            if (!is_array($now)) {
                $now = $data;
            } else {
                $now = $this->_upgrade($now, $data);
            }

            $this->current[$key] = $now;

            update_option($this->_name($key), $now);
        }

        $this->_migrate();
        $this->_db();
    }

    private function _upgrade($old, $new) {
        foreach ($new as $key => $value) {
            if (!array_key_exists($key, $old)) {
                $old[$key] = $value;
            }
        }

        $unset = array();
        foreach ($old as $key => $value) {
            if (!array_key_exists($key, $new)) {
                $unset[] = $key;
            }
        }

        if (!empty($unset)) {
            foreach ($unset as $key) {
                unset($old[$key]);
            }
        }

        return $old;
    }

    private function _groups() {
        return array_keys($this->settings);
    }

    private function _merge() {
        $merged = array();

        foreach ($this->settings as $key => $data) {
            $merged[$key] = array();

            foreach ($data as $name => $value) {
                $merged[$key][$name] = $value;
            }
        }

        return $merged;
    }

    private function _migrate() {
        require_once(GDBBX_PATH.'core/admin/migrate.php');

        gdbbx_settings_migration();
    }

    private function _db() {
        require_once(GDBBX_PATH.'core/admin/install.php');

        gdbbx_install_database();
    }

    public function init() {
        $this->current['info'] = get_option($this->_name('info'));

        $installed = is_array($this->current['info']) && isset($this->current['info']['build']);

        if (!$installed) {
            $this->_install();
        } else {
            $update = $this->current['info']['build'] != $this->info->build;

            if ($update) {
                $this->_update();
            } else {
                $groups = $this->_groups();

                foreach ($groups as $key) {
                    $this->current[$key] = get_option($this->_name($key));

                    if (!is_array($this->current[$key])) {
                        $data = $this->group($key);

                        if (!is_null($data)) {
                            $this->current[$key] = $data;

                            update_option($this->_name($key), $data);
                        }
                    }
                }
            }
        }

        do_action('gdbbx_plugin_settings_loaded');
    }

    public function group($group) {
        if (isset($this->settings[$group])) {
            return $this->settings[$group];
        } else {
            return null;
        }
    }

    public function exists($name, $group = 'settings') {
        if (isset($this->current[$group][$name])) {
            return true;
        } else if (isset($this->settings[$group][$name])) {
            return true;
        } else {
            return false;
        }
    }

    public function allowed($name, $group = 'settings', $visitor = false, $super_admin = true) {
        $allowed = false;

        if (current_user_can('d4p_bbpt_'.$name, 'do_not_allow') || current_user_can('gdbbx_cap_'.$name, 'do_not_allow')) {
            $allowed = true;
        }

        if ($super_admin && !$allowed && is_super_admin()) {
            $allowed = $this->get($name.'_super_admin', $group);
        }

        if (!$allowed && is_user_logged_in()) {
            $roles = $this->get($name.'_roles', $group);

            if (is_null($roles)) {
                $allowed = true;
            } else if (is_array($roles) && empty($roles)) {
                $allowed = false;
            } else if (is_array($roles) && !empty($roles)) {
                global $current_user;

                if (is_array($current_user->roles)) {
                    $matched = array_intersect($current_user->roles, $roles);
                    $allowed = !empty($matched);
                }
            }
        }

        if ($visitor && !$allowed && !is_user_logged_in()) {
            $allowed = $this->get($name.'_visitor', $group);
        }

        return apply_filters('gdbbx_allowed_'.$name, $allowed);
    }

    public function prefix_get($prefix, $group = 'settings') {
        $settings = array_keys($this->group($group));

        $results = array();

        foreach ($settings as $key) {
            if (substr($key, 0, strlen($prefix)) == $prefix) {
                $results[substr($key, strlen($prefix))] = $this->get($key, $group);
            }
        }

        return $results;
    }

    public function group_get($group) {
        return $this->current[$group];
    }

    public function get_core($name) {
        return $this->get($name, 'core');
    }

    public function get($name, $group = 'settings') {
        $exit = null;

        if (isset($this->current[$group][$name])) {
            $exit = $this->current[$group][$name];
        } else if (isset($this->settings[$group][$name])) {
            $exit = $this->settings[$group][$name];
        }

        return apply_filters('gdbbx_settings_get', $exit, $name, $group);
    }

    public function set($name, $value, $group = 'settings', $save = false) {
        $this->current[$group][$name] = $value;

        if ($save) {
            $this->save($group);
        }
    }

    public function save($group) {
        update_option($this->_name($group), $this->current[$group]);
    }

    public function is_install() {
        return $this->get('install', 'info');
    }

    public function is_update() {
        return $this->get('update', 'info');
    }

    public function override_get($value, $name, $group) {
        if ($group == 'bbpress' && $name == 'notify_subscribers_override_content' && $value == '') {
            $value = file_get_contents(GDBBX_PATH.'templates/notify_topic.txt');
        }

        if ($group == 'bbpress' && $name == 'notify_subscribers_forum_override_content' && $value == '') {
            $value = file_get_contents(GDBBX_PATH.'templates/notify_forum.txt');
        }

        if ($group == 'bbpress' && $name == 'notify_subscribers_edit_content' && $value == '') {
            $value = file_get_contents(GDBBX_PATH.'templates/notify_topic_edit.txt');
        }

        if ($group == 'bbpress' && $name == 'notify_subscribers_reply_edit_content' && $value == '') {
            $value = file_get_contents(GDBBX_PATH.'templates/notify_reply_edit.txt');
        }

        if ($group == 'bbpress' && $name == 'notify_moderators_topic_content' && $value == '') {
            $value = file_get_contents(GDBBX_PATH.'templates/notify_topic_mods.txt');
        }

        if ($group == 'report' && $name == 'notify_content' && $value == '') {
            $value = file_get_contents(GDBBX_PATH.'templates/notify_report.txt');
        }

        if ($group == 'thanks' && $name == 'notify_content' && $value == '') {
            $value = file_get_contents(GDBBX_PATH.'templates/notify_thanks.txt');
        }

        if ($group == 'attachments' && $name == 'mime_types_list' && empty($value)) {
            $list = get_allowed_mime_types();
            $value = array_keys($list);
        }

        if ($group == 'core' && $name == 'unread_cutoff' && $value == 0) {
            $value = time();

            $this->set('unread_cutoff', $value, 'core', true);
        }

        return $value;
    }

    public function remove_plugin_settings() {
        foreach ($this->_groups() as $group) {
            delete_option($this->_name($group));
        }
    }

    public function remove_forums_settings() {
        $sql = "DELETE FROM ".gdbbx_db()->wpdb()->postmeta." WHERE meta_key = '_gdbbatt_settings'";

        gdbbx_db()->query($sql);
    }

    public function remove_tracking_settings() {
        $sql = "DELETE FROM ".gdbbx_db()->wpdb()->usermeta." WHERE meta_key = '".gdbbx_db()->user_meta_key_last_activity()."'";

        gdbbx_db()->query($sql);
    }

    public function remove_signature_settings() {
        $sql = "DELETE FROM ".gdbbx_db()->wpdb()->usermeta." WHERE meta_key = 'signature'";

        gdbbx_db()->query($sql);
    }

    public function import_from_object($import, $list = array()) {
        if (empty($list)) {
            $list = $this->_groups();
        }

        foreach ($import as $key => $data) {
            if (in_array($key, $list)) {
                $this->current[$key] = (array)$data;

                $this->save($key);
            }
        }
    }

    public function serialized_export($list = array()) {
        if (empty($list)) {
            $list = $this->_groups();
        }

        $data = new stdClass();
        $data->info = $this->current['info'];

        foreach ($list as $name) {
            $data->$name = $this->current[$name];
        }

        return serialize($data);
    }

    public function session_cookie_expiration() {
        return time() + $this->get('track_current_session_cookie_expiration', 'tools') * 60;
    }

    public function tracking_cookie_expiration() {
        return time() + $this->get('track_basic_cookie_expiration', 'tools') * 3600 * 24;
    }

    public function has_free_plugins() {
        $list = array();

        if (defined('GDBBPRESSATTACHMENTS_INSTALLED')) {
            $list[] = 'GD bbPress Attachments';
        }

        if (defined('GDBBPRESSTOOLS_INSTALLED')) {
            $list[] = 'GD bbPress Tools';
        }

        if (defined('GDBBPRESSWIDGETS_INSTALLED')) {
            $list[] = 'GD bbPress Widgets';
        }

        return $list;
    }

    public function file_version() {
        return $this->info_version.'.'.$this->info_build;
    }
}
