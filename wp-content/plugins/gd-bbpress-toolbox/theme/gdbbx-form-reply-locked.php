<?php if (bbp_is_reply_edit()) : ?>

<div id="bbpress-forums">

    <?php bbp_breadcrumb(); ?>

<?php endif; ?>

    <div id="new-reply-<?php bbp_topic_id(); ?>" class="bbp-reply-form">
        <div class="bbp-template-notice">
            <p><?php echo gdbbx()->get('reply_form_message', 'lock'); ?></p>
        </div>
    </div>
    
<?php if (bbp_is_reply_edit()) : ?>

</div>

<?php endif; 