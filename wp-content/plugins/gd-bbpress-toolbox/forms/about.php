<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("About Plugin", "gd-bbpress-toolbox"), 'icon' => 'info-circle', 
        'info' => __("Get more information about this plugin.", "gd-bbpress-toolbox")),
    'changelog' => array(
        'title' => __("Changelog", "gd-bbpress-toolbox"), 'icon' => 'file-text',
        'info' => __("Check out full changelog for this plugin.", "gd-bbpress-toolbox")),
    'translations' => array(
        'title' => __("Translations", "gd-bbpress-toolbox"), 'icon' => 'language',
        'info' => __("List of translations included for this plugin.", "gd-bbpress-toolbox")),
    'dev4press' => array(
        'title' => __("Dev4Press", "gd-bbpress-toolbox"), 'icon' => 'd4p-dev4press',
        'info' => __("Check out other Dev4Press products.", "gd-bbpress-toolbox"))
);

include(GDBBX_PATH.'forms/shared/top.php');

?>

<div class="d4p-content-left">
    <div class="d4p-panel-title">
        <i aria-hidden="true" class="fa fa-info-circle"></i>
        <h3><?php _e("About", "gd-bbpress-toolbox"); ?></h3>
        <?php if ($_panel != 'index') { ?>
            <h4><i aria-hidden="true" class="<?php echo d4p_icon_class($panels[$_panel]['icon']); ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
        <?php } ?>
    </div>
    <div class="d4p-panel-info">
        <?php echo $panels[$_panel]['info']; ?>
    </div>
    <?php if ($_panel == 'index') { ?>
    <div class="d4p-panel-links">
        <a href="admin.php?page=gd-bbpress-toolbox-about&panel=changelog"><i aria-hidden="true" class="fa fa-file-text fa-fw"></i> <?php _e("Changelog", "gd-bbpress-toolbox"); ?></a>
        <a href="admin.php?page=gd-bbpress-toolbox-about&panel=translations"><i aria-hidden="true" class="fa fa-language fa-fw"></i> <?php _e("Translations", "gd-bbpress-toolbox"); ?></a>
        <a href="admin.php?page=gd-bbpress-toolbox-about&panel=dev4press"><i aria-hidden="true" class="d4pi d4p-dev4press d4pi-fw"></i> Dev4Press</a>
    </div>
    <?php } ?>
</div>
<div class="d4p-content-right">
    <?php

        if ($_panel == 'index') {
            include(GDBBX_PATH.'forms/panels/about.php');
        } else {
            include(GDBBX_PATH.'forms/panels/'.$_panel.'.php');
        }

    ?>
</div>

<?php 

include(GDBBX_PATH.'forms/shared/bottom.php');
