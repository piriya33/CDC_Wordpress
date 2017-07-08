<div class="gdbbx-canned-replies">
    <a role="button" href="#" class="gdbbx-canned-replies-show"><?php _e("Show Canned Replies List", "gd-bbpress-toolbox"); ?></a>
    <a role="button" href="#" class="gdbbx-canned-replies-hide"><?php _e("Hide Canned Replies List", "gd-bbpress-toolbox"); ?></a>

    <fieldset class="gdbbx-canned-replies-list">
        <legend>
            <label><?php _e("Canned Replies", "gd-bbpress-toolbox"); ?>:</label>
        </legend>

        <?php

        $categories = gdbbx_module_canned()->categories();

        if (empty($categories)) {
            $replies = gdbbx_module_canned()->replies();

            if ($replies->have_posts()) {
                echo '<ul>';

                while ($replies->have_posts()) {
                    $replies->the_post();

                    include(gdbbx_get_template_part('gdbbx-single-canned-reply.php'));
                }

                echo '</ul>';
            }
        } else {
            $replies = gdbbx_module_canned()->replies(-1);

            if ($replies->have_posts()) {
                echo '<h4 class="gdbbx-canned-category">'.__("Uncategorized", "gd-bbpress-toolbox").'</h4>';
                echo '<ul>';

                while ($replies->have_posts()) {
                    $replies->the_post();

                    include(gdbbx_get_template_part('gdbbx-single-canned-reply.php'));
                }

                echo '</ul>';
            }

            foreach ($categories as $cat) {
                $replies = gdbbx_module_canned()->replies($cat->term_id);

                if ($replies->have_posts()) {
                    echo '<h4 class="gdbbx-canned-category">'.$cat->name.'</h4>';
                    echo '<ul>';

                    while ($replies->have_posts()) {
                        $replies->the_post();

                        include(gdbbx_get_template_part('gdbbx-single-canned-reply.php'));
                    }

                    echo '</ul>';
                }
            }
        }

        wp_reset_postdata();

        ?>
    </fieldset>
</div>