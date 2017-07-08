<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Admin {
    private $is_calculated = false;

    function __construct() {
        add_action('pre_user_query', array($this, 'pre_user_query'));

        add_action('admin_menu', array($this, 'admin_meta'));
        add_action('admin_head', array($this, 'admin_head'));

        add_action('gdbbx_admin_toolbox_meta_content_attachments', array($this, 'metabox_content_attachments'));
        add_action('gdbbx_admin_toolbox_meta_content_privacy', array($this, 'metabox_content_privacy'));
        add_action('gdbbx_admin_toolbox_meta_content_locking', array($this, 'metabox_content_locking'));

        add_action('save_post', array($this, 'save_edit_forum'));

        add_filter('manage_users_columns', array($this, 'users_columns'));
        add_filter('manage_users_custom_column', array($this, 'users_custom_column'), 10, 3);
        add_filter('manage_users_sortable_columns', array($this, 'users_sortable_columns'));

        add_action('manage_topic_posts_columns', array($this, 'admin_topic_columns'), 990);
        add_action('manage_topic_posts_custom_column', array($this, 'admin_columns_data'), 990, 2);

        add_action('manage_reply_posts_columns', array($this, 'admin_reply_columns'), 990);
        add_action('manage_reply_posts_custom_column', array($this, 'admin_columns_data'), 990, 2);

        add_action('wp_dashboard_setup', array($this, 'dashboard_widgets'), 300);
    }

    public function dashboard_widgets() {
        if (gdbbx()->get('dashboard_widget_remove', 'tools')) {
            remove_meta_box('bbp-dashboard-right-now', 'dashboard', 'normal');
        }

        if (gdbbx()->get('dashboard_widget_activity', 'tools')) {
            wp_add_dashboard_widget('gdbbx-dashboard-activity', __("Latest Forum Topics and Replies", "gd-bbpress-toolbox"), array($this, 'widget_latest_activity'));
        }

        if (gdbbx()->get('dashboard_widget', 'online')) {
            wp_add_dashboard_widget('gdbbx-dashboard-users', __("Online Users in the Forums", "gd-bbpress-toolbox"), array($this, 'widget_online_users'));
        }
    }

    public function widget_latest_activity() {
        include(GDBBX_PATH.'forms/meta/dashboard.activity.php');
    }

    public function widget_online_users() {
        include(GDBBX_PATH.'forms/meta/dashboard.online.php');
    }

    public function save_edit_forum($post_id) {
        if (isset($_POST['post_ID']) && $_POST['post_ID'] > 0) {
            $post_id = $_POST['post_ID'];
        }

        if (isset($_POST['gdbbx_forum_settings']) && $_POST['gdbbx_forum_settings'] == 'edit') {
            $data = isset($_POST['gdbbx_settings']) ? (array)$_POST['gdbbx_settings'] : array();

            $meta = array();
            $_string = array('privacy_lock_topic_form', 'privacy_lock_reply_form', 'privacy_enable_topic_private', 'privacy_enable_reply_private');
            $_int = array();

            if (isset($data['attachments_status'])) {
                $_string = array_merge($_string, array('attachments_status', 'attachments_hide_from_visitors', 'attachments_max_file_size_override', 'attachments_max_to_upload_override', 'attachments_mime_types_list_override'));
                $_int = array_merge($_int, array('attachments_max_file_size', 'attachments_max_to_upload'));
            }

            foreach ($_string as $key) {
                $meta[$key] = stripslashes(strip_tags($data[$key]));
            }

            foreach ($_int as $key) {
                $meta[$key] = absint(intval($data[$key]));
            }

            if (isset($meta['attachments_mime_types_list_override']) && $meta['attachments_mime_types_list_override'] == 'yes') {
                $meta['attachments_mime_types_list'] = (array)($data['attachments_mime_types_list']);
            }

            $meta = wp_parse_args($meta, gdbbx_default_forum_settings());

            update_post_meta($post_id, '_gdbbx_settings', $meta);
        }
    }

    public function admin_meta() {
        if (current_user_can(GDBBX_CAP)) {
            add_meta_box('gdbbx-meta-forum', __("GD bbPress Toolbox", "gd-bbpress-toolbox"), array($this, 'metabox_forum'), bbp_get_forum_post_type(), 'side', 'high');
        }
    }

    public function metabox_forum() {
        include(GDBBX_PATH.'forms/meta/forum.php');
    }

    public function metabox_content_attachments($post_id) {
        include(GDBBX_PATH.'forms/meta/forum.attachments.php');
    }

    public function metabox_content_privacy($post_id) {
        include(GDBBX_PATH.'forms/meta/forum.privacy.php');
    }

    public function metabox_content_locking($post_id) {
        include(GDBBX_PATH.'forms/meta/forum.locking.php');
    }

    public function admin_head() { ?>
        <style type="text/css">
            /*<![CDATA[*/
            .wp-list-table.users th.column-bbp-topics, 
            .wp-list-table.users th.column-bbp-replies { width: 90px; }
            .wp-list-table.users th.column-bbp-activity { width: 140px; }

            .wp-list-table.posts th.column-bbp-is-private, 
            .wp-list-table.posts td.column-bbp-is-private { width: 30px; text-align: center; }

            .wp-list-table.posts td.column-bbp-is-private { color: #aa0000; font-size: 1.1em; font-weight: bold; }

            .wp-list-table.posts th.column-bbp-is-private div { font-size: 18px; }
            /*]]>*/
        </style><?php
    }

    public function admin_topic_columns($columns) {
        if (gdbbx()->get('topic_columns_private', 'tools')) {
            $columns['bbp-is-private'] = '<div class="dashicons dashicons-lock" title="'.__("Private", "gd-bbpress-toolbox").'"></div>';
        }

        return $columns;
    }

    public function admin_reply_columns($columns) {
        if (gdbbx()->get('reply_columns_private', 'tools')) {
                $columns['bbp-is-private'] = '<div class="dashicons dashicons-lock" title="'.__("Private", "gd-bbpress-toolbox").'"></div>';
        }

        return $columns;
    }

    public function admin_columns_data($column, $id) {
        if ($column == 'bbp-is-private') {
            
            if (bbp_is_topic($id)) {
                if (gdbbx_is_topic_private($id, true)) {
                    echo '&#x2713;';
                }
            } else if (bbp_is_reply($id)) {
                if (gdbbx_is_reply_private($id, true)) {
                    echo '&#x2713;';
                }
            }
        }
    }

    public function pre_user_query($query) {
        if (!isset($query->query_vars['toolbox'])) {
            if ($query->query_vars['orderby'] == 'usr.replies') {
                $query->query_from.= " LEFT JOIN (SELECT post_author, count(*) as replies FROM ".gdbbx_db()->wpdb()->posts." WHERE post_type = 'reply' AND post_status IN ('publish', 'pending', 'closed') GROUP BY post_author) usr ON usr.post_author = ".gdbbx_db()->wpdb()->users.".ID";
            } else if ($query->query_vars['orderby'] == 'usr.topics') {
                $query->query_from.= " LEFT JOIN (SELECT post_author, count(*) as topics FROM ".gdbbx_db()->wpdb()->posts." WHERE post_type = 'topic' AND post_status IN ('publish', 'pending', 'closed') GROUP BY post_author) usr ON usr.post_author = ".gdbbx_db()->wpdb()->users.".ID";
            }

            if ($query->query_vars['orderby'] == 'usr.replies' || $query->query_vars['orderby'] == 'usr.topics') {
                $query->query_orderby = 'ORDER BY '.$query->query_vars['orderby'].' '.$query->query_vars['order'];
            }
        }
    }

    public function users_columns($columns) {
        if (gdbbx()->get('user_columns_topics_replies', 'tools')) {
            $columns['bbp-topics'] = __("Topics", "gd-bbpress-toolbox");
            $columns['bbp-replies'] = __("Replies", "gd-bbpress-toolbox");
        }

        if (gdbbx()->get('user_columns_last_activity', 'tools')) {
            $columns['bbp-activity'] = __("Last Forum Activity", "gd-bbpress-toolbox");
        }

	return $columns;
    }

    public function users_custom_column($value, $column, $user_id) {
        global $wp_list_table;

        $this->calculate_counts();

        if ($column == 'bbp-topics') {
            $value = isset($wp_list_table->items[$user_id]->data->forums['topic']) ? $wp_list_table->items[$user_id]->data->forums['topic'] : 0;

            if ($value > 0) {
                $value = '<a href="'.admin_url("edit.php?post_type=topic&amp;author=$user_id").'">'.$value.'</a>';
            }
	} else if ($column == 'bbp-replies') {
            $value = isset($wp_list_table->items[$user_id]->data->forums['reply']) ? $wp_list_table->items[$user_id]->data->forums['reply'] : 0;

            if ($value > 0) {
                $value = '<a href="'.admin_url("edit.php?post_type=reply&amp;author=$user_id").'">'.$value.'</a>';
            }
	} else if ($column == 'bbp-activity') {
            $value = $this->get_last_activity($user_id);
        }

	return $value;
    }

    public function users_sortable_columns($columns) {
        $columns['bbp-topics'] = 'usr.topics';
	$columns['bbp-replies'] = 'usr.replies';

        return $columns;
    }

    private function get_last_activity($user_id) {
        $timestamp = gdbbx_db()->get_user_last_activity($user_id) + d4p_gmt_offset() * 3600;

        if ($timestamp == 0) {
            return '—';
        } else {
            return date('Y-m-d', $timestamp).'<br/>@ '.date('H:i:s', $timestamp);
        }
    }

    private function calculate_counts() {
        global $wp_list_table;

        if ($this->is_calculated || !$wp_list_table) {
            return;
        }

        $users = array_keys($wp_list_table->items);
        $sql = "SELECT post_type, post_author, count(*) AS counter FROM ".gdbbx_db()->wpdb()->posts." WHERE post_type IN ('reply', 'topic') AND post_status IN ('pending', 'publish', 'closed') AND post_author IN (".join(', ', $users).") GROUP BY post_type, post_author";
        $raw = gdbbx_db()->get_results($sql);

        foreach ($raw as $row) {
            $wp_list_table->items[$row->post_author]->data->forums[$row->post_type] = $row->counter;
        }

        $this->is_calculated = true;
    }
}
