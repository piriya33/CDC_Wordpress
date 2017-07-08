<?php

if (!defined('ABSPATH')) exit;

d4p_include('grid', 'admin', GDBBX_D4PLIB);

class gdbbx_grid_reports extends d4p_grid {
    public $_sanitize_orderby_fields = array('a.action_id', 'a.post_id', 'a.logged');
    public $_table_class_name = 'gdbbx-grid-report';

    public function __construct($args = array()) {
        parent::__construct(array(
            'singular'=> 'reports',
            'plural' => 'reportss',
            'ajax' => false
        ));
    }

    private function _self($args, $getback = false) {
        $url = 'admin.php?page=gd-bbpress-toolbox-reported-posts&'.$args;

        if ($getback) {
            $url.= '&gdbbx_handler=getback';
            $url.= '&_wpnonce='.wp_create_nonce('gd-bbpress-toolbox-report');
            $url.= '&_wp_http_referer='.wp_unslash($_SERVER['REQUEST_URI']);
        }

        return self_admin_url($url);
    }

    public function extra_tablenav($which) {
        if ($which == 'top') {
            $reported = array(
                '' => __("For Topics And Replies", "gd-bbpress-toolbox"),
                'topic' => __("For Topics Only", "gd-bbpress-toolbox"),
                'reply' => __("For Replies Only", "gd-bbpress-toolbox")
            );

            $_sel_attached = isset($_GET['filter-type']) && !empty($_GET['filter-type']) ? $_GET['filter-type'] : '';

            echo '<div class="alignleft actions">';
            d4p_render_select($reported, array('selected' => $_sel_attached, 'name' => 'filter-type'));
            submit_button(__("Filter", "gd-bbpress-toolbox"), 'button', false, false, array('id' => 'gdbbx-reports-submit'));
            echo '</div>';
        }
    }

    public function single_row($item) {
        $classes = $this->get_row_classes($item);

        $classes[] = 'gdbbx-report-status-'.$item->meta->status;

        echo '<tr class="'.join(' ', $classes).'">';
        $this->single_row_columns($item);
        echo '</tr>';
    }

    public function rows_per_page() {
        $user = get_current_user_id();
        $per_page = get_user_meta($user, 'gdbbx_rows_per_page_reports', true);

        if (empty($per_page) || $per_page < 1) {
            $per_page = 25;
        }

        return $per_page;
    }

    public function get_columns() {
	return array(
            'id' => __("ID", "gd-bbpress-toolbox"),
            'type' => '',
            'post' => __("Topic / Reply", "gd-bbpress-toolbox"),
            'reporter' => __("Reported by", "gd-bbpress-toolbox"),
            'report' => __("Report", "gd-bbpress-toolbox"),
            'status' => __("Status", "gd-bbpress-toolbox"),
            'date' => __("Reported", "gd-bbpress-toolbox"),
            'forum' => __("Forum", "gd-bbpress-toolbox")
	);
    }

    public function get_sortable_columns() {
	$columns = array(
            'id' => array('a.action_id', false),
            'post' => array('a.post_id', false),
            'date' => array('a.logged', false)
	);

        return $columns;
    }

    public function column_id($item){
        return $item->action_id;
    }

    public function column_date($item){
        return mysql2date('Y.m.d', $item->logged).'<br/>@ '.mysql2date('H:m:s', $item->logged);
    }

    public function column_post($item){
        $post = $item->post_id;

        $title = '';
        $url = '';

        if (bbp_is_reply($post)) {
            $title = bbp_get_reply_title($post);
            $url = bbp_get_reply_url($post);
        } else if (bbp_is_topic($post)) {
            $title = bbp_get_topic_title($post);
            $url = get_permalink($post);
        }

        if ($url == '') {
            return '&minus;';
        } else {
            $actions = array(
                'visit' => sprintf('<a href="%s">%s</a>', $url, __("Visit", "gd-bbpress-toolbox"))
            );

            return $title.$this->row_actions($actions);
        }
    }

    public function column_type($item) {
        return ucfirst($item->meta->type);
    }

    public function column_reporter($item) {
        $user = get_user_by('id', $item->user_id);

        if ($user === false) {
            return __("User not found", "gd-bbpress-toolbox");
        } else {
            $actions = array(
                'profile' => sprintf('<a href="%s">%s</a>', bbp_get_user_profile_url($item->user_id), __("Profile", "gd-bbpress-toolbox"))
            );

            if (current_user_can('edit_users')) {
                $actions['edit'] = sprintf('<a href="%s">%s</a>', get_edit_user_link($item->user_id), __("Edit", "gd-bbpress-toolbox"));
            }

            return $user->display_name.$this->row_actions($actions);
        }
    }

    public function column_report($item) {
        return $item->meta->content;
    }

    public function column_status($item) {
        $actions = array();

        if ($item->meta->status == 'waiting') {
            $actions['close'] = sprintf('<a href="%s">%s</a>', $this->_self('report='.$item->action_id.'&single-action=close-report', true), __("Close", "gd-bbpress-toolbox"));
        }

        return ucfirst($item->meta->status).$this->row_actions($actions);
    }

    public function column_forum($item){
        if ($item->post_type == bbp_get_topic_post_type()) {
            $forum_id = bbp_get_topic_forum_id($item->post_id);
        } else {
            $forum_id = bbp_get_reply_forum_id($item->post_id);
        }

        if ($forum_id == 0) {
            return '&minus;';
        } else {
            $actions = array(
                'visit' => sprintf('<a href="%s">%s</a>', get_permalink($forum_id), __("Visit", "gd-bbpress-toolbox")),
                'topics' => sprintf('<a href="edit.php?post_type=topic&bbp_forum_id=%s">%s</a>', $forum_id, __("Topics", "gd-bbpress-toolbox"))
            );

            return bbp_get_forum_title($forum_id).$this->row_actions($actions);
        }
    }

    public function prepare_items() {
        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());

        $per_page = $this->rows_per_page();

        $_sel_type = isset($_GET['filter-type']) && !empty($_GET['filter-type']) ? "'".sanitize_text_field($_GET['filter-type'])."'" : "'topic', 'reply'";

        $query_where = array("a.action = 'report'");
        $query_reports = "SELECT SQL_CALC_FOUND_ROWS a.*, p.post_date, p.post_author, p.post_type, p.post_title FROM ".gdbbx_db()->actions." a LEFT JOIN ".gdbbx_db()->wpdb()->posts." p ON p.ID = a.post_id AND p.post_type in (".$_sel_type.")";

        if (!empty($query_where)) {
            $query_reports.= ' WHERE '.join(' AND ', $query_where);
        }

        $orderby = !empty($_GET['orderby']) ? $this->sanitize_field('orderby', $_GET['orderby'], 'p.ID') : 'p.ID';
        $order = !empty($_GET['order']) ? $this->sanitize_field('order', $_GET['order'], 'DESC') : 'DESC';

        $query_reports.= " ORDER BY $orderby $order";

        $paged = !empty($_GET['paged']) ? esc_sql($_GET['paged']) : '';
        if (empty($paged) || !is_numeric($paged) || $paged <= 0 ){
            $paged = 1;
        }

        $offset = intval(($paged - 1) * $per_page);
        $query_reports.= " LIMIT $offset, $per_page";

        $this->items = gdbbx_db()->run_and_index($query_reports, 'action_id');

        $total_rows = gdbbx_db()->get_var('SELECT FOUND_ROWS()');

        $this->set_pagination_args(array(
            'total_items' => $total_rows,
            'total_pages' => ceil($total_rows / $per_page),
            'per_page' => $per_page,
        ));

        foreach (array_keys($this->items) as $item) {
            $this->items[$item]->meta = new stdClass();
        }

        $ids = gdbbx_db()->pluck($this->items, 'action_id');

        if (!empty($ids)) {
            $query_meta = "SELECT * FROM ".gdbbx_db()->actionmeta." WHERE action_id in (".join(', ', $ids).")";
            $metas = gdbbx_db()->run($query_meta);

            foreach ($metas as $meta) {
                $this->items[$meta->action_id]->meta->{$meta->meta_key} = $meta->meta_value;
            }
        }

        foreach ($this->items as &$item) {
            if ($item->meta->status == 'waiting' && empty($item->post_type)) {
                $item->meta->status = 'deleted';

                gdbbx_db()->report_status($item->action_id, 'deleted');
            }
        }
    }
}
