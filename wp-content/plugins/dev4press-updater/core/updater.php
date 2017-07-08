<?php

if (!defined('ABSPATH')) exit;

class d4pupd_core_updater {
    public $update = false;

    public $debug;
    public $apikey;
    public $status;

    public $statuses = array(
        'stable',
        'beta',
        'alpha',
        'nightly'
    );

    public $transcode = array(
        'gd-rating-system-builder' => 'code-builder-addon',
        'gd-rating-system-multi' => 'multi-ratings-addon',
        'gd-rating-system-user-reviews' => 'user-reviews-addon',
        'gd-rating-system-comments-form' => 'comments-form-addon',
        'gd-rating-system-data-export' => 'data-export-addon',
        'gd-rating-system-emojione' => 'emojione-pack-addon',
        'gd-rating-system-halloween' => 'halloween-pack-addon',
        'gd-rating-system-christmas' => 'christmas-pack-addon',
        'gd-press-tools-storage-dropbox' => 'dropbox-storage-addon',
        'gd-press-tools-storage-s3' => 'amazon-s3-storage-addon',

        'code-builder-addon' => 'gd-rating-system-builder',
        'multi-ratings-addon' => 'gd-rating-system-multi',
        'user-reviews-addon' => 'gd-rating-system-user-reviews',
        'comments-form-addon' => 'gd-rating-system-comments-form',
        'data-export-addon' => 'gd-rating-system-data-export',
        'emojione-pack-addon' => 'gd-rating-system-emojione',
        'halloween-pack-addon' => 'gd-rating-system-halloween',
        'christmas-pack-addon' => 'gd-rating-system-christmas',
        'dropbox-storage-addon' => 'gd-press-tools-storage-dropbox',
        'amazon-s3-storage-addon' => 'gd-press-tools-storage-s3'
    );

    public $plugins = array(
        'gd-taxonomies-tools/gd-taxonomies-tools.php',

        'dev4press-updater/dev4press-updater.php',

        'gd-security-toolbox/gd-security-toolbox.php',
        'gd-rating-system/gd-rating-system.php',
        'gd-seo-toolbox/gd-seo-toolbox.php',
        'gd-bbpress-toolbox/gd-bbpress-toolbox.php',
        'gd-swift-navigator/gd-swift-navigator.php',
        'gd-crumbs-navigator/gd-crumbs-navigator.php',
        'gd-knowledge-base/gd-knowledge-base.php',
        'gd-clever-widgets/gd-clever-widgets.php',
        'gd-webfonts-toolbox/gd-webfonts-toolbox.php',
        'gd-press-tools/gd-press-tools.php',
        'gd-products-center/gd-products-center.php',
        'gd-content-tools/gd-content-tools.php',
        'gd-topic-prefix/gd-topic-prefix.php',
        'gd-topic-polls/gd-topic-polls.php',

        'gd-rating-system-emojione/gd-rating-system-emojione.php',
        'gd-rating-system-halloween/gd-rating-system-halloween.php',
        'gd-rating-system-christmas/gd-rating-system-christmas.php',
        'gd-rating-system-builder/gd-rating-system-builder.php',
        'gd-rating-system-multi/gd-rating-system-multi.php',
        'gd-rating-system-user-reviews/gd-rating-system-user-reviews.php',
        'gd-rating-system-comments-form/gd-rating-system-comments-form.php',
        'gd-rating-system-data-export/gd-rating-system-data-export.php',

        'gd-press-tools-storage-dropbox/gd-press-tools-storage-dropbox.php',
        'gd-press-tools-storage-s3/gd-press-tools-storage-s3.php'
    );

    public $check = 'https://www.dev4press.com/service/updater/check3/';

    public $download = 'https://www.dev4press.com/download/%category%/%apikey%/%id%/%build%/';
    public $cdn = 'https://d3pfz6v4o98uk0.cloudfront.net/gfx/';

    public $feeds = array(
        'promotions' => 'https://www.dev4press.com/service/feeds/promotions/',
        'releases' => 'https://www.dev4press.com/service/feeds/releases/',
        'blog' => 'https://www.dev4press.com/service/feeds/blog/',
    );

    public function __construct() {
        add_action('d4pupd_plugin_core_ready', array($this, 'ready'));
    }

    public function ready() {
        $this->apikey = d4pupd_settings()->get('dev4press_api_key');
        $this->status = d4pupd_settings()->get('update_status');
        $this->debug = d4pupd_settings()->get('debug_level');

        $this->update = get_site_transient('dev4press_updater_response');

        if ($this->apikey != '') {
            if (is_main_site()) {
                if (!wp_next_scheduled('dev4press_update_check') && d4pupd_settings()->get('check_interval') != '__none__') {
                    wp_schedule_event($this->cron_time_day(), $this->cron_check_interval(), 'dev4press_update_check');
                }
            } else {
                if (wp_next_scheduled('dev4press_update_check') !== false) {
                    d4pupd_remove_cron('dev4press_update_check');
                }
            }

            if ($this->update !== false) {
                add_filter('site_transient_update_plugins', array($this, 'add_updates_plugins'));

                add_filter('plugins_api', array($this, 'add_plugin_info'), 20, 3);
            }

            add_filter('upgrader_post_install', array($this, 'clear_update_information'), 10, 3);
            add_filter('http_request_args', array($this, 'request_headers'), 1000, 2);

            add_filter('install_plugin_complete_actions', array($this, 'install_plugin_complete_actions'), 10, 3);
        }
    }

    public function install_plugin_complete_actions($actions, $api, $plugin_file) {
        if (in_array($plugin_file, $this->plugins)) {
            $actions['plugins_page'] = '<a href="'.self_admin_url('admin.php?page=dev4press-updater-install').'" target="_parent">'.__("Return to Dev4Press Installer", "dev4press-updater").'</a>';
        }

        return $actions;
    }

    public function request_headers($r, $url) {
        if (strpos($url, 'www.dev4press.com/download') !== false) {
            $r['headers']['X-Dev4press-Updater-Domain'] = d4pupd_plugin()->domain;
        }

        return $r;
    }

    public function clear_update_information($res, $hook_extra, $result) {
        if (isset($hook_extra['plugin'])) {
            $plugin = $hook_extra['plugin'];

            if (is_string($plugin) && in_array($plugin, $this->plugins)) {
                $this->_update('plugins', $plugin);
            }
        }

        return $res;
    }

    public function add_updates_plugins($updates) {
        if (isset($this->update['core']['status']) && $this->update['core']['status'] == 'ok') {
            foreach ($this->update['plugins'] as $plugin => $data) {
                $release = false;

                foreach ($this->statuses as $status) {
                    if (isset($data[$status])) {
                        $release = $data[$status];
                        break;
                    }
                }

                if ($release !== false) {
                    $update = new StdClass;

                    $update->id = $release->id;
                    $update->slug = $release->group;
                    $update->new_version = $release->version;
                    $update->url = 'https://plugins.dev4press.com/'.$release->group;
                    $update->package = $this->download_product_url($release);
                    $update->upgrade_notice = $release->info;
                    $update->plugin = $plugin;

                    if ($this->debug == 'full') {
                        dev4upd_debug_log('PLUGIN_UPDATE_PACKAGE', $update);
                    }

                    $updates->response[$plugin] = $update;
                }
            }
        }

        return $updates;
    }

    public function add_plugin_info($result, $action = null, $args = null) {
        if ($action == 'plugin_information' && isset($args->slug) && $args->slug != '') {
            if (isset($this->update['purchase']) && 
                isset($this->update['purchase']['plugins']) && 
                isset($this->update['purchase']['addons']) && 
                is_array($this->update['purchase']['plugins']) && 
                is_array($this->update['purchase']['addons'])) {

                $the_list = array_merge(
                        $this->update['purchase']['plugins'], 
                        $this->update['purchase']['addons']);

                foreach ($the_list as $code => $data) {
                    if ($args->slug == $code) {
                        $result = new stdClass();

                        $result->name = $data->name;
                        $result->slug = $code;
                        $result->version = $data->latest->version;
                        $result->homepage = $data->url;
                        $result->last_updated = $data->latest->release_date;
                        $result->download_link = $this->download_product_url($data->latest);
                        $result->requires = $data->latest->wordpress;
                        $result->author = 'Milan Petrovic, Dev4Press';
                        $result->author_homepage = 'https://www.dev4press.com/';
                        $result->sections = array(
                            'description' => $data->description,
                            'changelog' => '<strong>'.__("Version", "dev4press-updater").': '.$data->latest->version.'</strong><p>'.$data->latest->info.'</p><strong>'.__("Full Changelog", "dev4press-updater").':</strong><p><a target="_blank" href="'.$data->url.'changelog/">'.__("Changelog page", "dev4press-updater").'</a></p>',
                        );

                        if ($this->debug == 'full') {
                            dev4upd_debug_log('PLUGIN_INSTALL_PACKAGE', $result);
                        }
                    }
                }
            }
        }

        return $result;
    }

    public function cron_time_day() {
        return mktime(0, 5, 2, date('m'), date('d') + 1, date('Y'));
    }

    public function cron_check_interval() {
        return d4pupd_settings()->get('check_interval') != '' ? d4pupd_settings()->get('check_interval') : 'twicedaily';
    }

    public function download_product_url($release, $type = 'plugin') {
        $url = $this->download;

        $url = str_replace('%category%', $type, $url);
        $url = str_replace('%apikey%', $this->apikey, $url);
        $url = str_replace('%id%', $release->id, $url);
        $url = str_replace('%build%', d4pupd_settings()->info_build, $url);

        return $url;
    }

    public function run() {
        if ($this->apikey != '') {
            $throttle = get_site_transient('dev4press_updater_throttle');

            if ($throttle == false) {
                $plugins = $this->get_plugins();

                $this->update = $this->_request($plugins);

                set_site_transient('dev4press_updater_response', $this->update, 604800);
                set_site_transient('dev4press_updater_throttle', 'wait', 120);
            }
        }

        return $this->update;
    }

    public function get_plugins() {
        require_once(ABSPATH.'wp-admin/includes/plugin.php');
        $all_plugins = get_plugins();

        $_plugins = array();

        foreach ($this->plugins as $plugin) {
            if (isset($all_plugins[$plugin])) {
                $pp = explode('/', $plugin);

                $_plugins[$plugin] = array(
                    'plugin' => $plugin,
                    'product_id' => $pp[0],
                    'edition' => $pp[0] == 'dev4press-updater' ? 'free' : 'pro',
                    'name' => $all_plugins[$plugin]['Name'],
                    'version' => $all_plugins[$plugin]['Version'],
                    'build' => 0
                );

                $_plugins[$plugin]['build'] = 0;

                $build_path = WP_PLUGIN_DIR.'/'.$pp[0].'/code/build.php';

                if (!file_exists($build_path)) {
                    $build_path = WP_PLUGIN_DIR.'/'.$pp[0].'/core/build.php';
                }

                if (file_exists($build_path)) {
                    include($build_path);

                    $_plugins[$plugin]['build'] = $build;
                }
            }
        }

        return $_plugins;
    }

    public function has_updates() {
        $list = array(
            'plugins' => array(),
            'themes' => array()
        );

        if (isset($this->update['plugins']) && is_array($this->update['plugins'])) {
            foreach ($this->update['plugins'] as $plugin => $data) {
                reset($data);
                $status = key($data);

                if (in_array($status, $this->statuses)) {
                    $list['plugins'][] = array(
                        'name' => $data[$status]->name,
                        'version' => $data[$status]->version,
                        'released' => $data[$status]->release_date
                    );
                }
            }
        }

        return $list;
    }

    public function has_licenses($code) {
        $list = array();

        if (isset($this->update['licenses']['active']) && is_array($this->update['licenses']['active'])) {
            foreach ($this->update['licenses']['active'] as $lic) {
                if ($lic['code'] == $code) {
                    $list[] = $lic;
                }
            }
        }

        return empty($list) ? false : $list;
    }

    public function generic_error() {
        if (isset($this->update['core']['message'])) {
            return $this->update['core']['message'];
        } else {
            return __("There was an error with update check.", "dev4press-updater");
        }
    }

    private function _update($type, $name) {
        $this->update[$type][$name] = array(
            'not_found' => __("You are using latest version.", "dev4press-updater")
        );

        set_site_transient('dev4press_updater_response', $this->update, 604800);

        $timestamp = d4p_next_scheduled('dev4press_update_check');
        if ($timestamp === false || $timestamp > time() + 300) {
            wp_schedule_single_event(time() + 300, 'dev4press_update_check');
        }
    }

    private function _meta() {
        return array(
            d4pupd_settings()->info_build, 
            $this->apikey,
            D4PUPD_WPV, 
            is_multisite() ? 'Y' : 'N', 
            d4pupd_prepare_host(), 
            $_SERVER['SERVER_NAME']
        );
    }

    private function _post($url, $data) {
        global $wp_version;

        $options = array(
            'timeout' => 30, 
            'body' => serialize($data), 
            'method' => 'POST',
            'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url')
        );

        return wp_remote_post($url, $options);
    }

    private function _request($plugins) {
        $request = array(
            'updater' => d4pupd_settings()->info_build,
            'api_key' => $this->apikey,
            'home_url' => get_bloginfo('url'),
            'domain' => d4pupd_plugin()->domain,
            'wordpress' => D4PUPD_WPV,
            'php' => function_exists('phpversion') ? phpversion() : 'NA',
            'mysql' => d4pupd_mysql_version(),
            'multisite' => is_multisite() ? 'yes' : 'no',
            'status' => $this->status,
            'meta' => d4pupd_prepare_meta(serialize($this->_meta()), d4pupd_settings()->info_build),
            'plugins' => $plugins, 
            'themes' => array()
        );

        if ($this->debug == 'full' || $this->debug == 'requests') {
            dev4upd_debug_log('REMOTE_POST_REQUEST_DATA', $request);
        }

        $raw = $this->_post($this->check, $request);

        if ($this->debug == 'full' || $this->debug == 'responses') {
            dev4upd_debug_log('REMOTE_POST_RESPONSE_RAW', $raw);
        }

        $response = false;

        if (!is_wp_error($raw)) {
            $response = unserialize($raw['body']);

            if (isset($response['core']['status']) && $response['core']['status'] == 'ok') {
                if ($this->debug == 'full' || $this->debug == 'responses') {
                    dev4upd_debug_log('REMOTE_POST_RESPONSE_DATA', $response);
                }
            } else {
                $response = array('core' => array('status' => 'remote_error'));
            }
        }

        $response['core']['time'] = time();

        return $response;
    }
}
