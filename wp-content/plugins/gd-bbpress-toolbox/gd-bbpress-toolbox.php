<?php

/*
Plugin Name: GD bbPress Toolbox Pro
Plugin URI: https://plugins.dev4press.com/gd-bbpress-toolbox/
Description: Expand bbPress powered forums with attachments upload, BBCodes support, signatures, widgets, quotes, toolbar menu, activity tracking, enhanced widgets, extra views...
Version: 4.7.2
Author: Milan Petrovic
Author URI: https://www.dev4press.com/
Text Domain: gd-bbpress-toolbox
Private: true

== Copyright ==
Copyright 2008 - 2017 Milan Petrovic (email: milan@gdragon.info)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>
*/

$gdbx_dirname_basic = dirname(__FILE__).'/';
$gdbx_urlname_basic = plugins_url('/gd-bbpress-toolbox/');

define('GDBBX_PATH', $gdbx_dirname_basic);
define('GDBBX_URL', $gdbx_urlname_basic);
define('GDBBX_D4PLIB', $gdbx_dirname_basic.'d4plib/');

require_once(GDBBX_D4PLIB.'d4p.core.php');

d4p_includes(array(
    array('name' => 'wpdb', 'directory' => 'plugin'), 
    array('name' => 'widget', 'directory' => 'plugin'), 
    'functions', 
    'sanitize', 
    'access', 
    'wp'
), GDBBX_D4PLIB);

global $_gdbbx_plugin, $_gdbbx_settings, $_gdbbx_loader, $_gdbbx_db, $_gbbx_roles;

require_once(GDBBX_PATH.'core/functions/bbpress.php');
require_once(GDBBX_PATH.'core/functions/features.php');
require_once(GDBBX_PATH.'core/functions/conditionals.php');
require_once(GDBBX_PATH.'core/functions/override.php');

require_once(GDBBX_PATH.'core/objects/core.db.php');
require_once(GDBBX_PATH.'core/objects/core.roles.php');

require_once(GDBBX_PATH.'core/plugin.php');
require_once(GDBBX_PATH.'core/version.php');
require_once(GDBBX_PATH.'core/settings.php');

require_once(GDBBX_PATH.'core/loader.php');

$_gdbbx_db = new gdbbx_core_db();
$_gdbbx_plugin = new gdbbx_core_plugin();
$_gdbbx_settings = new gdbbx_core_settings();
$_gdbbx_loader = new gdbbx_core_loader();
$_gbbx_roles = new gdbbx_core_roles();

function gdbbx_db() {
    global $_gdbbx_db;
    return $_gdbbx_db;
}

function gdbbx_plugin() {
    global $_gdbbx_plugin;
    return $_gdbbx_plugin;
}

function gdbbx_loader() {
    global $_gdbbx_loader;
    return $_gdbbx_loader;
}

function gdbbx_roles() {
    global $_gbbx_roles;
    return $_gbbx_roles;
}

function gdbbx_settings() {
    global $_gdbbx_settings;
    return $_gdbbx_settings;
}

function gdbbx() {
    global $_gdbbx_settings;
    return $_gdbbx_settings;
}

if (D4P_ADMIN) {
    d4p_includes(array(
        array('name' => 'functions', 'directory' => 'admin')
    ), GDBBX_D4PLIB);

    require_once(GDBBX_PATH.'core/admin.php');
}

if (D4P_AJAX) {
    require_once(GDBBX_PATH.'core/ajax.php');
}

require_once(GDBBX_PATH.'core/functions/public.php');
