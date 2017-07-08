<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("Settings Index", "gd-bbpress-toolbox"), 'icon' => 'cogs', 
        'info' => __("All plugin settings are split into several panels, and you access each starting from the right.", "gd-bbpress-toolbox")),
    'administration' => array(
        'title' => __("Administration", "gd-bbpress-toolbox"), 'icon' => 'dashboard', 
        'break' => __("Basic Settings", "gd-bbpress-toolbox"), 
        'info' => __("These settings are for enhancing administration side of WordPress and bbPress.", "gd-bbpress-toolbox")),
    'widgets' => array(
        'title' => __("Widgets", "gd-bbpress-toolbox"), 'icon' => 'puzzle-piece', 
        'info' => __("These settings are to control default and plugin added widgets.", "gd-bbpress-toolbox")),
    'standard' => array(
        'title' => __("Standard", "gd-bbpress-toolbox"), 'icon' => 'tasks', 
        'info' => __("These are some common plugin settings that don't fit anywhere else.", "gd-bbpress-toolbox")),
    'forums' => array(
        'title' => __("Forums", "gd-bbpress-toolbox"), 'icon' => 'd4p-forum', 
        'break' => __("Enhance bbPress", "gd-bbpress-toolbox"), 
        'info' => __("These are settings for adding extra features to forums.", "gd-bbpress-toolbox")),
    'topics' => array(
        'title' => __("Topics", "gd-bbpress-toolbox"), 'icon' => 'd4p-topic', 
        'info' => __("These are settings for adding extra features to topics in the forums.", "gd-bbpress-toolbox")),
    'replies' => array(
        'title' => __("Replies", "gd-bbpress-toolbox"), 'icon' => 'd4p-reply', 
        'info' => __("These are settings for adding extra features to replies in the forums.", "gd-bbpress-toolbox")),
    'editors' => array(
        'title' => __("Editors", "gd-bbpress-toolbox"), 'icon' => 'pencil', 
        'info' => __("These are settings for additional control over topic and reply editors.", "gd-bbpress-toolbox")),
    'revisions' => array(
        'title' => __("Revisions", "gd-bbpress-toolbox"), 'icon' => 'calendar-o', 
        'info' => __("These settings are used to control who can view the topic/reply revisions list.", "gd-bbpress-toolbox")),
    'tweaks' => array(
        'title' => __("Various Tweaks", "gd-bbpress-toolbox"), 'icon' => 'check-square', 
        'info' => __("These settings include all sorts of various tweaks for bbPress.", "gd-bbpress-toolbox")),
    'notifications' => array(
        'title' => __("Notifications", "gd-bbpress-toolbox"), 'icon' => 'envelope', 
        'break' => __("Notifications", "gd-bbpress-toolbox"), 
        'info' => __("These are settings for additional notification system settings.", "gd-bbpress-toolbox")),
    'notify_templates' => array(
        'title' => __("Notify Templates", "gd-bbpress-toolbox"), 'icon' => 'envelope-o', 
        'info' => __("These are settings for control over notifications content sent to users.", "gd-bbpress-toolbox")),
    'files' => array(
        'title' => __("JS/CSS Files", "gd-bbpress-toolbox"), 'icon' => 'file-code-o', 
        'break' => __("Advanced", "gd-bbpress-toolbox"), 
        'info' => __("These settings control JavaScript and CSS files used by the plugin.", "gd-bbpress-toolbox")),
    'objects' => array(
        'title' => __("Objects", "gd-bbpress-toolbox"), 'icon' => 'thumb-tack', 
        'info' => __("These settings are for expanding post types registered by bbPress for forums, topics and replies.", "gd-bbpress-toolbox")),
    'advanced' => array(
        'title' => __("Additional", "gd-bbpress-toolbox"), 'icon' => 'warning', 
        'info' => __("These settings are for the features that are not used very often and only for experienced users.", "gd-bbpress-toolbox"))
);

include(GDBBX_PATH.'forms/shared/top.php');

?>

<form method="post" action="" id="gdbbx-form-settings">
    <?php settings_fields('gd-bbpress-toolbox-settings'); ?>

    <div class="d4p-content-left">
        <div class="d4p-panel-scroller d4p-scroll-active">
            <div class="d4p-panel-title">
                <i aria-hidden="true" class="fa fa-cogs"></i>
                <h3><?php _e("Settings", "gd-bbpress-toolbox"); ?></h3>
                <?php if ($_panel != 'index') { ?>
                <h4><i aria-hidden="true" class="<?php echo d4p_icon_class($panels[$_panel]['icon']); ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
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
                    <i aria-hidden="true" class="<?php echo d4p_icon_class($obj['icon']); ?>"></i>
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

            ?>

            <div class="clear"></div>
            <div style="padding-top: 15px; border-top: 1px solid #777; max-width: 800px;">
                <input type="submit" value="<?php _e("Save Settings", "gd-bbpress-toolbox"); ?>" class="button-primary">
            </div>

            <?php

        }

        ?>
    </div>
</form>

<?php 

include(GDBBX_PATH.'forms/shared/bottom.php');
