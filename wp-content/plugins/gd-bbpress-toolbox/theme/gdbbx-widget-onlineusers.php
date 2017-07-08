<div class="gdbbx-online-status">
    <?php $online = gdbbx_module_tracking()->online(); ?>

    <p class="gdbbx-online-current">
        <?php echo sprintf(_n("There is <strong>%s</strong> user online", "There are <strong>%s</strong> users online", $online['counts']['total'], "gd-bbpress-toolbox"), $online['counts']['total']); ?> - 
        <?php echo sprintf(_n("<strong>%s</strong> registered", "<strong>%s</strong> registered", $online['counts']['users'], "gd-bbpress-toolbox"), $online['counts']['users']); ?>, 
        <?php echo sprintf(_n("<strong>%s</strong> guest", "<strong>%s</strong> guests", $online['counts']['guests'], "gd-bbpress-toolbox"), $online['counts']['guests']); ?>.
    </p>

    <?php

    if ($instance['show_users_list']) {
        $_roles = bbp_get_dynamic_roles();
        $_users = gdbbx_get_online_users_list(
            $instance['show_users_limit'], 
            $instance['show_users_avatar'], 
            $instance['show_users']
        );

        if (!empty($_users)) {
            if ($instance['show_user_roles']) {
                foreach ($_users as $role => $users) {

                    ?>

                        <p>
                            <strong><?php echo $_roles[$role]['name']; ?></strong><br/>
                            <?php echo join(', ', $users); ?>
                        </p>

                    <?php

                }
            } else {
                $all_users = array();
                foreach ($_users as $users) {
                    $all_users = array_merge($all_users, $users);
                }

                ?>

                <p>
                    <strong><?php _e("Users online", "gd-bbpress-toolbox") ?></strong><br/>
                    <?php echo join(', ', $all_users); ?>
                </p>

                <?php

            }
        }
    }

    ?>

    <?php if ($instance['show_max_users']) { ?>
        <?php $max = gdbbx_module_tracking()->max(); ?>

        <p class="gdbbx-online-maximum">
            <?php echo sprintf(__("Most users ever online was <strong>%s</strong> on %s.", "gd-bbpress-toolbox"), $max['total']['count'], date_i18n(get_option('date_format').', '.get_option('time_format'), $max['total']['timestamp'])); ?>
        </p>
    <?php } ?>
</div>