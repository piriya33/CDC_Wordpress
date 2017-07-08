<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_NavMenu {
    function __construct() {
        if (gdbbx()->get('navmenu_metabox_extras', 'bbpress')) {
            add_action('admin_head-nav-menus.php', array($this, 'extras_metabox'), 10, 1);
            add_filter('wp_get_nav_menu_items', array($this, 'extras_items_processing'), 10, 3);
        }

        if (gdbbx()->get('navmenu_metabox_views', 'bbpress')) {
            add_action('admin_head-nav-menus.php', array($this, 'views_metabox'), 10, 1);
            add_filter('wp_get_nav_menu_items', array($this, 'views_items_processing'), 10, 3);
        }
    }

    public function extras_metabox($object) {
        add_meta_box('bbx-add-extras', __("bbPress Specific", "gd-bbpress-toolbox"), array($this, 'admin_extras_metabox'), 'nav-menus', 'side', 'default');
    }

    public function admin_extras_metabox() {
        include(GDBBX_PATH.'forms/meta/navmenu.extras.php');
    }

    public function extras_items_processing($items, $menu, $args) {
        foreach ($items as &$item) {
            if ($item->object != 'bbx-extra') {
                continue;
            }

            switch ($item->type) {
                case 'bbx-home':
                    $item->url = bbp_get_forums_url();
                    break;
                case 'bbx-profile':
                    $item->url = bbp_get_user_profile_url(bbp_get_current_user_id());
                    break;
                case 'bbx-topics':
                    $item->url = bbp_get_user_topics_created_url(bbp_get_current_user_id());
                    break;
                case 'bbx-replies':
                    $item->url = bbp_get_user_replies_created_url(bbp_get_current_user_id());
                    break;
                case 'bbx-favorites':
                    $item->url = bbp_get_favorites_permalink(bbp_get_current_user_id());
                    break;
                case 'bbx-subscriptions':
                    $item->url = bbp_get_subscriptions_permalink(bbp_get_current_user_id());
                    break;
                case 'bbx-edit':
                    $item->url = bbp_get_user_profile_edit_url(bbp_get_current_user_id());
                    break;
                case 'bbx-login':
                    $item->url = wp_login_url(d4p_current_url());
                    break;
                case 'bbx-logout':
                    $item->url = wp_logout_url(d4p_current_url());
                    break;
                case 'bbx-register':
                    $item->url = wp_registration_url();
                    break;
            }

            if (d4p_current_url() == $item->url) {
                $item->classes[]= 'current-menu-item active';
                $item->current = true;
            }
        }

        return $items;
    }

    public function views_metabox($object) {
        add_meta_box('bbx-add-views', __("bbPress Topic Views", "gd-bbpress-toolbox"), array($this, 'admin_views_metabox'), 'nav-menus', 'side', 'default');
    }

    public function admin_views_metabox() {
        include(GDBBX_PATH.'forms/meta/navmenu.views.php');
    }

    public function views_items_processing($items, $menu, $args) {
        foreach ($items as &$item) {
            if ($item->object != 'bbx-view') {
                continue;
            }

            $item->url = bbp_get_view_url($item->type);

            if (get_query_var('bbp_view') == $item->type) {
                $item->classes[]= 'current-menu-item  active';
                $item->current = true;
            }
        }

        return $items;
    }
}
