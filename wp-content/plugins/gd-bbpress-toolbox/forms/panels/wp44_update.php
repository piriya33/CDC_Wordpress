<?php

require_once(GDBBX_PATH.'core/admin/update.php');

$queries = gdbbx_shortcodes_wp44_build_query();

?>
<div class="d4p-group d4p-group-import d4p-group-important">
    <h3><?php _e("Important", "gd-bbpress-toolbox"); ?></h3>
    <div class="d4p-group-inner">
        <h4 style="margin-top: 0; font-size: 18px;"><?php _e("Problem Description", "gd-bbpress-toolbox"); ?></h4>
        <p><?php _e("WordPress 4.4 introduced some changes in the way it parses shortcodes, and this affected some of the BBCodes added by GD bbPress Toolbox Pro.", "gd-bbpress-toolbox"); ?></p>
        <h4 style="font-size: 18px;"><?php _e("Solution", "gd-bbpress-toolbox"); ?></h4>
        <p><?php _e("To fix the issue, plugin is updated to handle changes. But, all topics and replies created before contain BBCodes used in the way WordPress 4.4 no longer allows. The only way to fix this is to update all old topics and replies and replace old BBCodes with new BBCodes format. You can do it automatically using this tool (just click Update button), or you can use SQL queries listed below and run them directly on your database.", "gd-bbpress-toolbox"); ?></p>
        <p><?php _e("If you use run update through the plugin, once it is done, this update panel will be hidden. You can enable it again from plugin Advanced Settings.", "gd-bbpress-toolbox"); ?></p>
        <h4 style="font-size: 18px;"><?php _e("Disclaimer", "gd-bbpress-toolbox"); ?></h4>
        <p style="color: #d00;"><?php _e("This operation is not reversible, and before using this tool, make sure you have backup of your database (or at least 'posts' table) so you can restore it if something goes wrong.", "gd-bbpress-toolbox"); ?></p>
    </div>
</div>

<div class="d4p-group d4p-group-queries">
    <h3><?php _e("List of SQL queries", "gd-bbpress-toolbox"); ?></h3>
    <div class="d4p-group-inner" style="overflow: auto;">
        <pre style="margin: 0;">
<?php echo join(D4P_EOL, $queries); ?>
        </pre>
    </div>
</div>
