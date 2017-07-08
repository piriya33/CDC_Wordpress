<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Canned {
    public $settings = array();

    public function __construct() {
        $this->settings = gdbbx()->group_get('canned');

        add_action('gdbbx_init', array($this, 'init'));

        add_filter('gdbbx_script_values', array($this, 'script_values'));
        add_action('bbp_theme_before_reply_form_content', array($this, 'form'));
    }

    public function script_values($values) {
        $values['run_canned_replies'] = true;
        $values['auto_close_on_insert'] = $this->settings['auto_close_on_insert'];

        return $values;
    }

    public function form() {
        if (current_user_can('moderate')) {
            include(gdbbx_get_template_part('gdbbx-list-canned-replies.php'));
        }
    }

    public function posttype_labels($singular, $plural) {
        $labels = array(
            'name' => $plural,
            'singular_name' => $singular,
            'menu_name' => $plural
        );

        $labels['add_new'] = __("Add New", "gd-bbpress-toolbox").' '.$singular;
        $labels['edit'] = __("Edit", "gd-bbpress-toolbox").' '.$singular;
        $labels['add_new_item'] = __("Add New", "gd-bbpress-toolbox").' '.$singular;
        $labels['edit_item'] = __("Edit", "gd-bbpress-toolbox").' '.$singular;
        $labels['new_item'] = __("New", "gd-bbpress-toolbox").' '.$singular;
        $labels['view_item'] = __("View", "gd-bbpress-toolbox").' '.$singular;
        $labels['search_items'] = __("Search", "gd-bbpress-toolbox").' '.$plural;
        $labels['not_found'] = __("No", "gd-bbpress-toolbox").' '.$plural.' '.__("Found", "gd-bbpress-toolbox");
        $labels['not_found_in_trash'] = __("No", "gd-bbpress-toolbox").' '.$plural.' '.__("Found In Trash", "gd-bbpress-toolbox");
        $labels['parent_item_colon'] = __("Parent", "gd-bbpress-toolbox").' '.$plural.':';
        $labels['all_items'] = __("All", "gd-bbpress-toolbox").' '.$plural;
        $labels['menu_name'] = $plural;

        return $labels;
    }

    public function taxonomy_labels($singular, $plural) {
        $labels = array(
            'name' => $plural,
            'singular_name' => $singular,
            'menu_name' => $plural
        );

        $labels['parent_item'] = __("Parent", "gd-bbpress-toolbox").' '.$singular;
        $labels['search_items'] = __("Search", "gd-bbpress-toolbox").' '.$plural;
        $labels['popular_items'] = __("Popular", "gd-bbpress-toolbox").' '.$plural;
        $labels['all_items'] = __("All", "gd-bbpress-toolbox").' '.$plural;
        $labels['edit_item'] = __("Edit", "gd-bbpress-toolbox").' '.$singular;
        $labels['view_item'] = __("View", "gd-bbpress-toolbox").' '.$singular;
        $labels['update_item'] = __("Update", "gd-bbpress-toolbox").' '.$singular;
        $labels['add_new_item'] = __("Add New", "gd-bbpress-toolbox").' '.$singular;
        $labels['add_or_remove_items'] = __("Add or remove", "gd-bbpress-toolbox").' '.$plural;
        $labels['choose_from_most_used'] = __("Choose from the most used", "gd-bbpress-toolbox").' '.$plural;
        $labels['parent_item_colon'] = __("Parent", "gd-bbpress-toolbox").' '.$plural.':';
        $labels['new_item_name'] = __("New", "gd-bbpress-toolbox").' '.$plural.' '.__("Name", "gd-bbpress-toolbox");
        $labels['not_found'] = __("No", "gd-bbpress-toolbox").' '.$plural.' '.__("found", "gd-bbpress-toolbox");
        $labels['separate_items_with_commas'] = __("Separate", "gd-bbpress-toolbox").' '.$plural.' '.__("with commas", "gd-bbpress-toolbox");

        return $labels;
    }

    public function init() {
        $this->post_type();

        if ($this->settings['use_taxonomy']) {
            $this->taxonomy();
        }
    }

    public function taxonomy() {
        $reg = array(
            'labels' => $this->taxonomy_labels(
                $this->settings['taxonomy_singular'],
                $this->settings['taxonomy_plural']),
            'hierarchical' => true, 
            'rewrite' => false,
            'query_var' => true,
            'public' => false,
            'show_ui' => true,
            'show_tagcloud' => false,
            'show_admin_column' => true, 
            'capabilities' => array(
                'manage_terms' => 'manage_categories',
                'edit_terms' => 'manage_categories',
                'delete_terms' => 'manage_categories',
                'assign_terms' => 'manage_categories'),
            'show_in_nav_menus' => false
        );

        $data = apply_filters('gdbbx_registration_canned_replies_category', $reg);

        register_taxonomy('bbx_canned_category', array('bbx_canned_reply'), $data);
    }

    public function post_type() {
        $reg = array(
            'labels' => $this->posttype_labels(
                $this->settings['post_type_singular'],
                $this->settings['post_type_plural']),
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'public' => false,
            'rewrite' => false,
            'show_in_menu' => 'gd-bbpress-toolbox-front',
            'show_in_admin_bar' => false,
            'has_archive' => false,
            'query_var' => true,
            'supports' => array('title', 'editor', 'author', 'revisions'),
            'show_ui' => true,
            'can_export' => true,
            'show_in_nav_menus' => false,
            '_edit_link' => 'post.php?post=%d'
        );

        $data = apply_filters('gdbbx_registration_canned_replies_post_type', $reg);

        register_post_type('bbx_canned_reply', $data);
    }

    public function categories() {
        return $this->settings['use_taxonomy'] ? get_terms('bbx_canned_category') : array();
    }

    public function replies($category = array()) {
        $args = array(
            'post_type' => 'bbx_canned_reply',
            'post_status' => 'publish',
            'nopaging' => true
        );

        if ($category === -1) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'bbx_canned_category',
                    'operator' => 'NOT EXISTS'
                )
            );
        } else if (!empty($category)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'bbx_canned_category',
                    'field' => 'term_id',
                    'terms' => (array)$category
                )
            );
        }

        $args = apply_filters('gdbbx_get_canned_replies_query', $args);

        return new WP_Query($args);
    }
}

/** @return gdbbxMod_Canned */
function gdbbx_module_canned() {
    return gdbbx_loader()->modules['canned'];
}
