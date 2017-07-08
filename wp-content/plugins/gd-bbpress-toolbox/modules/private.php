<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Private {
    public $topics = false;
    public $replies = false;

    public $topic_id = 0;
    public $reply_id = 0;

    public $threaded = false;
    
    public function __construct() {
        add_action('gdbbx_template', array($this, 'loader'));
    }

    public function loader() {
        $this->threaded = bbp_thread_replies();

        $this->topics = $this->is_enabled_topic_private();
        $this->replies = $this->is_enabled_reply_private();

        if ($this->topics) {
            if (gdbbx()->allowed('private_topics', 'bbpress', true)) {
                add_action(gdbbx()->get('private_topic_form_position', 'bbpress'), array($this, 'topic_checkbox'), 8);

                add_action('bbp_new_topic', array($this, 'topic_save'), 1);
                add_action('bbp_edit_topic', array($this, 'topic_save'), 1);
            }

            add_filter('bbp_get_topic_class', array($this, 'topic_post_class'), 10, 2);

            add_filter('bbp_get_topic_excerpt', array($this, 'topic_hidding'), 10000, 2);
            add_filter('bbp_get_topic_content', array($this, 'topic_hidding'), 10000, 2);

            if (gdbbx()->get('private_topics_icon', 'bbpress')) {
                add_action('bbp_theme_before_topic_title', array($this, 'show_private_icon'), 15);
            }

            add_filter('bbp_current_user_can_access_create_reply_form', array($this, 'topic_reply_form'));

            add_filter('bbp_get_forum_subscribers', array($this, 'forum_subscribers'));

            add_filter('bbp_get_topic_subscribe_link', array($this, 'topic_link_override'), 10, 2);
            add_filter('bbp_get_user_favorites_link', array($this, 'topic_link_override'), 10, 2);

            add_filter('bbp_get_single_topic_description', array($this, 'topic_description'), 10, 2);
            add_filter('bbp_after_has_replies_parse_args', array($this, 'topic_has_replies'));

            add_filter('bbp_activity_topic_create_excerpt', array($this, 'topic_activity_stream'));
        }

        if ($this->replies) {
            if (gdbbx()->allowed('private_replies', 'bbpress', true)) {
                add_action(gdbbx()->get('private_reply_form_position', 'bbpress'), array($this, 'reply_checkbox'), 8);

                add_action('bbp_new_reply', array($this, 'reply_save'), 1, 2);
                add_action('bbp_edit_reply', array($this, 'reply_save'), 1, 2);
            }

            add_filter('bbp_get_reply_excerpt', array($this, 'reply_hidding'), 10000, 2);
            add_filter('bbp_get_reply_content', array($this, 'reply_hidding'), 10000, 2);

            add_filter('bbp_get_topic_subscribers', array($this, 'topic_subscribers'));

            add_filter('bbp_activity_reply_create_excerpt', array($this, 'reply_activity_stream'));
        }

        if ($this->topics || $this->replies) {
            add_filter('bbp_get_reply_class', array($this, 'reply_post_class'), 10, 2);
        }
    }

    public function is_enabled_topic_private() {
        $forum = gdbbx_obj_forums()->forum()->privacy()->get('enable_topic_private');

        $active = false;
        if ($forum == 'default') {
            $active = gdbbx()->get('private_topics', 'bbpress');
        } else if ($forum == 'yes') {
            $active = true;
        } else if ($forum == 'no') {
            $active = false;
        }

        return apply_filters('gdbbx_privacy_is_enabled_topic_private', $active);
    }

    public function is_enabled_reply_private() {
        $forum = gdbbx_obj_forums()->forum()->privacy()->get('enable_reply_private');

        $active = false;
        if ($forum == 'default') {
            $active = gdbbx()->get('private_replies', 'bbpress');
        } else if ($forum == 'yes') {
            $active = true;
        } else if ($forum == 'no') {
            $active = false;
        }

        return apply_filters('gdbbx_privacy_is_enabled_reply_private', $active);
    }

    public function topic_activity_stream($content) {
        if ($this->is_topic_private($this->topic_id)) {
            $content = __("Topic is marked as private.", "gd-bbpress-toolbox");
        }

        return $content;
    }

    public function reply_activity_stream($content) {
        if ($this->is_reply_private($this->reply_id)) {
            $content = __("Reply is marked as private.", "gd-bbpress-toolbox");
        }

        return $content;
    }

    public function topic_has_replies($r) {
        if (bbp_is_single_topic()) {
            $topic_id = $r['post_parent'];

            if (!$this->is_user_allowed_to_topic($topic_id)) {
                $r['post_type'] = '_fake_reply_';
            }
        }

        return $r;
    }

    public function topic_description($retstr, $r) {
        if (!$this->is_user_allowed_to_topic($r['topic_id'])) {
            $retstr = $r['before'].__("This topic is marked as private", "gd-bbpress-toolbox").$r['after'];
        }

        return $retstr;
    }

    public function topic_link_override($content, $r) {
        if (!$this->is_user_allowed_to_topic($r['topic_id'], $r['user_id'])) {
            $content = '';
        }

        return $content;
    }

    public function forum_subscribers($users) {
        $final = array();

        foreach ($users as $user_id) {
            if ($this->is_user_allowed_to_topic($this->topic_id, $user_id)) {
                $final[] = $user_id;
            }
        }

        return $final;
    }

    public function topic_subscribers($users) {
        $final = array();

        foreach ($users as $user_id) {
            if ($this->is_user_allowed_to_reply($this->reply_id, $user_id)) {
                $final[] = $user_id;
            }
        }

        return $final;
    }

    public function topic_reply_form($retval) {
        if (!$this->is_user_allowed_to_topic()) {
            $retval = false;
        }

        return $retval;
    }

    public function show_private_icon() {
        if ($this->is_topic_private()) {
            echo gdbbx_obj_icons()->private_topic();
        }
    }

    public function topic_hidding($content, $topic_id) {
        if (!$this->is_user_allowed_to_topic($topic_id)) {
            $content = __("This topic has been set as private.", "gd-bbpress-toolbox");
        }

        return $content;
    }

    public function reply_hidding($content, $reply_id) {
        if (!$this->is_user_allowed_to_reply($reply_id)) {
            $content = __("This reply has been set as private.", "gd-bbpress-toolbox");
        }

        return $content;
    }

    public function topic_save($topic_id = 0) {
        $this->topic_id = $topic_id;

        if (isset($_POST['gdbbx_private_topic'])) {
            update_post_meta($topic_id, '_bbp_topic_is_private', '1');
        } else {
            delete_post_meta($topic_id, '_bbp_topic_is_private');
        }
    }

    public function reply_save($reply_id = 0, $topic_id = 0) {
        $this->reply_id = $reply_id;
        $this->topic_id = $topic_id;

        if (isset($_POST['gdbbx_private_reply'])) {
            update_post_meta($reply_id, '_bbp_reply_is_private', '1');
        } else {
            delete_post_meta($reply_id, '_bbp_reply_is_private');
        }
    }

    public function topic_checkbox() {
        $edit = bbp_is_topic_edit();
        $status = $edit ? $this->is_topic_private() : (gdbbx()->get('private_topics_default', 'bbpress') == "checked");

        ?>

        <p>
            <input name="gdbbx_private_topic" id="gdbbx_private_topic" type="checkbox"<?php checked('1', $status); ?> value="1" tabindex="<?php bbp_tab_index(); ?>" /> 
            <label for="gdbbx_private_topic"><?php _e("Set this as private topic", "gd-bbpress-toolbox"); ?></label>
        </p>

        <?php 
    }

    public function reply_checkbox() {
        $edit = bbp_is_reply_edit();
        $status = $edit ? $this->is_reply_private() : (gdbbx()->get('private_replies_default', 'bbpress') == "checked");

        ?>

        <p>
            <input name="gdbbx_private_reply" id="gdbbx_private_reply" type="checkbox"<?php checked('1', $status); ?> value="1" tabindex="<?php bbp_tab_index(); ?>" /> 
            <label for="gdbbx_private_reply"><?php _e("Set this as private reply", "gd-bbpress-toolbox"); ?></label>
        </p>

        <?php 
    }

    public function topic_post_class($classes, $topic_id) {
        if ($this->is_topic_private($topic_id)) {
            $classes[] = 'private-topic';

            if (!$this->is_user_allowed_to_topic($topic_id)) {
                $classes[] = 'private-topic-locked';
            }
        }

        return $classes;
    }

    public function reply_post_class($classes, $reply_id) {
        if (bbp_is_topic($reply_id)) {
            $classes = $this->topic_post_class($classes, $reply_id);
        } else {
            if ($this->is_reply_private($reply_id)) {
                $classes[] = 'private-reply';

                if (!$this->is_user_allowed_to_reply($reply_id)) {
                    $classes[] = 'private-reply-locked';

                    if (gdbbx()->get('private_replies_css_hide', 'bbpress')) {
                        $classes[] = 'gdbbx-private-reply-hidden';
                    }
                }
            }
        }

        return $classes;
    }

    public function is_user_allowed_to_topic($topic_id = 0, $user_id = 0) {
        if ($topic_id == 0) {
            $topic_id = bbp_get_topic_id();
        }

        if ($user_id == 0) {
            $user_id = bbp_get_current_user_id();
        }

        if ($this->is_topic_private($topic_id)) {
            $author_id = bbp_get_topic_author_id($topic_id);

            $allowed = false;

            if ($user_id > 0) {
                $allowed = $author_id == $user_id;
            }

            if (!$allowed) {
                $allowed = gdbbx_can_user_moderate();
            }

            return $allowed;
        } else {
            return true;
        }
    }

    public function is_user_allowed_to_reply($reply_id = 0, $user_id = 0) {
        if ($reply_id == 0) {
            $reply_id = bbp_get_reply_id();
        }

        if ($user_id == 0) {
            $user_id = bbp_get_current_user_id();
        }

        if ($this->is_reply_private($reply_id)) {
            $author_id = bbp_get_reply_author_id($reply_id);

            $allowed = false;

            if ($user_id > 0) {
                $allowed = $author_id == $user_id;
            }

            if (!$allowed) {
                $topic_id = bbp_get_reply_topic_id($reply_id);
                $topic_author_id = bbp_get_topic_author_id($topic_id);

                if ($user_id > 0) {
                    $allowed = $topic_author_id == $user_id;
                }
            }

            if (!$allowed && $this->threaded && gdbbx()->get('private_replies_threaded', 'bbpress')) {
                $reply_to_id = (int)get_post_meta($reply_id, '_bbp_reply_to', true);
                $reply_to_author_id = bbp_get_reply_author_id($reply_to_id);

                if ($user_id > 0 && $reply_to_id > 0) {
                    $allowed = $reply_to_author_id == $user_id;
                }
            }

            if (!$allowed) {
                $allowed = gdbbx_can_user_moderate();
            }

            return $allowed;
        } else {
            return true;
        }
    }

    public function is_topic_private($topic_id = 0, $forced_check = false) {
        if ($this->topics || $forced_check) {
            if ($topic_id == 0) {
                $topic_id = bbp_get_topic_id();
            }

            $status = get_post_meta($topic_id, '_bbp_topic_is_private', true) == '1';

            return apply_filters('gdbbx_is_topic_private', $status, $topic_id);
        }

        return false;
    }

    public function is_reply_private($reply_id = 0, $forced_check = false) {
        if ($this->replies || $forced_check) {
            if ($reply_id == 0) {
                $reply_id = bbp_get_reply_id();
            }

            $status = get_post_meta($reply_id, '_bbp_reply_is_private', true) == '1';

            return apply_filters('gdbbx_is_reply_private', $status, $reply_id);
        }

        return false;
    }
}
