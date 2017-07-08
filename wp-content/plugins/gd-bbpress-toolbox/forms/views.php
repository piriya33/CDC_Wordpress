<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("Settings Index", "gd-bbpress-toolbox"), 'icon' => 'cogs', 
        'info' => __("All plugin settings are split into several panels, and you access each starting from the right.", "gd-bbpress-toolbox")),
    'views_settings' => array(
        'title' => __("Views Settings", "gd-bbpress-toolbox"), 'icon' => 'file-o', 
        'break' => __("Settings", "gd-bbpress-toolbox"), 
        'info' => __("These are settings for additional controll over added views.", "gd-bbpress-toolbox")),
    'views_basic' => array(
        'title' => __("Basic Views", "gd-bbpress-toolbox"), 'icon' => 'files-o', 
        'break' => __("Views Control", "gd-bbpress-toolbox"), 
        'info' => __("These are settings for controlling additional topic views.", "gd-bbpress-toolbox")),
    'views_personal' => array(
        'title' => __("Personal Views", "gd-bbpress-toolbox"), 'icon' => 'files-o', 
        'info' => __("These are settings for controlling additional topic views.", "gd-bbpress-toolbox")),
    'views_time' => array(
        'title' => __("New Posts Views", "gd-bbpress-toolbox"), 'icon' => 'files-o', 
        'info' => __("These are settings for controlling additional topic views.", "gd-bbpress-toolbox"))
);

include(GDBBX_PATH.'forms/shared/top.php');

?>

<form method="post" action="">
    <?php settings_fields('gd-bbpress-toolbox-settings'); ?>

    <div class="d4p-content-left">
        <div class="d4p-panel-scroller d4p-scroll-active">
            <div class="d4p-panel-title">
                <i aria-hidden="true" class="fa fa-files-o"></i>
                <h3><?php _e("Views", "gd-bbpress-toolbox"); ?></h3>
                <?php if ($_panel != 'index') { ?>
                <h4><i aria-hidden="true" class="fa fa-<?php echo $panels[$_panel]['icon']; ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
                <?php } ?>
            </div>
            <div class="d4p-panel-info">
                <?php echo $panels[$_panel]['info']; ?>
            </div>
            <?php if ($_panel != 'index') { ?>
                <div class="d4p-panel-buttons">
                    <input type="submit" value="<?php _e("Save Settings", "gd-bbpress-toolbox"); ?>" class="button-primary">
                </div>
            <?php } ?>
            <div class="d4p-return-to-top">
                <a href="#wpwrap"><?php _e("Return to top", "gd-bbpress-toolbox"); ?></a>
            </div>
        </div>
    </div>
    <div class="d4p-content-right">
        <?php

        if ($_panel == 'index') {
            foreach ($panels as $panel => $obj) {
                if ($panel == 'index') continue;

                $url = 'admin.php?page=gd-bbpress-toolbox-'.$_page.'&panel='.$panel;

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
                        <a class="button-primary" href="<?php echo $url; ?>"><?php _e("Settings Panel", "gd-bbpress-toolbox"); ?></a>
                    </div>
                </div>
        
                <?php
            }
        } else {
            require_once(GDBBX_PATH.'d4plib/admin/d4p.functions.php');
            require_once(GDBBX_PATH.'d4plib/admin/d4p.settings.php');

            include(GDBBX_PATH.'core/admin/internal.php');

            $options = new gdbbx_admin_settings();

            $panel = gdbbx_admin()->panel;
            $groups = $options->get($panel);

            $render = new d4pSettingsRender($panel, $groups);
            $render->base = 'gdbbxvalue';
            $render->render();
        }

        ?>
    </div>
</form>

<?php 

include(GDBBX_PATH.'forms/shared/bottom.php');
