<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Front {
    public function __construct() {
        if (gdbbx()->get('forum_load_welcome_front', 'bbpress') && gdbbx()->allowed('forum_load_welcome_front', 'bbpress', false, false)) {
            if (gdbbx()->get('forum_load_welcome_filter', 'bbpress') == 'before') {
                add_action('bbp_template_before_forums_index', array($this, 'welcome_index'));
            } else {
                add_action('bbp_template_after_forums_index', array($this, 'welcome_index'));
            }
        }

        if (gdbbx()->get('forum_load_statistics_front', 'bbpress') && gdbbx()->allowed('forum_load_statistics_front', 'bbpress', true, false)) {
            if (gdbbx()->get('forum_load_statistics_filter', 'bbpress') == 'before') {
                add_action('bbp_template_before_forums_index', array($this, 'forum_index'));
            } else {
                add_action('bbp_template_after_forums_index', array($this, 'forum_index'));
            }
        }
    }

    public function get_welcome($name) {
        return gdbbx()->get('forum_load_welcome_show_'.$name, 'bbpress');
    }

    public function get_statistics($name) {
        return gdbbx()->get('forum_load_statistics_show_'.$name, 'bbpress');
    }

    public function welcome_index() {
        include(gdbbx_get_template_part('gdbbx-forums-welcome.php'));
    }

    public function forum_index() {
        include(gdbbx_get_template_part('gdbbx-forums-statistics.php'));
    }

    public function user_visit() {
        $timestamp = GDBBX_LAST_ACTIVTY + 3600 * d4p_gmt_offset();

        return array(
            'topics' => gdbbx_db()->get_topics_count_since(GDBBX_LAST_ACTIVTY),
            'replies' => gdbbx_db()->get_replies_count_since(GDBBX_LAST_ACTIVTY),
            'time' => date(get_option('time_format'), $timestamp),
            'date' => date(get_option('date_format'), $timestamp),
        );
    }

    public function user_links() {
        $links = array();

        $_view_new_posts = gdbbx()->get('view_newposts_slug', 'tools');
        if (bbp_get_view_id($_view_new_posts) !== false) {
            $links[] = '<a href="'.bbp_get_view_url($_view_new_posts).'">'.__("New posts since last visit", "gd-bbpress-toolbox").'</a>';
        }

        $_view_latest_topics = gdbbx()->get('view_latesttopics_slug', 'tools');
        if (bbp_get_view_id($_view_latest_topics) !== false) {
            $links[] = '<a href="'.bbp_get_view_url($_view_latest_topics).'">'.__("All latest topics", "gd-bbpress-toolbox").'</a>';
        }

        $links[] = '<a href="'.bbp_get_user_profile_url(bbp_get_current_user_id()).'">'.__("My user profile page", "gd-bbpress-toolbox").'</a>';

        return $links;
    }

    public function user_roles_legend() {
        $_roles = gdbbx_get_user_roles();

        $items = array();

        foreach ($_roles as $role => $name) {
            $items[] = '<span class="gdbbx-front-user gdbbx-user-color-'.$role.'">'.$name.'</span>';
        }

        return join(', ', $items);
    }

    public function users_list() {
        $_show = $this->get_statistics('users');
        $_limit = $this->get_statistics('users_limit');

        $items = array();
        $label = '';
        if ($_show == 0) {
            $online = gdbbx_module_tracking()->online();
            
            $_users = array();
            foreach ($online['roles'] as $ids) {
                $_users = array_merge($_users, $ids);
            }

            foreach ($_users as $id) {
                if (count($items) == $_limit) {
                    break;
                }

                $items[] = get_user_by('id', absint($id));
            }

            $label = __("Users currently online", "gd-bbpress-toolbox");
        } else {
            $_users = array_keys(gdbbx_db()->get_users_active_in_past($_show * MINUTE_IN_SECONDS, $_limit));

            foreach ($_users as $id) {
                $items[] = get_user_by('id', absint($id));
            }

            $standard = array(
                30 => __("30 minutes", "gd-bbpress-toolbox"),
                60 => __("60 minutes", "gd-bbpress-toolbox"),
                120 => __("2 hours", "gd-bbpress-toolbox"),
                720 => __("12 hours", "gd-bbpress-toolbox"),
                1440 => __("24 hours", "gd-bbpress-toolbox"),
                10080 => __("7 days", "gd-bbpress-toolbox")
            );

            $label = sprintf(__("Users active in the past %s", "gd-bbpress-toolbox"), $standard[$_show]);
        }

        $render = array();

        foreach ($items as $user) {
            $render[] = $this->_user_format_for_display($user);
        }

        if (empty($render)) {
            $render[] = '&minus;';
        }
        
        return '<label>'.$label.'</label>: '.join(', ', $render);
    }

    public function newest_user() {
        $users = new WP_User_Query(array(
            'orderby' => 'registered', 
            'order' => 'DESC', 'number' => 1
        ));

        $user = $users->get_results();

        return $this->_user_format_for_display($user[0]);
    }

    private function _user_format_for_display(WP_User $user) {
        $_color = $this->get_statistics('users_colors');
        $_avatar = $this->get_statistics('users_avatars');
        $_link = $this->get_statistics('users_links');
        $_roles = $_color ? $this->_user_roles($user) : array();

        $_class = 'gdbbx-front-user';

        if (!empty($_roles)) {
            $_class.= ' gdbbx-user-color-'.$_roles[0];
        }

        $item = '<span class="'.$_class.'">';

        if ($_avatar) {
            if ($_link) {
                $item.= '<a class="bbp-author-avatar" href="'.esc_url(bbp_get_user_profile_url($user->ID)).'">';
            }

            $item.= get_avatar($user, '14');

            if ($_link) {
                $item.= '</a>';
            }
        }

        if ($_link) {
            $item.= bbp_get_user_profile_link($user->ID);
        } else {
            $item.= $user->display_name;
        }

        $item.= '</span>';

        return $item;
    }

    private function _user_roles(WP_User $user) {
        $_roles = array_keys(gdbbx_get_user_roles());
        $_inter = array_intersect($user->roles, $_roles);
        
        return array_values($_inter);
    }
}

/** @return gdbbxMod_Front */
function gdbbx_module_front() {
    return gdbbx_loader()->modules['front'];
}
