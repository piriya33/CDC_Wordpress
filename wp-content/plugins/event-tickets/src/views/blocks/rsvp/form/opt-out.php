<?php
/**
 * Block: RSVP
 * Form Opt-Out
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/blocks/rsvp/form/opt-out.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link {INSERT_ARTICLE_LINK_HERE}
 *
 * @since 4.9
 * @since 4.11.0 Updated the optout markup and classes used.
 * @since 4.11.3 Ensure we always show the optout by default.
 *
 * @version 4.11.3
 *
 */
$modal    = $this->get( 'is_modal' );
$ticket   = $this->get( 'ticket' );

/**
 * Use this filter to hide the Attendees List Optout
 *
 * @since 4.9
 *
 * @param bool
 */
$hide_attendee_list_optout = apply_filters( 'tribe_tickets_plus_hide_attendees_list_optout', false );

if ( $hide_attendee_list_optout ) {
	return;
}

/* var Tribe__Tickets__Privacy $privacy  */
$privacy = tribe( 'tickets.privacy' );

$field_id = [
	'tribe-tickets-attendees-list-optout',
	$ticket->ID
];

$field_id = implode( '-', $field_id );
?>
<div class="tribe-common-form-control-checkbox tribe-tickets-attendees-list-optout--wrapper">
	<label
		class="tribe-common-form-control-checkbox__label"
		for="<?php echo esc_attr( $field_id ); ?>"
	>
		<input
			class="tribe-common-form-control-checkbox__input tribe-tickets__item__optout"
			id="<?php echo esc_attr( $field_id ); ?>"
			name="attendee[optout]"
			type="checkbox"
			<?php checked( true ); ?>
		/><?php echo $privacy->get_opt_out_text(); ?></label>
</div>
