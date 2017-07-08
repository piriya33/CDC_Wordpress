<?php

function gdbbx_select_forum_settings() {
    return array(
        'default' => __("Default", "gd-bbpress-toolbox"),
        'inherit' => __("Inherit", "gd-bbpress-toolbox"),
        'yes' => __("Yes", "gd-bbpress-toolbox"),
        'no' => __("No", "gd-bbpress-toolbox")
    );
}

function gdbbx_select_forum_override() {
    return array(
        'default' => __("Default", "gd-bbpress-toolbox"),
        'inherit' => __("Inherit", "gd-bbpress-toolbox"),
        'yes' => __("Override", "gd-bbpress-toolbox")
    );
}

global $post_ID, $_meta;

$tabs = apply_filters('gdbbx_admin_toolbox_meta', array(
    'attachments' => __("Attachments", "gd-bbpress-toolbox"),
    'privacy' => __("Privacy", "gd-bbpress-toolbox"),
    'locking' => __("Locking", "gd-bbpress-toolbox")
));

$_meta = get_post_meta($post_ID, '_gdbbx_settings', true);

if (!is_array($_meta)) {
    $_meta = gdbbx_default_forum_settings();
} else {
    $_meta = wp_parse_args($_meta, gdbbx_default_forum_settings());
}

?>
<div class="d4plib-metabox-wrapper">
    <input type="hidden" name="gdbbx_forum_settings" value="edit" />

    <ul class="wp-tab-bar">
        <?php

        $active = true;
        foreach ($tabs as $tab => $label) {
            echo '<li class="'.($active ? 'wp-tab-active' : '').'"><a href="#gdbbx-meta-'.$tab.'">'.$label.'</a></li>';

            $active = false;
        }

        ?>
    </ul>
    <?php

    $active = true;
    foreach ($tabs as $tab => $label) {
        echo '<div id="gdbbx-meta-'.$tab.'" class="wp-tab-panel '.($active ? 'tabs-panel-active' : 'tabs-panel-inactive').'">';

        do_action('gdbbx_admin_toolbox_meta_content_'.$tab, $post_ID);

        echo '</div>';

        $active = false;
    }

    ?>
</div>
<script type="text/javascript">
(function($, window, document) {
    $(".d4plib-metabox-wrapper .gdbbx-override").change(function(){
        var sel = $(this).val(),
            target = $(this).parent().next();

        if (sel === "yes") {
            target.slideDown();
        } else {
            target.slideUp();
        }
    });
}(window.jQuery, window, document));
</script>