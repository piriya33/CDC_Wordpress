<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("Tools Index", "gd-bbpress-toolbox"), 'icon' => 'wrench', 
        'info' => __("All plugin tools are split into several panels, and you access each starting from the right.", "gd-bbpress-toolbox")),
    'close' => array(
        'title' => __("Close Topics", "gd-bbpress-toolbox"), 'icon' => 'eye-slash', 
        'break' => __("bbPress", "gd-bbpress-toolbox"), 
        'button' => 'submit', 'button_text' => __("Close", "gd-bbpress-toolbox"),
        'info' => __("Close old and inactive topics.", "gd-bbpress-toolbox")),
    'updater' => array(
        'title' => __("Recheck and Update", "gd-bbpress-toolbox"), 'icon' => 'refresh', 
        'break' => __("Maintenance", "gd-bbpress-toolbox"), 
        'button' => 'none', 'button_text' => '',
        'info' => __("Recheck plugin database tables and update plugin settings.", "gd-bbpress-toolbox")),
    'export' => array(
        'title' => __("Export Settings", "gd-bbpress-toolbox"), 'icon' => 'download', 
        'button' => 'button', 'button_text' => __("Export", "gd-bbpress-toolbox"),
        'info' => __("Export all plugin settings into file.", "gd-bbpress-toolbox")),
    'import' => array(
        'title' => __("Import Settings", "gd-bbpress-toolbox"), 'icon' => 'upload', 
        'button' => 'submit', 'button_text' => __("Import", "gd-bbpress-toolbox"),
        'info' => __("Import all plugin settings from export file.", "gd-bbpress-toolbox")),
    'remove' => array(
        'title' => __("Remove Settings", "gd-bbpress-toolbox"), 'icon' => 'refresh', 
        'button' => 'submit', 'button_text' => __("Remove", "gd-bbpress-toolbox"),
        'info' => __("Remove selected plugin settings and information.", "gd-bbpress-toolbox")),
    'wp44_update' => array(
        'title' => "WordPress 4.4", 'icon' => 'wordpress', 
        'break' => __("Update", "gd-bbpress-toolbox"), 
        'button' => 'submit', 'button_text' => __("Update", "gd-bbpress-toolbox"),
        'info' => __("Update topics and replies content to resolve problems with WordPress 4.4 update.", "gd-bbpress-toolbox"))
);

if (gdbbx_settings()->get('wp44_update', 'core')) {
    unset($panels['wp44_update']);
}

include(GDBBX_PATH.'forms/shared/top.php');

?>

<form method="post" action="" enctype="multipart/form-data">
    <?php settings_fields('gd-bbpress-toolbox-tools'); ?>
    <input type="hidden" value="<?php echo $_panel; ?>" name="gdbbxtools[panel]" />

    <div class="d4p-content-left">
        <div class="d4p-panel-title">
            <i aria-hidden="true" class="fa fa-wrench"></i>
            <h3><?php _e("Tools", "gd-bbpress-toolbox"); ?></h3>
            <?php if ($_panel != 'index') { ?>
            <h4><i aria-hidden="true" class="fa fa-<?php echo $panels[$_panel]['icon']; ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
            <?php } ?>
        </div>
        <div class="d4p-panel-info">
            <?php echo $panels[$_panel]['info']; ?>
        </div>
        <?php if ($_panel != 'index' && $panels[$_panel]['button'] != 'none') { ?>
            <div class="d4p-panel-buttons">
                <input id="gdbbx-tool-<?php echo $_panel; ?>" class="button-primary" type="<?php echo $panels[$_panel]['button']; ?>" value="<?php echo $panels[$_panel]['button_text']; ?>" />
            </div>
        <?php } ?>
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
                        <a class="button-primary" href="<?php echo $url; ?>"><?php _e("Tools Panel", "gd-bbpress-toolbox"); ?></a>
                    </div>
                </div>

                <?php
            }
        } else {
            include(GDBBX_PATH.'forms/panels/'.$_panel.'.php');

            if ($_panel != 'index' && $_panel != 'export' && $panels[$_panel]['button'] != 'none') {

            ?>

            <div class="clear"></div>
            <div style="padding-top: 15px; border-top: 1px solid #777; max-width: 800px;">
                <input id="gdbbx-tool-<?php echo $_panel; ?>-sec" class="button-primary" type="<?php echo $panels[$_panel]['button']; ?>" value="<?php echo $panels[$_panel]['button_text']; ?>" />
            </div>

            <?php

            }
        }

        ?>
    </div>
</form>

<?php 

include(GDBBX_PATH.'forms/shared/bottom.php');
