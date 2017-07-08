<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("About Plugin", "dev4press-updater"), 'icon' => 'info-circle', 
        'info' => __("Get more information about this plugin.", "dev4press-updater")),
    'changelog' => array(
        'title' => __("Changelog", "dev4press-updater"), 'icon' => 'file-text',
        'info' => __("Check out full changelog for this plugin.", "dev4press-updater")),
    'translations' => array(
        'title' => __("Translations", "dev4press-updater"), 'icon' => 'language',
        'info' => __("List of translations included for this plugin.", "dev4press-updater")),
    'dev4press' => array(
        'title' => __("Dev4Press", "dev4press-updater"), 'icon' => 'd4p-dev4press',
        'info' => __("Check out other Dev4Press products.", "dev4press-updater"))
);

include(D4PUPD_PATH.'forms/shared/top.php');

?>

<div class="d4p-content-left">
    <div class="d4p-panel-title">
        <i aria-hidden="true" class="fa fa-info-circle"></i>
        <h3><?php _e("About", "dev4press-updater"); ?></h3>
        <?php if ($_panel != 'index') { ?>
            <h4><i aria-hidden="true" class="<?php echo d4p_icon_class($panels[$_panel]['icon']); ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
        <?php } ?>
    </div>
    <div class="d4p-panel-info">
        <?php echo $panels[$_panel]['info']; ?>
    </div>
    <?php if ($_panel == 'index') { ?>
    <div class="d4p-panel-links">
        <a href="admin.php?page=dev4press-updater-about&panel=changelog"><i aria-hidden="true" class="fa fa-file-text fa-fw"></i> <?php _e("Changelog", "dev4press-updater"); ?></a>
        <a href="admin.php?page=dev4press-updater-about&panel=translations"><i aria-hidden="true" class="fa fa-language fa-fw"></i> <?php _e("Translations", "dev4press-updater"); ?></a>
        <a href="admin.php?page=dev4press-updater-about&panel=dev4press"><i aria-hidden="true" class="d4pi d4p-dev4press d4pi-fw"></i> Dev4Press</a>
    </div>
    <?php } ?>
</div>
<div class="d4p-content-right">
    <?php

        if ($_panel == 'index') {
            include(D4PUPD_PATH.'forms/panels/about.php');
        } else {
            include(D4PUPD_PATH.'forms/panels/'.$_panel.'.php');
        }

    ?>
</div>

<?php 

include(D4PUPD_PATH.'forms/shared/bottom.php');
