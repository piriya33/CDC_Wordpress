<?php
/**
 * This template renders the registration/purchase attendee fields
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/registration/content.php
 *
 * @since 4.9
 * @since 4.10.1 Update template paths to add the "registration/" prefix
 * @version 4.10.1
 *
 */
// If there are no events with tickets in cart, print the empty cart template
if ( empty( $events ) ) {
	$this->template( 'registration/cart-empty' );
	return;
}
?>
<?php foreach ( $events as $event_id => $tickets ) : ?>

	<div
		class="tribe-block__tickets__registration__event"
		data-event-id="<?php echo esc_attr( $event_id ); ?>"
		data-is-meta-up-to-date="<?php echo absint( $is_meta_up_to_date ); ?>"
	>
		<?php $this->template( 'registration/summary/content', array( 'event_id' => $event_id, 'tickets' => $tickets ) ); ?>

		<div class="tribe-block__tickets__registration__actions">
			<?php $this->template( 'registration/button-cart', array( 'event_id' => $event_id ) ); ?>
		</div>

		<div class="tribe-block__tickets__item__attendee__fields">

			<?php $this->template( 'registration/attendees/error', array( 'event_id' => $event_id, 'tickets' => $tickets ) ); ?>

			<form
				method="post"
				class="tribe-block__tickets__item__attendee__fields__form<?php if ( ! empty( $providers[ $event_id ] ) ) : ?> tribe-block__tickets__item__attendee__fields__form--<?php echo esc_attr( $providers[ $event_id ] ); ?><?php endif; ?>"
				name="<?php echo 'event' . esc_attr( $event_id ); ?>"
				novalidate
			>
				<?php $this->template( 'registration/attendees/content', array( 'event_id' => $event_id, 'tickets' => $tickets ) ); ?>
				<input type="hidden" name="tribe_tickets_saving_attendees" value="1" />
				<button type="submit"><?php esc_html_e( 'Save Attendee Info', 'event-tickets' ); ?></button>
			</form>

			<?php $this->template( 'registration/attendees/error', array() ); ?>
			<?php $this->template( 'registration/attendees/success', array() ); ?>

			<?php $this->template( 'registration/attendees/loader', array() ); ?>

		</div>

	</div>

<?php endforeach; ?>

<?php $this->template( 'registration/button-checkout', array( 'checkout_url' => $checkout_url, 'cart_has_required_meta' => $cart_has_required_meta, 'is_meta_up_to_date' => $is_meta_up_to_date ) );
