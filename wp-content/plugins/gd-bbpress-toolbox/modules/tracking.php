<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Tracking {
    public $settings = array();
    public $trackers = array();
    public $forums = array();
    public $thread_reply_id = null;

    function __construct() {
        $this->settings = gdbbx()->group_get('online');

        if (!is_admin()) {
            if (gdbbx()->get('track_last_activity_active', 'tools')) {
                add_action('bbp_template_before_single_forum', array($this, 'user_last_active'));
                add_action('bbp_template_before_single_reply', array($this, 'user_last_active'));
                add_action('bbp_template_before_lead_topic', array($this, 'user_last_active'));
                add_action('bbp_template_before_single_topic', array($this, 'user_last_active'));
            }

            if (is_user_logged_in() && gdbbx()->get('latest_track_users_topic', 'tools')) {
                add_action('bbp_template_after_single_topic', array($this, 'latest_users_topic'));
                add_action('bbp_theme_before_topic_title', array($this, 'latest_topic_before'), 1);
                add_action('bbp_theme_before_forum_title', array($this, 'latest_forum_before'), 1);
            }

            if (is_user_logged_in() && gdbbx()->get('latest_topic_new_replies_in_thread', 'tools')) {
                add_action('bbp_template_before_replies_loop', array($this, 'new_replies_thread'));
            }

            $this->current_session_cookie();

            $this->visit_tracking_cookie();
        }

        if ($this->settings['active']) {
            $this->online_tracking_cookie();
            $this->online_logged_users();

            add_filter('gdbbx_user_stats_items', array($this, 'user_stats'), 5, 2);
        }
    }

    private function _cookie_tracking() {
        return gdbbx_db()->prefix().'gdbbx_tracking_activity';
    }

    private function _cookie_session() {
        return gdbbx_db()->prefix().'gdbbx_session_activity';
    }

    private function _cookie_online() {
        return gdbbx_db()->prefix().'gdbbx_online_activity';
    }

    public function timestamp() {
        return gdbbx_db()->timestamp();
    }

    public function calculate_the_f() {
        $user_id = bbp_get_current_user_id();
        $forum_id = bbp_get_forum_id();
        $forums = gdbbx_get_forum_children_ids($forum_id);
        $forums[] = $forum_id;

        $last_forum_visit = gdbbx_db()->get_forum_last_visit($user_id, $forums);

        $visitd = $last_forum_visit !== false ? $last_forum_visit->latest : false;
        $latest = gdbbx_db()->get_forum_last_post_time($forums);
        $cutoff = gdbbx_settings()->get('latest_use_cutoff_timestamp', 'tools') ? gdbbx_settings()->get_core('unread_cutoff') : 0;

        $F = apply_filters('gdbbx_user_forum_visit_control', array(
            'user_last_activity' => GDBBX_LAST_ACTIVTY,
            'user_last_visit' => $visitd,
            'user_visited' => $visitd !== false,
            'forum_last_active' => $latest,
            'forum_is_unread' => $latest > $cutoff && $visitd === false,
            'forum_has_new_posts' => $visitd !== false && 
                $visitd < $latest
        ));

        $this->forums[$forum_id] = $F;

        return $F;
    }

    public function calculate_the_t() {
        $user_id = bbp_get_current_user_id();
        $topic_id = bbp_get_topic_id();

        $last_visit = gdbbx_db()->get_topic_last_visit($user_id, $topic_id);

        $author = bbp_get_topic_author_id($topic_id);
        $visitd = $last_visit !== false ? $last_visit->latest : false;
        $replie = $last_visit !== false ? $last_visit->reply_id : 0;
        $latest = gdbbx_get_topic_last_reply_time($topic_id);
        $topics = gdbbx_get_topic_post_time($topic_id);
        $cutoff = gdbbx_settings()->get('latest_use_cutoff_timestamp', 'tools') ? gdbbx_settings()->get_core('unread_cutoff') : 0;

        $T = apply_filters('gdbbx_user_topic_visit_control', array(
            'user_last_activity' => GDBBX_LAST_ACTIVTY,
            'user_last_visit' => $visitd,
            'user_visited' => $visitd !== false,
            'topic_first_active' => $topics,
            'topic_last_active' => $latest,
            'topic_last_reply' => $replie == 0 ? 
                bbp_get_topic_last_reply_id($topic_id) : 
                gdbbx_db()->get_topic_next_reply_id($topic_id, $replie),
            'topic_is_unread' => $latest > $cutoff && 
                $visitd === false && 
                $author != $user_id,
            'topic_is_new' => GDBBX_LAST_ACTIVTY > 0 && 
                $topics > GDBBX_LAST_ACTIVTY && 
                $visitd === false && 
                $author != $user_id,
            'topic_has_new_replies' => $visitd !== false && 
                $visitd < $latest
        ), $user_id, $topic_id);

        $this->trackers[$topic_id] = $T;

        return $T;
    }

    public function new_replies_thread() {
        $T = $this->calculate_the_t();

        if ($T['topic_has_new_replies']) {
            $this->thread_reply_id = (int)$T['topic_last_reply'];

            add_action('bbp_theme_after_reply_admin_links', array($this, 'topic_thread_reply'));
        }
    }

    public function topic_thread_reply() {
        if (bbp_get_reply_id() >= $this->thread_reply_id) {
            echo apply_filters('gdbbx_reply_badge_new', 
                        '<span title="'.__("New Reply", "gd-bbpress-toolbox").'" class="gdbbx-badge-new-reply">'.__("new", "gd-bbpress-toolbox").'</span>');
        }
    }

    public function latest_forum_before() {
        $_strong = false;

        $forum_id = bbp_get_forum_id();

        $F = $this->calculate_the_f();

        if ($F['forum_has_new_posts']) {
            if (gdbbx_settings()->get('latest_forum_new_posts_strong_title', 'tools')) {
                $_strong = true;
            }

            if (gdbbx_settings()->get('latest_forum_new_posts_badge', 'tools')) {
                echo apply_filters('gdbbx_forum_badge_new_posts', 
                        '<span title="'.__("Forum has new posts", "gd-bbpress-toolbox").'" class="gdbbx-badge-new-posts">'.__("new posts", "gd-bbpress-toolbox").'</span>', 
                        $forum_id, $F);
            }
        } else if ($F['forum_is_unread']) {
            if (gdbbx_settings()->get('latest_forum_unread_forum_strong_title', 'tools')) {
                $_strong = true;
            }

            if (gdbbx_settings()->get('latest_forum_unread_forum_badge', 'tools')) {
                echo apply_filters('gdbbx_forum_badge_unread', 
                        '<span title="'.__("Unread Forum", "gd-bbpress-toolbox").'" class="gdbbx-badge-unread-forum">'.__("unread", "gd-bbpress-toolbox").'</span>', 
                        $forum_id, $F);
            }
        }

        if ($_strong) {
            add_action('bbp_theme_before_forum_title', array($this, 'title_strong_before'), 10000);
            add_action('bbp_theme_after_forum_title', array($this, 'title_strong_after'), 1);
        }
    }

    public function latest_topic_before() {
        $_strong = false;

        $user_id = bbp_get_current_user_id();
        $topic_id = bbp_get_topic_id();

        $T = $this->calculate_the_t();

        if ($T['topic_is_new']) {
            if (gdbbx_db()->user_replied_to_topic($topic_id, $user_id)) {
                $T['topic_is_new'] = false;
            }
        }

        if ($T['topic_is_new']) {
            if (gdbbx_settings()->get('latest_topic_new_topic_strong_title', 'tools')) {
                $_strong = true;
            }

            if (gdbbx_settings()->get('latest_topic_new_topic_badge', 'tools')) {
                echo apply_filters('gdbbx_topic_badge_new', 
                        '<span title="'.__("New Topic", "gd-bbpress-toolbox").'" class="gdbbx-badge-new-topic">'.__("new", "gd-bbpress-toolbox").'</span>', 
                        $topic_id, $T);
            }
        } else if ($T['topic_is_unread']) {
            if (gdbbx_settings()->get('latest_topic_unread_topic_strong_title', 'tools')) {
                $_strong = true;
            }

            if (gdbbx_settings()->get('latest_topic_unread_topic_badge', 'tools')) {
                echo apply_filters('gdbbx_topic_badge_unread', 
                        '<span title="'.__("Unread Topic", "gd-bbpress-toolbox").'" class="gdbbx-badge-unread-topic">'.__("unread", "gd-bbpress-toolbox").'</span>', 
                        $topic_id, $T);
            }
        }

        if ($T['topic_has_new_replies']) {
            if (gdbbx_settings()->get('latest_topic_new_replies_strong_title', 'tools')) {
                $_strong = true;
            }

            if (gdbbx_settings()->get('latest_topic_new_replies_mark', 'tools')) {
                add_action('bbp_theme_after_topic_title', array($this, 'title_new_replies_mark'));
            }
        }

        if ($_strong) {
            add_action('bbp_theme_before_topic_title', array($this, 'title_strong_before'), 10000);
            add_action('bbp_theme_after_topic_title', array($this, 'title_strong_after'), 1);
        }
    }

    public function title_strong_before() {
        echo '<strong>';

        remove_action('bbp_theme_before_forum_title', array($this, 'title_strong_before'), 10000);
        remove_action('bbp_theme_before_topic_title', array($this, 'title_strong_before'), 10000);
    }

    public function title_strong_after() {
        echo '</strong>';

        remove_action('bbp_theme_after_forum_title', array($this, 'title_strong_after'), 1);
        remove_action('bbp_theme_after_topic_title', array($this, 'title_strong_after'), 1);
    }

    public function title_new_replies_mark() {
        $topic_id = bbp_get_topic_id();
        $url = bbp_get_reply_url($this->trackers[$topic_id]['topic_last_reply']);

        echo apply_filters('gdbbx_topic_badge_new_replies', 
                '<a title="'.__("First new reply", "gd-bbpress-toolbox").'" class="gdbbx-new-topic-replies" href="'.$url.'">'.gdbbx_obj_icons()->new_replies().'</a>',
                $topic_id, $url, $this->trackers[$topic_id]);

        remove_action('bbp_theme_after_topic_title', array($this, 'title_new_replies_mark'));
    }

    public function latest_users_topic() {
        $user_id = bbp_get_current_user_id();
        $topic_id = bbp_get_topic_id();
        $forum_id = bbp_get_forum_id();
        $reply_id = bbp_get_topic_last_reply_id($topic_id);

        if ($user_id != 0 && $topic_id != 0 && $forum_id != 0) {
            gdbbx_db()->track_topic_visit($user_id, $topic_id, $forum_id, $reply_id);
        }
    }

    public function current_session_cookie() {
        $activity = 0;

        if (!isset($_COOKIE[$this->_cookie_session()])) {
            global $userdata;

            $user_id = isset($userdata) ? $userdata->ID : 0;

            if ($user_id > 0) {
                $activity = gdbbx_db()->get_user_last_activity($user_id);
            } else {
                if (isset($_COOKIE[$this->_cookie_tracking()])) {
                    $activity = intval($_COOKIE[$this->_cookie_tracking()]);
                }
            }

            setcookie($this->_cookie_session(), $activity, gdbbx()->session_cookie_expiration(), '/', COOKIE_DOMAIN);
        } else {
            $activity = $_COOKIE[$this->_cookie_session()];
        }

        define('GDBBX_LAST_ACTIVTY', intval($activity));
    }

    public function visit_tracking_cookie() {
        setcookie($this->_cookie_tracking(), $this->timestamp(), gdbbx()->tracking_cookie_expiration(), '/', COOKIE_DOMAIN);
    }

    public function online_tracking_cookie() {
        $save = false;
        $time = $this->timestamp();

        if (!is_user_logged_in() && $this->settings['track_guests']) {
            if (!isset($_COOKIE[$this->_cookie_online()])) {
                $key = wp_rand(1000, 9999).'-'.$time.'-'.wp_rand(1000, 9999);
                $exp = $time + $this->settings['window'];

                setcookie($this->_cookie_online(), $key, $exp, '/', COOKIE_DOMAIN);

                $this->settings['guests'][$key] = $time;

                $save = true;
            }
        }

        $this->track_guest($time, $save);
    }

    public function online_logged_users() {
        $save = false;
        $time = $this->timestamp();

        if (is_user_logged_in() && $this->settings['track_users']) {
            $user = bbp_get_current_user_id();
            $role = bbp_get_user_role($user);

            if (!isset($this->settings['users'][$role][$user])) {
                $this->settings['users'][$role][$user] = $this->timestamp();

                $save = true;
            }
        }

        $this->track_user($time, $save);
    }

    public function track_user($time, $save = false) {
        foreach ($this->settings['users'] as $role => $users) {
            foreach ($users as $user => $stamp) {
                if ($stamp + $this->settings['window'] < $time) {
                    unset($this->settings['users'][$role][$user]);
                    $save = true;
                }
            }
        }

        if ($save) {
            gdbbx()->set('users', $this->settings['users'], 'online', true);
        }

        $this->track_max();
    }

    public function track_guest($time, $save = false) {
        foreach ($this->settings['guests'] as $key => $stamp) {
            if ($stamp + $this->settings['window'] < $time) {
                unset($this->settings['guests'][$key]);
                $save = true;
            }
        }

        if ($save) {
            gdbbx()->set('guests', $this->settings['guests'], 'online', true);
        }

        $this->track_max();
    }

    public function track_max() {
        $guests = count($this->settings['guests']);
        $users = count($this->settings['users']);
        $total = $guests + $users;

        $_prev_guests = intval($this->settings['max_guests_count']);
        $_prev_users = intval($this->settings['max_users_count']);
        $_prev_total = intval($this->settings['max_total_count']);

        $save = false;

        if ($users > $_prev_users) {
            gdbbx()->set('max_users_count', $users, 'online');
            gdbbx()->set('max_users_timestamp', $this->timestamp(), 'online');

            $save = true;
        }

        if ($guests > $_prev_guests) {
            gdbbx()->set('max_guests_count', $guests, 'online');
            gdbbx()->set('max_guests_timestamp', $this->timestamp(), 'online');

            $save = true;
        }

        if ($total > $_prev_total) {
            gdbbx()->set('max_total_count', $total, 'online');
            gdbbx()->set('max_total_timestamp', $this->timestamp(), 'online');

            $save = true;
        }

        if ($save) {
            gdbbx()->save('online');
        }
    }

    public function user_last_active() {
        global $userdata;
        $user_id = isset($userdata) ? $userdata->ID : 0;

        if ($user_id > 0) {
            gdbbx_db()->update_user_last_activity($user_id, $this->timestamp());
        }
    }

    public function user_stats($list, $user_id) {
        if ($this->settings['users_stats']) {
            $online = $this->is_online($user_id);

            $item = apply_filters('gdbbx_user_stats_online_status', 
                    '<span class="bbp-label bbx-status-'.($online ? 'online' : 'offline').'">'.($online ? __("Online", "gd-bbpress-toolbox") : __("Offline", "gd-bbpress-toolbox")).'</span>', $online);

            array_unshift($list, $item);
        }

        return $list;
    }

    public function is_online($user_id = 0) {
        if ($user_id == 0) {
            return true;
        } else {
            foreach ($this->settings['users'] as $users) {
                if (isset($users[$user_id])) {
                    return true;
                }
            }

            return false;
        }
    }

    public function max() {
        return array(
            'total' => array(
                'count' => $this->settings['max_total_count'],
                'timestamp' => $this->settings['max_total_timestamp']
            ),
            'users' => array(
                'count' => $this->settings['max_users_count'],
                'timestamp' => $this->settings['max_users_timestamp']
            ),
            'guests' => array(
                'count' => $this->settings['max_guests_count'],
                'timestamp' => $this->settings['max_guests_timestamp']
            ),
        );
    }

    public function online() {
        $time = $this->timestamp();

        $this->track_user($time);
        $this->track_guest($time);

        $info = array(
            'counts' => array(
                'total' => 0,
                'users' => 0,
                'guests' => 0
            ),
            'roles' => array(
                bbp_get_keymaster_role() => array(),
                bbp_get_moderator_role() => array()
            )
        );

        $info['counts']['guests'] = count($this->settings['guests']);
        $info['counts']['total']+= $info['counts']['guests'];

        foreach ($this->settings['users'] as $role => $users) {
            if (!empty($users)) {
                $info['roles'][$role] = array_keys($users);

                $info['counts']['users']+= count($info['roles'][$role]);
                $info['counts']['total']+= count($info['roles'][$role]);
            }
        }

        return $info;
    }
}

/** @return gdbbxMod_Tracking  */
function gdbbx_module_tracking() {
    return gdbbx_loader()->modules['tracking'];
}
