<?php include_once('parts/header.php' ); ?>
<div class="wrap" style="
     position: relative;
     margin: 25px 40px 0 20px;
     max-width: 1200px;">
     <?php
     $wp_list_table = new QLWCDC_Suggestions_List_Table();
     $wp_list_table->prepare_items();
     ?>
  <form id="plugin-filter" method="post" class="importer-item">
    <?php $wp_list_table->display(); ?>
  </form>
</div>