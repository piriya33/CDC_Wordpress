<?php

/*
Plugin Name: GD bbPress Tools
Plugin URI: https://plugins.dev4press.com/gd-bbpress-toolbox/
Description: Adds different expansions and tools to the bbPress 2.x plugin powered forums: BBCode support, signatures, custom views, quote...
Version: 1.9.2
Author: Milan Petrovic
Author URI: https://www.dev4press.com/
Text Domain: gd-bbpress-tools

== Copyright ==
Copyright 2008 - 2017 Milan Petrovic (email: milan@gdragon.info)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!defined('GDBBPRESSTOOLS_CAP')) {
    define('GDBBPRESSTOOLS_CAP', 'activate_plugins');
}

require_once(dirname(__FILE__).'/code/defaults.php');
require_once(dirname(__FILE__).'/code/shared.php');
require_once(dirname(__FILE__).'/code/sanitize.php');
require_once(dirname(__FILE__).'/code/tools/class.php');
