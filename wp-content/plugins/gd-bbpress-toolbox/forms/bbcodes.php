<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("BBCodes Index", "gd-bbpress-toolbox"), 'icon' => 'pencil-square', 'type' => 'index',
        'info' => __("Settings for BBCodes and lists of available BBCodes.", "gd-bbpress-toolbox")),
    'bbcodes_basic' => array(
        'title' => __("General", "gd-bbpress-toolbox"), 'icon' => 'pencil-square', 'type' => 'settings',  
        'break' => __("Settings", "gd-bbpress-toolbox"), 
        'info' => __("These are settings for control basics of BBCodes implementation.", "gd-bbpress-toolbox")),
    'bbcodes_toolbar' => array(
        'title' => __("Toolbar", "gd-bbpress-toolbox"), 'icon' => 'bars', 'type' => 'settings', 
        'info' => __("These are settings for control over BBCodes Toolbar.", "gd-bbpress-toolbox")),
    'bbcodes_single' => array(
        'title' => __("Defaults", "gd-bbpress-toolbox"), 'icon' => 'code', 'type' => 'settings', 
        'info' => __("These are settings for control of individual BBCodes default settings.", "gd-bbpress-toolbox")),
    'bbcodes_disable' => array(
        'title' => __("Disable BBCodes", "gd-bbpress-toolbox"), 'icon' => 'ban', 'type' => 'settings', 
        'info' => __("These are settings for control of individual BBCodes default settings.", "gd-bbpress-toolbox")),
    'standard' => array(
        'title' => __("Standard", "gd-bbpress-toolbox"), 'icon' => 'pencil', 'type' => 'list', 
        'break' => __("BBCodes List", "gd-bbpress-toolbox"), 
        'info' => __("These codes are safe to use and releated to content formatting.", "gd-bbpress-toolbox")),
    'advanced' => array(
        'title' => __("Advanced", "gd-bbpress-toolbox"), 'icon' => 'pencil-square-o', 'type' => 'list', 
        'info' => __("These codes are used embedding external content: videos, links...", "gd-bbpress-toolbox")),
    'restricted' => array(
        'title' => __("Restricted", "gd-bbpress-toolbox"), 'icon' => 'pencil-square', 'type' => 'list', 
        'info' => __("These codes are not available to users, and only administrators can choose to use them.", "gd-bbpress-toolbox"))
);

include(GDBBX_PATH.'forms/shared/top.php');

?>

<form method="post" action="" autocomplete="off">
    <?php settings_fields('gd-bbpress-toolbox-settings'); ?>

    <div class="d4p-content-left">
        <div class="d4p-panel-title">
            <i aria-hidden="true" class="fa fa-pencil-square"></i>
            <h3><?php _e("BBCodes", "gd-bbpress-toolbox"); ?></h3>
            <?php if ($_panel != 'index') { ?>
            <h4><i aria-hidden="true" class="fa fa-<?php echo $panels[$_panel]['icon']; ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
            <?php } ?>
        </div>
        <div class="d4p-panel-info">
            <?php echo $panels[$_panel]['info']; ?>
        </div>
        <?php if ($panels[$_panel]['type'] == 'settings') { ?>
            <div class="d4p-panel-buttons">
                <input type="submit" value="<?php _e("Save Settings", "gd-bbpress-toolbox"); ?>" class="button-primary">
            </div>
        <?php } ?>

        <div class="d4p-return-to-top">
            <a href="#wpwrap"><?php _e("Return to top", "gd-bbpress-toolbox"); ?></a>
        </div>
    </div>
    <div class="d4p-content-right">
        <?php

        if ($_panel == 'index') {
            foreach ($panels as $panel => $obj) {
                if ($panel == 'index') continue;

                $url = 'admin.php?page=gd-bbpress-toolbox-'.$_page.'&panel='.$panel;
                $lab = $obj['type'] == 'settings' ? __("Settings Panel", "gd-bbpress-toolbox") : __("View BBCodes", "gd-bbpress-toolbox");

                if (isset($obj['break'])) { ?>

                    <div style="clear: both"></div>
                    <div class="d4p-panel-break d4p-clearfix">
                        <h4><?php echo $obj['break']; ?></h4>
                    </div>
                    <div style="clear: both"></div>

                <?php } ?>

                <div class="d4p-options-panel">
                    <i aria-hidden="true" class="fa fa-<?php echo $obj['icon']; ?>"></i>
                    <h5><?php echo $obj['title']; ?></h5>
                    <div>
                        <a class="button-primary" href="<?php echo $url; ?>"><?php echo $lab; ?></a>
                    </div>
                </div>

                <?php
            }
        } else {
            if ($panels[$_panel]['type'] == 'settings') {
                require_once(GDBBX_PATH.'d4plib/admin/d4p.functions.php');
                require_once(GDBBX_PATH.'d4plib/admin/d4p.settings.php');

                include(GDBBX_PATH.'core/admin/internal.php');

                $options = new gdbbx_admin_settings();

                $panel = gdbbx_admin()->panel;
                $groups = $options->get($panel);

                $render = new d4pSettingsRender($panel, $groups);
                $render->base = 'gdbbxvalue';
                $render->render();
            } else {
                require_once(GDBBX_PATH.'core/functions/bbcodes.php');

                foreach (gdbbx_get_bbcodes_list() as $code => $obj) {
                    if ((!isset($obj['class']) && $_panel == 'standard') || (isset($obj['class']) && $obj['class'] == $_panel)) { ?>
                        <div class="d4p-group d4p-group-bbcodeslist">
                            <h3>[<?php echo $code; ?>] - <?php echo $obj['title']; ?></h3>
                            <div class="d4p-group-inner">
                                <?php echo join('<br/>', $obj['examples']); ?>
                            </div>
                        </div>
                    <?php }
                }
            }
        }

        ?>
    </div>
</form>

<?php 

include(GDBBX_PATH.'forms/shared/bottom.php');
