/*jslint regexp: true, nomen: true, undef: true, sloppy: true, eqeq: true, vars: true, white: true, plusplus: true, maxerr: 50, indent: 4 */
var d4p_pretty_print_r;

;(function($, window, document, undefined) {
    d4p_pretty_print_r = {
        icons: {
            down: "&#9660;",
            right: "&#9658;"
        },
        init: function() {
            if (typeof d4p_pretty_data !== "undefined") {
                d4p_pretty_print_r.icons.right = d4p_pretty_data.icon_right;
                d4p_pretty_print_r.icons.down = d4p_pretty_data.icon_down;
            }

            $(document).on("click", ".gdp_r a.gdp_r_c", function(e) {
                e.preventDefault();

                if ($(this).hasClass("gdp_r_aa")) {
                    var button = $(this).find(".gdp_r_a");
                    var branch = $("#" + $(this).data("branch"));

                    if (branch) {
                        if (branch.hasClass("gdp_r_open")) {
                            button.html(d4p_pretty_print_r.icons.right);
                        } else {
                            button.html(d4p_pretty_print_r.icons.down);
                        }

                        branch.toggleClass("gdp_r_open");
                    }
                }
            });
        }
    };

    d4p_pretty_print_r.init();
})(jQuery, window, document);
