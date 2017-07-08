<?php

if (!defined('ABSPATH')) exit;

$_classes = array('d4p-wrap', 'wpv-'.GDBBX_WPV, 'd4p-page-update');

?>
<div class="<?php echo join(' ', $_classes); ?>">
    <div class="d4p-header">
        <div class="d4p-plugin">
            GD bbPress Toolbox Pro
        </div>
    </div>
    <div class="d4p-content">
        <div class="d4p-content-left">
            <div class="d4p-panel-title">
                <i aria-hidden="true" class="fa fa-magic"></i>
                <h3><?php _e("Update", "gd-bbpress-toolbox"); ?></h3>
            </div>
            <div class="d4p-panel-info">
                <?php _e("Before you continue, make sure plugin was successfully updated.", "gd-bbpress-toolbox"); ?>
            </div>
        </div>
        <div class="d4p-content-right">
            <div class="d4p-update-info">
                <?php include(GDBBX_PATH.'forms/panels/db.php'); ?>

                <h3><?php _e("All Done", "gd-bbpress-toolbox"); ?></h3>
                <?php

                    gdbbx()->set('install', false, 'info');
                    gdbbx()->set('update', false, 'info', true);

                    _e("Update completed.", "gd-bbpress-toolbox");

                ?>
                <br/><br/><a class="button-primary" href="<?php echo d4p_current_url(); ?>"><?php _e("Click here to continue.", "gd-bbpress-toolbox"); ?></a>

                <h3 style="margin: 20px 0;"><?php _e("Important Notice", "gd-bbpress-toolbox"); ?></h3>
                <?php _e("Before you can use the plugin, clear the website and browser cache to make sure that latest JS and CSS files are loaded.", "gd-bbpress-toolbox"); ?>

                <?php if (!gdbbx_settings()->get('wp44_update', 'core')) { ?>

                    <h3 style="margin: 20px 0;"><?php _e("WordPress 4.4 Update", "gd-bbpress-toolbox"); ?></h3>
                    <?php _e("WordPress 4.4 introduced some changes in the way it parses shortcodes, and this affected some of the BBCodes added by GD bbPress Toolbox Pro.", "gd-bbpress-toolbox"); ?>
                    <br/><br/><a class="button-secondary" href="admin.php?page=gd-bbpress-toolbox-tools&panel=wp44_update"><?php _e("Click here to run Update tool.", "gd-bbpress-toolbox"); ?></a>

                <?php } ?>
            </div>
            <?php echo gdbbx_plugin()->recommend('update'); ?>
        </div>
    </div>
</div>
