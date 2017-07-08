<?php

if (!defined('ABSPATH')) exit;

class gdbbx_error {
    public $errors = array();

    function __construct() { }

    function add($code, $message, $data) {
        $this->errors[$code][] = array($message, $data);
    }
}

class gdbbx_core_plugin {
    function __construct() {
        add_action('plugins_loaded', array($this, 'core'));
        add_action('after_setup_theme', array($this, 'init'));

        add_action('gdbbx_plugin_settings_loaded', array($this, 'settings_loaded'));
    }

    public function settings_loaded() {
        if (gdbbx()->get('fix_404_headers_error', 'bbpress')) {
            add_action('parse_query', array($this, 'fix_404_issues'), 100000);
            add_action('wp', array($this, 'fix_404_issues_status'), 100000);
        }
    }

    public function fix_404_issues() {
        global $wp_query;

        if ($wp_query->bbp_is_single_user || $wp_query->bbp_is_single_user_profile || $wp_query->bbp_is_view) {
            $wp_query->is_404 = false;
        }
    }

    public function fix_404_issues_status() {
        global $wp_query;

        if ($wp_query->bbp_is_single_user || $wp_query->bbp_is_single_user_profile || $wp_query->bbp_is_view) {
            $wp_query->is_404 = false;

            status_header(200);
            nocache_headers();
        }
    }

    public function core() {
        global $wp_version;

        $version = substr(str_replace('.', '', $wp_version), 0, 2);
        define('GDBBX_WPV', intval($version));

        if (gdbbx_has_bbpress()) {
            add_action('init', array($this, 'init_language'));

            do_action('gdbbx_plugin_core_ready');
        }
    }

    public function init() {
        require_once(GDBBX_PATH.'core/functions/theme.php');
    }

    public function init_language() {
        load_plugin_textdomain('gd-bbpress-toolbox', false, 'gd-bbpress-toolbox/languages');
    }

    public function recommend($panel = 'update') {
        d4p_includes(array(
            array('name' => 'ip', 'directory' => 'classes'), 
            array('name' => 'four', 'directory' => 'classes')
        ), GDBBX_D4PLIB);

        $four = new d4p_core_four('plugin', 'gd-bbpress-toolbox', gdbbx()->info_version, gdbbx()->info_build);
        $four->ad();

        return $four->ad_render($panel);
    }
}
