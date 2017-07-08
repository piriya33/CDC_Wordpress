<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_views {
    public $log_hide = false;
    public $log_user = false;

    public $views = array();
    public $active = false;

    public $new_posts_done = false;
    public $new_posts_ids = array();

    public $last_activity = '';
    public $user_filtered = 0;
    public $current_user = 0;

    private $mapped = array();

    public function __construct() {
        $raw = gdbbx()->prefix_get('view_', 'tools');

        $this->log_hide = gdbbx()->get('views_hide_log_required', 'tools');
        $this->log_user = is_user_logged_in();
        
        foreach ($raw as $key => $value) {
            $parts = explode('_', $key, 2);
            $this->views[$parts[0]][$parts[1]] = $value;

            if (!$this->active && $parts[1] == 'active' && $value) {
                $this->active = true;
            }
        }

        if ($this->active) {
            foreach ($this->views as $key => $data) {
                $this->mapped[$data['slug']] = $key;
            }

            add_action('gdbbx_core', array($this, 'register_views'));

            add_filter('bbp_get_view_query_args', array($this, 'modify_view_args'), 10, 2);
        }
    }

    public function modify_view_args($query, $view) {
        if (!isset($this->mapped[$view])) {
            return $query;
        }

        if ($this->mapped[$view] == 'mostthanked' || $this->mapped[$view] == 'mymostthanked') {
            add_filter('posts_clauses', array($this, 'posts_thanks'));

            if ($this->mapped[$view] == 'mymostthanked') {
                $this->current_user = bbp_get_current_user_id();
            }
        } else if ($this->mapped[$view] == 'newposts') {
            global $userdata;

            $user_id = isset($userdata) ? $userdata->ID : 0;

            if ($user_id > 0) {
                $this->last_activity = defined('GDBBX_LAST_ACTIVTY') ? GDBBX_LAST_ACTIVTY : gdbbx_db()->get_user_last_activity($user_id);
            }

            if ($this->last_activity != 0) {
                add_filter('posts_where', array($this, 'new_posts_where'));

                $this->get_new_posts();
            }
        } else if ($this->mapped[$view] == 'newposts24h') {
            add_filter('posts_where', array($this, 'new_posts_where'));

            $this->last_activity = mktime(date('H') - 1, 0, 0, date('n'), date('j') - 1, date('Y'));
            $this->get_new_posts();
        } else if ($this->mapped[$view] == 'newposts3dy') {
            add_filter('posts_where', array($this, 'new_posts_where'));

            $this->last_activity = mktime(date('H') - 1, 0, 0, date('n'), date('j') - 3, date('Y'));
            $this->get_new_posts();
        } else if ($this->mapped[$view] == 'newposts7dy') {
            add_filter('posts_where', array($this, 'new_posts_where'));

            $this->last_activity = mktime(date('H') - 1, 0, 0, date('n'), date('j') - 7, date('Y'));
            $this->get_new_posts();
        } else if ($this->mapped[$view] == 'newposts1mn') {
            add_filter('posts_where', array($this, 'new_posts_where'));

            $this->last_activity = mktime(date('H') - 1, 0, 0, date('n') - 1, date('j'), date('Y'));
            $this->get_new_posts();
        } else if ($this->mapped[$view] == 'mymostreplies' || $this->mapped[$view] == 'myactive' || $this->mapped[$view] == 'mynoreplies' || $this->mapped[$view] == 'mytopics') {
            add_filter('posts_where', array($this, 'new_posts_where'));

            $this->current_user = bbp_get_current_user_id();
        } else if ($this->mapped[$view] == 'myreply') {
            add_filter('posts_where', array($this, 'new_posts_where'));

            $this->user_filtered = bbp_get_current_user_id();
            $this->get_new_posts();
        }

        return $query;
    }

    public function get_new_posts() {
        if ($this->last_activity != '') {
            $this->new_posts_ids = gdbbx_get_new_topics($this->last_activity);
        }

        if ($this->user_filtered > 0) {
            $this->new_posts_ids = gdbbx_db()->get_topics_with_user_reply($this->user_filtered);
        }
    }

    public function posts_thanks($query) {
        if (bbp_is_single_view()) {
            $query['join'].= " INNER JOIN ".gdbbx_db()->actions." gdbbx_ac ON gdbbx_ac.post_id = ".gdbbx_db()->wpdb()->posts.".ID AND gdbbx_ac.action = 'thanks'";
            $query['orderby'] = "CAST(count(gdbbx_ac.post_id) AS UNSIGNED) DESC";

            if ($this->current_user > 0) {
                $query['where'].= " AND ".gdbbx_db()->wpdb()->posts.".post_author = ".$this->current_user;
            }
        }

        return $query;
    }

    public function new_posts_where($where) {
        if (bbp_is_single_view()) {
            if (!empty($this->new_posts_ids)) {
                $where.= " AND ".gdbbx_db()->wpdb()->posts.".ID in (".join(', ', $this->new_posts_ids).") ";
            } else if ($this->current_user > 0) {
                $where.= " AND ".gdbbx_db()->wpdb()->posts.".post_author = ".$this->current_user;
            } else {
                $where.= " AND 1 = 2 ";
            }
        }

        return $where;
    }

    public function register_views() {
        foreach ($this->views as $view => $args) {
            if ($args['active'] == 1) {
                $fnc = '_view_'.$view;

                if (method_exists($this, $fnc)) {
                    $this->$fnc($args);
                } else {
                    $this->_view_basic($args);
                }
            }
        }
    }

    private function _view_allowed() {
        if (!$this->log_user) {
            return !$this->log_hide;
        } else {
            return true;
        }
    }

    private function _view_basic($args) {
        bbp_register_view(
            $args['slug'],
            __($args['title']), 
            array(), 
            false);
    }

    private function _view_mostreplies($args) {
        bbp_register_view(
            $args['slug'],
            __($args['title']),
            array('meta_key' => '_bbp_reply_count', 
                  'orderby' => 'meta_value_num'), 
            false);
    }

    private function _view_latesttopics($args) {
        bbp_register_view(
            $args['slug'],
            __($args['title']),
            array('orderby' => 'post_date'), 
            false);
    }

    private function _view_topicsfresh($args) {
        bbp_register_view(
            $args['slug'],
            __($args['title']),
            array('orderby' => 'meta_value',
                  'order' => 'DESC',
                  'meta_key' => '_bbp_last_active_time',
                  'post_status' => array(bbp_get_public_status_id(), bbp_get_closed_status_id()),
                  'post_type' => bbp_get_topic_post_type()), 
            false);
    }

    private function _view_myactive($args) {
        if ($this->_view_allowed()) {
            bbp_register_view(
                $args['slug'],
                __($args['title']),
                array('orderby' => 'post_date', 
                      'post_status' => array(bbp_get_public_status_id()),
                      'post_type' =>  bbp_get_topic_post_type()), 
                false);
        }
    }

    private function _view_myreply($args) {
        if ($this->_view_allowed()) {
            bbp_register_view(
                $args['slug'],
                __($args['title']),
                array('orderby' => 'meta_value',
                      'order' => 'DESC',
                      'meta_key' => '_bbp_last_active_time',
                      'post_type' =>  bbp_get_topic_post_type()), 
                false);
        }
    }

    private function _view_mytopics($args) {
        if ($this->_view_allowed()) {
            bbp_register_view(
                $args['slug'],
                __($args['title']),
                array('orderby' => 'post_date', 
                      'post_type' => bbp_get_topic_post_type()), 
                false);
        }
    }

    private function _view_mynoreplies($args) {
        if ($this->_view_allowed()) {
            bbp_register_view(
                $args['slug'],
                __($args['title']),
                array('meta_key' => '_bbp_reply_count',
                      'meta_value' => 1,
                      'meta_compare' => '<',
                      'orderby' => 'post_date',
                      'post_type' =>  bbp_get_topic_post_type()), 
                false);
        }
    }

    private function _view_mymostreplies($args) {
        if ($this->_view_allowed()) {
            bbp_register_view(
                $args['slug'],
                __($args['title']),
                array('meta_key' => '_bbp_reply_count', 
                      'orderby' => 'meta_value_num'), 
                false);
        }
    }

    private function _view_myfavorite($args) {
        if ($this->_view_allowed()) {
            $ids = bbp_get_user_favorites_topic_ids(bbp_get_current_user_id());

            if (!empty($ids)) {
                bbp_register_view(
                    $args['slug'],
                    __($args['title']),
                    array('post__in' => $ids), 
                    false);
            } else {
                $this->_empty_view($args);
            }
        }
    }

    private function _view_mysubscribed($args) {
        if ($this->_view_allowed()) {
            $ids = bbp_get_user_subscribed_topic_ids(bbp_get_current_user_id());

            if (!empty($ids)) {
                bbp_register_view(
                    $args['slug'],
                    __($args['title']),
                    array('post__in' => $ids), 
                    false);
            } else {
                $this->_empty_view($args);
            }
        }
    }

    private function _empty_view($args) {
        bbp_register_view(
            $args['slug'],
            __($args['title']),
            array('meta_key' => '_bbp_fake_key_',
              'meta_value' => '_fake_'), 
            false);
    }
}
