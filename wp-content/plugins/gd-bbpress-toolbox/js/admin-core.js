/*jslint regexp: true, nomen: true, undef: true, sloppy: true, eqeq: true, vars: true, white: true, plusplus: true, maxerr: 50, indent: 4 */
/*global d4plib_admin_data*/
var gdbbx_admin;

;(function($, window, document, undefined) {
    gdbbx_admin = {
        init: function() {
            $("#gdbbx-form-settings").areYouSure();

            $("#gdbbx-tool-export").click(function(e){
                e.preventDefault();

                window.location = $("#gdbbxtools-export-url").val();
            });

            $(".d4p-setting-expandable_list a.button-primary").click(function(e) {
                e.preventDefault();

                var list = $(this).closest(".d4p-setting-expandable_list"),
                    next = $(".d4p-next-id", list),
                    next_id = next.val(),
                    el = $(".list-element-0", list).clone();

                $("input", el).each(function(){
                    var id = $(this).attr("id").replace("_0_", "_" + next_id + "_"),
                        name = $(this).attr("name").replace("[0]", "[" + next_id + "]");

                    $(this).attr("id", id).attr("name", name);
                });

                el.attr("class", "list-element-" + next_id).fadeIn();
                $(this).before(el);

                next_id++;
                next.val(next_id);
            });
        }
    };

    gdbbx_admin.init();
})(jQuery, window, document);
