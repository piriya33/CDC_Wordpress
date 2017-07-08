<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Attachments {
    public $o;

    public $admin;
    public $front;

    function __construct() {
        $this->o = gdbbx()->group_get('attachments');

        add_action('gdbbx_init', array($this, 'load'));

        add_action('before_delete_post', array($this, 'delete_post'));
    }

    public function get($name) {
        return $this->o[$name];
    }

    public function load() {
        $this->init_thumbnail_size();
        $this->delete_attachments();

        if (is_admin()) {
            require_once(GDBBX_PATH.'modules/attachments/admin.php');
            $this->admin = new gdbbxAttachments_Admin();
        } else {
            require_once(GDBBX_PATH.'modules/attachments/front.php');
            $this->front = new gdbbxAttachments_Front();
        }
    }

    public function init_thumbnail_size() {
        $size = $this->o['image_thumbnail_size'];
        $size = explode('x', $size);

        add_image_size('d4p-bbp-thumb', $size[0], $size[1], true);
    }

    public function deletion_status($author_id) {
        $user_id = bbp_get_current_user_id();

        $allow = 'no';

        if (gdbbx_is_current_user_bbp_keymaster()) {
            $allow = gdbbx()->get('delete_visible_to_admins', 'attachments');
        } else if (gdbbx_is_current_user_bbp_moderator()) {
            $allow = gdbbx()->get('delete_visible_to_moderators', 'attachments');
        } else if ($author_id == $user_id) {
            $allow = gdbbx()->get('delete_visible_to_author', 'attachments');
        }

        return $allow;
    }

    public function delete_attachment($att_id, $bbp_id, $action) {
        $user_id = bbp_get_current_user_id();

        $post = get_post($bbp_id);
        $author_id = $post->post_author;
        $file = get_attached_file($att_id);
        $file_name = pathinfo($file, PATHINFO_BASENAME);

        $allow = $this->deletion_status($author_id);

        if ($action == 'delete' && ($allow == 'delete' || $allow == 'both')) {
            wp_delete_attachment($att_id);

            add_post_meta($bbp_id, '_bbp_attachment_log', array(
                'code' => 'delete_attachment', 'user' => $user_id, 'file' => $file_name)
            );
        }

        if ($action == 'detach' && ($allow == 'detach' || $allow == 'both')) {
            gdbbx_db()->update(gdbbx_db()->wpdb()->posts, array('post_parent' => 0), array('ID' => $att_id));

            add_post_meta($bbp_id, '_bbp_attachment_log', array(
                'code' => 'detach_attachment', 'user' => $user_id, 'file' => $file_name, 'attachment_id' => $att_id)
            );
        }

        $_topic_id = bbp_is_topic($bbp_id) ? $bbp_id : bbp_get_reply_topic_id($bbp_id);

        gdbbx_db()->update_topic_attachments_count($_topic_id);
    }

    public function delete_attachments() {
        if (isset($_GET['d4pbbaction'])) {
            $nonce = wp_verify_nonce($_GET['_wpnonce'], 'd4p-bbpress-attachments');

            if ($nonce) {
                $action = d4p_sanitize_basic($_GET['d4pbbaction']);
                $att_id = absint($_GET['att_id']);
                $bbp_id = absint($_GET['bbp_id']);

                if ($att_id > 0 && $bbp_id > 0 && ($action == 'delete' || $action == 'detach')) {
                    $this->delete_attachment($att_id, $bbp_id, $action);
                }
            }

            $url = remove_query_arg(array('_wpnonce', 'd4pbbaction', 'att_id', 'bbp_id'));
            wp_redirect($url);
            exit;
        }
    }

    public function delete_post($id) {
        if (gdbbx_has_bbpress()) {
            if (bbp_is_reply($id) || bbp_is_topic($id)) {
                if ($this->o['delete_attachments'] == 'delete') {
                    $files = gdbbx_get_post_attachments($id);

                    if (is_array($files) && !empty($files)) {
                        foreach ($files as $file) {
                            wp_delete_attachment($file->ID);
                        }
                    }
                } else if ($this->o['delete_attachments'] == 'detach') {
                    gdbbx_db()->update(gdbbx_db()->wpdb()->posts, array('post_parent' => 0), array('post_parent' => $id, 'post_type' => 'attachment'));
                }
            }
        }
    }

    public function get_file_size($forum_id = 0) {
        $size = gdbbx()->get('max_file_size', 'attachments');

        $forum = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('max_file_size_override');
        $override = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('max_file_size');

        if ($override > 0 && $forum == 'yes') {
            $size = $override;
        }

        return apply_filters('gdbbx_attchaments_max_file_size', $size, gdbbx_obj_forums()->id());
    }

    public function get_max_files($forum_id = 0) {
        $files = gdbbx()->get('max_to_upload', 'attachments');

        $forum = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('max_to_upload_override');
        $override = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('max_to_upload');

        if ($override > 0 && $forum == 'yes') {
            $files = $override;
        }

        return apply_filters('gdbbx_attchaments_max_to_upload', $files, gdbbx_obj_forums()->id());
    }

    public function filter_mime_types($forum_id = 0) {
        if ($this->is_no_limit()) {
            return null;
        }

        if (gdbbx()->get('mime_types_limit_active', 'attachments')) {
            $full = get_allowed_mime_types();
            $list = gdbbx()->get('mime_types_list', 'attachments');

            $forum = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('mime_types_list_override');
            $override = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('mime_types_list');

            if (!empty($override) && $forum == 'yes') {
                $list = $override;
            }

            $filtered = array();
            foreach ($full as $key => $mime) {
                if (in_array($key, $list)) {
                    $filtered[$key] = $mime;
                }
            }

            return $filtered;
        } else {
            return null;
        }
    }

    public function get_file_extensions($forum_id = 0) {
        $list = gdbbx()->get('mime_types_list', 'attachments');

        $forum = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('mime_types_list_override');
        $override = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('mime_types_list');

        if (!empty($override) && $forum == 'yes') {
            $list = $override;
        }

        $show = array();
        foreach ($list as $i) {
            $show = array_merge($show, explode('|', $i));
        }

        return apply_filters('gdbbx_attchaments_extensions_list', $show, gdbbx_obj_forums()->id());
    }

    public function is_hidden_from_visitors($forum_id = 0) {
        $forum = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('hide_from_visitors');

        $hide = false;
        if ($forum == 'default') {
            $hide = gdbbx()->get('hide_from_visitors', 'attachments');
        } else if ($forum == 'yes') {
            $hide = true;
        } else if ($forum == 'no') {
            $hide = false;
        }

        return apply_filters('gdbbx_attchaments_is_hidden_from_visitors', $hide);
    }

    public function is_active($forum_id = 0) {
        $forum = gdbbx_obj_forums()->forum($forum_id)->attachments()->get('status');

        $active = false;
        if ($forum == 'default') {
            $active = gdbbx()->get('attachments_active', 'attachments');
        } else if ($forum == 'yes') {
            $active = true;
        } else if ($forum == 'no') {
            $active = false;
        }

        return apply_filters('gdbbx_attchaments_forum_enabled', $active, gdbbx_obj_forums()->id());
    }

    public function is_right_size($file, $forum_id = 0) {
        if ($this->is_no_limit()) {
            return true;
        }

        $file_size = $this->get_file_size($forum_id);

        return $file['size'] <= $file_size * KB_IN_BYTES;
    }

    public function is_user_allowed() {
        $allowed = false;

        if (is_user_logged_in()) {
            if (!isset($this->o['roles_to_upload'])) {
                $allowed = true;
            } else {
                global $current_user;

                $value = $this->o['roles_to_upload'];

                if (!is_array($value)) {
                    $allowed = true;
                }

                if (is_array($current_user->roles)) {
                    $matched = array_intersect($current_user->roles, $value);
                    $allowed = !empty($matched);
                }
            }
        }

        return apply_filters('gdbbx_attchaments_is_user_allowed', $allowed);
    }

    public function is_no_limit() {
        $allowed = false;

        if (is_user_logged_in()) {
            $value = $this->o['roles_no_limit'];

            if (is_array($value)) {
                global $current_user;

                if (is_array($current_user->roles)) {
                    $matched = array_intersect($current_user->roles, $value);
                    $allowed = !empty($matched);
                }
            }
        }

        return apply_filters('gdbbx_attchaments_is_user_with_no_limit', $allowed);
    }

    public function max_server_allowed() {
        return floor(d4p_php_ini_size_value('upload_max_filesize') / KB_IN_BYTES);
    }
}

global $_gdbbx_attachments;
$_gdbbx_attachments = new gdbbxMod_Attachments();

function gdbbx_attachments() {
    global $_gdbbx_attachments;
    return $_gdbbx_attachments;
}
