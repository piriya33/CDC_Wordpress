<?php

if (!defined('ABSPATH')) exit;

$panels = array(
    'index' => array(
        'title' => __("Modules Index", "gd-bbpress-toolbox"), 'icon' => 'th-large', 
        'info' => __("Settings for plugin modules are listed here, and you access each starting from the right", "gd-bbpress-toolbox")),
    'canned' => array(
        'title' => __("Canned Replies", "gd-bbpress-toolbox"), 'icon' => 'reply', 
        'break' => __("Features", "gd-bbpress-toolbox"), 
        'info' => __("These are settings for control over canned replies.", "gd-bbpress-toolbox")),
    'say_thanks' => array(
        'title' => __("Say Thanks", "gd-bbpress-toolbox"), 'icon' => 'thumbs-up', 
        'info' => __("These are settings for control over thanks for topics and replies.", "gd-bbpress-toolbox")),
    'seo' => array(
        'title' => __("SEO", "gd-bbpress-toolbox"), 'icon' => 'search-plus', 
        'info' => __("These are settings for some basic search engine optimization.", "gd-bbpress-toolbox")),
    'signatures' => array(
        'title' => __("Signatures", "gd-bbpress-toolbox"), 'icon' => 'user', 
        'info' => __("These are settings for user signatures.", "gd-bbpress-toolbox")),
    'quotes' => array(
        'title' => __("Quotes", "gd-bbpress-toolbox"), 'icon' => 'quote-right', 
        'info' => __("These are settings for content quoting feature.", "gd-bbpress-toolbox")),
    'report' => array(
        'title' => __("Report Posts", "gd-bbpress-toolbox"), 'icon' => 'exclamation-triangle', 
        'info' => __("These are settings for content report topics and replies feature.", "gd-bbpress-toolbox")),
    'buddypress' => array(
        'title' => __("BuddyPress", "gd-bbpress-toolbox"), 'icon' => 'd4p-buddypress', 
        'break' => __("Integrations", "gd-bbpress-toolbox"), 
        'info' => __("These settings are for the BuddyPress related features.", "gd-bbpress-toolbox")
    ),
    'lock' => array(
        'title' => __("Forums Locking", "gd-bbpress-toolbox"), 'icon' => 'lock', 
        'break' => __("Privacy and Users Related", "gd-bbpress-toolbox"), 
        'info' => __("These settings can lock down your forums for new topics or replies (useful for maintenance).", "gd-bbpress-toolbox")),
    'privacy' => array(
        'title' => __("Private Topics & Replies", "gd-bbpress-toolbox"), 'icon' => 'user-secret', 
        'info' => __("These settings can be used to add private topics and replies where only administrators and moderators can read and post.", "gd-bbpress-toolbox")),
    'user_stats' => array(
        'title' => __("User Stats", "gd-bbpress-toolbox"), 'icon' => 'user-plus', 
        'info' => __("These settings can be used to add private topics and replies where only administrators and moderators can read and post.", "gd-bbpress-toolbox")),
    'visitors_redirect' => array(
        'title' => __("Visitors Redirect", "gd-bbpress-toolbox"), 'icon' => 'external-link-square', 
        'info' => __("These settings are used to prevent non-logged users (visitors) to view any of the forum pages.", "gd-bbpress-toolbox")),
    'tracking' => array(
        'title' => __("Users Tracking", "gd-bbpress-toolbox"), 'icon' => 'location-arrow', 
        'break' => __("New and Unread Topics Tracking", "gd-bbpress-toolbox"), 
        'info' => __("These settings are used for control over user activity tracking in the forums.", "gd-bbpress-toolbox")),
    'topic_read' => array(
        'title' => __("For Topics", "gd-bbpress-toolbox"), 'icon' => 'd4p-topic', 
        'info' => __("These settings are used to control display of topics activity inside the topics list.", "gd-bbpress-toolbox")),
    'forum_read' => array(
        'title' => __("For Forums", "gd-bbpress-toolbox"), 'icon' => 'd4p-forum', 
        'info' => __("These settings are used to control display of topics activity inside the forums list.", "gd-bbpress-toolbox")),
    'toolbar' => array(
        'title' => __("Toolbar Menu", "gd-bbpress-toolbox"), 'icon' => 'list-alt', 
        'break' => __("Helpers", "gd-bbpress-toolbox"), 
        'info' => __("These are settings for adding forums specific toolbar menu.", "gd-bbpress-toolbox")),
    'disable_rss' => array(
        'title' => __("Disable RSS Feeds", "gd-bbpress-toolbox"), 'icon' => 'rss', 
        'info' => __("These settings are for disabling the RSS feeds for forums and topics.", "gd-bbpress-toolbox"))
);

if (!gdbbx_has_buddypress()) {
    unset($panels['buddypress']);
}

include(GDBBX_PATH.'forms/shared/top.php');

?>

<form method="post" action="">
    <?php settings_fields('gd-bbpress-toolbox-settings'); ?>

    <div class="d4p-content-left">
        <div class="d4p-panel-scroller d4p-scroll-active">
            <div class="d4p-panel-title">
                <i aria-hidden="true" class="fa fa-th-large"></i>
                <h3><?php _e("Modules", "gd-bbpress-toolbox"); ?></h3>
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
        }

        ?>
    </div>
</form>

<?php 

include(GDBBX_PATH.'forms/shared/bottom.php');
