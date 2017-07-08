<?php

$message = '';
$list = array();

if ($thanks_list['total'] > $thanks_list['count']) {
    $message = sprintf(__("Total of %s users thanked author for this post. Here are last %s listed.", "gd-bbpress-toolbox"), $thanks_list['total'], $thanks_list['count']);
} else {
    $message = sprintf(_n("%s user thanked author for this post.", "%s users thanked author for this post.", $thanks_list['total'], "gd-bbpress-toolbox"), $thanks_list['total']);
}

foreach ($thanks_list['list'] as $thanks) {
    $user = $thanks->user_id;

    if (get_userdata($user) !== false) {
        $list[] = get_avatar($user, '16').' '.bbp_get_user_profile_link($user);
    }
}

?>
<div class="bbp-said-thanks">
    <h6><?php echo $message; ?></h6>

    <div class="bbp-thanks-list">
        <?php echo join(', ', $list); ?>
    </div>
</div>