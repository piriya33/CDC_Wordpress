<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("Attachments Index", "gd-bbpress-toolbox"), 'icon' => 'paperclip', 
        'info' => __("Attachment settings are split into several panels, and you access each starting from the right.", "gd-bbpress-toolbox")),
    'attachments' => array(
        'title' => __("General", "gd-bbpress-toolbox"), 'icon' => 'archive', 
        'break' => __("Settings", "gd-bbpress-toolbox"), 
        'info' => __("These are basic settings for control over attachments in the forums.", "gd-bbpress-toolbox")),
    'attachments_integration' => array(
        'title' => __("Integration", "gd-bbpress-toolbox"), 'icon' => 'sliders', 
        'info' => __("These are settings for control over attachments integration into bbPress.", "gd-bbpress-toolbox")),
    'attachments_images' => array(
        'title' => __("Images", "gd-bbpress-toolbox"), 'icon' => 'image', 
        'info' => __("These are settings for control over image based attachments display.", "gd-bbpress-toolbox")),
    'attachments_mime' => array(
        'title' => __("Allowed Types", "gd-bbpress-toolbox"), 'icon' => 'file-o', 
        'info' => __("Here you can select which MIME types are allowed for upload.", "gd-bbpress-toolbox")),
    'attachments_advanced' => array(
        'title' => __("Advanced", "gd-bbpress-toolbox"), 'icon' => 'flag', 
        'info' => __("These are settings for additional attachments features.", "gd-bbpress-toolbox")),
    'attachments_deletion' => array(
        'title' => __("Deletion", "gd-bbpress-toolbox"), 'icon' => 'trash', 
        'info' => __("These are settings for options related to attachments deletion.", "gd-bbpress-toolbox")),
    'mimetypes' => array(
        'title' => __("Extra MIME Types", "gd-bbpress-toolbox"), 'icon' => 'file', 
        'break' => __("MIME", "gd-bbpress-toolbox"), 
        'info' => __("From here you can add additional MIME Types (file extensions) for attachments upload.", "gd-bbpress-toolbox"))
);

include(GDBBX_PATH.'forms/shared/top.php');

?>

<form method="post" action="">
    <?php settings_fields('gd-bbpress-toolbox-settings'); ?>

    <div class="d4p-content-left">
        <div class="d4p-panel-scroller d4p-scroll-active">
            <div class="d4p-panel-title">
                <i aria-hidden="true" class="fa fa-paperclip"></i>
                <h3><?php _e("Attachments", "gd-bbpress-toolbox"); ?></h3>
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
