/*jslint regexp: true, nomen: true, undef: true, sloppy: true, eqeq: true, vars: true, white: true, plusplus: true, maxerr: 50, indent: 4 */
/*global gdbxRender_Data, tinymce, tinyMCE */
var gdbxRender, gdbxHelper;

;(function($, window, document, undefined) {
    gdbxHelper = {
        detect_msie: function() {
            var ua = window.navigator.userAgent;

            var msie = ua.indexOf('MSIE ');

            if (msie > 0) {
                return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
            }

            var trident = ua.indexOf('Trident/');
            if (trident > 0) {
                var rv = ua.indexOf('rv:');

                return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
            }

            return 99;
        },
        get_selection: function() {
            var t = "";

            if (window.getSelection){
                t = window.getSelection();
            } else if (document.getSelection){
                t = document.getSelection();
            } else if (document.selection){
                t = document.selection.createRange().text;
            }

            return $.trim(t.toString());
        },
        file_extension: function(name) {
            return name.substr(name.lastIndexOf(".") + 1).toLowerCase();
        },
        into_editor: function(text) {
            var id = $("#bbp_topic_content").length > 0 ? "bbp_topic_content" : "bbp_reply_content";

            if (gdbxRender_Data.wp_editor && !$("#" + id).is(":visible")) {
                text+= "<br/><br/>";

                if (gdbxRender_Data.wp_version > 38) {
                    tinymce.get(id).execCommand("mceInsertContent", false, text);
                } else {
                    tinyMCE.execInstanceCommand(id, "mceInsertContent", false, text);
                }
            } else {
                var txtr = $("#" + id);
                var cntn = txtr.val();

                if ($.trim(cntn) !== "") {
                    text = "\n\n" + text;
                }

                text+= "\n\n";

                txtr.val(cntn + text);
            }
        },
        scroll_to_editor: function() {
            if (gdbxHelper.detect_msie() > 8) {
                $("html, body").animate({scrollTop: $("#new-post").offset().top}, 1000);
            } else {
                document.location.href = "#new-post";
            }

            $(".bbp-the-content-wrapper textarea").focus();
        }
    };

    gdbxRender = {
        storage: {
            sending_report: false,
            files_counter: 1,
            attachments_submit: true,
            attachments_extensions: [],
            attachments_enhanced: true
        },
        attachments: {
            init: function() {
                $("form#new-post").attr("enctype", "multipart/form-data");
                $("form#new-post").attr("encoding", "multipart/form-data");

                $(document).on("click", ".bbp-attachment-insert", function(e){
                    e.preventDefault();

                    var id = $(this).attr("href").substr(1),
                        shortcode = '[attachment file="' + id + '"]';

                    gdbxHelper.into_editor(shortcode);
                    gdbxHelper.scroll_to_editor();
                });

                $(document).on("click", ".bbp-attachment-confirm", function(e){
                    if (!confirm(gdbxRender_Data.text_are_you_sure)) {
                        e.preventDefault();
                    }
                });

                $(document).on("click", ".d4p-attachment-addfile", function(e){
                    e.preventDefault();

                    if (!gdbxRender_Data.limiter || gdbxRender.storage.files_counter < gdbxRender_Data.max_files) {
                        $(this).before(gdbxRender.attachments.block());
                        gdbxRender.storage.files_counter++;
                    }

                    if (gdbxRender_Data.limiter && gdbxRender.storage.files_counter === gdbxRender_Data.max_files) {
                        $(this).hide();
                    }
                });

                if (gdbxRender.storage.attachments_enhanced) {
                    $(".bbp-attachments-form > div").addClass("bbp-validation-active");

                    gdbxRender.attachments.validation();
                }
            },
            block: function() {
                var cls = "bbp-attachments-input", block;

                if (gdbxRender.storage.attachments_enhanced) {
                    cls+= " bbp-validation-active";
                } else {
                    cls+= " bbp-validation-disabled";
                }

                block = '<div class="' + cls + '">';

                if (gdbxRender.storage.attachments_enhanced) {
                    block+= '<div role="button" class="bbp-attachment-preview"><span aria-hidden="true">' + gdbxRender_Data.text_select_file + '</span></div>';
                }

                block+= '<label><input type="file" size="40" name="d4p_attachment[]" />';
                block+= '<span class="bbp-accessibility-show-for-sr">' + gdbxRender_Data.text_select_file + '</span></label>';

                if (gdbxRender.storage.attachments_enhanced) {
                    block+= '<div class="bbp-attachment-control"></div>';
                }

                block+= '</div>';

                return block;
            },
            check_submit: function() {
                var valid = true;

                $(".bbp-attachments-form .bbp-attachments-input").each(function(){
                    if ($(this).hasClass("bbp-attachment-invalid")) {
                        valid = false;
                    }
                });

                $(".bbp-attachments-form").closest("form").find(".bbp-submit-wrapper button").attr("disabled", !valid);
            },
            validation: function() {
                gdbxRender.storage.attachments_extensions = gdbxRender_Data.allowed_extensions.split(" ");

                $(document).on("click", ".bbp-attachment-preview", function(){
                    $(this).closest(".bbp-attachments-input").find("input[type=file]").click();
                });

                $(document).on("click", ".bbp-attachments-input a.bbp-att-remove", function(e){
                    e.preventDefault();

                    $(this).closest(".bbp-attachments-input").fadeOut("slow", function(){
                        gdbxRender.storage.files_counter--;

                        $(".d4p-attachment-addfile").show();

                        if (gdbxRender.storage.files_counter === 0) {
                            $(this).after(gdbxRender.attachments.block());
                            gdbxRender.storage.files_counter++;
                        }

                        $(this).remove();

                        gdbxRender.attachments.check_submit();
                    });
                });

                $(document).on("click", ".bbp-attachments-input a.bbp-att-caption", function(e){
                    e.preventDefault();

                    $(this).prev().find("input").show();
                    $(this).hide();
                });

                $(document).on("click", ".bbp-attachments-input a.bbp-att-shortcode", function(e){
                    e.preventDefault();

                    var shortcode = '[attachment file="' + $(this).data("file") + '"]';

                    gdbxHelper.into_editor(shortcode);
                    gdbxHelper.scroll_to_editor();
                });

                $(document).on("change", ".bbp-attachments-input input[type=file]", function(){
                    if (!this.files) {
                        return;
                    }

                    var block = $(this).closest(".bbp-attachments-input"), file = this.files[0], txt = "",
                        size = Math.round(file.size / 1024), img = "", limiter = gdbxRender_Data.limiter, 
                        valid = true, valid_size = true, valid_type = true, forbidden = ["js", "php"], 
                        ext = gdbxHelper.file_extension(file.name),
                        regex = /^([a-zA-Z0-9\s_\\.\-:\+])+(.jpg|.jpeg|.gif|.png|.bmp)$/;

                    block.removeClass("bbp-attachment-invalid");

                    txt = '<div>' + gdbxRender_Data.text_file_name + ": <strong>" + file.name + "</strong></div>";
                    txt+= '<div>' + gdbxRender_Data.text_file_size + ": <strong>" + size + " kb</strong>, ";
                    txt+= gdbxRender_Data.text_file_type + ": <strong>" + ext.toUpperCase() + "</strong></div>";

                    if ($.inArray(ext, forbidden) > -1) {
                        valid = false;
                        valid_type = false;
                    }

                    if (limiter && file.size > gdbxRender_Data.max_size) {
                        valid = false;
                        valid_size = false;
                    }

                    if (limiter && $.inArray(ext, gdbxRender.storage.attachments_extensions) === -1) {
                        valid = false;
                        valid_type = false;
                    }

                    if (!valid) {
                        txt+= "<strong>";
                        txt+= gdbxRender_Data.text_file_validation;

                        if (!valid_type) {
                            txt+= " " + gdbxRender_Data.text_file_validation_type;
                        }

                        if (!valid_size) {
                            txt+= " " + gdbxRender_Data.text_file_validation_size;
                        }

                        txt+= "</strong><br/>";

                        block.addClass("bbp-attachment-invalid");
                    }

                    if (valid) {
                        txt+= "<div><label><input name='d4p_attachment_caption[]' type='text' style='display: none' placeholder='" + gdbxRender_Data.text_file_caption_placeholder + "' /><span class='bbp-accessibility-show-for-sr'>" + gdbxRender_Data.text_file_caption_placeholder + "</span></label><a data-file='" + file.name + "' class='bbp-att-caption' href='#'>" + gdbxRender_Data.text_file_caption + "</a></div>";

                        if (gdbxRender_Data.insert_into_content) {
                            txt+= "<div><a class='bbp-att-shortcode' href='#'>" + gdbxRender_Data.text_file_shortcode + "</a></div>";
                        }
                    }

                    txt+= "<div><a class='bbp-att-remove' href='#'>" + gdbxRender_Data.text_file_remove + "</a></div>";

                    block.find(".bbp-attachment-control").html(txt);
                    block.find(".bbp-attachment-control .bbp-att-shortcode").data('file', file.name);
                    block.find(".bbp-attachment-preview .bbp-attached-file").remove();

                    if (window.FileReader && regex.test(file.name.toLowerCase())) {
                        var reader = new FileReader();
                        reader.readAsDataURL(file);

                        reader.onloadend = function(){
                            img = '<img class="bbp-attached-file" alt="' + file.name + '" src="' + this.result + '" />';
                            block.find(".bbp-attachment-preview").prepend(img);
                        };
                    } else {
                        img = '<p class="bbp-attached-file" title="' + file.name + '">.' + ext.toUpperCase() + '</p>';
                        block.find(".bbp-attachment-preview").prepend(img);
                    }

                    gdbxRender.attachments.check_submit();
                });
            }
        },
        bbcodes: {
            init: function() {
                $(".d4pbbc-spoiler").each(function(){
                    var hover = $(this).data("hover"),
                        normal = $(this).data("color");

                    $(this).hover(
                        function() {
                            $(this).css("background", hover);
                        },
                        function() {
                            $(this).css("background", normal);
                        }
                    );
                });
            }
        },
        quotes: {
            init: function() {
                $(document).on("click", ".d4p-bbt-quote-link", function(e){
                    e.preventDefault();

                    if ($("#bbp_reply_content").length > 0) {
                        var qout = gdbxHelper.get_selection();
                        var id = $(this).data("id");
                        var quote_id = "#d4p-bbp-quote-" + id;

                        if (qout === "") {
                            qout = $(quote_id).html();
                        }

                        qout = qout.replace(/&nbsp;/g, " ");
                        qout = qout.replace(/<p>|<br>/g, "");
                        qout = qout.replace(/<\/\s*p>/g, "\n");

                        qout = $("<div>").html(qout).html();

                        if (gdbxRender_Data.quote_method === "bbcode") {
                            qout = "[quote quote=" + id + "]" + qout + "[/quote]";
                        } else {
                            var title = '<div class="d4p-bbp-quote-title"><a href="' + $(this).data("url") + '">';
                            title+= $(this).data("author") + ' ' + gdbxRender_Data.quote_wrote + ':</a></div>';
                            qout = '<blockquote class="d4pbbc-quote">' + title + qout + '</blockquote>';
                        }

                        gdbxHelper.into_editor(qout);
                        gdbxHelper.scroll_to_editor();
                    }
                });
            }
        },
        canned_replies: {
            init: function() {
                $(".gdbbx-canned-replies .gdbbx-canned-replies-show").click(function(e){
                    e.preventDefault();

                    var container = $(this).closest(".gdbbx-canned-replies");

                    $(this).hide();
                    $(".gdbbx-canned-replies-hide", container).show();
                    $(".gdbbx-canned-replies-list", container).slideDown();
                });

                $(".gdbbx-canned-replies .gdbbx-canned-replies-hide").click(function(e){
                    e.preventDefault();

                    var container = $(this).closest(".gdbbx-canned-replies");

                    $(this).hide();
                    $(".gdbbx-canned-replies-show", container).show();
                    $(".gdbbx-canned-replies-list", container).slideUp();
                });

                $(".gdbbx-canned-replies .gdbbx-canned-reply-insert").click(function(e){
                    e.preventDefault();

                    var container = $(this).closest(".gdbbx-canned-reply"),
                        content = $(".gdbbx-canned-reply-content", container).html();

                    gdbxHelper.into_editor(content);

                    if (gdbxRender_Data.auto_close_on_insert) {
                        var wrapper = $(this).closest(".gdbbx-canned-replies");

                        $(".gdbbx-canned-replies-hide", wrapper).click();
                    }
                });
            }
        },
        fitvids: {
            init: function() {
                $(".bbp-topic-content, .bbp-reply-content").fitVids();
            }
        },
        report: {
            init: function() {
                $(".d4p-bbt-report-link").click(function(e){
                    e.preventDefault();

                    if (!gdbxRender.storage.sending_report) {
                        if (gdbxRender_Data.report_mode === "form") {
                            gdbxRender.report.form($(this));
                        } else {
                            gdbxRender.report.button($(this));
                        }
                    }
                });
            },
            button: function(el) {
                var id = el.data("id"), post_type = el.data("post-type"), 
                    type = el.data("type"), nonce = el.data("nonce");

                if (gdbxRender_Data.report_mode === "confirm") {
                    if (confirm(gdbxRender_Data.report_confirm) === false) {
                        return;
                    }
                }

                var call = {
                    post: id,
                    nonce: nonce
                };

                gdbxRender.storage.sending_report = true;

                $.ajax({
                    dataType: "html", type: "post", data: call,
                    url: gdbxRender_Data.url + "?action=gdbbx_report_post",
                    success: function(html) {
                        gdbxRender.storage.sending_report = false;

                        $(".d4p-bbt-report-link-" + call.post).replaceWith("<span>" + gdbxRender_Data.report_after + "</span>");
                    }
                });
            },
            form: function(el) {
                var id = el.data("id"), post_type = el.data("post-type"), 
                    type = el.data("type"), nonce = el.data("nonce"), 
                    forums = el.closest("#bbpress-forums"),
                    content = el.closest("#bbpress-forums").find(".post-" + id + " .bbp-reply-content, .post-" + id + " .bbp-topic-content");

                if (content.length === 1) {
                    if (content.find(".gdbbx-report-wrapper").length === 0) {
                        $(".gdbbx-report-wrapper").remove();

                        var form = $(".gdbbx-report-template > div")
                                .clone()
                                .addClass("gdbbx-report-wrapper");

                        form.find("button")
                            .data("id", id)
                            .data("nonce", nonce);

                        content.append(form);

                        form.find("input").focus();

                        gdbxRender.report.handle(content.find(".gdbbx-report-wrapper"));
                    }

                    if (gdbxRender_Data.report_scroll) {
                        var offset = 0;

                        if ($("#wpadminbar").length > 0) {
                            offset = $("#wpadminbar").height();
                        }

                        $("html, body").animate({
                            scrollTop: content.find(".gdbbx-report-wrapper").offset().top - offset
                        }, 500);
                    }
                }
            },
            handle: function(el) {
                $("button.gdbbx-report-cancel", el).click(function(){
                    $(".gdbbx-report-wrapper").remove();
                });

                $("button.gdbbx-report-send", el).click(function(){
                    var text = $("input", el).val();

                    if (text.length < gdbxRender_Data.report_min) {
                        alert(gdbxRender_Data.report_alert);
                    } else {
                        var call = {
                            report: text,
                            post: $(this).data("id"),
                            nonce: $(this).data("nonce")
                        };

                        $(".gdbbx-report-form", el).hide();
                        $(".gdbbx-report-sending", el).show();

                        gdbxRender.storage.sending_report = true;

                        $.ajax({
                            dataType: "html", type: "post", data: call,
                            url: gdbxRender_Data.url + "?action=gdbbx_report_post",
                            success: function(html) {
                                gdbxRender.storage.sending_report = false;

                                $(".gdbbx-report-sending", el).hide();
                                $(".gdbbx-report-sent", el).show();

                                $(".d4p-bbt-report-link-" + call.post).replaceWith("<span>" + gdbxRender_Data.report_after + "</span>");
                            }
                        });
                    }
                });
            }
        },
        thanks: {
            init: function() {
                $(".d4p-bbt-thanks-link, .d4p-bbt-unthanks-link").click(function(e){
                    e.preventDefault();

                    gdbxRender.thanks.handle(this);
                });
            },
            handle: function(el) {
                var call = {
                        nonce: $(el).data("thanks-nonce"),
                        say: $(el).data("thanks-action"),
                        id: $(el).data("thanks-id")
                    }, button = $(el), 
                    is_thanks = button.hasClass("d4p-bbt-thanks-link");

                $.ajax({
                    dataType: "html", type: "post", data: call,
                    url: gdbxRender_Data.url + "?action=gdbbx_say_thanks",
                    success: function(html) {
                        var thanks = $(html).fadeIn(600);

                        $(".gdbbx-thanks-post-" + call.id).fadeOut(400).replaceWith(thanks);

                        if (is_thanks) {
                            if (gdbxRender_Data.thanks_removal) {
                                button.removeClass("d4p-bbt-thanks-link")
                                      .addClass("d4p-bbt-unthanks-link")
                                      .data("thanks-action", "unthanks")
                                      .html(gdbxRender_Data.thanks_unthanks);
                            } else {
                                button.replaceWith("<span>" + gdbxRender_Data.thanks_saved + "</span>");
                            }
                        } else {
                            button.removeClass("d4p-bbt-unthanks-link")
                                  .addClass("d4p-bbt-thanks-link")
                                  .data("thanks-action", "thanks")
                                  .html(gdbxRender_Data.thanks_thanks);
                        }
                    }
                });
            }
        },
        misc: {
            privacy: function() {
                $(".gdbbx-private-reply-hidden").each(function(){
                    $(this).hide().prev(".bbp-reply-header").hide();
                });
            }
        },
        run: function() {
            if (typeof gdbxRender_Data !== "undefined") {
                gdbxRender.misc.privacy();

                if (gdbxRender_Data.run_quote) {
                    gdbxRender.quotes.init();
                }

                if (gdbxRender_Data.run_attachments) {
                    gdbxRender.storage.attachments_enhanced = gdbxRender_Data.validate_attachments && gdbxHelper.detect_msie() > 9;

                    gdbxRender.attachments.init();
                }

                if (gdbxRender_Data.run_bbcodes) {
                    gdbxRender.bbcodes.init();
                }

                if (gdbxRender_Data.run_report) {
                    gdbxRender.report.init();
                }

                if (gdbxRender_Data.run_thanks) {
                    gdbxRender.thanks.init();
                }

                if (gdbxRender_Data.run_canned_replies) {
                    gdbxRender.canned_replies.init();
                }

                if (gdbxRender_Data.run_fitvids && $.fn.fitVids) {
                    gdbxRender.fitvids.init();
                }
            }
        }
    };

    gdbxRender.run();
})(jQuery, window, document);
