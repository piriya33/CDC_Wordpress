<h4><?php _e("Select Statistics", "gd-bbpress-toolbox"); ?></h4>
<table>
    <tbody>
        <tr>
            <td class="cell-singular">
                <div class="d4plib-checkbox-list gdbbx-stats-list">
                    <ul class="gdbbx-stats-ul">
                    <?php

                    $_act = (array)$instance['stats'];
                    $_all = gdbbx_list_of_statistics_elements();

                    foreach ($_act as $stat) {
                        $title = $_all[$stat];

                        echo sprintf('<li class="bbx-stat-item-%s" data-stat="%s"><label><input type="checkbox" name="%s[]" value="%s"%s />%s</label></li>',
                                $stat, $stat, $this->get_field_name('stats'), $stat, 'checked="checked"', $title);
                    }

                    foreach ($_all as $stat => $title) {
                        if (!in_array($stat, $_act) || empty($_act)) {
                            echo sprintf('<li class="bbx-stat-item-%s" data-stat="%s"><label><input type="checkbox" name="%s[]" value="%s"%s />%s</label></li>',
                                    $stat, $stat, $this->get_field_name('stats'), $stat, '', $title);
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
    jQuery("a.gdbbx-tab-topics-stats.d4plib-tab-active").click();
});
</script>