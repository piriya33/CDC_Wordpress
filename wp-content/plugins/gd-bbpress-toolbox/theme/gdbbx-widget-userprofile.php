<?php if (is_user_logged_in()) : ?>

<?php if ($instance['show_profile']) { ?>
    <h3 class="d4p-bbp-profile-title">

    <?php bbp_user_profile_link(bbp_get_current_user_id()); ?>

    </h3>
<?php } ?>

<div class="d4p-bbp-profile">
    <div class="d4p-bbp-profile-left">
        <a href="<?php echo esc_url(bbp_get_user_profile_url(bbp_get_current_user_id())); ?>">
            <?php echo get_avatar(bbp_get_current_user_id(), $instance['avatar_size']); ?>
        </a>

        <?php if ($instance['show_edit']) : ?>

        <a href="<?php echo esc_url(bbp_get_user_profile_edit_url(bbp_get_current_user_id())); ?>"><?php _e("edit profile", "gd-bbpress-toolbox"); ?></a>

        <?php endif; ?>

        <?php if ($instance['show_logout']) : ?>

        <a href="<?php echo wp_logout_url(); ?>"><?php _e("log out", "gd-bbpress-toolbox"); ?></a>

        <?php endif; ?>
    </div>
    <div class="d4p-bbp-profile-right">
        <?php

            $profile_data = array();
            $important_links = array();
        
            if ($instance['show_role']) {
                $profile_data['role'] = __("Role", "gd-bbpress-toolbox").': <strong>'.bbp_get_user_display_role(bbp_get_current_user_id()).'</strong>';
            }

            if ($instance['show_stats']) {
                $profile_data['topics'] = __("Topics Started", "gd-bbpress-toolbox").': <strong>'.bbp_get_user_topic_count_raw(bbp_get_current_user_id()).'</strong>';
                $profile_data['replies'] = __("Replies Created", "gd-bbpress-toolbox").': <strong>'.bbp_get_user_reply_count_raw(bbp_get_current_user_id()).'</strong>';
            }

            if ($instance['show_topics']) {
                $important_links['topics'] = '<a href="'.esc_url(bbp_get_user_topics_created_url(bbp_get_current_user_id())).'">'.__("Topics Started", "gd-bbpress-toolbox").'</a>';
            }

            if ($instance['show_replies']) {
                $important_links['replies'] = '<a href="'.esc_url(bbp_get_user_replies_created_url(bbp_get_current_user_id())).'">'.__("Replies Created", "gd-bbpress-toolbox").'</a>';
            }

            if ($instance['show_favorites']) {
                $important_links['favorites'] = '<a href="'.esc_url(bbp_get_favorites_permalink(bbp_get_current_user_id())).'">'.__("Favorites", "gd-bbpress-toolbox").'</a>';
            }

            if ($instance['show_subsciptions']) {
                $important_links['subscriptions'] = '<a href="'.esc_url(bbp_get_subscriptions_permalink(bbp_get_current_user_id())).'">'.__("Subscriptions", "gd-bbpress-toolbox").'</a>';
            }

            $profile_data = apply_filters('gdbbx_userprofile_profile', $profile_data);
            $important_links = apply_filters('gdbbx_userprofile_links', $important_links);

        ?>

        <?php if (!empty($profile_data)) : ?>

        <div class="d4p-bbp-profile-basic">
            <h4><?php _e("Profile", "gd-bbpress-toolbox"); ?></h4>

            <ul>
                <li><?php echo join('</li><li>', $profile_data); ?></li>
            </ul>
        </div>

        <?php endif; ?>

        <?php if (!empty($important_links)) : ?>

        <div class="d4p-bbp-profile-extended">
            <h4><?php _e("Important Links", "gd-bbpress-toolbox"); ?></h4>

            <ul>
                <li><?php echo join('</li><li>', $important_links); ?></li>
            </ul>
        </div>

        <?php endif; ?>
    </div>
</div>

<?php else : ?>

<?php 

    $links = array(
        'login' => '<a href="'.esc_url(wp_login_url()).'">'.__("Log In", "gd-bbpress-toolbox").'</a>'
    );

    if (get_option('users_can_register')) {
        $links['register'] = '<a href="'.esc_url(site_url('wp-login.php?action=register', 'login')).'">'.__("Register", "gd-bbpress-toolbox").'</a>';
    }

    $links = apply_filters('gdbbx_userprofile_login', $links);

?>

<div class="d4p-bbp-profile-login">
    <h3><?php _e("Login &amp; Registration", "gd-bbpress-toolbox"); ?></h3>

    <ul>
        <li><?php echo join('</li><li>', $links); ?></li>
    </ul>
</div>

<?php endif; 