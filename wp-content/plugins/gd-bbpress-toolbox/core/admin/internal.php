<?php

if (!defined('ABSPATH')) exit;

class gdbbx_admin_settings {
    private $settings;

    function __construct() {
        $this->init();
    }

    public function get($panel, $group = '') {
        if ($group == '') {
            return $this->settings[$panel];
        } else {
            return $this->settings[$panel][$group];
        }
    }

    public function settings($panel) {
        $list = array();

        foreach ($this->settings[$panel] as $obj) {
            foreach ($obj['settings'] as $o) {
                $list[] = $o;
            }
        }

        return $list;
    }

    private function init() {
        $_max_size_kb = gdbbx_attachments()->max_server_allowed();

        $this->settings = array(
            'standard' => array(
                'icons' => array('name' => __("Icons", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'icons_mode', __("For Icons Use", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('icons_mode', 'attachments'), 'array', $this->data_attachment_icon_method())
                )),
                'fitvids' => array('name' => __("FitVids for Responsive Videos", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'apply_fitvids_to_content', __("Enable FitVids", "gd-bbpress-toolbox"), __("FitVids will be applied to the topic and reply content and it will make YouTube and Vimeo videos responsive.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('apply_fitvids_to_content', 'bbpress'))
                ))
            ),
            'files' => array(
                'loading_css' => array('name' => __("CSS Files Loading", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('settings', 'load_own_css', __("Own CSS", "gd-bbpress-toolbox"), __("Load built in CSS file needed for plugin on the front end.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('load_own_css')),
                    new d4pSettingElement('settings', 'load_own_css_widgets', __("Own Widgets CSS", "gd-bbpress-toolbox"), __("These are styles for the plugin widgets. It will be loaded everywhere, not only on bbPress pages, because widgets can be used on any WordPress page.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('load_own_css_widgets'))
                )),
                'loading_fa' => array('name' => __("FontAwesome Loading", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('settings', 'load_fontawesome', __("FontAwesome", "gd-bbpress-toolbox"), __("FontAwesome 4.2 is needed for BBCodes Toolbar.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('load_fontawesome')),
                    new d4pSettingElement('settings', 'fontawesome_source', __("Load from", "gd-bbpress-toolbox"), __("FontAwesome 4.2 is needed for BBCodes Toolbar.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('fontawesome_source'), 'array', $this->data_fontawesome_source())
                )),
                'loading_js' => array('name' => __("JS Files Loading", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('settings', 'load_own_js', __("Own JavaScript", "gd-bbpress-toolbox"), __("Load built in JavaScript file needed for plugin on the front end.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('load_own_js')),
                    new d4pSettingElement('settings', 'load_fitvids', __("FitVids", "gd-bbpress-toolbox"), __("Load FitVids library for making YouTube and Vimeo videos responsive.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('load_fitvids'))
                )),
                'advanced_load' => array('name' => __("Forced load of CSS and JS files", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('settings', 'load_always', __("Always Load", "gd-bbpress-toolbox"), __("If you use shortcodes to embed forums, and you rely on plugin to add JS and CSS, you also need to enable this option to skip checking for bbPress specific pages.", "gd-bbpress-toolbox").' '.__("This option is not needed anymore, but if you still have issues with loaded files, enable it.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('load_always'))
                ))
            ),
            'disable_rss' => array(
                'drss_status' => array('name' => __("Activity", "gd-bbpress-toolbox"),
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'canned-replies'), 'settings' => array(
                    new d4pSettingElement('disable_rss', 'active', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('active', 'disable_rss'))
                )),
                'drss_views' => array('name' => __("Topic Views RSS", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('disable_rss', 'view_feed', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_feed', 'disable_rss'), null, array(), array('label' => __("Disable Feed", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('disable_rss', 'view_feed_redirect', __("Redirect to", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('view_feed_redirect', 'disable_rss'), 'array', $this->data_disable_rss())
                )),
                'drss_forum' => array('name' => __("Forums RSS", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('disable_rss', 'forum_feed', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_feed', 'disable_rss'), null, array(), array('label' => __("Disable Feed", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('disable_rss', 'forum_feed_redirect', __("Redirect to", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('forum_feed_redirect', 'disable_rss'), 'array', $this->data_disable_rss())
                )),
                'drss_topic' => array('name' => __("Topics RSS", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('disable_rss', 'topic_feed', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('topic_feed', 'disable_rss'), null, array(), array('label' => __("Disable Feed", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('disable_rss', 'topic_feed_redirect', __("Redirect to", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('topic_feed_redirect', 'disable_rss'), 'array', $this->data_disable_rss())
                )),
                'drss_reply' => array('name' => __("Replies RSS", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('disable_rss', 'reply_feed', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('reply_feed', 'disable_rss'), null, array(), array('label' => __("Disable Feed", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('disable_rss', 'reply_feed_redirect', __("Redirect to", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('reply_feed_redirect', 'disable_rss'), 'array', $this->data_disable_rss())
                ))
            ),
            'tweaks' => array(
                'status' => array('name' => __("Status Header 404", "gd-bbpress-toolbox"), 
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'fixing-404-header-error'), 'settings' => array(
                    new d4pSettingElement('bbpress', 'fix_404_headers_error', __("Fix the 404 Errors", "gd-bbpress-toolbox"), __("Due to the WordPress query limitations, user profile and views pages in bbPress return with 404 status.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('fix_404_headers_error', 'bbpress'))
                )),
                'media_library' => array('name' => __("Allow Participants to use Media Library", "gd-bbpress-toolbox"), 
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'media-library-access-for-participants'), 'settings' => array(
                    new d4pSettingElement('bbpress', 'participant_media_library_upload', __("Add Media button in TinyMCE", "gd-bbpress-toolbox"), __("If you use TinyMCE editor, Participants can't use Media Library and Add Media button. By enabling this option, you allow Participants to do this. This operation is not reccommended, and you are doing it on your own risk. Check out the Knowledge Base for more information before enabling this option.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('participant_media_library_upload', 'bbpress'))
                )),
                'editor_tags' => array('name' => __("Expand KSES allowed HTML tags and attributes", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'kses_allowed_override', __("Allowed tags list", "gd-bbpress-toolbox"), __("By default, only some HTML tags and attributes are allowed when adding HTML in topics or replies. This option allows you to expand list of supported tags and attributes.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('kses_allowed_override', 'bbpress'), 'array', $this->data_kses_allowed_tags_override()),
                    new d4pSettingElement('bbpress', 'allowed_tags_div', __("Allow DIV tag", "gd-bbpress-toolbox"), __("This must be enabled to enable use of Quote feature for all user roles. If this is disabled, bbPress will not allow DIV tags in the content, and quote will get messed up.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('allowed_tags_div', 'bbpress')),
                    new d4pSettingElement('bbpress', 'kses_img_class', __("Allow IMG tag class attribute", "gd-bbpress-toolbox"),  __("By default 'class' attribute in IMG tag will be stripped by bbPress from the post content. Enable this to allow 'class' attribute in content.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('kses_img_class', 'bbpress'))
                )),
                'title_length' => array('name' => __("HTML Maximum Title Length", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'title_length_override', __("Custom Length", "gd-bbpress-toolbox"), __("This value is set for title HTML tag through default bbPress filter.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('title_length_override', 'bbpress')),
                    new d4pSettingElement('bbpress', 'title_length_value', __("Maximum Length Allowed", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('title_length_value', 'bbpress'))
                )),
                'breadcrumbs' => array('name' => __("bbPress Breadcrumbs", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'disable_bbpress_breadcrumbs', __("Disable Breadcrumbs", "gd-bbpress-toolbox"), __("This option will disable default bbPress breadcrumbs.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('disable_bbpress_breadcrumbs', 'bbpress'), null, array(), array('label' => __("Disable", "gd-bbpress-toolbox")))
                ))
            ),
            'widgets' => array(
                'widgets' => array('name' => __("Plugin Widgets", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('widgets', 'widget_userprofile', __("User Profile", "gd-bbpress-toolbox"), __("Logged in user profile with useful links and stats.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('widget_userprofile', 'widgets'), null, array(), array('label' => __("Enable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'widget_statistics', __("Statistics", "gd-bbpress-toolbox"), __("Enhanced list of important forum statistics.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('widget_statistics', 'widgets'), null, array(), array('label' => __("Enable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'widget_topicinfo', __("Topic Information", "gd-bbpress-toolbox"), __("Show information about the topic currently displayed.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('widget_topicinfo', 'widgets'), null, array(), array('label' => __("Enable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'widget_newposts', __("New posts List", "gd-bbpress-toolbox"), __("List of new topics or topics with new replies.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('widget_newposts', 'widgets'), null, array(), array('label' => __("Enable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'widget_topicsviews', __("Topics Views List", "gd-bbpress-toolbox"), __("Selectable list of topics views.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('widget_topicsviews', 'widgets'), null, array(), array('label' => __("Enable Widget", "gd-bbpress-toolbox")))
                )),
                'default_widgets' => array('name' => __("Default bbPress Widgets", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('widgets', 'default_disable_recenttopics', __("Recent Topics", "gd-bbpress-toolbox"), __("If you use this plugin 'New Posts List' widget, you can disable default one.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('default_disable_recenttopics', 'widgets'), null, array(), array('label' => __("Disable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'default_disable_recentreplies', __("Recent Replies", "gd-bbpress-toolbox"), __("If you use this plugin 'New Posts List' widget, you can disable default one.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('default_disable_recentreplies', 'widgets'), null, array(), array('label' => __("Disable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'default_disable_topicviewslist', __("Topics Views List", "gd-bbpress-toolbox"), __("If you use this plugin 'Topics Views List' widget, you can disable default one.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('default_disable_topicviewslist', 'widgets'), null, array(), array('label' => __("Disable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'default_disable_login', __("Login", "gd-bbpress-toolbox"), __("If you use this plugin 'User Profile' widget, you can disable default one.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('default_disable_login', 'widgets'), null, array(), array('label' => __("Disable Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('widgets', 'default_disable_stats', __("Statistics", "gd-bbpress-toolbox"), __("If you use this plugin 'Statistics' widget, you can disable default one.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('default_disable_stats', 'widgets'), null, array(), array('label' => __("Disable Widget", "gd-bbpress-toolbox")))
                ))
            ),
            'canned' => array(
                'canned_status' => array('name' => __("Activity", "gd-bbpress-toolbox"),
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'canned-replies'), 'settings' => array(
                    new d4pSettingElement('canned', 'active', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('active', 'canned')),
                    new d4pSettingElement('canned', 'use_taxonomy', __("Use Categories", "gd-bbpress-toolbox"), __("If you plan to add many canned replies, it is a good idea to keep them categorized.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('use_taxonomy', 'canned'))
                )),
                'canned_cpt' => array('name' => __("Post Type", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('canned', 'post_type_singular', __("Label Singular", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('post_type_singular', 'canned')),
                    new d4pSettingElement('canned', 'post_type_plural', __("Label Plural", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('post_type_plural', 'canned')),
                )),
                'canned_tax' => array('name' => __("Category", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('canned', 'taxonomy_singular', __("Label Singular", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('taxonomy_singular', 'canned')),
                    new d4pSettingElement('canned', 'taxonomy_plural', __("Label Plural", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('taxonomy_plural', 'canned')),
                )),
                'canned_extra' => array('name' => __("Additional Options", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('canned', 'auto_close_on_insert', __("Auto close on insert", "gd-bbpress-toolbox"), __("Canned Replies box will auto close when you click to insert reply into editor.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('auto_close_on_insert', 'canned'))
                ))
            ),
            'privacy' => array(
                'topics' => array('name' => __("Private Topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'private_topics', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('private_topics', 'bbpress')),
                    new d4pSettingElement('bbpress', 'private_topics_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('private_topics_super_admin', 'bbpress')),
                    new d4pSettingElement('bbpress', 'private_topics_visitor', __("Available to visitors", "gd-bbpress-toolbox"), __("If anonymous (visitor) creates private topic only administrators and moderators can read the topic.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('private_topics_visitor', 'bbpress')),
                    new d4pSettingElement('bbpress', 'private_topics_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('private_topics_roles', 'bbpress'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('bbpress', 'private_topics_default', __("Default", "gd-bbpress-toolbox"), __("This is related to new topics only, not edits.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('private_topics_default', 'bbpress'), 'array', $this->data_private_checked_status()),
                    new d4pSettingElement('bbpress', 'private_topics_icon', __("Icon", "gd-bbpress-toolbox"), __("Show icon in the forum or views topics list", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('private_topics_icon', 'bbpress'))
                )),
                'replies' => array('name' => __("Private Replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'private_replies', __("Status", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('private_replies', 'bbpress')),
                    new d4pSettingElement('bbpress', 'private_replies_threaded', __("Threaded Replies", "gd-bbpress-toolbox"), __("If enabled, plugin will support threaded replies. Authort of parent reply will see private replies to his replies. Currently, this works only for direct descendant replies only.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('private_replies', 'bbpress')),
                    new d4pSettingElement('bbpress', 'private_replies_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('private_replies_super_admin', 'bbpress')),
                    new d4pSettingElement('bbpress', 'private_replies_visitor', __("Available to visitors", "gd-bbpress-toolbox"), __("If anonymous (visitor) creates private reply only administrators and moderators can read the reply.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('private_replies_visitor', 'bbpress')),
                    new d4pSettingElement('bbpress', 'private_replies_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('private_replies_roles', 'bbpress'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('bbpress', 'private_replies_default', __("Default", "gd-bbpress-toolbox"), __("This is related to new replies only, not edits.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('private_replies_default', 'bbpress'), 'array', $this->data_private_checked_status()),
                    new d4pSettingElement('bbpress', 'private_replies_css_hide', __("Hide using CSS/JS", "gd-bbpress-toolbox"), __("Hide private reply in the topic thread from users with no access rights using CSS and JavaScript (this might not work with every theme).", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('private_replies_css_hide', 'bbpress'))
                )),
                'position' => array('name' => __("Form Position", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'private_topic_form_position', __("Topic Form", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('private_topic_form_position', 'bbpress'), 'array', $this->data_form_position_topic()),
                    new d4pSettingElement('bbpress', 'private_reply_form_position', __("Reply Form", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('private_reply_form_position', 'bbpress'), 'array', $this->data_form_position_reply())
                ))
            ),
            'visitors_redirect' => array(
                'redirect_nonlogged' => array('name' => __("Redirect visitors to custom URL", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('lock', 'redirect_for_visitors', __("Status", "gd-bbpress-toolbox"), __("If non-logged user (or visitor) attempts to access any forum page, it will be redirected to custom URL or home page.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('redirect_for_visitors', 'lock'), null, array(), array('label' => __("Redirect non-logged visitors", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('lock', 'redirect_for_visitors_url', __("Redirect to", "gd-bbpress-toolbox"), __("If empty, it will redirect to website home page.", "gd-bbpress-toolbox"), d4pSettingType::LINK, gdbbx()->get('redirect_for_visitors_url', 'lock'))
                )),
                'redirect_hidden' => array('name' => __("Redirect hidden forums access attempt to custom URL", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('lock', 'redirect_hidden_forums', __("Status", "gd-bbpress-toolbox"), __("Any user trying to access hidden forum, and has no rights to do that, will be redirected to custom URL. If this option is disabled, user will see 404 page.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('redirect_hidden_forums', 'lock')),
                    new d4pSettingElement('lock', 'redirect_hidden_forums_url', __("Redirect to", "gd-bbpress-toolbox"), __("If empty, it will redirect to website home page.", "gd-bbpress-toolbox"), d4pSettingType::LINK, gdbbx()->get('redirect_hidden_forums_url', 'lock'))
                )),
                'redirect_private' => array('name' => __("Redirect private forums access attempt to custom URL", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('lock', 'redirect_private_forums', __("Status", "gd-bbpress-toolbox"), __("Any user trying to access private forum, and has no rights to do that, will be redirected to custom URL. If this option is disabled, user will see 404 page.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('redirect_private_forums', 'lock')),
                    new d4pSettingElement('lock', 'redirect_private_forums_url', __("Redirect to", "gd-bbpress-toolbox"), __("If empty, it will redirect to website home page.", "gd-bbpress-toolbox"), d4pSettingType::LINK, gdbbx()->get('redirect_private_forums_url', 'lock'))
                )),
                'redirect_blocked' => array('name' => __("Redirect blocked users to custom URL", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('lock', 'redirect_blocked_users', __("Status", "gd-bbpress-toolbox"), __("Any blocked user trying to access forums, will be redirected to custom URL. If this option is disabled, user will see 404 page.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('redirect_blocked_users', 'lock')),
                    new d4pSettingElement('lock', 'redirect_blocked_users_url', __("Redirect to", "gd-bbpress-toolbox"), __("If empty, it will redirect to website home page.", "gd-bbpress-toolbox"), d4pSettingType::LINK, gdbbx()->get('redirect_blocked_users_url', 'lock'))
                ))
            ),
            'lock' => array(
                'topic_form' => array('name' => __("Topic Form", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('lock', 'topic_form_locked', __("Status", "gd-bbpress-toolbox"), __("Topic form (edit or new) will be disabled. Only user roles listed bellow can create or edit topics.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_form_locked', 'lock'), null, array(), array('label' => __("Disable Topic Form", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('lock', 'topic_form_allow_super_admin', __("Allowed to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('topic_form_allow_super_admin', 'lock')),
                    new d4pSettingElement('lock', 'topic_form_allow_roles', __("Allowed to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('topic_form_allow_roles', 'lock'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('lock', 'topic_form_message', __("Lock message", "gd-bbpress-toolbox"), __("If the form is locked, this message will be displayed instead.", "gd-bbpress-toolbox"), d4pSettingType::TEXT_HTML, gdbbx()->get('topic_form_message', 'lock'))
                )),
                'reply_form' => array('name' => __("Reply Form", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('lock', 'reply_form_locked', __("Status", "gd-bbpress-toolbox"), __("Reply form (edit or new) will be disabled. Only user roles listed bellow can create or edit replies.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_form_locked', 'lock'), null, array(), array('label' => __("Disable Reply Form", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('lock', 'reply_form_allow_super_admin', __("Allowed to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('reply_form_allow_super_admin', 'lock')),
                    new d4pSettingElement('lock', 'reply_form_allow_roles', __("Allowed to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('reply_form_allow_roles', 'lock'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('lock', 'reply_form_message', __("Lock message", "gd-bbpress-toolbox"), __("If the form is locked, this message will be displayed instead.", "gd-bbpress-toolbox"), d4pSettingType::TEXT_HTML, gdbbx()->get('reply_form_message', 'lock'))
                ))
            ),
            'seo' => array(
                'forums_seo' => array('name' => __("Forum", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('seo', 'override_forum_title_replace', __("Meta Title", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('override_forum_title_replace', 'seo'), null, array(), array('label' => __("Replace with Custom Text", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'override_forum_title_text', '', __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %FORUM_TITLE%', d4pSettingType::TEXT, gdbbx()->get('override_forum_title_text', 'seo')),
                    new d4pSettingElement('seo', 'meta_description_forum', __("Meta Description Tag", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('meta_description_forum', 'seo'))
                )),
                'topics_seo' => array('name' => __("Topic", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('seo', 'override_topic_title_replace', __("Meta Title", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('override_topic_title_replace', 'seo'), null, array(), array('label' => __("Replace with Custom Text", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'override_topic_title_text', '', __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %TOPIC_TITLE%, %FORUM_TITLE%', d4pSettingType::TEXT, gdbbx()->get('override_topic_title_text', 'seo')),
                    new d4pSettingElement('seo', 'override_topic_excerpt', __("Excerpt", "gd-bbpress-toolbox"), __("Use this only if you want to take private content into account or have extra control, or your SEO plugin has problems with getting proper excerpt.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('override_topic_excerpt', 'seo'), null, array(), array('label' => __("Override Default", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'override_topic_length', __("Excerpt Length", "gd-bbpress-toolbox"), '', d4pSettingType::NUMBER, gdbbx()->get('override_topic_length', 'seo')),
                    new d4pSettingElement('seo', 'private_topic_excerpt_replace', __("Private Topics Excerpt", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('private_topic_excerpt_replace', 'seo'), null, array(), array('label' => __("Replace with Custom Text", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'private_topic_excerpt_text', '', __("Private topic content will be replaced with this text. You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %TOPIC_TITLE%', d4pSettingType::TEXT, gdbbx()->get('private_topic_excerpt_text', 'seo')),
                    new d4pSettingElement('seo', 'meta_description_topic', __("Meta Description Tag", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('meta_description_topic', 'seo'))
                )),
                'replies_seo' => array('name' => __("Reply", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('seo', 'override_reply_title_replace', __("Meta Title", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('override_reply_title_replace', 'seo'), null, array(), array('label' => __("Replace with Custom Text", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'override_reply_title_text', '', __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %REPLY_TITLE%, %TOPIC_TITLE%, %FORUM_TITLE%', d4pSettingType::TEXT, gdbbx()->get('override_reply_title_text', 'seo')),
                    new d4pSettingElement('seo', 'override_reply_excerpt', __("Excerpt", "gd-bbpress-toolbox"), __("Use this only if you want to take private content into account or have extra control, or your SEO plugin has problems with getting proper excerpt.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('override_reply_excerpt', 'seo'), null, array(), array('label' => __("Override Default", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'override_reply_length', __("Excerpt Length", "gd-bbpress-toolbox"), '', d4pSettingType::NUMBER, gdbbx()->get('override_reply_length', 'seo')),
                    new d4pSettingElement('seo', 'private_reply_excerpt_replace', __("Private Reply Excerpt", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('private_reply_excerpt_replace', 'seo'), null, array(), array('label' => __("Replace with Custom Text", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'private_reply_excerpt_text', '', __("Private topic content will be replaced with this text. You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %TOPIC_TITLE%', d4pSettingType::TEXT, gdbbx()->get('private_reply_excerpt_text', 'seo')),
                    new d4pSettingElement('seo', 'meta_description_reply', __("Meta Description Tag", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('meta_description_reply', 'seo'))
                )),
                'private_meta' => array('name' => __("Private Topics and Replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('seo', 'noindex_private_topic', __("Private Topic", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('noindex_private_topic', 'seo'), null, array(), array('label' => __("Robots Meta NoIndex", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('seo', 'noindex_private_reply', __("Private Reply", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('noindex_private_reply', 'seo'), null, array(), array('label' => __("Robots Meta NoIndex", "gd-bbpress-toolbox")))
                )),
                'nofollow' => array('name' => __("bbPress NoFollow for Links", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'nofollow_topic_content', __("Topic Content", "gd-bbpress-toolbox"), __("bbPress modifies all links in topic content and adds (and overrides) 'nofollow' rel attribute.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('nofollow_topic_content', 'bbpress'), null, array(), array('label' => __("Enabled NoFollow", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'nofollow_reply_content', __("Reply Content", "gd-bbpress-toolbox"), __("bbPress modifies all links in reply content and adds (and overrides) 'nofollow' rel attribute.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('nofollow_reply_content', 'bbpress'), null, array(), array('label' => __("Enabled NoFollow", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'nofollow_topic_author', __("Topic Author Link", "gd-bbpress-toolbox"), __("bbPress modifies topic author links and adds (and overrides) 'nofollow' rel attribute.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('nofollow_topic_author', 'bbpress'), null, array(), array('label' => __("Enabled NoFollow", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'nofollow_reply_author', __("Reply Author Link", "gd-bbpress-toolbox"), __("bbPress modifies reply author links and adds (and overrides) 'nofollow' rel attribute.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('nofollow_reply_author', 'bbpress'), null, array(), array('label' => __("Enabled NoFollow", "gd-bbpress-toolbox")))
                )),
                'rich_snippets' => array('name' => __("Rich Snippets", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('seo', 'rich_snippet_breadcrumbs', __("Breadcrumbs", "gd-bbpress-toolbox"), __("This option will modify bbPress generated breadcrumbs to make them Google Rich Snippet compatible. This will work only if you have not modified bbPress breadcrumbs in some other way. Also, make sure breadcrumbs are enabled (this plugin has option to disable the breadcrumbs).", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('rich_snippet_breadcrumbs', 'seo'))
                ))
            ),
            'editors' => array(
                'topics' => array('name' => __("Topic Editor", "gd-bbpress-toolbox"), 
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'setup-rich-text-tinymce-editor-for-topics-and-replies'), 'settings' => array(
                    new d4pSettingElement('tools', 'editor_topic_active', __("Enable Enhancements", "gd-bbpress-toolbox"), __("For this to work, Fancy Editor must be enabled in bbPress settings. To enable it, enable settings under Post Formatting in the bbPress Forum settings:", "gd-bbpress-toolbox").' <a href="options-general.php?page=bbpress">'.__("bbPress Settings", "gd-bbpress-toolbox").'</a>.', d4pSettingType::BOOLEAN, gdbbx()->get('editor_topic_active', 'tools')),
                    new d4pSettingElement('tools', 'editor_topic_tinymce', __("TinyMCE Editor", "gd-bbpress-toolbox"), __("Full rich text editor.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('editor_topic_tinymce', 'tools')),
                    new d4pSettingElement('tools', 'editor_topic_teeny', __("Compact Editor Toolbar", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_topic_teeny', 'tools')),
                    new d4pSettingElement('tools', 'editor_topic_media_buttons', __("Media Buttons", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_topic_media_buttons', 'tools')),
                    new d4pSettingElement('tools', 'editor_topic_quicktags', __("Quicktags", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_topic_quicktags', 'tools')),
                    new d4pSettingElement('tools', 'editor_topic_wpautop', __("WPAutoP Filter", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_topic_wpautop', 'tools')),
                    new d4pSettingElement('tools', 'editor_topic_textarea_rows', __("Editor rows", "gd-bbpress-toolbox"), '', d4pSettingType::NUMBER, gdbbx()->get('editor_topic_textarea_rows', 'tools'))
                )),
                'replies' => array('name' => __("Reply Editor", "gd-bbpress-toolbox"), 
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'setup-rich-text-tinymce-editor-for-topics-and-replies'), 'settings' => array(
                    new d4pSettingElement('tools', 'editor_reply_active', __("Enable Enhancements", "gd-bbpress-toolbox"), __("For this to work, Fancy Editor must be enabled in bbPress settings. To enable it, enable settings under Post Formatting in the bbPress Forum settings:", "gd-bbpress-toolbox").' <a href="options-general.php?page=bbpress">'.__("bbPress Settings", "gd-bbpress-toolbox").'</a>.', d4pSettingType::BOOLEAN, gdbbx()->get('editor_reply_active', 'tools')),
                    new d4pSettingElement('tools', 'editor_reply_tinymce', __("TinyMCE Editor", "gd-bbpress-toolbox"), __("Full rich text editor.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('editor_reply_tinymce', 'tools')),
                    new d4pSettingElement('tools', 'editor_reply_teeny', __("Compact Editor Toolbar", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_reply_teeny', 'tools')),
                    new d4pSettingElement('tools', 'editor_reply_media_buttons', __("Media Buttons", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_reply_media_buttons', 'tools')),
                    new d4pSettingElement('tools', 'editor_reply_quicktags', __("Quicktags", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_reply_quicktags', 'tools')),
                    new d4pSettingElement('tools', 'editor_reply_wpautop', __("WPAutoP Filter", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('editor_reply_wpautop', 'tools')),
                    new d4pSettingElement('tools', 'editor_reply_textarea_rows', __("Editor rows", "gd-bbpress-toolbox"), '', d4pSettingType::NUMBER, gdbbx()->get('editor_reply_textarea_rows', 'tools'))
                )),
                'kses' => array('name' => __("HTML Tags and Attributes allowed", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'kses_allowed_override', __("Allowed tags list", "gd-bbpress-toolbox"), __("By default, only some HTML tags and attributes are allowed when adding HTML in topics or replies. This option allows you to expand list of supported tags and attributes.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('kses_allowed_override', 'bbpress'), 'array', $this->data_kses_allowed_tags_override())
                )),
                'media_library' => array('name' => __("Allow Participants and Moderators to use Media Library", "gd-bbpress-toolbox"), 
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'media-library-access-for-participants'), 'settings' => array(
                    new d4pSettingElement('bbpress', 'participant_media_library_upload', __("Add Media button in TinyMCE", "gd-bbpress-toolbox"), __("If you use TinyMCE editor, Participants and Moderators can't use Media Library and Add Media button. By enabling this option, you allow Participants and Moderators to do this. This operation is not reccommended, and you are doing it on your own risk. Check out the Knowledge Base for more information before enabling this option.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('participant_media_library_upload', 'bbpress'))
                ))
            ),
            'revisions' => array(
                'reply_rev' => array('name' => __("Topic and Reply Revisions", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'revisions_reply_protection_active', __("Protection", "gd-bbpress-toolbox"), __("If this is enabled, only users and roles enabled here will be able to see revisions. Revisions will be hidden for everyone else.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('revisions_reply_protection_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'revisions_reply_protection_author', __("Available to author", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('revisions_reply_protection_author', 'bbpress')),
                    new d4pSettingElement('bbpress', 'revisions_reply_protection_topic_author', __("Available to topic author", "gd-bbpress-toolbox"), __("If the post is reply, this will take into account author of the topic too.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('revisions_reply_protection_topic_author', 'bbpress')),
                    new d4pSettingElement('bbpress', 'revisions_reply_protection_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('revisions_reply_protection_super_admin', 'bbpress')),
                    new d4pSettingElement('bbpress', 'revisions_reply_protection_visitor', __("Available to visitors", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('revisions_reply_protection_visitor', 'bbpress')),
                    new d4pSettingElement('bbpress', 'revisions_reply_protection_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('revisions_reply_protection_roles', 'bbpress'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                ))
            ),
            'say_thanks' => array(
                'thanks_status' => array('name' => __("Activation", "gd-bbpress-toolbox"),
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'say-thanks-for-topics-and-replies'), 'settings' => array(
                    new d4pSettingElement('thanks', 'active', __("Say Thanks", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('active', 'thanks')),
                )),
                'thanks_options' => array('name' => __("Controls", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('thanks', 'removal', __("Allow thanks removal", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('removal', 'thanks')),
                    new d4pSettingElement('thanks', 'topic', __("Available for Topics", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('topic', 'thanks')),
                    new d4pSettingElement('thanks', 'reply', __("Available for Replies", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('reply', 'thanks')),
                    new d4pSettingElement('thanks', 'location', __("Button Location", "gd-bbpress-toolbox"), __("Select where the thanks button will be displayed.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('location', 'thanks'), 'array', $this->data_quote_button_location()),
                )),
                'thanks_allow' => array('name' => __("Available for roles", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('thanks', 'allow_super_admin', __("Super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('allow_super_admin', 'thanks')),
                    new d4pSettingElement('thanks', 'allow_roles', __("Roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('allow_roles', 'thanks'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                )),
                'thanks_notify' => array('name' => __("Notifications", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('thanks', 'notify_active', __("Send", "gd-bbpress-toolbox"),  __("Send notification to topic or reply authors when they get new thanks.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('notify_active', 'thanks')),
                    new d4pSettingElement('thanks', 'notify_shortcodes', __("Process shortcodes", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_shortcodes', 'thanks')),
                    new d4pSettingElement('thanks', 'notify_content', __("Notification content", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %THANKS_AUTHOR%, %POST_TITLE%, %POST_LINK%, %FORUM_TITLE%, %BLOG_NAME%', d4pSettingType::HTML, gdbbx()->get('notify_content', 'thanks')),
                    new d4pSettingElement('thanks', 'notify_subject', __("Notification subject", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %THANKS_AUTHOR%, %POST_TITLE%, %FORUM_TITLE%, %BLOG_NAME%', d4pSettingType::TEXT, gdbbx()->get('notify_subject', 'thanks'))
                ))
            ),
            'notifications' => array(
                'notify_new' => array('name' => __("Notify when new topic is added", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'new_topic_notification_keymaster', __("Notify Keymasters", "gd-bbpress-toolbox"), __("When a new topic is added, keymasters will be notified.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('new_topic_notification_keymaster', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_topic_notification_moderator', __("Notify Moderators", "gd-bbpress-toolbox"), __("When a new topic is added, moderators will be notified.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('new_topic_notification_moderator', 'bbpress'))
                )),
                'notify_topic' => array('name' => __("Notify on Topic edit", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'topic_notification_on_edit', __("Include in edit form", "gd-bbpress-toolbox"), __("Plugin will add new block with checkboxes to send notifications to topic author and/or subscribers when the topic was edited.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_notification_on_edit', 'bbpress'))
                )),
                'notify_reply' => array('name' => __("Notify on Reply edit", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'reply_notification_on_edit', __("Include in edit form", "gd-bbpress-toolbox"), __("Plugin will add new block with checkboxes to send notifications to reply author and/or topic subscribers when the reply was edited.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_notification_on_edit', 'bbpress'))
                )),
                'notify_sender' => array('name' => __("Notifications Sender", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'notify_subscribers_sender_active', __("Modify notification sender", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_sender_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_sender_name', __("Sender name", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('notify_subscribers_sender_name', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_sender_email', __("Sender email", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('notify_subscribers_sender_email', 'bbpress')),
                ))
            ),
            'notify_templates' => array(
                'notify_email' => array('name' => __("Topic Subscribe Notifications Email", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'notify_subscribers_override_active', __("Modify notification content", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_override_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_override_shortcodes', __("Process shortcodes", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_override_shortcodes', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_override_content', __("Notification content", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %REPLY_AUTHOR%, %REPLY_CONTENT%, %REPLY_LINK%, %TOPIC_AUTHOR%, %TOPIC_LINK%, %TOPIC_TITLE%, %BLOG_NAME%', d4pSettingType::HTML, gdbbx()->get('notify_subscribers_override_content', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_override_subject', __("Notification subject", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %TOPIC_TITLE%, %BLOG_NAME%', d4pSettingType::TEXT, gdbbx()->get('notify_subscribers_override_subject', 'bbpress'))
                )),
                'notify_forum' => array('name' => __("Forum Subscribe Notifications Email", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'notify_subscribers_forum_override_active', __("Modify notification content", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_forum_override_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_forum_override_shortcodes', __("Process shortcodes", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_forum_override_shortcodes', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_forum_override_content', __("Notification content", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %FORUM_TITLE%, %FORUM_LINK%, %TOPIC_AUTHOR%, %TOPIC_TITLE%, %TOPIC_LINK%, %TOPIC_CONTENT%, %BLOG_NAME%', d4pSettingType::HTML, gdbbx()->get('notify_subscribers_forum_override_content', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_forum_override_subject', __("Notification subject", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %FORUM_TITLE%, %TOPIC_TITLE%, %BLOG_NAME%', d4pSettingType::TEXT, gdbbx()->get('notify_subscribers_forum_override_subject', 'bbpress'))
                )),
                'notify_on_topic_edit' => array('name' => __("Topic Edit Notify Subscribers", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'notify_subscribers_edit_active', __("Modify notification content", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_edit_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_edit_shortcodes', __("Process shortcodes", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_edit_shortcodes', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_edit_content', __("Notification content", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %TOPIC_EDITOR%, %TOPIC_AUTHOR%, %TOPIC_CONTENT%, %TOPIC_EDIT%, %TOPIC_LINK%, %TOPIC_TITLE%, %BLOG_NAME%', d4pSettingType::HTML, gdbbx()->get('notify_subscribers_edit_content', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_edit_subject', __("Notification subject", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %TOPIC_TITLE%, %BLOG_NAME%', d4pSettingType::TEXT, gdbbx()->get('notify_subscribers_edit_subject', 'bbpress'))
                )),
                'notify_on_reply_edit' => array('name' => __("Reply Edit Notify Subscribers", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'notify_subscribers_reply_edit_active', __("Modify notification content", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_reply_edit_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_reply_edit_shortcodes', __("Process shortcodes", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_subscribers_reply_edit_shortcodes', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_reply_edit_content', __("Notification content", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %REPLY_EDITOR%, %REPLY_CONTENT% %REPLY_AUTHOR%, %REPLY_EDIT%, %REPLY_LINK%, %REPLY_TITLE%, %BLOG_NAME%', d4pSettingType::HTML, gdbbx()->get('notify_subscribers_reply_edit_content', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_subscribers_reply_edit_subject', __("Notification subject", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %REPLY_TITLE%, %BLOG_NAME%', d4pSettingType::TEXT, gdbbx()->get('notify_subscribers_reply_edit_subject', 'bbpress'))
                )),
                'notify_topic_mod' => array('name' => __("New Topic for Keymasters and Moderators", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'notify_moderators_topic_active', __("Modify notification content", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_moderators_topic_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_moderators_topic_shortcodes', __("Process shortcodes", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_moderators_topic_shortcodes', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_moderators_topic_content', __("Notification content", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %FORUM_TITLE%, %FORUM_LINK%, %TOPIC_AUTHOR%, %TOPIC_CONTENT%, %TOPIC_LINK%, %TOPIC_TITLE%, %BLOG_NAME%', d4pSettingType::HTML, gdbbx()->get('notify_moderators_topic_content', 'bbpress')),
                    new d4pSettingElement('bbpress', 'notify_moderators_topic_subject', __("Notification subject", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %FORUM_TITLE%, %TOPIC_TITLE%, %BLOG_NAME%', d4pSettingType::TEXT, gdbbx()->get('notify_moderators_topic_subject', 'bbpress'))
                ))
            ),
            'signatures' => array(
                'signature' => array('name' => __("User Signatures", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'signature_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('signature_active', 'tools')),
                    new d4pSettingElement('tools', 'signature_limiter', __("Limit Counter", "gd-bbpress-toolbox"), __("Use JavaScript to show signature length and limit. This will not work if the TinyMCE editor is used for signatures.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('signature_limiter', 'tools')),
                    new d4pSettingElement('tools', 'signature_length', __("Maximum Length", "gd-bbpress-toolbox"), '', d4pSettingType::NUMBER, gdbbx()->get('signature_length', 'tools')),
                    new d4pSettingElement('tools', 'signature_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('signature_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'signature_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('signature_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                )),
                'editing' => array('name' => __("Signatures Editing", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('_', '_', __("Important", "gd-bbpress-toolbox"), __("You can limit ability to edit the signatures to selected roles. That way, signatures will be enabled, but only some users will be able to edit them. You can set only for admins to be able to set signatures for other users.", "gd-bbpress-toolbox"), d4pSettingType::INFO),
                    new d4pSettingElement('tools', 'signature_edit_super_admin', __("Super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('signature_edit_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'signature_edit_roles', __("Roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('signature_edit_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                )),
                'enhanced' => array('name' => __("Enhanced Signatures", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'signature_enhanced_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('signature_enhanced_active', 'tools')),
                    new d4pSettingElement('tools', 'signature_enhanced_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('signature_enhanced_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'signature_enhanced_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('signature_enhanced_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('tools', 'signature_enhanced_method', __("Allowed Content", "gd-bbpress-toolbox"), __("If the editor type is set to TinyMCE, HTML will be allowed regardless of this option.", "gd-bbpress-toolbox").' <strong>'.sprintf(__("Make sure to read <a href='%s' target='_blank'>this article</a> before configuring this option to understand limitations related to frontend signature editing.", "gd-bbpress-toolbox"), 'https://support.dev4press.com/kb/article/signatures-with-bbcodes-editing-limitations/').'</strong>', d4pSettingType::SELECT, gdbbx()->get('signature_enhanced_method', 'tools'), 'array', $this->data_enhanced_signature_method()),
                    new d4pSettingElement('tools', 'signature_editor', __("Editor Type", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('signature_editor', 'tools'), 'array', $this->data_enhanced_editor_types())
                )),
                'processing' => array('name' => __("Display Processing", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'signature_process_smilies', __("Convert Smilies", "gd-bbpress-toolbox"), __("Convert smilies characters into inline images.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('signature_process_smilies', 'tools')),
                    new d4pSettingElement('tools', 'signature_process_chars', __("Convert Chars", "gd-bbpress-toolbox"), __("Run standard WordPress unicode chars conversion and cleanup.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('signature_process_chars', 'tools')),
                    new d4pSettingElement('tools', 'signature_process_autop', __("Convert AutoP", "gd-bbpress-toolbox"), __("Run standard WordPress AutoP function.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('signature_process_autop', 'tools'))
                ))
            ),
            'report' => array(
                'report_status' => array('name' => __("Reporting Basics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('report', 'active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('active', 'report')),
                    new d4pSettingElement('report', 'report_mode', __("Mode", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('report_mode', 'report'), 'array', $this->data_report_mode()),
                    new d4pSettingElement('report', 'allow_roles', __("Roles", "gd-bbpress-toolbox"), __("Only users with selected roles can post reports.", "gd-bbpress-toolbox"), d4pSettingType::CHECKBOXES, gdbbx()->get('allow_roles', 'report'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                )),
                'report_display' => array('name' => __("Display Control", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('report', 'location', __("Button Location", "gd-bbpress-toolbox"), __("Select where the report button will be displayed.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('location', 'report'), 'array', $this->data_quote_button_location()),
                    new d4pSettingElement('report', 'scroll_form', __("Scroll to Form", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('scroll_form', 'report')),
                )),
                'report_info' => array('name' => __("Display Report Information", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('report', 'show_report_status', __("Status", "gd-bbpress-toolbox"), __("For each reported topic or reply show the notice that it is reported.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('show_report_status', 'report'))
                )),
                'report_notify' => array('name' => __("Notifications", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('report', 'notify_active', __("Send", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_active', 'report')),
                    new d4pSettingElement('report', 'notify_keymasters', __("Send to Keymasters", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_keymasters', 'report')),
                    new d4pSettingElement('report', 'notify_moderators', __("Send to Moderators", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_moderators', 'report')),
                    new d4pSettingElement('report', 'notify_shortcodes', __("Process shortcodes", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('notify_shortcodes', 'report')),
                    new d4pSettingElement('report', 'notify_content', __("Notification content", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %REPORT_AUTHOR%, %REPORT_CONTENT%, %REPORT_LINK%, %REPORT_TITLE%, %REPORTS_LIST%, %FORUM_TITLE%, %BLOG_NAME%', d4pSettingType::HTML, gdbbx()->get('notify_content', 'report')),
                    new d4pSettingElement('report', 'notify_subject', __("Notification subject", "gd-bbpress-toolbox"), __("You can use special tags that will be replaced with actual values", "gd-bbpress-toolbox").': %REPORT_TITLE%, %BLOG_NAME%', d4pSettingType::TEXT, gdbbx()->get('notify_subject', 'report'))
                ))
            ),
            'quotes' => array(
                'quote' => array('name' => __("Quote Topics and Replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'quote_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('quote_active', 'tools')),
                    new d4pSettingElement('tools', 'quote_location', __("Button Location", "gd-bbpress-toolbox"), __("Select where the quote button will be displayed.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('quote_location', 'tools'), 'array', $this->data_quote_button_location()),
                    new d4pSettingElement('tools', 'quote_method', __("Quote Method", "gd-bbpress-toolbox"), __("If you want to use BBCode method, you need to enable BBCodes support also.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('quote_method', 'tools'), 'array', $this->data_quote_button_method()),
                    new d4pSettingElement('tools', 'quote_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('quote_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'quote_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('quote_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                )),
                'kses' => array('name' => __("HTML Tags and Attributes allowed", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'kses_allowed_override', __("Allowed tags list", "gd-bbpress-toolbox"), __("By default, only some HTML tags and attributes are allowed when adding HTML in topics or replies. This option allows you to expand list of supported tags and attributes.", "gd-bbpress-toolbox").'<br/><strong>'.__("It is recommended to switch this option to second or third option for quotes to work with complex content.", "gd-bbpress-toolbox").'</strong>', d4pSettingType::SELECT, gdbbx()->get('kses_allowed_override', 'bbpress'), 'array', $this->data_kses_allowed_tags_override())
                ))
            ),
            'toolbar' => array(
                'toolbar_ctrl' => array('name' => __("Toolbar Control", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'toolbar_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('toolbar_active', 'tools')),
                    new d4pSettingElement('tools', 'toolbar_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('toolbar_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'toolbar_visitor', __("Available to visitors", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('toolbar_visitor', 'tools')),
                    new d4pSettingElement('tools', 'toolbar_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('toolbar_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                )),
                'toolbar_looks' => array('name' => __("Additional Settings", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'toolbar_title', __("Menu Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('toolbar_title', 'tools')),
                    new d4pSettingElement('tools', 'toolbar_information', __("Information Submenu", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('toolbar_information', 'tools'))
                ))
            ),
            'administration' => array(
                'admin_users' => array('name' => __("Users Panel", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'user_columns_topics_replies', __("Topics/Replies columns", "gd-bbpress-toolbox"), __("Two columns for topics and replies with counts and links to filter them by user.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('user_columns_topics_replies', 'tools')),
                    new d4pSettingElement('tools', 'user_columns_last_activity', __("Last activity column", "gd-bbpress-toolbox"), __("Column with the user last activity date and time.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('user_columns_last_activity', 'tools'))
                )),
                'admin_topics' => array('name' => __("Topics Panel", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'topic_columns_attachments', __("Attachments count column", "gd-bbpress-toolbox"), __("Column with number of attachments.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_columns_attachments', 'tools')),
                    new d4pSettingElement('tools', 'topic_columns_private', __("Private topic column", "gd-bbpress-toolbox"), __("Column with privacy status.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_columns_private', 'tools'))
                )),
                'admin_replies' => array('name' => __("Replies Panel", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'reply_columns_attachments', __("Attachments count column", "gd-bbpress-toolbox"), __("Column with number of attachments.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_columns_attachments', 'tools')),
                    new d4pSettingElement('tools', 'reply_columns_private', __("Private reply column", "gd-bbpress-toolbox"), __("Column with privacy status.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_columns_private', 'tools'))
                )),
                'admin_dashboard' => array('name' => __("Dashboard Widgets", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('online', 'dashboard_widget', __("Online Users widget", "gd-bbpress-toolbox"), __("This will add Online Users dashboard widget.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('dashboard_widget', 'online'), null, array(), array('label' => __("Add Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('tools', 'dashboard_widget_activity', __("Latest Activity widget", "gd-bbpress-toolbox"), __("This will add Latest Activity dashboard widget that includes recent topics and replies.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('dashboard_widget_activity', 'tools'), null, array(), array('label' => __("Add Widget", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('tools', 'dashboard_widget_remove', __("Right now in Forums widget", "gd-bbpress-toolbox"), __("This will remove bbPress default 'Right now in the forums' dashboard widget.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('dashboard_widget_remove', 'tools'), null, array(), array('label' => __("Remove Widget", "gd-bbpress-toolbox")))
                )),
                'navmenus' => array('name' => __("Navigation Menus", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'navmenu_metabox_extras', __("Extras Metabox", "gd-bbpress-toolbox"), __("Show metabox with extra items to add to Nav Menu related to bbPress.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('navmenu_metabox_extras', 'bbpress')),
                    new d4pSettingElement('bbpress', 'navmenu_metabox_views', __("Views Metabox", "gd-bbpress-toolbox"), __("Show metabox with views to add to Nav Menu related to bbPress.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('navmenu_metabox_views', 'bbpress'))
                )),
                'advanced_tools' => array('name' => __("Tools Panels", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('core', 'wp44_update', __("WordPress 4.4 Update", "gd-bbpress-toolbox"), __("If you used this tool once, it will be automatically hidden. Uncheck this option to show the panel again.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('wp44_update', 'core'), null, array(), array('label' => __("Hide this Panel", "gd-bbpress-toolbox")))
                ))
            ),
            'user_stats' => array(
                'user_stats' => array('name' => __("Show User Statistics with each Topic and Reply", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'users_stats_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_active', 'tools')),
                    new d4pSettingElement('tools', 'users_stats_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'users_stats_visitor', __("Available to visitors", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_visitor', 'tools')),
                    new d4pSettingElement('tools', 'users_stats_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('users_stats_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                )),
                'user_show' => array('name' => __("Choose what to show", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('online', 'users_stats', __("Show online status", "gd-bbpress-toolbox"), __("Only if online status tracking is enabled.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('users_stats', 'online')),
                    new d4pSettingElement('tools', 'users_stats_show_registration_date', __("Show registration date", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_show_registration_date', 'tools')),
                    new d4pSettingElement('tools', 'users_stats_show_topics', __("Show topics count", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_show_topics', 'tools')),
                    new d4pSettingElement('tools', 'users_stats_show_replies', __("Show replies count", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_show_replies', 'tools')),
                    new d4pSettingElement('tools', 'users_stats_show_thanks_given', __("Show thanks given count", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_show_thanks_given', 'tools')),
                    new d4pSettingElement('tools', 'users_stats_show_thanks_received', __("Show thanks received count", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('users_stats_show_thanks_received', 'tools'))
                ))
            ),
            'forums' => array(
                'forums_welcome' => array('name' => __("User welcome overview", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'forum_load_welcome_front', __("Load for Forum index", "gd-bbpress-toolbox"), __("Main forums index, underneath the list of forums, will show the basic forums statistics.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_welcome_front', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_welcome_filter', __("Location", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('forum_load_welcome_filter', 'bbpress'), 'array', $this->data_forum_index_filters()),
                    new d4pSettingElement('bbpress', 'forum_load_welcome_front_roles', __("Show to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('forum_load_welcome_front_roles', 'bbpress'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('', '', __("Welcome Back Block", "gd-bbpress-toolbox"), '', d4pSettingType::HR),
                    new d4pSettingElement('bbpress', 'forum_load_welcome_show_links', __("Show important links for a user", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_welcome_show_links', 'bbpress')),
                )),
                'forums_stats' => array('name' => __("Forums statistics overview", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'forum_load_statistics_front', __("Load for Forum index", "gd-bbpress-toolbox"), __("Main forums index, underneath the list of forums, will show the basic forums statistics.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_front', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_filter', __("Location", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('forum_load_statistics_filter', 'bbpress'), 'array', $this->data_forum_index_filters()),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_front_roles', __("Show to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('forum_load_statistics_front_roles', 'bbpress'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_front_visitor', __("Show to visitors", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_front_visitor', 'bbpress')),
                    new d4pSettingElement('', '', __("Users Block", "gd-bbpress-toolbox"), '', d4pSettingType::HR),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_online', __("Show active users block", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_online', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_online_overview', __("Show online users overview", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_online_overview', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_online_top', __("Show most online users", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_online_top', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_users', __("Show active users", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('forum_load_statistics_show_users', 'bbpress'), 'array', $this->data_active_users_period()),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_users_colors', __("Show users color coded", "gd-bbpress-toolbox"), __("Each user will be displayed with different color according to user role.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_users_colors', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_users_avatars', __("Show users avatars", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_users_avatars', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_users_links', __("Show users linked", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_users_links', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_users_limit', __("Limit displayed users", "gd-bbpress-toolbox"), __("Showing long list of users can be performance intensive.", "gd-bbpress-toolbox"), d4pSettingType::ABSINT, gdbbx()->get('forum_load_statistics_show_users_limit', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_legend', __("Show colors legend", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_legend', 'bbpress')),
                    new d4pSettingElement('', '', __("Statistics Block", "gd-bbpress-toolbox"), '', d4pSettingType::HR),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_statistics', __("Show statistics block", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_statistics', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_statistics_totals', __("Show totals counts", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_statistics_totals', 'bbpress')),
                    new d4pSettingElement('bbpress', 'forum_load_statistics_show_statistics_newest_user', __("Show newest user", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('forum_load_statistics_show_statistics_newest_user', 'bbpress')),
                ))
            ),
            'topics' => array(
                'topics_minmax' => array('name' => __("Save Topic - Title and Content length", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'new_topic_minmax_active', __("Length control", "gd-bbpress-toolbox"), __("When new topic is saved, minimal and maximal length for title and content will be enforced.", "gd-bbpress-toolbox").' '.__("Set value to zero to ignore it.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('new_topic_minmax_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_topic_min_title_length', __("Min Title Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_topic_min_title_length', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_topic_max_title_length', __("Max Title Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_topic_max_title_length', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_topic_min_content_length', __("Min Content Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_topic_min_content_length', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_topic_max_content_length', __("Max Content Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_topic_max_content_length', 'bbpress'))
                )),
                'topics_action' => array('name' => __("Topic Actions", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'topic_links_remove_merge', __("Action Link: Merge", "gd-bbpress-toolbox"), __("Remove 'Merge' link from the list of topic action links.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_links_remove_merge', 'bbpress'), null, array(), array('label' => __("Remove Link", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'topic_links_edit_footer', __("Action Link: Edit", "gd-bbpress-toolbox"), __("Move 'Edit' link into footer action links area.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_links_edit_footer', 'bbpress'), null, array(), array('label' => __("Link in Footer", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'topic_links_reply_footer', __("Action Link: Reply", "gd-bbpress-toolbox"), __("Move 'Reply' link into footer action links area.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_links_reply_footer', 'bbpress'), null, array(), array('label' => __("Link in Footer", "gd-bbpress-toolbox")))
                )),
                'topics_close' => array('name' => __("Close topic checkbox in reply form", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'reply_close_topic_checkbox_active', __("Show checkbox", "gd-bbpress-toolbox"), __("If this is enabled, only users and roles enabled here will be able to see revisions. Revisions will be hidden for everyone else.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_close_topic_checkbox_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'reply_close_topic_checkbox_topic_author', __("Available to topic author", "gd-bbpress-toolbox"), __("If the post is reply, this will take into account author of the topic too.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_close_topic_checkbox_topic_author', 'bbpress')),
                    new d4pSettingElement('bbpress', 'reply_close_topic_checkbox_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('reply_close_topic_checkbox_super_admin', 'bbpress')),
                    new d4pSettingElement('bbpress', 'reply_close_topic_checkbox_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('reply_close_topic_checkbox_roles', 'bbpress'), 'array', $this->data_high_level_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('bbpress', 'reply_close_topic_checkbox_form_position', __("Form Position", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('reply_close_topic_checkbox_form_position', 'bbpress'), 'array', $this->data_form_position_reply())
                )),
                'topics_tweaks' => array('name' => __("Various Settings", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'enable_lead_topic', __("Display Lead Topic", "gd-bbpress-toolbox"), __("Show main thread topic on top separated from replies.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('enable_lead_topic', 'bbpress')),
                    new d4pSettingElement('bbpress', 'enable_topic_reversed_replies', __("Reversed replies Order", "gd-bbpress-toolbox"), __("When displayling topic, replies will be reversed, and on top you will see latest reply. If the Lead topic is enabled, topic post will remain on the top, if not, topic post will be the last.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('enable_topic_reversed_replies', 'bbpress')),
                    new d4pSettingElement('bbpress', 'disable_make_clickable_topic', __("Disable Make Clickable filter", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('disable_make_clickable_topic', 'bbpress')),
                    new d4pSettingElement('bbpress', 'disable_mention_filter_topic', __("Disable Mention filter", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('disable_mention_filter_topic', 'bbpress'))
                )),
                'topics_lock' => array('name' => __("Button for Topic Lock", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('lock', 'button_topic_lock_active', __("Show Lock Button", "gd-bbpress-toolbox"), __("This option will allow you to temporarily lock topics for new replies. Only keymasters and moderators can use this option.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('button_topic_lock_active', 'lock')),
                    new d4pSettingElement('lock', 'button_topic_lock_location', __("Button Location", "gd-bbpress-toolbox"), __("Select where the lock button will be displayed.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('button_topic_lock_location', 'lock'), 'array', $this->data_quote_button_location())
                )),
                'forum_icons' => array('name' => __("Topic List Icons/Marks", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'forum_mark_replied', __("Reply Mark", "gd-bbpress-toolbox"), __("In the topics list, mark topics where current user replies at least once.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('forum_mark_replied', 'bbpress'), null, array(), array('label' => __("Logged in user replied in topic", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'forum_mark_stick', __("Stick Mark", "gd-bbpress-toolbox"), __("In the topics list, mark topics that are set as stick or front stick.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('forum_mark_stick', 'bbpress'), null, array(), array('label' => __("Topic is sticked, or front sticked", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'forum_mark_lock', __("Lock Mark", "gd-bbpress-toolbox"), __("In the topics list, mark topics that are temporarily locked.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('forum_mark_lock', 'bbpress'), null, array(), array('label' => __("Topic is temporarily locked", "gd-bbpress-toolbox")))
                )),
                'topics_copy' => array('name' => __("Topic Duplication", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'topic_single_copy_active', __("Duplicate Topic Only", "gd-bbpress-toolbox"), __("This will make a new topic with content of the old topic.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('topic_single_copy_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'topic_single_copy_location', __("Button Location", "gd-bbpress-toolbox"), __("Select where the Duplicate Topic button will be displayed.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('topic_single_copy_location', 'bbpress'), 'array', $this->data_quote_button_location())
                )),
                'topics_list' => array('name' => __("Forum Topics List", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'forum_list_topic_thumbnail', __("Show Thumbnail", "gd-bbpress-toolbox"), __("If there is a thumbnail (featured image) set for topic, or plugin can find image in topic content, it will display the thumbnail before topic title in the topics list.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('forum_list_topic_thumbnail', 'bbpress'))
                ))
            ),
            'replies' => array(
                'reply_minmax' => array('name' => __("Save Reply - Title and Content length", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'new_reply_minmax_active', __("Length control", "gd-bbpress-toolbox"), __("When new reply is saved, minimal and maximal length for title and content will be enforced.", "gd-bbpress-toolbox").' '.__("Set value to zero to ignore it.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('new_reply_minmax_active', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_reply_min_title_length', __("Min Title Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_reply_min_title_length', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_reply_max_title_length', __("Max Title Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_reply_max_title_length', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_reply_min_content_length', __("Min Content Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_reply_min_content_length', 'bbpress')),
                    new d4pSettingElement('bbpress', 'new_reply_max_content_length', __("Max Content Length", "gd-bbpress-toolbox"), '', d4pSettingType::INTEGER, gdbbx()->get('new_reply_max_content_length', 'bbpress'))
                )),
                'reply_actions' => array('name' => __("Reply Actions", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'reply_links_remove_split', __("Action Link: Split", "gd-bbpress-toolbox"), __("Remove 'Split' link from the list of topic action links.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_links_remove_split', 'bbpress'), null, array(), array('label' => __("Remove Link", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'reply_links_edit_footer', __("Action Link: Edit", "gd-bbpress-toolbox"), __("Move 'Edit' link into footer action links area.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_links_edit_footer', 'bbpress'), null, array(), array('label' => __("Link in Footer", "gd-bbpress-toolbox"))),
                    new d4pSettingElement('bbpress', 'reply_links_reply_footer', __("Action Link: Reply", "gd-bbpress-toolbox"), __("Move 'Reply' link into footer action links area.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_links_reply_footer', 'bbpress'), null, array(), array('label' => __("Link in Footer", "gd-bbpress-toolbox"))),
                )),
                'reply_tags' => array('name' => __("Topic tags in reply form", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'tags_in_reply_form_only_for_author', __("Only for topic author", "gd-bbpress-toolbox"), __("Reply form contains topic tags box, and any one replying can change the tags assigned. If enabled, this option will show this field only for topic author.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('tags_in_reply_form_only_for_author', 'bbpress'))
                )),
                'reply_various' => array('name' => __("Various Settings", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'reply_titles', __("Reply Titles", "gd-bbpress-toolbox"), __("By default, replies don't have titles. But, with this option, reply editor will have an extra field to set the reply title.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('reply_titles', 'bbpress')),
                    new d4pSettingElement('bbpress', 'disable_make_clickable_reply', __("Disable Make Clickable filter", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('disable_make_clickable_reply', 'bbpress')),
                    new d4pSettingElement('bbpress', 'disable_mention_filter_reply', __("Disable Mention filter", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('disable_mention_filter_reply', 'bbpress'))
                ))
            ),
            'mimetypes' => array(
                'extra_mimes' => array('name' => __("Additional MIME Types", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'extra_mime_types', __("MIME Types", "gd-bbpress-toolbox"), '', d4pSettingType::EXPANDABLE_PAIRS, gdbbx()->get('extra_mime_types', 'tools'), '', array(), array('label_key' => __("Extensions (Vertical pipe separated)", "gd-bbpress-toolbox"), 'label_value' => __("MIME Type", "gd-bbpress-toolbox"), 'label_button_add' => __("Add New MIME Type", "gd-bbpress-toolbox"), 'label_buttom_remove' => __("Remove", "gd-bbpress-toolbox"))),
                ))
            ),
            'attachments_mime' => array(
                'mime' => array('name' => __("Basic Control", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'mime_types_limit_active', __("Filter by MIME Type", "gd-bbpress-toolbox"), __("If this option is active, only MIME Types selected bellow will be allowed to upload.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('mime_types_limit_active', 'attachments')),
                    new d4pSettingElement('attachments', 'mime_types_limit_display', __("Display allowed types", "gd-bbpress-toolbox"), __("If active, plugin will show list of allowed types in the upload form as notice.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('mime_types_limit_display', 'attachments'))
                )),
                'mime_list' => array('name' => __("MIME Types allowed to upload", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'mime_types_list', __("Allowed MIME Types", "gd-bbpress-toolbox"), __("List shows extensions allowed by WordPress, and if you hover over the extensions names you will see which MIME type they belong to.", "gd-bbpress-toolbox"), d4pSettingType::CHECKBOXES, gdbbx()->get('mime_types_list', 'attachments'), 'array', gdbbx_mime_types_list(), array('class' => 'gdbbx-bbcodes'))
                ))
            ),
            'attachments_advanced' => array(
                'errors' => array('name' => __("Errors Logging", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'log_upload_errors', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('log_upload_errors', 'attachments')),
                    new d4pSettingElement('attachments', 'errors_visible_to_admins', __("Visible to administrators", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('errors_visible_to_admins', 'attachments')),
                    new d4pSettingElement('attachments', 'errors_visible_to_moderators', __("Visible to moderators", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('errors_visible_to_moderators', 'attachments')),
                    new d4pSettingElement('attachments', 'errors_visible_to_author', __("Visible to author", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('errors_visible_to_author', 'attachments')),
                ))
            ),
            'attachments_integration' => array(
                'form_position' => array('name' => __("Form Position", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'form_position_topic', __("Topic Form", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('form_position_topic', 'attachments'), 'array', $this->data_form_position_topic()),
                    new d4pSettingElement('attachments', 'form_position_reply', __("Reply Form", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('form_position_reply', 'attachments'), 'array', $this->data_form_position_reply())
                )),
                'file_list' => array('name' => __("Files List", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'files_list_position', __("Embed Position", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('files_list_position', 'attachments'), 'array', $this->data_files_position_topic()),
                    new d4pSettingElement('attachments', 'hide_from_visitors', __("Hide attachements from visitors", "gd-bbpress-toolbox"), __("If enabled, only logged in users will be able to see attachments list.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('hide_from_visitors', 'attachments')),
                    new d4pSettingElement('attachments', 'file_target_blank', __("Link opens blank page", "gd-bbpress-toolbox"), __("All displayed attachments links will lead to open blank page to display attachment (for images or documents).", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('file_target_blank', 'attachments')),
                    new d4pSettingElement('attachments', 'download_link_attribute', __("Download Attribute", "gd-bbpress-toolbox"), __("Each link will have download attribute set, and for supported browser will force click on the link to download the file.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('download_link_attribute', 'attachments')),
                )),
                'icons' => array('name' => __("Attachment Icons", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'attachment_icon', __("Attachment Icon", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('attachment_icon', 'attachments')),
                    new d4pSettingElement('attachments', 'attachment_icons', __("File Type Icons", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('attachment_icons', 'attachments'))
                )),
                'featured' => array('name' => __("Auto generate featured image", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'topic_featured_image', __("For Topic", "gd-bbpress-toolbox"), __("First image uploaded to topic, will be set as featured (if topic has no featured image set already).", "gd-bbpress-toolbox").' <strong>'.__("For this to work, theme must have Post Thumbnails support.", "gd-bbpress-toolbox").'</strong>', d4pSettingType::BOOLEAN, gdbbx()->get('topic_featured_image', 'attachments')),
                    new d4pSettingElement('attachments', 'reply_featured_image', __("For Reply", "gd-bbpress-toolbox"), __("First image uploaded to reply, will be set as featured (if reply has no featured image set already).", "gd-bbpress-toolbox").' <strong>'.__("For this to work, theme must have Post Thumbnails support.", "gd-bbpress-toolbox").'</strong>', d4pSettingType::BOOLEAN, gdbbx()->get('reply_featured_image', 'attachments'))
                ))
            ),
            'attachments_images' => array(
                'thumbnails' => array('name' => __("Show as Thumbnails", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'image_thumbnail_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('image_thumbnail_active', 'attachments'))
                )),
                'thumbnails_display' => array('name' => __("Display control", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'image_thumbnail_size', __("Thumbnails Size", "gd-bbpress-toolbox"), __("Changing thumbnails size affects only new image attachments. To use new size for old attachments, resize them using Regenerate Thumbnails plugin.", "gd-bbpress-toolbox"), d4pSettingType::X_BY_Y, gdbbx()->get('image_thumbnail_size', 'attachments')),
                    new d4pSettingElement('attachments', 'image_thumbnail_caption', __("With caption", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('image_thumbnail_caption', 'attachments')),
                    new d4pSettingElement('attachments', 'image_thumbnail_inline', __("In line", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('image_thumbnail_inline', 'attachments'))
                )),
                'thumbnails_attr' => array('name' => __("Thumbnail attributes", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'image_thumbnail_css', __("CSS class", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('image_thumbnail_css', 'attachments')),
                    new d4pSettingElement('attachments', 'image_thumbnail_rel', __("REL attribute", "gd-bbpress-toolbox"), __("You can use these tags", "gd-bbpress-toolbox").' %ID%, %TOPIC%', d4pSettingType::TEXT, gdbbx()->get('image_thumbnail_rel', 'attachments'))
                ))
            ),
            'attachments' => array(
                'main_files' => array('name' => __("Basic Settings", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'attachments_active', __("Attachments active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('attachments_active', 'attachments')),
                    new d4pSettingElement('attachments', 'validation_active', __("Enhanced Interface", "gd-bbpress-toolbox"), __("Enables validation of attachments added by user: size and file type allowed, and will not allow form to submit if validation fails. Uploaded file (image) preview and validation works only with modern browsers with HTML5 support.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('validation_active', 'attachments'))
                )),
                'attach_form' => array('name' => __("Attachment Form", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'insert_into_content', __("Button: Insert into content", "gd-bbpress-toolbox"), __("With this option, plugin will show button for inserting file shortcode insertion option for each valid attachment.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('insert_into_content', 'attachments'))
                )),
                'default_limits' => array('name' => __("Default Limits", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'max_file_size', __("Maximum file size", "gd-bbpress-toolbox"), __("Size set in KB.", "gd-bbpress-toolbox").' '.sprintf(__("Current server configuration allows maximum file size of <strong>%s KB</strong>.", "gd-bbpress-toolbox"), $_max_size_kb), d4pSettingType::ABSINT, gdbbx()->get('max_file_size', 'attachments'), '', '', array('max' => $_max_size_kb, 'min' => 1)),
                    new d4pSettingElement('attachments', 'max_to_upload', __("Maximum files to upload", "gd-bbpress-toolbox"), '', d4pSettingType::NUMBER, gdbbx()->get('max_to_upload', 'attachments')),
                    new d4pSettingElement('attachments', 'roles_to_upload', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('roles_to_upload', 'attachments'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                )),
                'no_limits' => array('name' => __("No Limits Upload", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'roles_no_limit', __("Available to roles", "gd-bbpress-toolbox"), __("Users with these roles will be able to upload files regardless of the limits. These users will be able to upload files of any size and any number of files and any file type allowed by the system.", "gd-bbpress-toolbox").' '.sprintf(__("Current server configuration allows maximum file size of <strong>%s KB</strong>.", "gd-bbpress-toolbox"), $_max_size_kb), d4pSettingType::CHECKBOXES, gdbbx()->get('roles_no_limit', 'attachments'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                ))
            ),
            'attachments_deletion' => array(
                'delete_method' => array('name' => __("Attachments deletion", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'delete_method', __("Method", "gd-bbpress-toolbox"), __("This will control how the options to delete attachments are presented.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('delete_method', 'attachments'), 'array', $this->data_attachment_delete_method()),
                )),
                'delete_topics' => array('name' => __("Deletion of Topics and Replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'delete_attachments', __("Action", "gd-bbpress-toolbox"), __("This control what happens to attachments once the topic or reply with attachments is deleted.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('delete_attachments', 'attachments'), 'array', $this->data_attachment_topic_delete()),
                )),
                'delete_files' => array('name' => __("Deletion of Attachments", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('attachments', 'delete_visible_to_admins', __("Administrators", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('delete_visible_to_admins', 'attachments'), 'array', $this->data_attachment_file_delete()),
                    new d4pSettingElement('attachments', 'delete_visible_to_moderators', __("Moderators", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('delete_visible_to_moderators', 'attachments'), 'array', $this->data_attachment_file_delete()),
                    new d4pSettingElement('attachments', 'delete_visible_to_author', __("Author", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('delete_visible_to_author', 'attachments'), 'array', $this->data_attachment_file_delete())
                ))
            ),
            'bbcodes_single' => array(
                'code_scode' => array('name' => __("Source Code", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_scode_theme', __("Color Theme", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('bbcodes_scode_theme', 'tools'), 'array', $this->data_bbcodes_scode_theme())
                )),
                'code_hide' => array('name' => __("Hide", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_hide_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::HTML, gdbbx()->get('bbcodes_hide_title', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_hide_content_normal', __("Content: Normal", "gd-bbpress-toolbox"), __("When HIDE is set with no value, user must be logged in to see hidden content.", "gd-bbpress-toolbox"), d4pSettingType::HTML, gdbbx()->get('bbcodes_hide_content_normal', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_hide_content_count', __("Content: Counts", "gd-bbpress-toolbox"), __("When HIDE is set to integer value, user must be logged in and have at least the amount of posts in the forum as specified to see the content.", "gd-bbpress-toolbox"), d4pSettingType::HTML, gdbbx()->get('bbcodes_hide_content_count', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_hide_content_reply', __("Content: Counts", "gd-bbpress-toolbox"), __("When HIDE is set to 'reply', user must reply to the topic to see the content.", "gd-bbpress-toolbox"), d4pSettingType::HTML, gdbbx()->get('bbcodes_hide_content_reply', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_hide_content_thanks', __("Content: Say Thanks", "gd-bbpress-toolbox"), __("When HIDE is set to 'thanks', user must say thanks to the topic author to see the content.", "gd-bbpress-toolbox"), d4pSettingType::HTML, gdbbx()->get('bbcodes_hide_content_thanks', 'tools'))
                )),
                'code_spoiler' => array('name' => __("Spoiler", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_spoiler_color', __("Main Color", "gd-bbpress-toolbox"), '', d4pSettingType::COLOR, gdbbx()->get('bbcodes_spoiler_color', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_spoiler_hover', __("Hover Background Color", "gd-bbpress-toolbox"), '', d4pSettingType::COLOR, gdbbx()->get('bbcodes_spoiler_hover', 'tools'))
                )),
                'code_highlight' => array('name' => __("Highlight", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_highlight_color', __("Text Color", "gd-bbpress-toolbox"), '', d4pSettingType::COLOR, gdbbx()->get('bbcodes_highlight_color', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_highlight_background', __("Background Color", "gd-bbpress-toolbox"), '', d4pSettingType::COLOR, gdbbx()->get('bbcodes_highlight_background', 'tools'))
                )),
                'code_heading' => array('name' => __("Heading", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_heading_size', __("Default Size", "gd-bbpress-toolbox"), __("Heading will render H{size} tag.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('bbcodes_heading_size', 'tools'), 'array', $this->data_bbcodes_heading())
                ))
            ),
            'bbcodes_toolbar' => array(
                'toolbar' => array('name' => __("Status", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_toolbar_active', __("BBCodes Toolbar Active", "gd-bbpress-toolbox"), __("This toolbar will appear only if you don't use any editor toolbars normally added by bbPress. To disable these, disable checkbox under 'Post Formatting' on this page:", "gd-bbpress-toolbox").' <a href="options-general.php?page=bbpress">'.__("bbPress Settings", "gd-bbpress-toolbox").'</a>.', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_active', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_toolbar_size', __("Toolbar Icons Size", "gd-bbpress-toolbox"), '', d4pSettingType::SELECT, gdbbx()->get('bbcodes_toolbar_size', 'tools'), 'array', $this->data_bbcodes_toolbar_size()),
                    new d4pSettingElement('tools', 'bbcodes_toolbar_editor_fix', __("Apply editor styling fix", "gd-bbpress-toolbox"), __("By default, editor textarea is not styled as fixed and it can look bad if the toolbar is active. This fix will apply styling changes to textarea editor to fit better with the toolbar and most themes.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_editor_fix', 'tools'))
                )),
                'hide_codes' => array('name' => __("Hide BBCodes", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_toolbar_hide_rare', __("Hide Rarely used BBCodes", "gd-bbpress-toolbox"), __("This will hide several BBCodes from toolbar", "gd-bbpress-toolbox").': reverse, anchor, border, area, list, quote, nfo.', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_hide_rare', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_toolbar_hide_image', __("Hide Image BBCode", "gd-bbpress-toolbox"), __("This will hide image BBCode from toolbar.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_hide_image', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_toolbar_hide_video', __("Hide Video related BBCodes", "gd-bbpress-toolbox"), __("This will hide several BBCodes from toolbar", "gd-bbpress-toolbox").': youtube, vimeo', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_hide_video', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_toolbar_hide_media', __("Hide Media related BBCodes", "gd-bbpress-toolbox"), __("This will hide several BBCodes from toolbar", "gd-bbpress-toolbox").': webshot, embed, google', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_hide_media', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_toolbar_hide_restricted', __("Hide Restricted BBCodes", "gd-bbpress-toolbox"), __("This will hide several BBCodes from toolbar", "gd-bbpress-toolbox").': iframe, note', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_hide_restricted', 'tools'))
                )),
                'filter_codes' => array('name' => __("Filter BBCodes", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_toolbar_show_available_only', __("Show only available BBCodes", "gd-bbpress-toolbox"), __("This will hide disabled BBCodes, or BBCodes that are not available to current user role.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_toolbar_show_available_only', 'tools'))
                ))
            ),
            'bbcodes_basic' => array(
                'main_codes' => array('name' => __("Standard Settings", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_active', __("BBCodes Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_active', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_notice', __("Form Notice", "gd-bbpress-toolbox"), __("If the BBCodes support is active, you can display notice in the new topic/reply form.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_notice', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_bbpress_only', __("bbPress Only", "gd-bbpress-toolbox"), __("Processing of the bbcodes can be limited only to bbPress implemented forums, topics and replies.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_bbpress_only', 'tools'))
                )),
                'advanced_codes' => array('name' => __("Advanced Codes", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_special_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_special_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_special_roles', __("Available to roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('bbcodes_special_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles')),
                    new d4pSettingElement('tools', 'bbcodes_special_visitor', __("Available to visitors", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_special_visitor', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_special_action', __("Restriction action", "gd-bbpress-toolbox"), __("If the advanced codes are used when not allowed, plugin can delete it or replace it with notice.", "gd-bbpress-toolbox"), d4pSettingType::SELECT, gdbbx()->get('bbcodes_special_action', 'tools'), 'array', $this->data_bbcodes_replacement())
                )),
                'restricted_codes' => array('name' => __("Restricted Codes", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_restricted_super_admin', __("Available to super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_restricted_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'bbcodes_restricted_administrator', __("Available to administrators", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('bbcodes_restricted_administrator', 'tools'))
                )),
            ),
            'bbcodes_disable' => array(
                'deactivate_codes' => array('name' => __("Deactivate Selected Codes", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'bbcodes_deactivated', __("Deactivate", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('bbcodes_deactivated', 'tools'), 'array', $this->data_list_bbcodes(), array('class' => 'gdbbx-bbcodes'))
                ))
            ),
            'views_settings' => array(
                'log_required_views' => array('name' => __("Views That Required Account", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'views_hide_log_required', __("Hide Views", "gd-bbpress-toolbox"), __("Some views can work only if logged in user is accessing them. If a visitor not logged in is accessing view, it will return no results. With this option you can disable such views for not logged in visitors.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('views_hide_log_required', 'tools'), null, array(), array('label' => __("Enabled", "gd-bbpress-toolbox")))
                ))
            ),
            'views_basic' => array(
                'mostreplies' => array('name' => __("Topics with most replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_mostreplies_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_mostreplies_active', 'tools')),
                    new d4pSettingElement('tools', 'view_mostreplies_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_mostreplies_title', 'tools')),
                    new d4pSettingElement('tools', 'view_mostreplies_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_mostreplies_slug', 'tools'))
                )),
                'latesttopics' => array('name' => __("Latest topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_latesttopics_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_latesttopics_active', 'tools')),
                    new d4pSettingElement('tools', 'view_latesttopics_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_latesttopics_title', 'tools')),
                    new d4pSettingElement('tools', 'view_latesttopics_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_latesttopics_slug', 'tools'))
                )),
                'topicsfresh' => array('name' => __("Topics by freshness", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_topicsfresh_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_topicsfresh_active', 'tools')),
                    new d4pSettingElement('tools', 'view_topicsfresh_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_topicsfresh_title', 'tools')),
                    new d4pSettingElement('tools', 'view_topicsfresh_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_topicsfresh_slug', 'tools'))
                )),
                'mostthanked' => array('name' => __("Most thanked topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_mostthanked_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_mostthanked_active', 'tools')),
                    new d4pSettingElement('tools', 'view_mostthanked_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_mostthanked_title', 'tools')),
                    new d4pSettingElement('tools', 'view_mostthanked_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_mostthanked_slug', 'tools')),
                ))
            ),
            'views_personal' => array(
                'myactive' => array('name' => __("My active topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_myactive_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_myactive_active', 'tools')),
                    new d4pSettingElement('tools', 'view_myactive_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_myactive_title', 'tools')),
                    new d4pSettingElement('tools', 'view_myactive_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_myactive_slug', 'tools'))
                )),
                'mytopics' => array('name' => __("All my topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_mytopics_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_mytopics_active', 'tools')),
                    new d4pSettingElement('tools', 'view_mytopics_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_mytopics_title', 'tools')),
                    new d4pSettingElement('tools', 'view_mytopics_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_mytopics_slug', 'tools'))
                )),
                'myreply' => array('name' => __("Topics with my reply", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_myreply_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_myreply_active', 'tools')),
                    new d4pSettingElement('tools', 'view_myreply_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_myreply_title', 'tools')),
                    new d4pSettingElement('tools', 'view_myreply_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_myreply_slug', 'tools'))
                )),
                'mynoreplies' => array('name' => __("My topics with no replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_mynoreplies_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_mynoreplies_active', 'tools')),
                    new d4pSettingElement('tools', 'view_mynoreplies_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_mynoreplies_title', 'tools')),
                    new d4pSettingElement('tools', 'view_mynoreplies_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_mynoreplies_slug', 'tools'))
                )),
                'mymostreplies' => array('name' => __("My topics with most replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_mymostreplies_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_mymostreplies_active', 'tools')),
                    new d4pSettingElement('tools', 'view_mymostreplies_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_mymostreplies_title', 'tools')),
                    new d4pSettingElement('tools', 'view_mymostreplies_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_mymostreplies_slug', 'tools'))
                )),
                'mymostthanked' => array('name' => __("My most thanked topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_mymostthanked_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_mymostthanked_active', 'tools')),
                    new d4pSettingElement('tools', 'view_mymostthanked_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_mymostthanked_title', 'tools')),
                    new d4pSettingElement('tools', 'view_mymostthanked_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_mymostthanked_slug', 'tools'))
                )),
                'myfavorite' => array('name' => __("My favorite topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_myfavorite_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_myfavorite_active', 'tools')),
                    new d4pSettingElement('tools', 'view_myfavorite_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_myfavorite_title', 'tools')),
                    new d4pSettingElement('tools', 'view_myfavorite_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_myfavorite_slug', 'tools'))
                )),
                'mysubscribed' => array('name' => __("My subscribed topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_mysubscribed_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_mysubscribed_active', 'tools')),
                    new d4pSettingElement('tools', 'view_mysubscribed_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_mysubscribed_title', 'tools')),
                    new d4pSettingElement('tools', 'view_mysubscribed_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_mysubscribed_slug', 'tools'))
                )),
                'newposts' => array('name' => __("New posts since last visit", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_newposts_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_newposts_active', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_newposts_title', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_newposts_slug', 'tools'))
                ))
            ),
            'views_time' => array(
                'newposts24h' => array('name' => __("New posts: Last day", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_newposts24h_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_newposts24h_active', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts24h_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_newposts24h_title', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts24h_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_newposts24h_slug', 'tools'))
                )),
                'newposts3dy' => array('name' => __("New posts: Last 3 days", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_newposts3dy_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_newposts3dy_active', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts3dy_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_newposts3dy_title', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts3dy_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_newposts3dy_slug', 'tools'))
                )),
                'newposts7dy' => array('name' => __("New posts: Last week", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_newposts7dy_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_newposts7dy_active', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts7dy_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_newposts7dy_title', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts7dy_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_newposts7dy_slug', 'tools'))
                )),
                'newposts1mn' => array('name' => __("New posts: Last month", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'view_newposts1mn_active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('view_newposts1mn_active', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts1mn_title', __("Title", "gd-bbpress-toolbox"), '', d4pSettingType::TEXT, gdbbx()->get('view_newposts1mn_title', 'tools')),
                    new d4pSettingElement('tools', 'view_newposts1mn_slug', __("URL Slug", "gd-bbpress-toolbox"), __("Only letters, numbers and dashes.", "gd-bbpress-toolbox"), d4pSettingType::TEXT, gdbbx()->get('view_newposts1mn_slug', 'tools'))
                ))
            ),
            'forum_read' => array(
                'forum_read_new_posts' => array('name' => __("New Posts", "gd-bbpress-toolbox"),
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'forums-logged-in-users-read-tracking'), 'settings' => array(
                    new d4pSettingElement('_', '_', __("Important", "gd-bbpress-toolbox"), __("If the new topic or reply is posted since the last user visit, forum this topic belongs to, will be marked. For this to work, you need to enable user activity tracking.", "gd-bbpress-toolbox"), d4pSettingType::INFO),
                    new d4pSettingElement('tools', 'latest_forum_new_posts_badge', __("Add new posts badge", "gd-bbpress-toolbox"), __("Add badge before the forum title.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_forum_new_posts_badge', 'tools')),
                    new d4pSettingElement('tools', 'latest_forum_new_posts_strong_title', __("Wrap title in strong tag", "gd-bbpress-toolbox"), __("Wrap the forum title in the STRONG to attempt display it as bold to stand out in the list.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_forum_new_posts_strong_title', 'tools'))
                )),
                'forum_read_unread_forum' => array('name' => __("Unread Forum", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('_', '_', __("Important", "gd-bbpress-toolbox"), __("If the forum is not read by the user (taking into account the cutoff timestamp), forum will be marked as unread.", "gd-bbpress-toolbox"), d4pSettingType::INFO),
                    new d4pSettingElement('tools', 'latest_forum_unread_forum_badge', __("Add unread forum badge", "gd-bbpress-toolbox"), __("Add badge before the forum title.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_forum_unread_forum_badge', 'tools')),
                    new d4pSettingElement('tools', 'latest_forum_unread_forum_strong_title', __("Wrap title in strong tag", "gd-bbpress-toolbox"), __("Wrap the forum title in the STRONG to attempt display it as bold to stand out in the list.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_forum_unread_forum_strong_title', 'tools'))
                ))
            ),
            'topic_read' => array(
                'topic_read_tracking' => array('name' => __("User read status tracking", "gd-bbpress-toolbox"),
                    'kb' => array('label' => __("KB", "gd-bbpress-toolbox"), 'url' => 'topics-logged-in-users-read-tracking'), 'settings' => array(
                    new d4pSettingElement('tools', 'latest_track_users_topic', __("Active", "gd-bbpress-toolbox"), __("Track users access to topics, latest reply for topic and use it to mark unread content.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_track_users_topic', 'tools')),
                    new d4pSettingElement('tools', 'latest_use_cutoff_timestamp', __("Use cutoff timestamp", "gd-bbpress-toolbox"), __("Tracking data begins storing when plugin version 4.5 is installed. This moment will be stored to serve as cutoff for displaying unread topics to users. If this is not used, all old topics will be initially marked as 'unread' to all users.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_use_cutoff_timestamp', 'tools'))
                )),
                'topic_read_new_replies' => array('name' => __("New Replies", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('_', '_', __("Important", "gd-bbpress-toolbox"), __("If one or more new replies are added to the topic since the last time user visited a topic, this topic will be marked and link placed to lead to the first new reply for the current user.", "gd-bbpress-toolbox"), d4pSettingType::INFO),
                    new d4pSettingElement('tools', 'latest_topic_new_replies_mark', __("Add new replies icon", "gd-bbpress-toolbox"), __("Add icon and link to the first new reply in topic.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_topic_new_replies_mark', 'tools')),
                    new d4pSettingElement('tools', 'latest_topic_new_replies_strong_title', __("Wrap title in strong tag", "gd-bbpress-toolbox"), __("Wrap the topic title in the STRONG to attempt display it as bold to stand out in the list.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_topic_new_replies_strong_title', 'tools')),
                    new d4pSettingElement('tools', 'latest_topic_new_replies_in_thread', __("Mark replies in topic thread", "gd-bbpress-toolbox"), __("When topic is opened, all new replies will get a 'new reply' badge.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_topic_new_replies_in_thread', 'tools'))
                )),
                'topic_read_new_topics' => array('name' => __("New Topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('_', '_', __("Important", "gd-bbpress-toolbox"), __("If the new topic is posted since the last user visit, they will be marked. For this to work, you need to enable user activity tracking.", "gd-bbpress-toolbox"), d4pSettingType::INFO),
                    new d4pSettingElement('tools', 'latest_topic_new_topic_badge', __("Add new topic badge", "gd-bbpress-toolbox"), __("Add badge before the topic title.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_topic_new_topic_badge', 'tools')),
                    new d4pSettingElement('tools', 'latest_topic_new_topic_strong_title', __("Wrap title in strong tag", "gd-bbpress-toolbox"), __("Wrap the topic title in the STRONG to attempt display it as bold to stand out in the list.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_topic_new_topic_strong_title', 'tools'))
                )),
                'topic_read_unread_topics' => array('name' => __("Unread Topics", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('_', '_', __("Important", "gd-bbpress-toolbox"), __("If the topic is not read by the user (taking into account the cutoff timestamp), it will be marked as unread.", "gd-bbpress-toolbox"), d4pSettingType::INFO),
                    new d4pSettingElement('tools', 'latest_topic_unread_topic_badge', __("Add unread topic badge", "gd-bbpress-toolbox"), __("Add badge before the topic title.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_topic_unread_topic_badge', 'tools')),
                    new d4pSettingElement('tools', 'latest_topic_unread_topic_strong_title', __("Wrap title in strong tag", "gd-bbpress-toolbox"), __("Wrap the topic title in the STRONG to attempt display it as bold to stand out in the list.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('latest_topic_unread_topic_strong_title', 'tools'))
                ))
            ),
            'tracking' => array(
                'user_tracking' => array('name' => __("User activity tracking", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'track_last_activity_active', __("Active", "gd-bbpress-toolbox"), __("Everytime user opens any forum, topic or reply page plugin will save activity timestamp.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('track_last_activity_active', 'tools')),
                    new d4pSettingElement('tools', 'track_basic_cookie_expiration', __("Cookie Expiration", "gd-bbpress-toolbox"), __("Value is in days.", "gd-bbpress-toolbox"), d4pSettingType::NUMBER, gdbbx()->get('track_basic_cookie_expiration', 'tools'))
                )),
                'last_visit_cookie' => array('name' => __("Current session cookie", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'track_current_session_cookie_expiration', __("Expiration", "gd-bbpress-toolbox"), __("Value is in minutes.", "gd-bbpress-toolbox"), d4pSettingType::NUMBER, gdbbx()->get('track_current_session_cookie_expiration', 'tools'))
                )),
                'online_status' => array('name' => __("Track online status for users and guests", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('online', 'active', __("Active", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('active', 'online')),
                    new d4pSettingElement('online', 'track_users', __("Track Users", "gd-bbpress-toolbox"), __("If enabled, plugin will track online status logged in users.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('track_users', 'online')),
                    new d4pSettingElement('online', 'track_guests', __("Track Guests", "gd-bbpress-toolbox"), __("If enabled, plugin will track online status for guests - users that are not logged in.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('track_guests', 'online')),
                    new d4pSettingElement('online', 'window', __("Online period", "gd-bbpress-toolbox"), __("Value is in seconds.", "gd-bbpress-toolbox"), d4pSettingType::INTEGER, gdbbx()->get('window', 'online'))
                ))
            ),
            'objects' => array(
                'obj_forum' => array('name' => __("Forum Extra WordPress Features", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'add_forum_features', __("Forum Features", "gd-bbpress-toolbox"), __("These will be added when registering forum post type.", "gd-bbpress-toolbox"), d4pSettingType::CHECKBOXES, gdbbx()->get('add_forum_features', 'tools'), 'array', $this->data_extra_features(), array('class' => 'gdbbx-bbcodes'))
                )),
                'obj_topic' => array('name' => __("Topic Extra WordPress Features", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'add_topic_features', __("Topic Features", "gd-bbpress-toolbox"), __("These will be added when registering topic post type.", "gd-bbpress-toolbox"), d4pSettingType::CHECKBOXES, gdbbx()->get('add_topic_features', 'tools'), 'array', $this->data_extra_features(), array('class' => 'gdbbx-bbcodes'))
                )),
                'obj_reply' => array('name' => __("Reply Extra WordPress Features", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'add_reply_features', __("Reply Features", "gd-bbpress-toolbox"), __("These will be added when registering reply post type.", "gd-bbpress-toolbox"), d4pSettingType::CHECKBOXES, gdbbx()->get('add_reply_features', 'tools'), 'array', $this->data_extra_features(), array('class' => 'gdbbx-bbcodes'))
                ))
            ),
            'advanced' => array(
                'capabilities' => array('name' => __("User Roles Capabilities", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('bbpress', 'roles_gdbbx_moderation', __("Moderation Capabilities", "gd-bbpress-toolbox"), __("If enabled, special capabilities will be added to forum 'keymaster' and 'moderator' roles. Moderators will be able to access some of the admin side plugin panels.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('roles_gdbbx_moderation', 'bbpress'))
                )),
                'admin_access' => array('name' => __("Limit bbPress Access on Admin Side", "gd-bbpress-toolbox"), 'settings' => array(
                    new d4pSettingElement('tools', 'admin_disable_active', __("Active", "gd-bbpress-toolbox"), __("Access to admin side for forums will be restricted. Select bellow who has access.", "gd-bbpress-toolbox"), d4pSettingType::BOOLEAN, gdbbx()->get('admin_disable_active', 'tools')),
                    new d4pSettingElement('tools', 'admin_disable_super_admin', __("Access for super admin", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('admin_disable_super_admin', 'tools')),
                    new d4pSettingElement('tools', 'admin_disable_roles', __("Access for roles", "gd-bbpress-toolbox"), '', d4pSettingType::CHECKBOXES, gdbbx()->get('admin_disable_roles', 'tools'), 'array', gdbbx_get_user_roles(), array('class' => 'gdbbx-roles'))
                ))
            ),
            'buddypress' => $this->_fields_for_buddypress()
        );
    }

    private function _fields_for_buddypress() {
        $items = array(
            'buddypress_xprofile' => array('name' => __("Extended Profile Support", "gd-bbpress-toolbox"), 'settings' => array(
                new d4pSettingElement('buddypress', 'xprofile_support', __("XProfile Integration", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('xprofile_support', 'buddypress'))
            )),
            'buddypress_override' => array('name' => __("BuddyPress Overriding URL's", "gd-bbpress-toolbox"), 'settings' => array(
                new d4pSettingElement('buddypress', 'disable_profile_override', __("Stop Profile Override", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('disable_profile_override', 'buddypress')),
                new d4pSettingElement('buddypress', 'disable_favorites_override', __("Stop Favorites Override", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('disable_favorites_override', 'buddypress')),
                new d4pSettingElement('buddypress', 'disable_subscriptions_override', __("Stop Subscriptions Override", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('disable_subscriptions_override', 'buddypress')),
            ))
        );

        if (!gdbbx_has_buddypress() || !bp_is_active('xprofile')) {
            unset($items['buddypress_xprofile']);
        } else {
            $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('', '', __("Forum Signature", "gd-bbpress-toolbox"), '', d4pSettingType::HR);
            $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('', '', __("Important", "gd-bbpress-toolbox"), __("The plugin adds specialized 'Signature Textarea' field type. Please, do not use this field for other extended profile fields, it should be used only for the field created by this plugin.", "gd-bbpress-toolbox"), d4pSettingType::INFO);

            if (gdbbx_is_module_loaded('signature')) {
                $_field_id = gdbbx()->get('xprofile_signature_field_id', 'buddypress');

                if ($_field_id == 0) {
                    $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('', '', __("XProfile Field", "gd-bbpress-toolbox"), __("The signature field for Extended profile is not added to the BuddyPress yet. Use the option below to create this field if you want for your users to be able to edit forum signature from their BuddyPress Extended profile.", "gd-bbpress-toolbox"), d4pSettingType::INFO);
                    $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('buddypress', 'xprofile_signature_field_add', __("Create Field", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('xprofile_signature_field_add', 'buddypress'));
                } else if (!gdbbx_module_buddypress()->has_signature_field()) {
                    $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('', '', __("XProfile Field", "gd-bbpress-toolbox"), __("The signature field for Extended profile was created earlied, but it is missing now. Use the option below to create this field again if you want for your users to be able to edit forum signature from their BuddyPress Extended profile.", "gd-bbpress-toolbox"), d4pSettingType::INFO);
                    $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('buddypress', 'xprofile_signature_field_add', __("Create Field", "gd-bbpress-toolbox"), '', d4pSettingType::BOOLEAN, gdbbx()->get('xprofile_signature_field_add', 'buddypress'));
                } else {
                    $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('', '', __("XProfile Field", "gd-bbpress-toolbox"), __("The signature field for Extended profile configured properly. You can modify the field to change it's name, but make sure it is always set to use 'Signature Textarea' field type, or the field will not work as expected.", "gd-bbpress-toolbox"), d4pSettingType::INFO);
                }
            } else {
                $items['buddypress_xprofile']['settings'][] = new d4pSettingElement('', '', __("Signatures Disabled", "gd-bbpress-toolbox"), __("The signatures module is disbaled.", "gd-bbpress-toolbox"), d4pSettingType::INFO);
            }
        }

        return $items;
    }

    private function data_kses_allowed_tags_override() {
        return array(
            'bbpress' => __("Default bbPress list of tags and attributes", "gd-bbpress-toolbox"),
            'expanded' => __("Expanded range of tags and attributes", "gd-bbpress-toolbox"),
            'post' => __("Wide range of tags and attributes as for WordPress posts", "gd-bbpress-toolbox")
        );
    }

    private function data_report_mode() {
        return array(
            'form' => __("Standard form with required message", "gd-bbpress-toolbox"),
            'confirm' => __("Simple confirmation dialog to send report", "gd-bbpress-toolbox"),
            'button' => __("Send report without any confirmation", "gd-bbpress-toolbox")
        );
    }

    private function data_quote_button_location() {
        return array(
            'header' => __("Reply or Topic header", "gd-bbpress-toolbox"),
            'footer' => __("Reply or Topic footer", "gd-bbpress-toolbox")
        );
    }

    private function data_quote_button_method() {
        return array(
            'bbcode' => 'BBCode',
            'html' => 'HTML'
        );
    }

    private function data_high_level_user_roles() {
        return array(
            bbp_get_keymaster_role() => __("Keymaster", "gd-bbpress-toolbox"),
            bbp_get_moderator_role() => __("Moderator", "gd-bbpress-toolbox")
        );
    }

    private function data_enhanced_editor_types() {
        return array(
            'textarea' => __("Normal Textarea", "gd-bbpress-toolbox"),
            'tinymce' => __("TinyMCE Full", "gd-bbpress-toolbox"),
            'tinymce_compact' => __("TinyMCE Compact", "gd-bbpress-toolbox"),
            'bbcodes' => __("BBCodes Toolbar", "gd-bbpress-toolbox")
        );
    }

    private function data_enhanced_signature_method() {
        return array(
            'plain' => __("Plain Text", "gd-bbpress-toolbox"),
            'html' => __("HTML", "gd-bbpress-toolbox"),
            'bbcode' => __("BBCodes", "gd-bbpress-toolbox"),
            'full' => __("HTML and BBCodes", "gd-bbpress-toolbox")
        );
    }

    private function data_bbcodes_replacement() {
        return array(
            'info' => __("Replace with notice", "gd-bbpress-toolbox"),
            'delete' => __("Remove from content", "gd-bbpress-toolbox")
        );
    }

    private function data_bbcodes_scode_theme() {
        return array(
            'default' => __("Default", "gd-bbpress-toolbox"),
            'django' => __("Django", "gd-bbpress-toolbox"),
            'eclipse' => __("Eclipse", "gd-bbpress-toolbox"),
            'emacs' => __("Emacs", "gd-bbpress-toolbox"),
            'fadetogrey' => __("Fade To Grey", "gd-bbpress-toolbox"),
            'mdultra' => __("MD Ultra", "gd-bbpress-toolbox"),
            'midnight' => __("Midnight", "gd-bbpress-toolbox"),
            'rdark' => __("Dark", "gd-bbpress-toolbox"),
            'swift' => __("Swift", "gd-bbpress-toolbox")
        );
    }

    private function data_bbcodes_toolbar_size() {
        return array(
            'small' => __("Small", "gd-bbpress-toolbox"),
            'medium' => __("Medium", "gd-bbpress-toolbox"),
            'large' => __("Large", "gd-bbpress-toolbox")
        );
    }

    private function data_list_bbcodes() {
        require_once(GDBBX_PATH.'core/functions/bbcodes.php');

        $list = array();
        foreach (gdbbx_get_bbcodes_list() as $key => $code) {
            $list[$key] = $code['title'].' ['.$key.']';
        }

        return $list;
    }

    private function data_attachment_icon_method() {
        return array(
            'images' => __("Images", "gd-bbpress-toolbox"),
            'font' => __("Font Icons", "gd-bbpress-toolbox")
        );
    }

    private function data_files_position_topic() {
        return array(
            'content' => __("Attach at the end of post content", "gd-bbpress-toolbox"),
            'after' => __("Place after the post content", "gd-bbpress-toolbox")
        );
    }

    private function data_form_position_topic() {
        return array(
            'bbp_theme_before_topic_form_title' => __("Before title", "gd-bbpress-toolbox"),
            'bbp_theme_after_topic_form_title' => __("After title", "gd-bbpress-toolbox"),
            'bbp_theme_before_topic_form_content' => __("Before content", "gd-bbpress-toolbox"),
            'bbp_theme_after_topic_form_content' => __("After content", "gd-bbpress-toolbox"),
            'bbp_theme_before_topic_form_submit_wrapper' => __("At the end", "gd-bbpress-toolbox")
        );
    }

    private function data_form_position_reply() {
        return array(
            'bbp_theme_before_reply_form_content' => __("Before content", "gd-bbpress-toolbox"),
            'bbp_theme_after_reply_form_content' => __("After content", "gd-bbpress-toolbox"),
            'bbp_theme_before_reply_form_submit_wrapper' => __("At the end", "gd-bbpress-toolbox")
        );
    }

    private function data_attachment_topic_delete() {
        return array(
            'detach' => __("Leave attachments in media library", "gd-bbpress-toolbox"),
            'delete' => __("Delete attachments", "gd-bbpress-toolbox"),
            'nohing' => __("Do nothing", "gd-bbpress-toolbox")
        );
    }

    private function data_attachment_delete_method() {
        return array(
            'default' => __("Default, inline links", "gd-bbpress-toolbox"),
            'edit' => __("Advanced, through edit pages", "gd-bbpress-toolbox"),
            'hide' => __("Hide deletion options", "gd-bbpress-toolbox")
        );
    }

    private function data_attachment_file_delete() {
        return array(
            'no' => __("Don't allow to delete", "gd-bbpress-toolbox"),
            'detach' => __("Only detach from topic/reply", "gd-bbpress-toolbox"),
            'delete' => __("Delete from Media Library", "gd-bbpress-toolbox"),
            'both' => __("Allow both delete and detach", "gd-bbpress-toolbox")
        );
    }

    private function data_extra_features() {
        return array(
            'thumbnail' => __("Thumbnail", "gd-bbpress-toolbox"),
            'excerpt' => __("Excerpt", "gd-bbpress-toolbox"),
            'custom-fields' => __("Custom Fields", "gd-bbpress-toolbox")
        );
    }

    private function data_forum_index_filters() {
        return array(
            'before' => __("Before Forum Index", "gd-bbpress-toolbox"),
            'after' => __("After Forum Index", "gd-bbpress-toolbox")
        );
    }

    private function data_private_checked_status() {
        return array(
            'unchecked' => __("Unchecked", "gd-bbpress-toolbox"),
            'checked' => __("Checked", "gd-bbpress-toolbox")
        );
    }

    private function data_disable_rss() {
        return array(
            'home' => __("Home Page", "gd-bbpress-toolbox"),
            '404' => __("Error 404 Page", "gd-bbpress-toolbox"),
            'forums' => __("Main Forums Page", "gd-bbpress-toolbox"),
            'parent' => __("Parent Page", "gd-bbpress-toolbox")
        );
    }

    private function data_fontawesome_source() {
        return array(
            'local' => __("The plugin", "gd-bbpress-toolbox"),
            'maxcdn' => __("MaxCDN", "gd-bbpress-toolbox")
        );
    }

    private function data_active_users_period() {
        return array(
            0 => __("Currently online", "gd-bbpress-toolbox"),
            30 => __("Active in the past 30 minutes", "gd-bbpress-toolbox"),
            60 => __("Active in the past 60 minutes", "gd-bbpress-toolbox"),
            120 => __("Active in the past 2 hours", "gd-bbpress-toolbox"),
            720 => __("Active in the past 12 hours", "gd-bbpress-toolbox"),
            1440 => __("Active in the past 24 hours", "gd-bbpress-toolbox"),
            10080 => __("Active in the past 7 days", "gd-bbpress-toolbox")
        );
    }

    private function data_bbcodes_heading() {
        return array(
            1 => 'H1',
            2 => 'H2',
            3 => 'H3',
            4 => 'H4',
            5 => 'H5',
            6 => 'H6'
        );
    }
}
