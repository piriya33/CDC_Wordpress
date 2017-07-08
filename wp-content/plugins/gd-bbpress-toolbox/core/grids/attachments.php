<?php

if (!defined('ABSPATH')) exit;

d4p_include('grid', 'admin', GDBBX_D4PLIB);

class gdbbx_grid_attachments extends d4p_grid {
    public $_sanitize_orderby_fields = array('p.ID', 'p.post_title', 'p.post_author', 'p.post_parent');
    public $_checkbox_field = 'ID';
    public $_table_class_name = 'gdbbx-grid-attachments';

    public function __construct($args = array()) {
        parent::__construct(array(
            'singular'=> 'attachment',
            'plural' => 'attachments',
            'ajax' => false
        ));
    }

    public function extra_tablenav($which) {
        if ($which == 'top') {
            $attached = array(
                '' => __("For Topics And Replies", "gd-bbpress-toolbox"),
                'topic' => __("For Topics Only", "gd-bbpress-toolbox"),
                'reply' => __("For Replies Only", "gd-bbpress-toolbox")
            );

            $_sel_attached = isset($_GET['filter-attached']) && !empty($_GET['filter-attached']) ? $_GET['filter-attached'] : '';

            echo '<div class="alignleft actions">';
            d4p_render_select($attached, array('selected' => $_sel_attached, 'name' => 'filter-attached'));
            submit_button(__("Filter", "gd-bbpress-toolbox"), 'button', false, false, array('id' => 'gdbbx-attchments-submit'));
            echo '</div>';
        }
    }

    public function rows_per_page() {
        $user = get_current_user_id();
        $per_page = get_user_meta($user, 'gdbbx_rows_per_page_attachments', true);

        if (empty($per_page) || $per_page < 1) {
            $per_page = 25;
        }

        return $per_page;
    }

    public function get_columns() {
	return array(
            'id' => __("ID", "gd-bbpress-toolbox"),
            'thumbnail' => '',
            'file' => __("File", "gd-bbpress-toolbox"),
            'author' => __("Uploader", "gd-bbpress-toolbox"),
            'topic' => __("Topic / Reply", "gd-bbpress-toolbox"),
            'forum' => __("Forum", "gd-bbpress-toolbox"),
            'date' => __("Date", "gd-bbpress-toolbox")
	);
    }

    public function get_sortable_columns() {
	$columns = array(
            'id' => array('p.ID', false),
            'file' => array('p.post_title', false),
            'author' => array('p.post_author', false),
            'topic' => array('p.post_parent', false)
	);

        return $columns;
    }

    public function get_bulk_actions() {
        $bulk = array(
            'delete' => __("Delete", "gd-bbpress-toolbox"),
            'unattach' => __("Unattach", "gd-bbpress-toolbox")
        );

        return $bulk;
    }

    public function column_id($item){
        return $item->ID;
    }

    public function column_file($item){
        $actions = array(
            'delete' => sprintf('<a href="admin.php?page=gd-bbpress-toolbox-attachments-list&single-action=%s&attachment=%s&_wpnonce=%s">%s</a>', 'delete', $item->ID, wp_create_nonce('gd-bbpress-toolbox-attachment'), __("Delete", "gd-bbpress-toolbox")),
            'unattach' => sprintf('<a href="admin.php?page=gd-bbpress-toolbox-attachments-list&single-action=%s&attachment=%s&_wpnonce=%s">%s</a>', 'unattach', $item->ID, wp_create_nonce('gd-bbpress-toolbox-attachment'), __("Unattach", "gd-bbpress-toolbox")),
        );

        $type = $this->attachment_type($item);

        $render = !empty($type) ? $type.': ' : '';
        $render.= '<a href="post.php?post='.$item->ID.'&action=edit"><strong>'.$item->post_title.'</strong></a>';

        return $render.$this->row_actions($actions);
    }

    public function column_topic($item){
        $topic_id = $item->post_parent;
        $post = get_post($item->post_parent);

        $title = '';
        if ($post->post_type == 'reply') {
            $topic_id = bbp_get_reply_topic_id($topic_id);
            $title = bbp_get_reply_title($topic_id);
        } else {
            $title = bbp_get_topic_title($topic_id);
        }

        $actions = array(
            'narrow' => sprintf('<a href="admin.php?page=gd-bbpress-toolbox-attachments-list&bbp_topic_id=%s">%s</a>', $topic_id, __("Filter", "gd-bbpress-toolbox")),
            'visit' => sprintf('<a href="%s">%s</a>', get_permalink($topic_id), __("Visit", "gd-bbpress-toolbox")),
            'edit' => sprintf('<a href="post.php?post=%s&action=edit">%s</a>', $item->post_parent, __("Edit", "gd-bbpress-toolbox")),
        );

        return $title.$this->row_actions($actions);
    }

    public function column_forum($item){
        $parent = get_post($item->post_parent);

        if ($parent->post_type == bbp_get_topic_post_type()) {
            $forum_id = bbp_get_topic_forum_id($item->post_parent);
        } else {
            $forum_id = bbp_get_reply_forum_id($item->post_parent);
        }

        $actions = array(
            'visit' => sprintf('<a href="%s">%s</a>', get_permalink($forum_id), __("Visit", "gd-bbpress-toolbox")),
            'edit' => sprintf('<a href="post.php?post=%s&action=edit">%s</a>', $forum_id, __("Edit", "gd-bbpress-toolbox")),
            'topics' => sprintf('<a href="edit.php?post_type=topic&bbp_forum_id=%s">%s</a>', $forum_id, __("Topics", "gd-bbpress-toolbox"))
        );

        return bbp_get_forum_title($forum_id).$this->row_actions($actions);
    }

    public function column_author($item){
        $user = get_user_by('id', $item->post_author);

        if ($user) {
            return '<a href="user-edit.php?user_id='.$item->post_author.'">'.$user->display_name.'</a>';
        } else {
            return '-';
        }
    }

    public function column_thumbnail($item){
        return wp_get_attachment_image($item->ID, array(80, 80), true);
    }

    public function column_date($item){
        return mysql2date('Y.m.d', $item->post_date).'<br/>@ '.mysql2date('H:m:s', $item->post_date);
    }

    private function attachment_type($item) {
        if (preg_match('/^.*?\.(\w+)$/', get_attached_file($item->ID), $matches)) {
            return esc_html(strtoupper($matches[1]));
        } else {
            return strtoupper(str_replace('image/', '', get_post_mime_type()));
        }
    }

    public function prepare_items() {
        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());

        $per_page = $this->rows_per_page();

        $_sel_attached = isset($_GET['filter-attached']) && !empty($_GET['filter-attached']) ? "'".sanitize_text_field($_GET['filter-attached'])."'" : "'topic', 'reply'";
        $_sel_topic = isset($_GET['bbp_topic_id']) && !empty($_GET['bbp_topic_id']) ? intval($_GET['bbp_topic_id']) : '';

        $query_where = array("p.post_type = 'attachment'", "t.post_type in (".$_sel_attached.")");
        $query_attachments = "SELECT SQL_CALC_FOUND_ROWS p.ID, p.post_parent, p.post_date, p.post_author, p.post_title FROM ".gdbbx_db()->wpdb()->posts." p INNER JOIN ".gdbbx_db()->wpdb()->posts." t ON p.post_parent = t.ID";

        if ($_sel_topic != '') {
            $replies = gdbbx_db()->get_topic_replies_ids($_sel_topic);
            $replies[] = $_sel_topic;
            $query_where[] = "p.post_parent in (".join(', ', $replies).")";
        }

        if (isset($_GET['s']) && $_GET['s'] != '') {
            $query_where[] = "(p.`post_title` LIKE '%".$_GET['s']."%')";
        }

        if (!empty($query_where)) {
            $query_attachments.= ' WHERE '.join(' AND ', $query_where);
        }

        $orderby = !empty($_GET['orderby']) ? $this->sanitize_field('orderby', $_GET['orderby'], 'p.ID') : 'p.ID';
        $order = !empty($_GET['order']) ? $this->sanitize_field('order', $_GET['order'], 'DESC') : 'DESC';

        $query_attachments.= " ORDER BY $orderby $order";

        $paged = !empty($_GET['paged']) ? esc_sql($_GET['paged']) : '';
        if (empty($paged) || !is_numeric($paged) || $paged <= 0 ){
            $paged = 1;
        }

        $offset = intval(($paged - 1) * $per_page);
        $query_attachments.= " LIMIT $offset, $per_page";

        $this->items = gdbbx_db()->get_results($query_attachments);

        $total_rows = gdbbx_db()->found_rows();

        $this->set_pagination_args(array(
            'total_items' => $total_rows,
            'total_pages' => ceil($total_rows / $per_page),
            'per_page' => $per_page,
        ));
    }
}
