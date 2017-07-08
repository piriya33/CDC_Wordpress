<?php

if (!defined('ABSPATH')) exit;

class gdbbx_admin_core {
    public $plugin = 'gd-bbpress-toolbox';

    public $debug;

    public $page = false;
    public $panel = false;
    public $free = array();

    public $menu_items;

    function __construct() {
        add_action('gdbbx_plugin_core_ready', array($this, 'core'));

        if (is_multisite()) {
            add_filter('wpmu_drop_tables', array($this, 'wpmu_drop_tables'));
        }
    }

    public function wpmu_drop_tables($drop_tables) {
        return array_merge($drop_tables, gdbbx_db()->db_site);
    }

    private function file($type, $name, $d4p = false) {
        $get = GDBBX_URL;

        if ($d4p) {
            $get.= 'd4plib/resources/';
        }

        if ($name == 'font') {
            $get.= 'font/styles.css';
        } else {
            $get.= $type.'/'.$name;

            if (!$this->debug && $type != 'font') {
                $get.= '.min';
            }

            $get.= '.'.$type;
        }

        return $get;
    }

    public function core() {
        $this->debug = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG;

        if (gdbbx_has_bbpress()) {
            $this->init();

            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'admin_menu'), 9);
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
            add_filter('set-screen-option', array($this, 'screen_options_grid_rows_save'), 10, 3);
        }

        if (gdbbx()->is_install()) {
            add_action('admin_notices', array($this, 'install_notice'));
        }

        if (gdbbx()->is_update()) {
            add_action('admin_notices', array($this, 'update_notice'));
        }

        $this->free = gdbbx()->has_free_plugins();

        if (!empty($this->free)) {
            add_action('admin_notices', array($this, 'free_plugins_notice'));
        }
    }

    public function current_url($with_panel = true) {
        $page = 'admin.php?page='.$this->plugin.'-';

        $page.= $this->page;

        if ($with_panel && $this->panel !== false && $this->panel != '') {
            $page.= '&panel='.$this->panel;
        }

        return self_admin_url($page);
    }

    public function free_plugins_notice() {
        if (!empty($this->free)) {
            echo '<div class="error"><p>';
            echo sprintf(__("GD bbPress Toolbox Pro detected that following plugins are still active: %s. They need to be disabled before you can use GD bbPress Toolbox.", "gd-bbpress-toolbox"), 
                '<strong>'.join('</strong>, <strong>', $this->free).'</strong>');
            echo '<br>'.__("You can", "gd-bbpress-toolbox").' <a href="plugins.php">'.__("open plugins page", "gd-bbpress-toolbox").'</a> '.__("to disable them manually", "gd-bbpress-toolbox").' '.__("or", "gd-bbpress-toolbox").' <a href="admin.php?page=gd-bbpress-toolbox-front&action=gdbbx-disable-free">'.__("click here", "gd-bbpress-toolbox").'</a> '.__("to disabled them automatically", "gd-bbpress-toolbox").'.';
            echo '</p></div>';
        }
    }

    public function update_notice() {
        if (current_user_can('install_plugins') && $this->page === false) {
            echo '<div class="updated"><p>';
            echo __("GD bbPress Toolbox Pro is updated, and you need to review the update process.", "gd-bbpress-toolbox");
            echo ' <a href="admin.php?page=gd-bbpress-toolbox-front">'.__("Click Here", "gd-bbpress-toolbox").'</a>.';
            echo '</p></div>';
        }
    }

    public function install_notice() {
        if (current_user_can('install_plugins') && $this->page === false) {
            echo '<div class="updated"><p>';
            echo __("GD bbPress Toolbox Pro is activated and it needs to finish installation.", "gd-bbpress-toolbox");
            echo ' <a href="admin.php?page=gd-bbpress-toolbox-front">'.__("Click Here", "gd-bbpress-toolbox").'</a>.';
            echo '</p></div>';
        }
    }

    public function screen_options_grid_rows_save($status, $option, $value) {
        if (in_array($option, array('gdbbx_rows_per_page_users', 'gdbbx_rows_per_page_attachments', 'gdbbx_rows_per_page_errors', 'gdbbx_rows_per_page_reports'))) {
            return absint($value);
        }

        return $status;
    }

    public function screen_options_grid_rows_reports() {
        $args = array(
            'label' => __("Rows", "gd-bbpress-toolbox"),
            'default' => 25,
            'option' => 'gdbbx_rows_per_page_reports'
        );

        add_screen_option('per_page', $args);
    }

    public function screen_options_grid_rows_users() {
        $args = array(
            'label' => __("Rows", "gd-bbpress-toolbox"),
            'default' => 25,
            'option' => 'gdbbx_rows_per_page_users'
        );

        add_screen_option('per_page', $args);
    }

    public function screen_options_grid_rows_attchments() {
        $args = array(
            'label' => __("Rows", "gd-bbpress-toolbox"),
            'default' => 25,
            'option' => 'gdbbx_rows_per_page_attachments'
        );

        add_screen_option('per_page', $args);
    }

    public function screen_options_grid_rows_errors() {
        $args = array(
            'label' => __("Rows", "gd-bbpress-toolbox"),
            'default' => 25,
            'option' => 'gdbbx_rows_per_page_errors'
        );

        add_screen_option('per_page', $args);
    }

    public function init() {
        $this->menu_items = apply_filters('gdbbx_admin_menu_items', array(
            'front' => array('title' => __("Overview", "gd-bbpress-toolbox"), 'icon' => 'home', 'cap' => 'gdbbx_moderation'),
            'about' => array('title' => __("About", "gd-bbpress-toolbox"), 'icon' => 'info-circle'),
            'modules' => array('title' => __("Modules", "gd-bbpress-toolbox"), 'icon' => 'th-large'),
            'views' => array('title' => __("Views", "gd-bbpress-toolbox"), 'icon' => 'files-o'),
            'bbcodes' => array('title' => __("BBCodes", "gd-bbpress-toolbox"), 'icon' => 'pencil-square'),
            'attachments' => array('title' => __("Attachments", "gd-bbpress-toolbox"), 'icon' => 'paperclip'),
            'settings' => array('title' => __("Settings", "gd-bbpress-toolbox"), 'icon' => 'cogs'),
            'users' => array('title' => __("Users", "gd-bbpress-toolbox"), 'icon' => 'users', 'cap' => 'gdbbx_moderation_users'),
            'reported-posts' => array('title' => __("Reported Posts", "gd-bbpress-toolbox"), 'icon' => 'exclamation-triangle', 'cap' => 'gdbbx_moderation_report'),
            'attachments-list' => array('title' => __("Attachments List", "gd-bbpress-toolbox"), 'icon' => 'file-text-o', 'cap' => 'gdbbx_moderation_attachments'),
            'errors' => array('title' => __("Errors Log", "gd-bbpress-toolbox"), 'icon' => 'bug', 'cap' => 'gdbbx_moderation_attachments'),
            'tools' => array('title' => __("Tools", "gd-bbpress-toolbox"), 'icon' => 'wrench')
        ));
    }

    public function action_delete_errors($ids) {
        foreach ($ids as $meta_id) {
            delete_metadata_by_mid('post', $meta_id);
        }
    }

    public function action_delete_attachments($ids) {
        global $user_ID;

        foreach ($ids as $att_id) {
            $attachment = get_post($att_id);
            $parent = $attachment->post_parent;

            $file = get_attached_file($att_id);
            $file = pathinfo($file, PATHINFO_BASENAME);

            wp_delete_attachment($att_id);

            add_post_meta($parent, '_bbp_attachment_log', array(
                'code' => 'delete_attachment', 'user' => $user_ID, 'file' => $file)
            );
        }
    }

    public function action_unattach_attachments($ids) {
        global $user_ID;

        foreach ($ids as $att_id) {
            $attachment = get_post($att_id);
            $parent = $attachment->post_parent;

            $file = get_attached_file($att_id);
            $file = pathinfo($file, PATHINFO_BASENAME);

            gdbbx_db()->update(gdbbx_db()->wpdb()->posts, array('post_parent' => 0), array('ID' => $att_id));

            add_post_meta($parent, '_bbp_attachment_log', array(
                'code' => 'detach_attachment', 'user' => $user_ID, 'file' => $file, 'attachment_id' => $att_id)
            );
        }
    }

    public function admin_init() {
        if (isset($_GET['panel']) && $_GET['panel'] != '') {
            $this->panel = trim(sanitize_key($_GET['panel']));
        }

        global $submenu;

        if (gdbbx()->get('active', 'canned')) {
            if (isset($submenu['gd-bbpress-toolbox-front'])) {
                $canned = $submenu['gd-bbpress-toolbox-front'][12];
                $canned[0] = gdbbx()->get('post_type_plural', 'canned');
                unset($submenu['gd-bbpress-toolbox-front'][12]);

                array_splice($submenu['gd-bbpress-toolbox-front'], 7, 0, array($canned));
            }
        }

        if (!isset($_GET['page'])) {
            return;
        }

        $_page = trim(sanitize_key($_GET['page']));

        if ($_page == 'gd-bbpress-toolbox-tools') {
            if (isset($_GET['action']) && $_GET['action'] == 'export') {
                check_ajax_referer('dev4press-plugin-export');

                if (!d4p_is_current_user_admin()) {
                    wp_die(__("Only administrators can use export features.", "gd-bbpress-toolbox"));
                }

                $export_date = date('Y-m-d-H-m-s');

                header('Content-type: application/force-download');
                header('Content-Disposition: attachment; filename="gd_bbpress_toolbox_settings_'.$export_date.'.gdbbx"');

                die(gdbbx()->serialized_export());
            }
        }

        if ($_page == 'gd-bbpress-toolbox-front') {
            if (isset($_GET['action']) && $_GET['action'] == 'gdbbx-disable-free') {
                deactivate_plugins(array(
                    'gd-bbpress-attachments/gd-bbpress-attachments.php',
                    'gd-bbpress-tools/gd-bbpress-tools.php',
                    'gd-bbpress-widgets/gd-bbpress-widgets.php'
                ));

                wp_redirect('admin.php?page=gd-bbpress-toolbox-front&message=free-disabled');
                exit;
            }

            if (isset($_GET['action']) && $_GET['action'] == 'dismiss-topic-prefix') {
                gdbbx_settings()->set('notice_gdtox_hide', true, 'core', true);

                wp_redirect('admin.php?page=gd-bbpress-toolbox-front');
                exit;
            }

            if (isset($_GET['action']) && $_GET['action'] == 'dismiss-topic-polls') {
                gdbbx_settings()->set('notice_gdpol_hide', true, 'core', true);

                wp_redirect('admin.php?page=gd-bbpress-toolbox-front');
                exit;
            }
        }

        if ($_page == 'gd-bbpress-toolbox-reported-posts') {
            if (isset($_GET['single-action'])) {
                $nonce = isset($_GET['_wpnonce']) ? $_GET['_wpnonce'] : '';

                if (wp_verify_nonce($nonce, 'gd-bbpress-toolbox-report') !== false) {
                    $user = get_current_user_id();
                    $action = $_GET['single-action'];
                    $id = isset($_GET['report']) ? absint($_GET['report']) : 0;

                    if ($action == 'close-report' && $id > 0) {
                        gdbbx_db()->report_status($id, 'closed');
                        gdbbx_db()->report_closed($id, $user);

                        wp_redirect('admin.php?page=gd-bbpress-toolbox-reported-posts');
                        exit;
                    }
                }
            }
        }

        if ($_page == 'gd-bbpress-toolbox-attachments') {
            if (isset($_GET['single-action'])) {
                $nonce = isset($_GET['_wpnonce']) ? $_GET['_wpnonce'] : '';

                if (wp_verify_nonce($nonce, 'gd-bbpress-toolbox-attachment') !== false) {
                    $action = $_GET['single-action'];
                    $id = isset($_GET['attachment']) ? array($_GET['attachment']) : array();

                    if ($action == 'delete') {
                        $this->action_delete_attachments($id);
                    } else if ($action == 'unattach') {
                        $this->action_unattach_attachments($id);
                    }

                    wp_redirect('admin.php?page=gd-bbpress-toolbox-attachments&message=attachment-'.$action);
                    exit;
                }
            }

            if (isset($_GET['action']) || isset($_GET['action2'])) {
                check_admin_referer('bulk-attachments');

                $action = isset($_GET['action']) && $_GET['action'] != '' && $_GET['action'] != '-1' ? $_GET['action'] : '';

                if ($action == '') {
                    $action = isset($_GET['action2']) && $_GET['action2'] != '' && $_GET['action2'] != '-1' ? $_GET['action2'] : '';
                }

                if ($action != '') {
                    $ids = isset($_GET['attachment']) ? (array)$_GET['attachment'] : array();

                    if (!empty($ids)) {
                        if ($action == 'delete') {
                            $this->action_delete_attachments($ids);
                        } else if ($action == 'unattach') {
                            $this->action_unattach_attachments($ids);
                        }
                    }

                    wp_redirect('admin.php?page=gd-bbpress-toolbox-attachments&message=attachments-'.$action);
                    exit;
                }
            }
        }

        if ($_page == 'gd-bbpress-toolbox-errors') {
            if (isset($_GET['single-action'])) {
                $nonce = isset($_GET['_wpnonce']) ? $_GET['_wpnonce'] : '';

                if (wp_verify_nonce($nonce, 'gd-bbpress-toolbox-error') !== false) {
                    $action = $_GET['single-action'];
                    $id = isset($_GET['error']) ? array($_GET['error']) : array();

                    if ($action == 'delete') {
                        $this->action_delete_errors($id);
                    }

                    wp_redirect('admin.php?page=gd-bbpress-toolbox-errors&message=error-deleted');
                    exit;
                }
            }

            if (isset($_GET['action']) || isset($_GET['action2'])) {
                check_admin_referer('bulk-errors');

                $action = isset($_GET['action']) && $_GET['action'] != '' && $_GET['action'] != '-1' ? $_GET['action'] : '';

                if ($action == '') {
                    $action = isset($_GET['action2']) && $_GET['action2'] != '' && $_GET['action2'] != '-1' ? $_GET['action2'] : '';
                }

                if ($action != '') {
                    $ids = isset($_GET['error']) ? (array)$_GET['error'] : array();

                    if (!empty($ids)) {
                        if ($action == 'delete') {
                            $this->action_delete_errors($ids);
                        }
                    }

                    wp_redirect('admin.php?page=gd-bbpress-toolbox-errors&message=errors-deleted');
                    exit;
                }
            }
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-bbpress-toolbox-tools') {
            check_admin_referer('gd-bbpress-toolbox-tools-options');

            $post = $_POST['gdbbxtools'];
            $action = $post['panel'];

            $url = 'admin.php?page=gd-bbpress-toolbox-tools&panel='.$action;

            $message = 'nothing';
            if ($action == 'remove') {
                if (isset($post['remove']['settings']) && $post['remove']['settings'] == 'on') {
                    gdbbx()->remove_plugin_settings();

                    $message = 'removed';
                }

                if (isset($post['remove']['forums']) && $post['remove']['forums'] == 'on') {
                    gdbbx()->remove_forums_settings();

                    $message = 'removed';
                }

                if (isset($post['remove']['tracking']) && $post['remove']['tracking'] == 'on') {
                    gdbbx()->remove_tracking_settings();

                    $message = 'removed';
                }

                if (isset($post['remove']['signature']) && $post['remove']['signature'] == 'on') {
                    gdbbx()->remove_signature_settings();

                    $message = 'removed';
                }
            } else if ($action == 'wp44_update') {
                require_once(GDBBX_PATH.'core/admin/update.php');

                $count = gdbbx_shortcodes_wp44_update();

                gdbbx_settings()->set('wp44_update', true, 'core', true);

                $url = 'admin.php?page=gd-bbpress-toolbox-tools';
                $message = 'wp44update&count='.$count;
            } else if ($action == 'close') {
                $topics_closed = 0;

                if (isset($post['close']['inactive']) && $post['close']['inactive'] == 'on') {
                    $days = intval($post['close']['inactivity']);

                    if ($days > 0) {
                        $topics_closed+= gdbbx_db()->close_inactive_topics($days);
                    }
                }

                if (isset($post['close']['old']) && $post['close']['old'] == 'on') {
                    $days = intval($post['close']['age']);

                    if ($days > 0) {
                        $topics_closed+= gdbbx_db()->close_old_topics($days);
                    }
                }

                if ($topics_closed > 0) {
                    $message = 'closed&topics='.$topics_closed;
                }
            } else if ($action == 'import') {
                if (is_uploaded_file($_FILES['import_file']['tmp_name'])) {
                    $data = file_get_contents($_FILES['import_file']['tmp_name']);
                    $data = maybe_unserialize($data);

                    if (is_object($data)) {
                        gdbbx()->import_from_object($data);

                        $message = 'imported';
                    }
                }
            }

            wp_redirect($url.'&message='.$message);
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-bbpress-toolbox-settings') {
            check_admin_referer('gd-bbpress-toolbox-settings-options');

            require_once(GDBBX_D4PLIB.'admin/d4p.functions.php');
            require_once(GDBBX_D4PLIB.'admin/d4p.settings.php');

            include(GDBBX_PATH.'core/admin/internal.php');

            $options = new gdbbx_admin_settings();
            $settings = $options->settings($this->panel);

            $processor = new d4pSettingsProcess($settings);
            $processor->base = 'gdbbxvalue';

            $data = $processor->process();

            foreach ($data as $group => $values) {
                foreach ($values as $name => $value) {
                    gdbbx()->set($name, $value, $group);
                }

                gdbbx()->save($group);
            }

            if ($this->page == 'views') {
                wp_flush_rewrite_rules();
            }

            $url = 'admin.php?page='.$_page.'&panel='.$this->panel;
            wp_redirect($url.'&message=saved');
            exit;
        }
    }

    public function admin_menu() {
        $parent = 'gd-bbpress-toolbox-front';

        $caps = gdbbx()->get('roles_gdbbx_moderation', 'bbpress');

        $cap = $caps ? 'gdbbx_moderation' : GDBBX_CAP;

        $this->page_ids[] = add_menu_page(
                        'GD bbPress Toolbox Pro', 
                        'bbPress Toolbox', 
                        $cap, 
                        $parent, 
                        array($this, 'panel_general'), 
                        gdbbx_loader()->svg_icon);

        foreach($this->menu_items as $item => $data) {
            $cap = GDBBX_CAP;

            if ($caps && isset($data['cap'])) {
                $cap = $data['cap'];
            }

            $this->page_ids[] = add_submenu_page($parent, 
                            'GD bbPress Toolbox Pro: '.$data['title'], 
                            $data['title'], 
                            $cap, 
                            'gd-bbpress-toolbox-'.$item, 
                            array($this, 'panel_general'));
        }

        $this->admin_load_hooks();
    }

    public function enqueue_scripts($hook) {
        $load_admin_data = false;

        if ($this->page !== false) {
            d4p_admin_enqueue_defaults();

            wp_enqueue_style('fontawesome', gdbbx_loader()->fontawesome_url(), array(), gdbbx_loader()->fontawesome_version);

            wp_enqueue_style('d4plib-font', $this->file('css', 'font', true), array(), D4P_VERSION.'.'.D4P_BUILD);
            wp_enqueue_style('d4plib-shared', $this->file('css', 'shared', true), array(), D4P_VERSION.'.'.D4P_BUILD);
            wp_enqueue_style('d4plib-admin', $this->file('css', 'admin', true), array('d4plib-shared'), D4P_VERSION.'.'.D4P_BUILD);

            wp_enqueue_script('d4pjs-areyousure', GDBBX_URL.'d4pjs/are-you-sure/jquery.are-you-sure.min.js', array('jquery'), D4P_VERSION.'.'.D4P_BUILD, true);
            wp_enqueue_script('d4plib-shared', $this->file('js', 'shared', true), array('jquery', 'wp-color-picker'), D4P_VERSION.'.'.D4P_BUILD, true);
            wp_enqueue_script('d4plib-admin', $this->file('js', 'admin', true), array('d4plib-shared'), D4P_VERSION.'.'.D4P_BUILD, true);

            wp_enqueue_style('gdbbx-plugin', $this->file('css', 'admin-core'), array('d4plib-admin'), gdbbx()->file_version());
            wp_enqueue_script('gdbbx-plugin', $this->file('js', 'admin-core'), array('d4plib-admin', 'd4pjs-areyousure'), gdbbx()->file_version(), true);

            $load_admin_data = true;
        }

        if ($hook == 'post.php' || $hook == 'post-new.php') {
            $post_type = $this->get_post_type();

            if ($post_type !== false) {
                wp_enqueue_style('d4plib-shared', $this->file('css', 'shared', true), array(), D4P_VERSION.'.'.D4P_BUILD);
                wp_enqueue_style('d4plib-metabox', $this->file('css', 'meta', true), array('d4plib-shared'), D4P_VERSION.'.'.D4P_BUILD);

                wp_enqueue_script('d4plib-shared', $this->file('js', 'shared', true), array('jquery', 'wp-color-picker'), D4P_VERSION.'.'.D4P_BUILD, true);
                wp_enqueue_script('d4plib-metabox', $this->file('js', 'meta', true), array('d4plib-shared'), D4P_VERSION.'.'.D4P_BUILD, true);

                $load_admin_data = true;
            }
        }

        if ($hook == 'index.php') {
            wp_enqueue_style('gdbbx-dashboard', $this->file('css', 'admin-dashboard'), array(), D4P_VERSION.'.'.D4P_BUILD);
        }

        if ($hook == 'widgets.php') {
            wp_enqueue_script('jquery-ui-sortable');

            wp_enqueue_style('d4plib-widgets', $this->file('css', 'widgets', true), array(), D4P_VERSION.'.'.D4P_BUILD);
            wp_enqueue_script('d4plib-widgets', $this->file('js', 'widgets', true), array('jquery'), D4P_VERSION.'.'.D4P_BUILD, true);

            wp_enqueue_script('gdbbx-widgets', $this->file('js', 'admin-widgets'), array('d4plib-widgets', 'jquery-ui-sortable'), gdbbx()->file_version(), true);
        }

        if ($load_admin_data) {
            wp_localize_script('d4plib-shared', 'd4plib_admin_data', array(
                'string_media_image_remove' => __("Remove", "gd-bbpress-toolbox"),
                'string_media_image_preview' => __("Preview", "gd-bbpress-toolbox"),
                'string_media_image_title' => __("Select Image", "gd-bbpress-toolbox"),
                'string_media_image_button' => __("Use Selected Image", "gd-bbpress-toolbox"),
                'string_are_you_sure' => __("Are you sure you want to do this?", "gd-bbpress-toolbox"),
                'string_image_not_selected' => __("Image not selected.", "gd-bbpress-toolbox")
            ));
        }
    }

    public function get_post_type() {
        if (isset($_GET['post_type'])) {
            $post_type = $_GET['post_type'];
        } else {
            global $post;

            if ($post) {
                $post_type = $post->post_type;
            }
        }

        if (in_array($post_type, array(
            bbp_get_forum_post_type(),
            bbp_get_topic_post_type(),
            bbp_get_reply_post_type()
        ))) {
            return $post_type;
        } else {
            return false;
        }
    }

    public function admin_load_hooks() {
        foreach ($this->page_ids as $id) {
            add_action('load-'.$id, array($this, 'load_admin_page'));
        }

        add_action('load-bbpress-toolbox_page_gd-bbpress-toolbox-users', array($this, 'screen_options_grid_rows_users'));
        add_action('load-bbpress-toolbox_page_gd-bbpress-toolbox-reported-posts', array($this, 'screen_options_grid_rows_reports'));
        add_action('load-bbpress-toolbox_page_gd-bbpress-toolbox-attachments-list', array($this, 'screen_options_grid_rows_attchments'));
        add_action('load-bbpress-toolbox_page_gd-bbpress-toolbox-errors', array($this, 'screen_options_grid_rows_errors'));
    }

    public function help_tab_sidebar() {
        $screen = get_current_screen();

        $screen->set_help_sidebar(
            '<p><strong>GD bbPress Toolbox Pro</strong></p>'.
            '<p><a target="_blank" href="https://plugins.dev4press.com/'.$this->plugin.'/">'.__("Home Page", "gd-bbpress-toolbox").'</a><br/>'.
            '<a target="_blank" href="https://support.dev4press.com/kb/product/'.$this->plugin.'/">'.__("Knowledge Base", "gd-bbpress-toolbox").'</a><br/>'.
            '<a target="_blank" href="https://support.dev4press.com/forums/forum/plugins/'.$this->plugin.'/">'.__("Support Forum", "gd-bbpress-toolbox").'</a></p>'
        );
    }

    public function help_tab_getting_help() {
        $screen = get_current_screen();

        $screen->add_help_tab(
            array(
                'id' => 'gdbbx-help-info',
                'title' => __("Getting Help", "gd-bbpress-toolbox"),
                'content' => '<p>'.__("To get help with this plugin, you can start with Knowledge Base list of frequently asked questions and articles. If you have any questions, or you want to report a bug, or you have a suggestion, you can use support forum. All important links for this are on the right side of this help dialog.", "gd-bbpress-toolbox").'</p>'
            )
        );
    }

    public function load_admin_page() {
        $this->help_tab_sidebar();

        $screen = get_current_screen();
        $id = $screen->id;

        if ($id == 'toplevel_page_gd-bbpress-toolbox-front') {
            $this->page = 'front';
        } else if (substr($id, 0, 40) == 'bbpress-toolbox_page_gd-bbpress-toolbox-') {
            $this->page = substr($id, 40);
        }

        $this->help_tab_getting_help();
    }

    public function install_or_update() {
        $install = gdbbx()->is_install();
        $update = gdbbx()->is_update();

        if ($install) {
            include(GDBBX_PATH.'forms/install.php');
        } else if ($update) {
            include(GDBBX_PATH.'forms/update.php');
        }

        return $install || $update;
    }

    public function panel_general() {
        if (!$this->install_or_update()) {
            $_current_page = $this->page;

            $path = apply_filters('gdbbx_admin_menu_panel_'.$_current_page, GDBBX_PATH.'forms/'.$_current_page.'.php');

            include($path);
        }
    }
}

global $_gdbbx_core_admin;
$_gdbbx_core_admin = new gdbbx_admin_core();

function gdbbx_admin() {
    global $_gdbbx_core_admin;
    return $_gdbbx_core_admin;
}
