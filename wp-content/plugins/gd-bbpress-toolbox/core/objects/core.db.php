<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_db extends d4p_wpdb {
    public $db_site = array();

    public $_prefix = 'gdbbx';
    public $_tables = array(
        'actions', 
        'actionmeta',
        'tracker'
    );
    public $_metas = array(
        'action' => 'action_id'
    );

    public function __construct() {
        $this->init();

        add_action('switch_blog', array($this, 'init'));
    }

    /** @global wpdb $wpdb */
    public function init() {
        global $wpdb;

        $plugin = new stdClass();
        $this->db = new stdClass();
        $this->db_site = array();

        foreach ($this->_tables as $name) {
            $prefix = in_array($name, $this->_network_tables) ? $wpdb->base_prefix : $wpdb->prefix;

            $wpdb_name = $this->_prefix.'_'.$name;
            $real_name = $prefix.$wpdb_name;

            $plugin->$name = $real_name;
            $this->db->$name = $real_name;

            $wpdb->$wpdb_name = $real_name;

            if (!in_array($name, $this->_network_tables)) {
                $this->db_site[] = $real_name;
            }
        }

        $wpdb->{$this->_prefix} = $plugin;

        if (!empty($this->_prefix) && !empty($this->_metas)) {
            foreach ($this->_metas as $key => $id) {
                $this->_meta_translate[$this->_prefix.'_'.$key.'_id'] = $id;
            }

            add_filter('sanitize_key', array($this, 'sanitize_meta'));
        }
    }

    public function user_meta_key_last_activity() {
        return $this->prefix().'bbp_last_activity';
    }

    public function get_user_last_activity($user_id) {
        $timestamp = get_user_meta($user_id, $this->user_meta_key_last_activity(), true);

        if ($timestamp == '') {
            $timestamp = get_user_meta($user_id, 'bbp_last_activity', true);
        }

        return intval($timestamp);
    }

    public function update_user_last_activity($user_id, $timestamp = 0) {
        update_user_meta($user_id, $this->user_meta_key_last_activity(), $timestamp);
    }

    public function get_topics_count_since($timestamp) {
        $from = date('Y-m-d H:i:s', $timestamp);

        $sql = "SELECT COUNT(*) FROM ".$this->wpdb()->posts."
                WHERE post_date_gmt > '".$from."' AND post_type = '".bbp_get_topic_post_type()."' 
                AND post_status IN ('publish', 'closed')";

        return $this->get_var($sql);
    }

    public function get_replies_count_since($timestamp) {
        $from = date('Y-m-d H:i:s', $timestamp);

        $sql = "SELECT COUNT(*) FROM ".$this->wpdb()->posts."
                WHERE post_date_gmt > '".$from."' AND post_type = '".bbp_get_reply_post_type()."' 
                AND post_status IN ('publish', 'closed')";

        return $this->get_var($sql);
    }

    public function get_total_users_count() {
        $query = "SELECT COUNT(*) FROM ".$this->users." u INNER JOIN ".$this->usermeta." m ON m.user_id = u.ID 
                  WHERE meta_key = '".$this->prefix()."capabilities' AND meta_value != 'a:0:{}'";

        return absint($this->get_var($query));
    }

    public function track_topic_visit($user_id, $topic_id, $forum_id, $reply_id) {
        $previous = $this->get_topic_last_visit_time($user_id, $topic_id);

        $latest = $this->datetime();

        if ($previous === false) {
            $this->insert($this->tracker, array(
                'user_id' => $user_id,
                'topic_id' => $topic_id,
                'forum_id' => $forum_id,
                'reply_id' => $reply_id,
                'latest' => $latest
            ));
        } else {
            $this->update($this->tracker, array(
                'forum_id' => $forum_id,
                'reply_id' => $reply_id,
                'latest' => $latest
            ), array(
                'user_id' => $user_id,
                'topic_id' => $topic_id
            ));
        }
    }

    public function get_topic_replies_ids($topic_id) {
        $sql = $this->wpdb()->prepare(
            "SELECT ID FROM ".$this->wpdb()->posts." WHERE post_type = %s AND ID IN 
                (".$this->_reply_inner_query($topic_id).") AND post_status IN ('publish', 'closed')", 
                bbp_get_reply_post_type()
            );

        $raw = $this->get_results($sql);

        return wp_list_pluck($raw, 'ID');
    }

    public function get_topic_participants($topic_id) {
        $sql = $this->wpdb()->prepare(
            "SELECT DISTINCT post_author FROM ".$this->wpdb()->posts." WHERE post_type = %s AND ID IN 
                (".$this->_reply_inner_query($topic_id).") AND post_status IN ('publish', 'closed')", 
                bbp_get_reply_post_type()
            );

        $raw = $this->get_results($sql);

        $users = array(absint(bbp_get_topic_author_id($topic_id)));

        foreach ($raw as $user) {
            $users[] = absint($user->post_author);
        }

        return array_unique(array_filter($users));
    }

    public function get_forum_last_post_time($forum_ids, $format = 'G') {
        $query = "SELECT p.post_date_gmt FROM ".$this->wpdb()->posts." p
                  INNER JOIN ".$this->wpdb()->postmeta." m ON m.post_id = p.ID AND m.meta_key = '_bbp_forum_id'
                  WHERE p.post_type IN ('".bbp_get_topic_post_type()."', '".bbp_get_topic_post_type()."') 
                  AND p.post_status IN ('publish', 'closed') 
                  AND CAST(m.meta_value AS UNSIGNED) IN (".join(', ', $forum_ids).")
                  ORDER BY p.post_date_gmt DESC LIMIT 0, 1";
        $date = $this->get_var($query);

        if (is_null($date)) {
            return false;
        }

        return mysql2date($format, $date);
    }

    public function get_forum_last_visit($user_id, $forum_ids, $visit = 'timestamp') {
        $query = $this->wpdb()->prepare(
            "SELECT forum_id, topic_id, reply_id, latest FROM ".$this->tracker."
                WHERE user_id = %s AND forum_id in (".join(', ', $forum_ids).")
                ORDER BY latest DESC LIMIT 0, 1",
                $user_id);

        $latest = $this->get_row($query);

        if (is_null($latest)) {
            return false;
        } else {
            if ($visit == 'timestamp') {
                $latest->latest = mysql2date('G', $latest->latest);
            }
        }

        return $latest;
    }

    public function get_topic_last_visit($user_id, $topic_id, $visit = 'timestamp') {
        $query = $this->wpdb()->prepare(
            "SELECT forum_id, reply_id, latest FROM ".$this->tracker." WHERE user_id = %s AND topic_id = %s",
                $user_id, $topic_id);

        $latest = $this->get_row($query);
        
        if (is_null($latest)) {
            return false;
        } else {
            if ($visit == 'timestamp') {
                $latest->latest = mysql2date('G', $latest->latest);
            }
        }

        return $latest;
    }

    public function get_topic_last_visit_time($user_id, $topic_id, $return = 'timestamp') {
        $latest = $this->get_topic_last_visit($user_id, $topic_id, $return);

        if ($latest !== false) {
            return $latest->latest;
        }

        return false;
    }

    public function get_topic_next_reply_id($topic_id, $reply_id) {
        $query = $this->wpdb()->prepare(
            "SELECT post_id FROM ".$this->wpdb()->postmeta." WHERE meta_key = '_bbp_topic_id' 
            AND meta_value = %s AND post_id > %d ORDER BY post_id ASC LIMIT 0, 1",
                $topic_id, $reply_id
            );

        $next_reply_id = $this->get_var($query);

        return is_null($next_reply_id) ? false : intval($next_reply_id);
    }

    public function get_topic_attachments_count($topic_id) {
        $topic_id = absint($topic_id);

        $count = get_post_meta($topic_id, '_bbp_attachments_count', true);

        if ($count == '') {
            $count = $this->update_topic_attachments_count($topic_id);
        }

        return $count;
    }

    public function update_topic_attachments_count($topic_id) {
        $topic_id = absint($topic_id);
        
        $sql = "SELECT COUNT(*) FROM ".$this->wpdb()->posts." WHERE (post_parent IN (".$this->_reply_inner_query($topic_id).") OR post_parent = ".$topic_id.") AND post_type = 'attachment'";

        $count = absint($this->get_var($sql));

        update_post_meta($topic_id, '_bbp_attachments_count', $count);

        return $count;
    }

    public function get_users_active_in_past($seconds = 86400, $limit = 0) {
        $min = intval($this->timestamp() - $seconds);

        $sql = "SELECT user_id, CAST(meta_value AS UNSIGNED) as last_active
                FROM ".$this->wpdb()->usermeta."
                WHERE meta_key = '".$this->user_meta_key_last_activity()."'
                AND CAST(meta_value AS UNSIGNED) > ".$min."
                ORDER BY last_active DESC";

        if ($limit > 0) {
            $sql.= " LIMIT 0, ".absint($limit);
        }

        $raw = $this->get_results($sql);

        $users = array();

        foreach ($raw as $user) {
            $users[$user->user_id] = $user->last_active;
        }

        return $users;
    }

    public function get_topics_with_user_reply($user_id, $offset = 0, $limit = 4096) {
        $sql = $this->wpdb()->prepare("SELECT DISTINCT CAST(m.meta_value AS UNSIGNED) as topic
                FROM ".$this->wpdb()->posts." p INNER JOIN ".$this->wpdb()->postmeta." m 
                ON m.post_id = p.ID AND m.meta_key = '_bbp_topic_id'
                WHERE p.post_type = 'reply' AND p.post_author = %d
                ORDER BY p.ID DESC LIMIT %d, %d", $user_id, $offset, $limit);
        $raw = $this->get_results($sql);

        return wp_list_pluck($raw, 'topic');
    }

    public function get_forum_visit_time($user_id, $forum_id, $return = 'timestamp') {
        $query = $this->wpdb()->prepare(
            "SELECT latest FROM ".$this->tracker." WHERE user_id = %s AND forum_id = %s",
                $user_id, $forum_id
            );

        $latest = $this->get_var($query);

        if (is_null($latest)) {
            return false;
        } else {
            if ($return == 'timestamp') {
                return mysql2date('G', $latest);
            }
        }

        return $latest;
    }

    public function get_forum_children($forum_id) {
        $query = $this->wpdb()->prepare(
                "SELECT ID FROM ".$this->wpdb()->posts." WHERE post_parent = %d 
                AND post_type = %s AND post_status IN ('publish', 'private')", 
                $forum_id, bbp_get_forum_post_type()
            );
        $raw = $this->get_results($query);

        if (empty($raw)) {
            return array();
        } else {
            return wp_list_pluck($raw, 'ID');
        }
    }

    public function user_replied_to_topic($topic_id = 0, $user_id = 0) {
        if ($topic_id == 0) {
            $topic_id = bbp_get_topic_id();
        }

        if ($user_id == 0) {
            $user_id = bbp_get_current_user_id();
        }

        $sql = $this->wpdb()->prepare(
            "SELECT COUNT(*) FROM ".$this->wpdb()->posts." WHERE post_author = %d AND 
                ID IN (".$this->_reply_inner_query($topic_id).") AND post_type = %s", 
                $user_id, bbp_get_reply_post_type()
            );

        return $this->get_var($sql) > 0;
    }

    public function thanks_add($post_id, $user_id) {
        $this->thanks_remove($post_id, $user_id);

        return $this->insert($this->actions, array('user_id' => $user_id, 'post_id' => $post_id, 'logged' => $this->datetime(), 'action' => 'thanks'));
    }

    public function thanks_remove($post_id, $user_id) {
        return $this->delete($this->actions, array('user_id' => $user_id, 'post_id' => $post_id, 'action' => 'thanks'));
    }

    public function thanks_given($post_id, $user_id) {
        $sql = $this->wpdb()->prepare(
            "SELECT COUNT(*) FROM ".$this->actions." WHERE post_id = %d AND user_id = %d AND action = 'thanks'", 
                $post_id, $user_id
            );

        return $this->get_var($sql) > 0;
    }

    public function thanks_list($post_id, $limit = 10) {
        $sql = $this->wpdb()->prepare(
            "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->actions." WHERE action = 'thanks' AND 
            post_id = %d ORDER BY logged DESC LIMIT 0, %d", 
                $post_id, $limit
            );

        $raw = $this->run($sql);

        return array('total' => intval($this->get_var("SELECT FOUND_ROWS()")), 'count' => count($raw), 'list' => $raw);
    }

    public function count_all_thanks_given($user_id = 0) {
        if ($user_id == 0) {
            $user_id = bbp_get_current_user_id();
        }

        $sql = $this->wpdb()->prepare(
            "SELECT COUNT(*) FROM ".$this->actions." WHERE action = 'thanks' AND user_id = %d", 
                $user_id
            );

        return $this->get_var($sql);
    }

    public function count_all_thanks_received($user_id = 0) {
        if ($user_id == 0) {
            $user_id = bbp_get_current_user_id();
        }

        $sql = $this->wpdb()->prepare(
            "SELECT COUNT(*) FROM ".$this->wpdb()->posts." p INNER JOIN ".$this->actions." a ON 
            a.post_id = p.ID WHERE a.action = 'thanks' AND p.post_author = %d", 
                $user_id
            );

        return $this->get_var($sql);
    }

    public function report_add($post_id, $user_id, $content = '') {
        $this->insert($this->actions, array('user_id' => $user_id, 'post_id' => $post_id, 'logged' => $this->datetime(), 'action' => 'report'));

        $action_id = $this->get_insert_id();
        $type = bbp_is_reply($post_id) ? bbp_get_reply_post_type() : bbp_get_topic_post_type();

        $this->insert($this->actionmeta, array('action_id' => $action_id, 'meta_key' => 'content', 'meta_value' => $content));
        $this->insert($this->actionmeta, array('action_id' => $action_id, 'meta_key' => 'type', 'meta_value' => $type));
        $this->insert($this->actionmeta, array('action_id' => $action_id, 'meta_key' => 'status', 'meta_value' => 'waiting'));
    }

    public function report_closed($post_id, $user_id) {
        $this->insert($this->actions, array('user_id' => $user_id, 'post_id' => $post_id, 'logged' => $this->datetime(), 'action' => 'report-closed'));
    }

    public function reported($post_id) {
        $sql = $this->wpdb()->prepare(
            "SELECT COUNT(*) FROM ".$this->actions." a INNER JOIN ".$this->actionmeta." m ON m.action_id = a.action_id
            WHERE a.post_id = %d AND a.action = 'report' AND m.meta_key = 'status' AND m.meta_value = 'waiting'", 
                $post_id
            );

        return $this->get_var($sql) > 0;
    }

    public function report_given($post_id, $user_id) {
        $sql = $this->wpdb()->prepare(
            "SELECT COUNT(*) FROM ".$this->actions." a INNER JOIN ".$this->actionmeta." m ON m.action_id = a.action_id
            WHERE a.post_id = %d AND a.user_id = %d AND a.action = 'report' AND m.meta_key = 'status' AND m.meta_value = 'waiting'", 
                $post_id, $user_id
            );

        return $this->get_var($sql) > 0;
    }

    public function report_status($report_id, $status) {
        $this->update($this->actionmeta, array('meta_value' => $status), array('action_id' => $report_id, 'meta_key' => 'status'));
    }

    public function close_old_topics($days) {
        $sql = "UPDATE ".$this->wpdb()->posts." SET post_status = '".bbp_get_closed_status_id()."'
                WHERE post_type = '".bbp_get_topic_post_type()."'
                AND post_status = '".bbp_get_public_status_id()."' AND post_date < DATE_SUB(curdate(), interval ".intval($days)." day)";

        return $this->query($sql);
    }

    public function close_inactive_topics($days) {
        $sql = "UPDATE ".$this->wpdb()->posts." p INNER JOIN ".$this->wpdb()->postmeta." m ON m.post_id = p.ID
                SET p.post_status = '".bbp_get_closed_status_id()."'
                WHERE p.post_type = '".bbp_get_topic_post_type()."'
                AND p.post_status = '".bbp_get_public_status_id()."' 
                AND m.meta_key = '_bbp_last_active_time' 
                AND STR_TO_DATE(m.meta_value, '%Y-%m-%d %T') < DATE_SUB(curdate(), interval ".intval($days)." day)";

        return $this->query($sql);
    }

    private function _reply_inner_query($topic_id) {
        return $this->wpdb()->prepare(
            "SELECT post_id FROM ".$this->wpdb()->postmeta."
            WHERE meta_key = '_bbp_topic_id' AND meta_value = %s AND post_id != %d", 
                $topic_id, $topic_id);
    }
}
