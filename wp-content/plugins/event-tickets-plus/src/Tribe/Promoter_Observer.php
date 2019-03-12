<?php

class Tribe__Tickets_Plus__Promoter_Observer {
	/**
	 * Hooks on which this obseverver notifies promoter
	 *
	 * @since TBD
	 */
	public function hook() {
		// Older versions of ET do not have the class registered.
		if ( ! tribe()->isBound( 'tickets.promoter.observer' ) ) {
			return;
		}

		// WOO
		add_action( 'event_tickets_woocommerce_ticket_created', tribe_callback( 'tickets.promoter.observer', 'notify_event_id' ), 10, 2 );
		add_action( 'wootickets_ticket_deleted', tribe_callback( 'tickets.promoter.observer', 'notify_event_id' ), 10, 2 );
		// EDD
		add_action( 'event_tickets_edd_ticket_created', tribe_callback( 'tickets.promoter.observer', 'notify_event_id' ), 10, 2 );
		add_action( 'eddtickets_ticket_deleted', tribe_callback( 'tickets.promoter.observer', 'notify_event_id' ), 10, 2 );
	}
}