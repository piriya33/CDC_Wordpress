jQuery( document ).ready( function( $ ) {

	// Global vars we'll use
	var soliloquy_defaults_url;

	/**
	* New Slider: When the 'Add New' option for a Soliloquy Slider is clicked, display a modal
	* to give the user an option to copy the config from another Slider or use the soliloquy
	* Defaults config.
	*/
	$( "a[href$='post-new.php?post_type=soliloquy']" ).on( 'click', function( e ) {

		// Prevent default action
		e.preventDefault();

		// Get the link target, as we will use this to load the Add New screen later
		soliloquy_defaults_url = $( this ).attr( 'href' );

		// Show modal dialog
		tb_show( soliloquy_defaults.modal_title, soliloquy_defaults.modal_url );

	} ); 

	/**
	* New Slider: When the modal form is submitted, grab the config ID and redirect to the slider
	* screen with that configuration parameter
	*/
	$( 'body' ).on( 'submit', 'form#soliloquy-defaults-config', function( e ) {

		// Prevent submit action
		e.preventDefault();

		// Amend the URL if a Slider was chosen
		if ( $( 'select', $( this ) ).val() != '' ) {
			soliloquy_defaults_url += '&soliloquy_defaults_config_id=' + $( 'select', $( this ) ).val();
		}

		// Redirect
		window.location = soliloquy_defaults_url;

	} );

} );