( function($) {

	"use strict";

	/* Drag widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.preview-rendered', wptu_fl_render_preview );

	/* Save widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.layout-rendered', wptu_fl_render_preview );

	/* Publish button event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.didSaveNodeSettings', wptu_fl_render_preview );

})(jQuery);

/* Function to render shortcode preview for Beaver Builder */
function wptu_fl_render_preview() {
	wptu_ticker_init();
}