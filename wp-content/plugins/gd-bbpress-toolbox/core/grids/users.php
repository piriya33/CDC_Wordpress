<?php

if (!defined('ABSPATH')) exit;

d4p_include('grid', 'admin', GDBBX_D4PLIB);

class gdbbx_grid_users extends d4p_grid {
    public $_table_class_name = 'gdbbx-grid-users';

    public $bbp_roles = array();

    public function __construct($args = array()) {
        $this->bbp_roles = gdbbx_get_user_roles();

        parent::__construct(array(
            'singular'=> 'user',
            'plural' => 'users',
            'ajax' => false
        ));
    }

    public function extra_tablenav($which) {
        if ($which == 'top') {
            $roles = array_merge(
                array('' => __("All User Roles", "gd-bbpress-toolbox")),
                $this->bbp_roles
            );

            $_sel_role = isset($_GET['filter-role']) && !empty($_GET['filter-role']) ? $_GET['filter-role'] : '0';

            echo '<div class="alignleft actions">';
            d4p_render_select($roles, array('selected' => $_sel_role, 'name' => 'filter-role'));
            submit_button(__("Filter", "gd-bbpress-toolbox"), 'button', false, false, array('id' => 'gdbbx-users-submit'));
            echo '</div>';
        }
    }

    public function rows_per_page() {
        $user = get_current_user_id();
        $per_page = get_user_meta($user, 'gdbbx_rows_per_page_users', true);

        if (empty($per_page) || $per_page < 1) {
            $per_page = 25;
        }

        return $per_page;
    }

    public function get_columns() {
	return array(
            'ID' => __("ID", "gd-bbpress-toolbox"),
            'avatar' => '',
            'username' => __("Username", "gd-bbpress-toolbox"),
            'email' => __("Email And Name", "gd-bbpress-toolbox"),
            'role' => __("Role", "gd-bbpress-toolbox"),
            'topics' => __("Topics", "gd-bbpress-toolbox"),
            'replies' => __("Replies", "gd-bbpress-toolbox"),
            'sig' => __("Signature", "gd-bbpress-toolbox"),
            'date' => __("Active", "gd-bbpress-toolbox")
	);
    }

    public function get_sortable_columns() {
	$columns = array(
            'ID' => array('ID', false),
            'username' => array('user_login', false),
            'email' => array('user_email', false),
            'topics' => array('usr.topics', false),
            'replies' => array('usr.replies', false)
	);

        return $columns;
    }

    public function column_avatar($item) {
        return get_avatar($item->ID, 40);
    }

    public function column_topics($item) {
        $value = isset($item->data->forums['topic']) ? $item->data->forums['topic'] : 0;

        if ($value > 0) {
            $value = '<a href="'.admin_url("edit.php?post_type=topic&amp;author=$item->ID").'">'.$value.'</a>';
        }

        return $value;
    }

    public function column_replies($item) {
        $value = isset($item->data->forums['reply']) ? $item->data->forums['reply'] : 0;

        if ($value > 0) {
            $value = '<a href="'.admin_url("edit.php?post_type=reply&amp;author=$item->ID").'">'.$value.'</a>';
        }

        return $value;
    }

    public function column_email($item) {
        $render = '<u>'.$item->user_email.'</u><br/>';
        $render.= $item->first_name.' '.$item->last_name;

        return $render;
    }

    public function column_role($item) {
        $roles = array();

        foreach ($item->roles as $role) {
            $_role = isset($this->bbp_roles[$role]) ? translate_user_role($this->bbp_roles[$role]) : '';

            if ($_role != '') {
                $roles[] = $_role;
            }
        }

        return !empty($roles) ? join('<br/>', $roles) : __("None", "gd-bbpress-toolbox");
    }

    public function column_username($item) {
        $actions = array();

        $render = "<strong>".$item->user_login."</strong>";

        if (current_user_can('edit_users')) {
            $edit_link = esc_url(add_query_arg('wp_http_referer', urlencode(wp_unslash($_SERVER['REQUEST_URI'])), get_edit_user_link($item->ID)));
            $render = "<strong><a href=\"$edit_link\">$item->user_login</a></strong>";

            $actions['edit'] = '<a href="'.$edit_link.'">'.__("Edit", "gd-bbpress-toolbox").'</a>';
        }

        return $render.$this->row_actions($actions);
    }

    public function column_sig($item) {
        $sig = $item->signature;

        $render = '';

        if ($sig != '') {
            $sig = convert_smilies($sig);
            $sig = do_shortcode($sig);

            $render = '<div class="bbp-signature">'.$sig.'</div>';
        }

        return $render;
    }

    public function column_date($item) {
        if ($item->{gdbbx_db()->user_meta_key_last_activity()} != '') {
            $time = intval($item->{gdbbx_db()->user_meta_key_last_activity()}) + d4p_gmt_offset() * 3600;

            return date('Y.m.d', $time).'<br/>@ '.date('H:i:s', $time);
        } else if ($item->bbp_last_activity != '') {
            $time = intval($item->bbp_last_activity) + d4p_gmt_offset() * 3600;

            return date('Y.m.d', $time).'<br/>@ '.date('H:i:s', $time);
        } else {
            return '—';
        }
    }

    public function prepare_items() {
        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());

        $per_page = $this->rows_per_page();

        $_sel_role = isset($_GET['filter-role']) && !empty($_GET['filter-role']) ? sanitize_text_field($_GET['filter-role']) : '';
        $_sel_search = isset($_GET['s']) && $_GET['s'] != '' ? sanitize_text_field($_GET['s']) : '';

        $paged = !empty($_GET['paged']) ? esc_sql($_GET['paged']) : '';
        if (empty($paged) || !is_numeric($paged) || $paged <= 0 ){
            $paged = 1;
        }

        $args = array(
            'number' => $per_page,
            'offset' => ($paged - 1) * $per_page,
            'role' => $_sel_role,
            'fields' => 'all_with_meta',
            'toolbox' => 'yes'
        );

        if ($_sel_search != '') {
            $args['search'] = '*'.$_sel_search.'*';
            $args['search_columns'] = array('user_login', 'user_email', 'user_nicename');
        }

        if (isset($_REQUEST['orderby'])) {
            $args['orderby'] = $_REQUEST['orderby'];
        }

        if (isset($_REQUEST['order'])) {
            $args['order'] = $_REQUEST['order'];
        }

        add_action('pre_user_query', array($this, 'users_query'));

        $wp_user_search = new WP_User_Query($args);

        $this->items = $wp_user_search->results;

        $this->set_pagination_args(array(
            'total_items' => $wp_user_search->get_total(),
            'total_pages' => ceil($wp_user_search->get_total() / $per_page),
            'per_page' => $per_page,
        ));

        $this->calculate_counts();
    }

    public function users_query($query) {
        $post_types = array(
            bbp_get_forum_post_type(),
            bbp_get_topic_post_type(),
            bbp_get_reply_post_type()
        );
        
        $query->query_where.= " AND ".gdbbx_db()->wpdb()->users.".ID in (SELECT DISTINCT post_author FROM ".gdbbx_db()->wpdb()->posts." WHERE post_type in ('".join("', '", $post_types)."'))";

        if ($query->query_vars['orderby'] == 'usr.replies') {
            $query->query_from.= " LEFT JOIN (SELECT post_author, count(*) as replies FROM ".gdbbx_db()->wpdb()->posts." WHERE post_type = 'reply' AND post_status IN ('publish', 'pending', 'closed') GROUP BY post_author) usr ON usr.post_author = ".gdbbx_db()->wpdb()->users.".ID";
        } else if ($query->query_vars['orderby'] == 'usr.topics') {
            $query->query_from.= " LEFT JOIN (SELECT post_author, count(*) as topics FROM ".gdbbx_db()->wpdb()->posts." WHERE post_type = 'topic' AND post_status IN ('publish', 'pending', 'closed') GROUP BY post_author) usr ON usr.post_author = ".gdbbx_db()->wpdb()->users.".ID";
        }

        if ($query->query_vars['orderby'] == 'usr.replies' || $query->query_vars['orderby'] == 'usr.topics') {
            $query->query_orderby = 'ORDER BY '.$query->query_vars['orderby'].' '.$query->query_vars['order'];
        }
    }

    private function calculate_counts() {
        $users = array_keys($this->items);

        if (!empty($users)) {
            $sql = "SELECT post_type, post_author, count(*) AS counter FROM ".gdbbx_db()->wpdb()->posts." WHERE post_type IN ('reply', 'topic') AND post_status IN ('pending', 'publish', 'closed') AND post_author IN (".join(', ', $users).") GROUP BY post_type, post_author";
            $raw = gdbbx_db()->get_results($sql);

            foreach ($raw as $row) {
                $this->items[$row->post_author]->data->forums[$row->post_type] = $row->counter;
            }
        }
    }
}
