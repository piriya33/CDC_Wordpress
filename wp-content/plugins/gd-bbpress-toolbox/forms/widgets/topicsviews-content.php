<h4><?php _e("Select Views to Show", "gd-bbpress-toolbox"); ?></h4>
<table>
    <tbody>
        <tr>
            <td class="cell-singular">
                <div class="d4plib-checkbox-list gdbbx-views-list">
                    <ul class="gdbbx-views-ul">
                    <?php

                    $_act = (array)$instance['views'];
                    $_all = array_keys(bbp_get_views());

                    foreach ($_act as $view) {
                        echo sprintf('<li class="bbx-view-item-%s" data-view="%s"><label><input type="checkbox" name="%s[]" value="%s"%s />%s</label></li>',
                                $view, $view, $this->get_field_name('views'), $view, 'checked="checked"', bbp_get_view_title($view));
                    }

                    foreach ($_all as $view) {
                        if (!in_array($view, $_act) || empty($_act)) {
                            echo sprintf('<li class="bbx-view-item-%s" data-view="%s"><label><input type="checkbox" name="%s[]" value="%s"%s />%s</label></li>',
                                    $view, $view, $this->get_field_name('views'), $view, '', bbp_get_view_title($view));
                        }
                    }

                    ?>
                    </ul>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery("a.gdbbx-tab-topics-views.d4plib-tab-active").click();
});
</script>