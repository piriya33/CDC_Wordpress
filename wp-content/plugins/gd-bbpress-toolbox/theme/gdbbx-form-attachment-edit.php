<fieldset class="bbp-form">
    <legend><?php _e("Current Attachments", "gd-bbpress-toolbox"); ?>:</legend>
    <div>
        <div class="bbp-attachments-form-current">
            <?php echo $this->embed_attachments_edit($attachments, $id); ?>
        </div>
    </div>
</fieldset>