<div class="gdbbx-online-status">
    <?php $online = gdbbx_module_tracking()->online(); ?>

    <p>
        <?php echo sprintf(_n("There is <strong>%s</strong> user online", "There are <strong>%s</strong> users online", $online['counts']['total'], "gd-bbpress-toolbox"), $online['counts']['total']); ?> - 
        <?php echo sprintf(_n("<strong>%s</strong> registered", "<strong>%s</strong> registered", $online['counts']['users'], "gd-bbpress-toolbox"), $online['counts']['users']); ?>, 
        <?php echo sprintf(_n("<strong>%s</strong> guest", "<strong>%s</strong> guests", $online['counts']['guests'], "gd-bbpress-toolbox"), $online['counts']['guests']); ?>.
    </p>

    <?php

    $_roles = bbp_get_dynamic_roles();
    $_users = gdbbx_get_online_users_list(0, true, 'profile_link');

    foreach ($_users as $role => $users) {

        ?>

            <p>
                <strong><?php echo $_roles[$role]['name']; ?></strong><br/>
                <?php echo join(', ', $users); ?>
            </p>

        <?php

    }

    ?>
</div>
