<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_loader {
    public $svg_icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMC4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyOTguOSAyOTguOSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk4LjkgMjk4Ljk7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsOiM5QkExQTY7fQ0KPC9zdHlsZT4NCjxnPg0KCTxnPg0KCQk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMjcxLjgsMTguM0gyNy4yYy00LjgsMC04LjgsMy45LTguOCw4Ljh2MC4xdjEwMi4xVjE5N3Y3My42djAuMWMwLDQuOSw1LDEwLDkuOSwxMEg3Mw0KCQkJYy0wLjEsMC0wLjEtMC4xLTAuMi0wLjFoMTc3LjhjLTAuMSwwLTAuMSwwLjEtMC4yLDAuMWgxOS43YzQuOSwwLDEwLjQtNS4yLDEwLjQtMTAuMXYtMC4xdi0yMC4zVjc1LjlWMjcuMnYtMC4xDQoJCQlDMjgwLjYsMjIuMiwyNzYuNywxOC4zLDI3MS44LDE4LjN6IE0yNzIuOCwyNTkuOWMtMy44LDQuNC03LjksOC41LTEyLjIsMTIuNEg2Mi45Yy0xNC40LTEzLjEtMjYuNi0yOS4yLTM1LjItNDhjMCwwLDAtMC4xLDAtMC4xDQoJCQl2LTEyMkM0MS45LDcwLjksNjYuOSw0NC40LDEwMC42LDI5YzEuNC0wLjcsMi45LTEuMiw0LjQtMS44aDExMy43YzIwLjUsOC42LDM5LjEsMjEuOCw1NC4xLDM5VjI1OS45eiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik04OS41LDE3MC44bDEyNS40LTU3LjNjMi45LTEuMyw1LjgtMS40LDguOC0wLjNjMywxLjEsNS4xLDMuMSw2LjQsNmMxLjMsMi45LDEuNCw1LjgsMC4zLDguOA0KCQljLTEuMSwzLTMuMSw1LjEtNiw2LjVMOTkuMSwxOTEuOGMtMi45LDEuMy01LjgsMS40LTguOCwwLjNjLTMtMS4xLTUuMS0zLjEtNi40LTZjLTEuMy0yLjktMS40LTUuOC0wLjMtOC44DQoJCUM4NC43LDE3NC4zLDg2LjcsMTcyLjEsODkuNSwxNzAuOHogTTExNC4zLDE5Ny40bDEwNC41LTQ3LjhjMi45LTEuMyw1LjgtMS40LDguOC0wLjNjMywxLjEsNS4xLDMuMSw2LjQsNmMxLjMsMi45LDEuNCw1LjgsMC4zLDguOA0KCQljLTEuMSwzLTMuMSw1LjEtNiw2LjVsLTEwNC41LDQ3LjhjLTIuOSwxLjMtNS44LDEuNC04LjgsMC4zYy0zLTEuMS01LjEtMy4xLTYuNC02Yy0xLjMtMi45LTEuNC01LjgtMC4zLTguOA0KCQlDMTA5LjQsMjAwLjksMTExLjQsMTk4LjcsMTE0LjMsMTk3LjR6IE0xODQsMTE1bC03My4yLDMzLjRjLTQuMywyLTguNywyLjEtMTMuMiwwLjVjLTQuNS0xLjctNy43LTQuNy05LjctOQ0KCQljLTItNC4zLTIuMS04LjctMC41LTEzLjJjMS43LTQuNSw0LjctNy43LDktOS43bDE2LjYtNy42Yy0xLjUtMS43LTIuNy0zLjMtMy4zLTQuOGMtMi00LjMtMi4xLTguNy0wLjUtMTMuMmMxLjctNC41LDQuNy03LjcsOS05LjcNCgkJbDEwLjUtNC44YzQuMy0yLDguNy0yLjEsMTMuMi0wLjVjNC41LDEuNyw3LjcsNC43LDkuNyw5YzAuNywxLjUsMS4xLDMuNCwxLjQsNS43bDE2LjYtNy42YzQuMy0yLDguNy0yLjEsMTMuMi0wLjUNCgkJYzQuNSwxLjcsNy43LDQuNyw5LjcsOWMyLDQuMywyLjEsOC43LDAuNSwxMy4yQzE5MS4zLDEwOS44LDE4OC4zLDExMywxODQsMTE1eiBNMTQ5LjUsMjE5LjJsNjIuNy0yOC43YzIuOS0xLjMsNS44LTEuNCw4LjgtMC4zDQoJCWMzLDEuMSw1LjEsMy4xLDYuNCw2YzEuMywyLjksMS40LDUuOCwwLjMsOC44Yy0xLjEsMy0zLjEsNS4xLTYsNi41bC0xMS40LDUuMmMxLjUsMS43LDIuNywzLjMsMy4zLDQuOGMyLDQuMywyLjEsOC43LDAuNSwxMy4yDQoJCWMtMS43LDQuNS00LjcsNy43LTksOS43bC0xMC41LDQuOGMtNC4zLDItOC43LDIuMS0xMy4yLDAuNWMtNC41LTEuNy03LjctNC43LTkuNy05Yy0wLjctMS41LTEuMS0zLjMtMS40LTUuN2wtMTEuNCw1LjINCgkJYy0yLjksMS4zLTUuOCwxLjQtOC44LDAuM2MtMy0xLjEtNS4xLTMuMS02LjQtNmMtMS4zLTIuOS0xLjQtNS44LTAuMy04LjhDMTQ0LjcsMjIyLjcsMTQ2LjcsMjIwLjYsMTQ5LjUsMjE5LjJ6Ii8+DQo8L2c+DQo8L3N2Zz4NCg==';
    public $fontawesome = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
    public $fontawesome_version = '4.7.0';

    public $buddypress = false;
    public $debug = false;

    public $modules = array();
    public $objects = array();

    public $is_search = false;
    public $enqueue_files = false;

    function __construct() {
        add_action('plugins_loaded', array($this, 'core'));

        add_action('gdbbx_plugin_settings_loaded', array($this, 'early'));

        add_action('template_redirect', array($this, 'template_redirect'), 7);

        add_action('bbp_init', array($this, 'load'), 1);
        add_action('bbp_init', array($this, 'init'), 2);
        add_action('bbp_init', array($this, 'hook'));

        add_action('wp', array($this, 'wp'));
    }

    public function core() {
        $this->debug = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG;
        $this->buddypress = gdbbx_has_buddypress();

        if (GDBBX_WPV < 43) {
            add_action('admin_notices', array($this, 'system_requirements_problem'));
        }

        if (gdbbx_has_bbpress()) {
            add_action('wp_head', array($this, 'wp_head'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_files'), 1);

            add_filter('gdbbx_enqueue_files', array($this, 'check_enqueue_files'), 1);
        } else {
            add_action('admin_notices', array($this, 'bbpress_requirements_problem'));
        }
    }

    public function system_requirements_problem() {
        ?>

<div class="notice notice-error">
    <p><?php _e("GD Topic Polls Pro requires WordPress 4.3 or newer. Plugin will now be disabled. To use this plugin, upgrade WordPress to 4.3 or newer version.", "gd-bbpress-toolbox"); ?></p>
</div>

        <?php

        $this->deactivate();
    }

    public function bbpress_requirements_problem() {
        ?>

<div class="notice notice-error">
    <p><?php _e("GD bbPress Toolbox Pro requires bbPress plugin for WordPress version 2.5 or newer. Plugin will now be disabled. To use this plugin, make sure you are using bbPress 2.5 or newer version.", "gd-bbpress-toolbox"); ?></p>
</div>

        <?php

        $this->deactivate();
    }

    public function deactivate() {
        deactivate_plugins('gd-bbpress-toolbox/gd-bbpress-toolbox.php', false);
    }

    public function early() {
        if (!gdbbx_has_bbpress()) {
            return;
        }

        require_once(GDBBX_PATH.'core/objects/core.early.php');
        $this->objects['early'] = new gdbbx_core_early();
        $this->objects['early']->features();
    }

    public function load() {
        if (!gdbbx_has_bbpress()) {
            return;
        }

        if (function_exists('bbp_is_search')) {
            $this->is_search = bbp_is_search();
        }

        require_once(GDBBX_PATH.'core/objects/core.forums.php');
        $this->objects['forums'] = new gdbbx_core_forums();

        require_once(GDBBX_PATH.'core/objects/core.icons.php');
        $this->objects['icons'] = new gdbbx_core_icons();

        require_once(GDBBX_PATH.'core/objects/core.widgets.php');
        $this->objects['widgets'] = new gdbbx_core_widgets();

        require_once(GDBBX_PATH.'core/objects/core.views.php');
        $this->objects['views'] = new gdbbx_core_views();

        require_once(GDBBX_PATH.'core/objects/core.rss.php');
        $this->objects['rss'] = new gdbbx_core_rss();

        require_once(GDBBX_PATH.'modules/bbpress.php');
        $this->modules['bbpress'] = new gdbbxMod_bbPress();

        require_once(GDBBX_PATH.'modules/notify.php');
        $this->modules['notify'] = new gdbbxMod_Notify();

        require_once(GDBBX_PATH.'modules/lock.php');
        $this->modules['lock'] = new gdbbxMod_Lock();

        require_once(GDBBX_PATH.'modules/private.php');
        $this->modules['private'] = new gdbbxMod_Private();

        require_once(GDBBX_PATH.'modules/navmenu.php');
        $this->modules['navmenu'] = new gdbbxMod_NavMenu();

        if (gdbbx()->get('toolbar_active', 'tools') && gdbbx()->allowed('toolbar', 'tools', true)) {
            require_once(GDBBX_PATH.'modules/toolbar.php');
            $this->modules['toolbar'] = new gdbbxMod_Toolbar();
        }

        if (gdbbx()->get('active', 'report') && gdbbx()->allowed('allow', 'report', false, false)) {
            require_once(GDBBX_PATH.'modules/report.php');
            $this->modules['report'] = new gdbbxMod_Report();
        }

        if (gdbbx()->get('active', 'canned')) {
            require_once(GDBBX_PATH.'modules/canned.php');
            $this->modules['canned'] = new gdbbxMod_Canned();
        }

        if (gdbbx()->get('signature_active', 'tools')) {
            require_once(GDBBX_PATH.'modules/signature.php');
            $this->modules['signature'] = new gdbbxMod_Signature();
        }

        if (gdbbx()->get('bbcodes_active', 'tools')) {
            require_once(GDBBX_PATH.'modules/bbcodes/load.php');
            $this->modules['bbcodes'] = new gdbbxMod_BBCodes();

            if (!is_admin() && gdbbx()->get('bbcodes_toolbar_active', 'tools') && !bbp_use_wp_editor()) {
                require_once(GDBBX_PATH.'modules/bbcodes/toolbar.php');
                $this->modules['bbcodes_toolbar'] = new gdbbxMod_BBCodesToolbar();
            }
        }
        
        if (is_admin()) {
            if (gdbbx()->get('admin_disable_active', 'tools') && !gdbbx()->allowed('admin_disable', 'tools')) {
                require_once(GDBBX_PATH.'modules/access.php');
                $this->modules['access'] = new gdbbxMod_Access();
            }

            require_once(GDBBX_PATH.'modules/admin.php');
            $this->modules['admin'] = new gdbbxMod_Admin();
        } else {
            if (gdbbx()->get('quote_active', 'tools') && gdbbx()->allowed('quote', 'tools') && !$this->is_search) {
                require_once(GDBBX_PATH.'modules/quote.php');
                $this->modules['quote'] = new gdbbxMod_Quote();
            }

            if (gdbbx()->get('active', 'thanks')) {
                require_once(GDBBX_PATH.'modules/thanks.php');
                $this->modules['thanks'] = new gdbbxMod_Thanks();
            }

            if (gdbbx()->get('active', 'disable_rss')) {
                require_once(GDBBX_PATH.'modules/rss.php');
                $this->modules['disable_rss'] = new gdbbxMod_DisableRSSFeeds();
            }

            require_once(GDBBX_PATH.'modules/front.php');
            $this->modules['front'] = new gdbbxMod_Front();

            require_once(GDBBX_PATH.'modules/integrate.php');
            $this->modules['integrate'] = new gdbbxMod_Integrate();

            require_once(GDBBX_PATH.'modules/seo.php');
            $this->modules['seo'] = new gdbbxMod_SEO();
        }

        if ($this->buddypress) {
            require_once(GDBBX_PATH.'modules/buddypress/load.php');
            $this->modules['buddypress'] = new gdbbxMod_BuddyPress();
        }

        require_once(GDBBX_PATH.'modules/attachments/load.php');
        $this->modules['attachments'] = 'loaded';

        require_once(GDBBX_PATH.'modules/tracking.php');
        $this->modules['tracking'] = new gdbbxMod_Tracking();
    }

    public function load_module_thanks() {
        require_once(GDBBX_PATH.'modules/thanks.php');
        $this->modules['thanks'] = new gdbbxMod_Thanks();
    }

    public function template_redirect() {
        do_action('gdbbx_template');
    }

    public function init() {
        do_action('gdbbx_init');
    }

    public function hook() {
        do_action('gdbbx_core');
    }

    public function wp() {
        do_action('gdbbx_wp');
    }

    public function wp_head() {
        $values = apply_filters('gdbbx_script_values', array(
            'url' => admin_url('admin-ajax.php'),
            'run_quote' => true,
            'run_report' => false,
            'run_thanks' => false,
            'run_attachments' => false,
            'run_canned_replies' => false,
            'run_bbcodes' => false,
            'run_thanks' => false,
            'run_fitvids' => gdbbx()->get('apply_fitvids_to_content', 'bbpress'),
            'wp_editor' => bbp_use_wp_editor(),
            'wp_version' => GDBBX_WPV,
            'last_cookie' => gdbbx()->session_cookie_expiration(),
            'bbpress_version' => gdbbx_bbpress_version(),
            'text_are_you_sure' => __("Are you sure? Operation is not reversible.", "gd-bbpress-toolbox"),
            'now' => time()
        ));

        if (!empty($values)) {
            $js = array();

            foreach ($values as $key => $value) {
                $v = '';

                if (is_bool($value)) {
                    $v = $key.': '.($value ? 'true' : 'false');
                } else if (is_numeric($value)) {
                    $v = $key.': '.$value;
                } else {
                    $v = $key.': "'.esc_attr($value).'"';
                }

                $js[] = $v;
            }

            ?>

<script type="text/javascript">
    /* <![CDATA[ */
    var gdbxRender_Data = <?php echo '{ '.join(', ', $js).' }'; ?>;
    /* ]]> */
</script>

        <?php }
    }

    public function check_enqueue_files($enqueue) {
        return gdbbx()->get('load_always') || gdbbx_is_bbpress();
    }

    public function enqueue_files() {
        if (is_admin()) {
            return;
        }

        $this->enqueue_files = apply_filters('gdbbx_enqueue_files', $this->enqueue_files);

        if ($this->enqueue_files) {
            $this->main_enqueue();
        }

        if (gdbbx()->get('load_own_css_widgets')) {
            wp_enqueue_style('gdbbx-front-widgets', $this->file('css', 'front-widgets'), array(), gdbbx_settings()->file_version());
        }
    }

    public function fontawesome_url() {
        $from = gdbbx_settings()->get('fontawesome_source');

        if ($from == 'local') {
            return GDBBX_URL.'d4plib/resources/fontawesome/css/font-awesome.min.css';
        } else {
            return $this->fontawesome;
        }
    }

    public function fontawesome_enqueue() {
        if (gdbbx()->get('load_fontawesome')) {
            wp_enqueue_style('fontawesome', $this->fontawesome_url(), array(), $this->fontawesome_version);
        }
    }

    public function toolbar_enqueue() {
        $this->fontawesome_enqueue();

        wp_enqueue_style('gdbbx-front-toolbar', $this->file('css', 'front-toolbar'), array(), gdbbx_settings()->file_version());
        wp_enqueue_script('gdbbx-front-toolbar', $this->file('js', 'front-toolbar'), array('jquery'), gdbbx_settings()->file_version(), true);
    }

    public function tinymce_enqueue() {
        wp_enqueue_style('gdbbx-front-tinymce', $this->file('css', 'front-tinymce'), array(), gdbbx_settings()->file_version());
    }

    public function main_enqueue() {
        $this->fontawesome_enqueue();

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $_icons_url = apply_filters('gdbbx_enqueue_url_icons_stylesheet', $this->file('css', 'icons/icons'));

            wp_enqueue_style('gdbbx-icons', $_icons_url, array(), gdbbx()->file_version());
        }

        if (gdbbx()->get('load_own_css')) {
            wp_enqueue_style('gdbbx-front-core', $this->file('css', 'front-core'), array(), gdbbx()->file_version());
        }

        if (gdbbx()->get('load_fitvids')) {
            wp_enqueue_script('gdbbx-fitvids', $this->file('js', 'fitvids'), array('jquery'), gdbbx()->file_version(), true);
        }

        if (gdbbx()->get('load_own_js')) {
            wp_enqueue_script('gdbbx-front-core', $this->file('js', 'front-core'), array('jquery'), gdbbx()->file_version(), true);
        }

        do_action('gdbbx_modules_enqueue');
    }

    public function file($type, $name) {
        $get = GDBBX_URL;

        if ($name == 'fitvids') {
            $get.= 'd4pjs/fitvids/jquery.fitvids.js';
        } else {
            $get.= $type.'/'.$name;

            if (!$this->debug) {
                $get.= '.min';
            }

            $get.= '.'.$type;
        }

        return $get;
    }
}
