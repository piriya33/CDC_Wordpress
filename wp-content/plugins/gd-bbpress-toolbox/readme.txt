=== GD bbPress Toolbox Pro ===
Contributors: GDragoN
Version: 4.7.2
Requires at least: 4.3
Tested up to: 4.8
Stable tag: trunk

Expand bbPress powered forums with attachments upload, BBCodes support, signatures, widgets, quotes, toolbar menu, activity tracking, enhanced widgets, extra views...

== Description ==
Expand bbPress powered forums with attachments upload, BBCodes support, signatures, widgets, quotes, toolbar menu, activity tracking, enhanced widgets, extra views...

== Installation ==
= General Requirements =
* PHP: 5.5 or newer
* bbPress 2.5 or newer
* mySQL: 5.5 or newer
* WordPress: 4.3 or newer
* jQuery: 1.11.1 or newer

= PHP Notice =
* The plugin should work with PHP 5.3 and 5.4, but these versions are no longer used for testing, and they are no longer supported.
* The plugin doesn't work with PHP 5.2 or older versions.

= WordPress Notice =
* The plugin should work with WordPress 4.0, 4.1 and 4.2, but these versions are no longer used for testing, and they are no longer supported.
* The plugin doesn't work with WordPress 3.9 or older versions.

= Basic Installation =
* Plugin folder in the WordPress plugins folder must be `gd-bbpress-toolbox`.
* Upload `gd-bbpress-toolbox` folder to the `/wp-content/plugins/` directory.
* Activate the plugin through the 'Plugins' menu in WordPress.
* Check all the plugin and plugin widgets settings before using the plugin.

== Frequently Asked Questions ==
= Does plugin works with WordPress MultiSite installations? =
Yes. Each website in network can activate and use plugin on it's on.

= Why is Media Library required? =  
All attachments uploads are handled by the WordPress Media Library, and plugin uses native WordPress upload functions. When file is uploaded it will be available through Media Library. Consult WordPress documentation about Media Library requirements.

= Will this plugin work with standalone bbPress instalation? =
No. This plugin requires the plugin versions of bbPress 2.5 or higher.

= Will this plugin work with bbPress that is part of BuddyPress plugin? =
No. Plugin requires bbPress 2.5 or higher plugin. It can work with BuddyPress, if you use bbPress 2.x plugin for site wide forums.

= Does plugin support dynamic roles added by bbPress 2.2? =
Yes, since GD bbPress Toolbox Pro 1.4. But, when updating, you must recheck all plugin settings depending on roles, and select roles you want and save. When dynamic roles are used, normal WP roles are suspended.

= Can I upgrade from Dev4Press free plugins for bbPress? =
Yes. If GD bbPress Attachments or GD bbPress Tools are active, GD bbPress Toolbox will disable them on activation.

= Can I translate plugin to my language? =
Yes. POT file is provided as a base for translation. Translation files should go into Languages directory.
