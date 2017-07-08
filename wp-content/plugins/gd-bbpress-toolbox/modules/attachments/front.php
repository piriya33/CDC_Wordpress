<?php

if (!defined('ABSPATH')) exit;

class gdbbxAttachments_Front {
    public $enabled = false;
    public $file_size = 0;

    private $icons = array(
        'code' => 'c|cc|h|js|class|json', 
        'xml' => 'xml', 
        'excel' => 'xla|xls|xlsx|xlt|xlw|xlam|xlsb|xlsm|xltm', 
        'word' => 'docx|dotx|docm|dotm', 
        'image' => 'png|gif|jpg|jpeg|jpe|jp|bmp|tif|tiff', 
        'psd' => 'psd', 
        'ai' => 'ai', 
        'archive' => 'zip|rar|gz|gzip|tar',
        'text' => 'txt|asc|nfo', 
        'powerpoint' => 'pot|pps|ppt|pptx|ppam|pptm|sldm|ppsm|potm', 
        'pdf' => 'pdf', 
        'html' => 'htm|html|css', 
        'video' => 'avi|asf|asx|wax|wmv|wmx|divx|flv|mov|qt|mpeg|mpg|mpe|mp4|m4v|ogv|mkv', 
        'documents' => 'odt|odp|ods|odg|odc|odb|odf|wp|wpd|rtf',
        'audio' => 'mp3|m4a|m4b|mp4|m4v|wav|ra|ram|ogg|oga|mid|midi|wma|mka',
        'icon' => 'ico'
    );

    private $fonti = array(
        'file-code-o' => 'code|xml|html',
        'file-picture-o' => 'image|psd|ai|icon',
        'file-pdf-o' => 'pdf',
        'file-excel-o' => 'excel',
        'file-word-o' => 'word',
        'file-powerpoint-o' => 'powerpoint',
        'file-text-o' => 'text|documents',
        'file-video-o' => 'video',
        'file-archive-o' => 'archive',
        'file-audio-o' => 'audio',
        'file-o' => 'generic'
    );

    function __construct() {
        add_action('gdbbx_core', array($this, 'load'));
    }

    public function load() {
        $this->icons = apply_filters('gdbbx_attachments_icons_sets', $this->icons);
        $this->fonti = apply_filters('gdbbx_attachments_font_icons_sets', $this->fonti);

        add_filter('gdbbx_script_values', array($this, 'script_values'));
        add_action('gdbbx_attachments_form_notices', array($this, 'form_notices'));

        add_action(gdbbx()->get('form_position_reply', 'attachments'), array($this, 'embed_form'));
        add_action(gdbbx()->get('form_position_topic', 'attachments'), array($this, 'embed_form'));

        add_action('bbp_edit_reply', array($this, 'save_reply'), 10, 5);
        add_action('bbp_edit_topic', array($this, 'save_topic'), 10, 4);
        add_action('bbp_new_reply', array($this, 'save_reply'), 10, 5);
        add_action('bbp_new_topic', array($this, 'save_topic'), 10, 4);

        $this->add_content_filters();

        if (gdbbx()->get('attachment_icon', 'attachments')) {
            add_action('bbp_theme_before_topic_title', array($this, 'show_attachments_icon'), 20);
        }
    }

    public function add_content_filters() {
        if (!$this->enabled) {
            $this->enabled = true;

            if (gdbbx()->get('files_list_position', 'attachments') == 'content') {
                add_filter('bbp_get_reply_content', array($this, 'embed_attachments'), 100, 2);
                add_filter('bbp_get_topic_content', array($this, 'embed_attachments'), 100, 2);
            } else if (gdbbx()->get('files_list_position', 'attachments') == 'after') {
                add_action('bbp_theme_after_topic_content', array($this, 'after_attachments'), 20);
                add_action('bbp_theme_after_reply_content', array($this, 'after_attachments'), 20);
            }
        }
    }

    public function remove_content_filters() {
        $this->enabled = false;

        remove_filter('bbp_get_topic_content', array($this, 'embed_attachments'), 100, 2);
        remove_filter('bbp_get_reply_content', array($this, 'embed_attachments'), 100, 2);
    }

    public function script_values($values) {
        $values['run_attachments'] = true;
        $values['validate_attachments'] = gdbbx_attachments()->get('validation_active');
        $values['insert_into_content'] = gdbbx_attachments()->get('insert_into_content');
        $values['max_files'] = gdbbx_attachments()->get_max_files();
        $values['max_size'] = gdbbx_attachments()->get_file_size() * 1024;
        $values['limiter'] = !gdbbx_attachments()->is_no_limit();
        $values['allowed_extensions'] = strtolower(join(' ', gdbbx_attachments()->get_file_extensions()));
        $values['text_select_file'] = __("Select File", "gd-bbpress-toolbox");
        $values['text_file_name'] = __("Name", "gd-bbpress-toolbox");
        $values['text_file_size'] = __("Size", "gd-bbpress-toolbox");
        $values['text_file_type'] = __("Extension", "gd-bbpress-toolbox");
        $values['text_file_validation'] = __("Error!", "gd-bbpress-toolbox");
        $values['text_file_validation_size'] = __("The file is too big.", "gd-bbpress-toolbox");
        $values['text_file_validation_type'] = __("File type not allowed.", "gd-bbpress-toolbox");
        $values['text_file_remove'] = __("Remove this file", "gd-bbpress-toolbox");
        $values['text_file_shortcode'] = __("Insert into content", "gd-bbpress-toolbox");
        $values['text_file_caption'] = __("Set file caption", "gd-bbpress-toolbox");
        $values['text_file_caption_placeholder'] = __("Caption...", "gd-bbpress-toolbox");

        return $values;
    }

    public function form_notices() {
        if (gdbbx_attachments()->is_no_limit()) {
            echo '<div class="bbp-template-notice info"><p>'.__("Your account has the ability to upload any attachment regardless of size and type.", "gd-bbpress-toolbox").'</p></div>';
        } else {
            $file_size = d4p_file_size_format($this->file_size * 1024, 2);

            echo '<div class="bbp-template-notice"><p>'.__("Maximum file size allowed is", "gd-bbpress-toolbox").' <strong>'.$file_size.'</strong>.</p></div>';

            if (gdbbx()->get('mime_types_limit_active', 'attachments') && gdbbx()->get('mime_types_limit_display', 'attachments')) {
                $show = gdbbx_attachments()->get_file_extensions();

                echo '<div class="bbp-template-notice"><p>'.__("File types allowed for upload", "gd-bbpress-toolbox").': <strong>.'.join('</strong>, <strong>.', $show).'</strong>.</p></div>';
            }
        }
    }

    public function save_topic($topic_id, $forum_id, $anonymous_data, $topic_author) {
        $this->save_reply(0, $topic_id, $forum_id, $anonymous_data, $topic_author);
    }

    public function save_reply($reply_id, $topic_id, $forum_id, $anonymous_data, $reply_author) {
        $is_topic = $reply_id == 0;

        $post_id = $reply_id == 0 ? $topic_id : $reply_id;

        if (isset($_POST['gdbbx']['remove-attachment'])) {
            $attachments = (array)$_POST['gdbbx']['remove-attachment'];

            foreach ($attachments as $id => $action) {
                $attachment_id = absint($id);

                if ($action == 'delete' || $action == 'detach') {
                    gdbbx_attachments()->delete_attachment($attachment_id, $post_id, $action);
                }
            }
        }

        $uploads = array();
        $original = array();
        $uploads_captions = array();

        $featured = false; 
        if ($is_topic) {
            $featured = gdbbx()->get('topic_featured_image', 'attachments');
        } else {
            $featured = gdbbx()->get('reply_featured_image', 'attachments');
        }

        $counter = 0;
        $captions = isset($_POST['d4p_attachment_caption']) ? (array)$_POST['d4p_attachment_caption'] : array();

        if (!empty($_FILES) && !empty($_FILES['d4p_attachment'])) {
            require_once(ABSPATH.'wp-admin/includes/file.php');

            $errors = new gdbbx_error();
            $overrides = array(
                'test_form' => false, 
                'upload_error_handler' => 'gdbbx_attachment_handle_upload_error'
            );

            foreach ($_FILES['d4p_attachment']['error'] as $key => $error) {
                $file_name = $_FILES['d4p_attachment']['name'][$key];

                if ($error == UPLOAD_ERR_OK) {
                    $file = array('name' => $file_name,
                        'type' => $_FILES['d4p_attachment']['type'][$key],
                        'size' => $_FILES['d4p_attachment']['size'][$key],
                        'tmp_name' => $_FILES['d4p_attachment']['tmp_name'][$key],
                        'error' => $_FILES['d4p_attachment']['error'][$key]
                    );

                    if (gdbbx_attachments()->is_right_size($file, $forum_id)) {
                        $mimes = gdbbx_attachments()->filter_mime_types($forum_id);
                        if (!is_null($mimes) && !empty($mimes)) {
                            $overrides['mimes'] = $mimes;
                        }

                        $upload = wp_handle_upload($file, $overrides);
                        $caption = isset($captions[$counter]) ? sanitize_text_field($captions[$counter]) : '';

                        if (!is_wp_error($upload)) {
                            $uploads[] = $upload;
                            $original[] = $file_name;
                            $uploads_captions[] = $caption;
                        } else {
                            $errors->add('wp_upload', $upload->errors['wp_upload_error'][0], $file_name);
                        }
                    } else {
                        $errors->add('d4p_upload', 'File exceeds allowed file size.', $file_name);
                    }
                } else {
                    switch ($error) {
                        default:
                        case 'UPLOAD_ERR_NO_FILE':
                            $errors->add('php_upload', 'File not uploaded.', $file_name);
                            break;
                        case 'UPLOAD_ERR_INI_SIZE':
                            $errors->add('php_upload', 'Upload file size exceeds PHP maximum file size allowed.', $file_name);
                            break;
                        case 'UPLOAD_ERR_FORM_SIZE':
                            $errors->add('php_upload', 'Upload file size exceeds FORM specified file size.', $file_name);
                            break;
                        case 'UPLOAD_ERR_PARTIAL':
                            $errors->add('php_upload', 'Upload file only partially uploaded.', $file_name);
                            break;
                        case 'UPLOAD_ERR_CANT_WRITE':
                            $errors->add('php_upload', 'Can\'t write file to the disk.', $file_name);
                            break;
                        case 'UPLOAD_ERR_NO_TMP_DIR':
                            $errors->add('php_upload', 'Temporary folder for upload is missing.', $file_name);
                            break;
                        case 'UPLOAD_ERR_EXTENSION':
                            $errors->add('php_upload', 'Server extension restriction stopped upload.', $file_name);
                            break;
                    }
                }

                $counter++;
            }
        }

        if (!empty($errors->errors) && gdbbx()->get('log_upload_errors', 'attachments') == 1) {
            foreach ($errors->errors as $code => $errs) {
                foreach ($errs as $error) {
                    if ($error[0] != '' && $error[1] != '') {
                        add_post_meta($post_id, '_bbp_attachment_upload_error', array(
                            'code' => $code, 'file' => $error[1], 'message' => $error[0])
                        );
                    }
                }
            }
        }

        if (!empty($uploads)) {
            require_once(ABSPATH.'wp-admin/includes/media.php');
            require_once(ABSPATH.'wp-admin/includes/image.php');

            $counter = 0;
            $update_attachments = array();
            foreach ($uploads as $_key => $upload) {
                $wp_filetype = wp_check_filetype(basename($upload['file']));
                $att_name = basename($upload['file']);
                $org_name = $original[$_key];

                $attachment = array('post_mime_type' => $wp_filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $att_name),
                    'post_excerpt' => $uploads_captions[$counter],
                    'post_content' => '','post_status' => 'inherit'
                );

                $attach_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
                $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);

                wp_update_attachment_metadata($attach_id, $attach_data);

                update_post_meta($attach_id, '_bbp_attachment', '1');
                update_post_meta($attach_id, '_bbp_attachment_name', $att_name);
                update_post_meta($attach_id, '_bbp_attachment_original_name', $org_name);

                $update_attachments[] = array('name' => $org_name, 'id' => $attach_id);

                $counter++;
            }

            if (!empty($update_attachments)) {
                $post = get_post($post_id);
                $content = $post->post_content;

                $matches = array();
                $new_list = array();

                $preg = preg_match_all("/(?<attachment>\[attachment.+?\])/i", $content, $matches);
                $list = isset($matches['attachment']) ? $matches['attachment'] : array();

                if (!empty($list)) {
                    foreach ($update_attachments as $att) {
                        $search = '"'.$att['name'].'"';
                        $replace = $att['id'];

                        foreach ($list as $_key => $file) {
                            if (stripos($file, $search) !== false) {
                                $nfile = str_replace($search, $replace, $file);
                                $new_list[$_key] = $nfile;
                                break;
                            }
                        }
                    }

                    if (!empty($new_list)) {
                        foreach ($list as $_key => $att) {
                            if (isset($new_list[$_key])) {
                                $content = str_replace($att, $new_list[$_key], $content);
                            }
                        }

                        wp_update_post(array(
                            'ID' => $post->ID,
                            'post_content' => $content
                        ));
                    }
                }
            }

            if (current_theme_supports('post-thumbnails')) {
                if ($featured && !has_post_thumbnail($post_id)) {
                    $args = array(
                        'numberposts' => 1,
                        'order' => 'ASC',
                        'post_mime_type' => 'image',
                        'post_parent' => $post_id,
                        'post_status' => null,
                        'post_type' => 'attachment',
                    );

                    $images = get_children($args);

                    if (!empty($images)) {
                        foreach ($images as $image) {
                            set_post_thumbnail($post_id, $image->ID);
                        }
                    }
                }
            }
        }

        gdbbx_db()->update_topic_attachments_count($topic_id);
    }

    public function show_attachments_icon() {
        $topic_id = bbp_get_topic_id();
        $count = gdbbx_db()->get_topic_attachments_count($topic_id, true);

        if ($count > 0) {
            echo $this->render_topic_list_icon($count);
        }
    }

    public function embed_attachments_edit($attachments, $post_id) {
        d4p_include('functions', 'admin', GDBBX_D4PLIB);

        $_icons = gdbbx()->get('attachment_icons', 'attachments');
        $_type = gdbbx()->get('icons_mode', 'attachments');

        $_deletion = gdbbx()->get('delete_method', 'attachments') == 'edit';

        $actions = array();

        if ($_deletion) {
            $post = get_post($post_id);
            $author_id = $post->post_author;

            $allow = gdbbx_attachments()->deletion_status($author_id);

            if ($allow != 'no') {
                $actions[''] = __("Do Nothing", "gd-bbpress-toolbox");

                if ($allow == 'delete' || $allow == 'both') {
                    $actions['delete'] = __("Delete", "gd-bbpress-toolbox");
                }

                if ($allow == 'detach' || $allow == 'both') {
                    $actions['detach'] = __("Detach", "gd-bbpress-toolbox");
                }
            }
        }

        $content = '<div class="bbp-attachments bbp-attachments-edit">';
        $content.= '<input type="hidden" />';
        $content.= '<ol';

        if ($_icons) {
            switch ($_type) {
                case 'images':
                    $content.= ' class="with-icons"';
                    break;
                case 'font':
                    $content.= ' class="with-font-icons"';
                    break;
            }
        }

        $content.= '>';

        foreach ($attachments as $attachment) {
            $insert = array('<a role="button" class="bbp-attachment-insert" href="#'.$attachment->ID.'">'.__("insert into content", "gd-bbpress-toolbox").'</a>');

            $file = get_attached_file($attachment->ID);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $filename = pathinfo($file, PATHINFO_BASENAME);
            $url = wp_get_attachment_url($attachment->ID);

            $a_title = $filename;
            $html = $filename;
            $class_li = '';

            if ($_icons && $_type == 'images') {
                $class_li = "bbp-atticon bbp-atticon-".$this->icon($ext);
            }

            if ($_icons && $_type == 'font') {
                $html = $this->render_attachment_icon($ext).$html;
            }

            $item = '<li id="d4p-bbp-attachment_'.$attachment->ID.'" class="d4p-bbp-attachment d4p-bbp-attachment-'.$ext.' '.$class_li.'">';
            $item.= '<a href="'.$url.'" title="'.$a_title.'" download>'.$html.'</a>';
            $item.= ' ['.join(' | ', $insert).']';

            if (!empty($actions)) {
                $item.= d4p_render_select($actions, array('name' => 'gdbbx[remove-attachment]['.$attachment->ID.']', 'echo' => false), array('title' => __("Attachment Actions", "gd-bbpress-toolbox")));
            }

            $item.= '</li>';

            $content.= $item;
        }

        $content.= '</ol>';
        $content.= '</div>';

        return $content;
    }

    public function after_attachments() {
        $id = bbp_get_reply_id();

        if ($id == 0) {
            $id = bbp_get_topic_id();
        }

        echo $this->embed_attachments('', $id);
    }

    public function embed_attachments($content, $id) {
        if (gdbbx_is_feed()) {
            return $content;
        }

        global $user_ID;

        $attachments = gdbbx_get_post_attachments($id);

        $post = get_post($id);
        $author_id = $post->post_author;

        if (!empty($attachments)) {
            $_image_types = apply_filters('gdbbx_attachment_image_extensions', array('png', 'gif', 'jpg', 'jpeg', 'jpe', 'bmp'));

            $_icons = gdbbx()->get('attachment_icons', 'attachments');
            $_type = gdbbx()->get('icons_mode', 'attachments');

            $_download = gdbbx()->get('download_link_attribute', 'attachments') ? ' download' : '';
            $_deletion = gdbbx()->get('delete_method', 'attachments') == 'default';

            $content.= '<div class="bbp-attachments">';
            $content.= '<h6>'.__("Attachments", "gd-bbpress-toolbox").':</h6>';

            if (!is_user_logged_in() && gdbbx_attachments()->is_hidden_from_visitors()) {
                $content.= sprintf(__("You must be <a href='%s'>logged in</a> to view attached files.", "gd-bbpress-toolbox"), wp_login_url(get_permalink()));
            } else {
                if (!empty($attachments)) {
                    $thumbnails = '<ol class="with-thumbnails">';
                    $listing = '<ol';

                    if ($_icons) {
                        switch ($_type) {
                            case 'images':
                                $listing.= ' class="with-icons"';
                                break;
                            case 'font':
                                $listing.= ' class="with-font-icons"';
                                break;
                        }
                    }

                    $listing.= '>';

                    $images = $files = 0;

                    foreach ($attachments as $attachment) {
                        $actions = array();

                        if ($_deletion) {
                            $action_url = add_query_arg('_wpnonce', wp_create_nonce('d4p-bbpress-attachments'));
                            $action_url = add_query_arg('att_id', $attachment->ID, $action_url);
                            $action_url = add_query_arg('bbp_id', $id, $action_url);

                            $allow = gdbbx_attachments()->deletion_status($author_id);

                            if ($allow == 'delete' || $allow == 'both') {
                                $actions[] = '<a class="bbp-attachment-confirm" href="'.esc_url(add_query_arg('d4pbbaction', 'delete', $action_url)).'">'.__("delete", "gd-bbpress-toolbox").'</a>';
                            }

                            if ($allow == 'detach' || $allow == 'both') {
                                $actions[] = '<a class="bbp-attachment-confirm" href="'.esc_url(add_query_arg('d4pbbaction', 'detach', $action_url)).'">'.__("detach", "gd-bbpress-toolbox").'</a>';
                            }
                        }

                        $file = get_attached_file($attachment->ID);
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        $filename = pathinfo($file, PATHINFO_BASENAME);
                        $url = wp_get_attachment_url($attachment->ID);

                        $html = $class_li = $class_a = $rel_a = '';
                        $a_title = $attachment->post_excerpt != '' ? $attachment->post_excerpt : $filename;
                        $a_target = gdbbx()->get('file_target_blank', 'attachments') ? '_blank' : '_self';
                        $caption = false;

                        $img = false;
                        if (gdbbx()->get('image_thumbnail_active', 'attachments')) {
                            if (in_array($ext, $_image_types)) {
                                $html = wp_get_attachment_image($attachment->ID, 'd4p-bbp-thumb');

                                if ($html != '') {
                                    $img = true;

                                    $class_li = 'bbp-atthumb';
                                    if (gdbbx()->get('image_thumbnail_inline', 'attachments') == 1) {
                                        $class_li.= ' bbp-inline';
                                    }

                                    $class_a = gdbbx()->get('image_thumbnail_css', 'attachments');
                                    $caption = gdbbx()->get('image_thumbnail_caption', 'attachments');

                                    $rel_a = ' rel="'.gdbbx()->get('image_thumbnail_rel', 'attachments').'"';
                                    $rel_a = str_replace('%ID%', $id, $rel_a);
                                    $rel_a = str_replace('%TOPIC%', bbp_get_topic_id(), $rel_a);
                                }
                            }
                        }

                        if ($html == '') {
                            $html = $filename;

                            if ($_icons && $_type == 'images') {
                                $class_li = "bbp-atticon bbp-atticon-".$this->icon($ext);
                            }

                            if ($_icons && $_type == 'font') {
                                $html = $this->render_attachment_icon($ext).$html;
                            }
                        }

                        $item = '<li id="d4p-bbp-attachment_'.$attachment->ID.'" class="d4p-bbp-attachment d4p-bbp-attachment-'.$ext.' '.$class_li.'">';

                        if ($caption) {
                            $size = gdbbx()->get('image_thumbnail_size', 'attachments');
                            $size = explode('x', $size);

                            $item.= '<div style="width: '.$size[0].'px" class="wp-caption">';
                        }

                        if ($img) {
                            $item.= '<a class="'.$class_a.'"'.$rel_a.' href="'.$url.'" title="'.$a_title.'" target="'.$a_target.'">'.$html.'</a>';
                        } else {
                            $item.= '<a class="'.$class_a.'"'.$rel_a.$_download.' href="'.$url.'" title="'.$a_title.'" target="'.$a_target.'">'.$html.'</a>';
                        }

                        if ($caption) {
                            $a_title = '<a href="'.$url.'"'.$_download.' target="'.$a_target.'">'.$a_title.'</a>';

                            $item.= '<p class="wp-caption-text">'.$a_title;
                            $item.= !empty($actions) ? '<br/>['.join(' | ', $actions).']' : '';
                            $item.= '</p></div>';
                        } else {
                            $item.= !empty($actions) ? ' ['.join(' | ', $actions).']' : '';
                        }

                        $item.= '</li>';

                        if ($img) {
                            $thumbnails.= $item;
                            $images++;
                        } else {
                            $listing.= $item;
                            $files++;
                        }
                    }

                    $thumbnails.= '</ol>';
                    $listing.= '</ol>';
                    
                    if ($images > 0) {
                        $content.= $thumbnails;
                    }

                    if ($files > 0) {
                        $content.= $listing;
                    }
                }
            }

            $content.= '</div>';
        }

        if ((gdbbx()->get('errors_visible_to_author', 'attachments') == 1 && $author_id == $user_ID) || (gdbbx()->get('errors_visible_to_admins', 'attachments') == 1 && d4p_is_current_user_admin()) || (gdbbx()->get('errors_visible_to_moderators', 'attachments') == 1 && gdbbx_is_current_user_bbp_moderator())) {
            $errors = get_post_meta($id, '_bbp_attachment_upload_error');

            if (!empty($errors)) {
                $content.= '<div class="bbp-attachments-errors">';
                $content.= '<h6>'.__("Upload Errors", "gd-bbpress-toolbox").':</h6>';
                $content.= '<ol>';

                foreach ($errors as $error) {
                    $content.= '<li><strong>'.$error['file'].'</strong>: '.__($error['message'], "gd-bbpress-attachments").'</li>';
                }

                $content.= '</ol></div>';
            }
        }

        return $content;
    }

    public function embed_form() {
        $is_this_edit = bbp_is_topic_edit() || bbp_is_reply_edit();

        $can_upload = apply_filters('gdbbx_attchaments_allow_upload', gdbbx_attachments()->is_user_allowed(), bbp_get_forum_id());

        if ($can_upload) {
            if (gdbbx_attachments()->is_active()) {
                $this->file_size = apply_filters('gdbbx_attchaments_max_file_size', gdbbx_attachments()->get_file_size(), bbp_get_forum_id());

                if ($is_this_edit) {
                    $id = bbp_is_topic_edit() ? bbp_get_topic_id() : bbp_get_reply_id();

                    $attachments = gdbbx_get_post_attachments($id);

                    if (!empty($attachments)) {
                        include(gdbbx_get_template_part('gdbbx-form-attachment-edit.php'));
                    }
                }

                include(gdbbx_get_template_part('gdbbx-form-attachment.php'));

                gdbbx_enqueue_files_force();
            }
        }
    }

    public function render_attachment_icon($ext) {
        $icon = $this->icon($ext);

        $cls = 'fa fa-';
        foreach ($this->fonti as $fa => $list) {
            $list = explode('|', $list);

            if (in_array($icon, $list)) {
                $cls.= $fa;
            }
        }

        return '<i class="'.$cls.' fa-fw"></i> ';
    }

    public function render_topic_list_icon($count) {
        $render = '';

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $render = '<span class="bbp-image-mark bbp-image-paperclip" title="'.$count.' '._n("attachment", "attachments", $count, "gd-bbpress-toolbox").'"></span>';
        } else if (gdbbx()->get('icons_mode', 'attachments') == 'font') {
            $render = '<i class="bbp-icon-mark fa fa-paperclip" title="'.$count.' '._n("attachment", "attachments", $count, "gd-bbpress-toolbox").'"></i> ';
        }

        return $render;
    }

    private function icon($ext) {
        foreach ($this->icons as $icon => $list) {
            $list = explode('|', $list);

            if (in_array($ext, $list)) {
                return $icon;
            }
        }

        return 'generic';
    }
}
