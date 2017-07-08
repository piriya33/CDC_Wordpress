<div id="bbp-user-welcome" class="gdbbx-forum-index-block">
    <div class="bbp-forums-inner-block">
        <h4><?php _e("Welcome back", "gd-bbpress-toolbox"); ?></h4>

        <p><?php

        $_user_visit = gdbbx_module_front()->user_visit();

        echo sprintf(
                __("There have been %s and %s since your last visit at %s on %s.", "gd-bbpress-toolbox"),
                sprintf(_n("%s new topic", "%s new topics", $_user_visit['topics'], "gd-bbpress-toolbox"), $_user_visit['topics']),
                sprintf(_n("%s new reply", "%s new replies", $_user_visit['replies'], "gd-bbpress-toolbox"), $_user_visit['replies']),
                $_user_visit['time'],
                $_user_visit['date']);

        ?></p>

        <?php

        if (gdbbx_module_front()->get_welcome('links')) {
            
        ?>

        <p><?php echo join(' &middot; ', gdbbx_module_front()->user_links()); ?></p>

        <?php

        }

        ?>
    </div>
</div>
