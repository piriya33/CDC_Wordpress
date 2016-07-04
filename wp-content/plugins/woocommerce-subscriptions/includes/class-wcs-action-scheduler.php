<?php
/**
 * Scheduler for subscription events that uses the Action Scheduler
 *
 * @class     WCS_Action_Scheduler
 * @version   2.0.0
 * @package   WooCommerce Subscriptions/Classes
 * @category  Class
 * @author    Prospress
 */
class WCS_Action_Scheduler extends WCS_Scheduler {

	/*@protected Array of $action_hook => $date_type values */
	protected $action_hooks = array(
		'woocommerce_scheduled_subscription_trial_end'  => 'trial_end',
		'woocommerce_scheduled_subscription_payment'    => 'next_payment',
		'woocommerce_scheduled_subscription_expiration' => 'end',

	);

	/**
	 * Maybe set a schedule action if the new date is in the future
	 *
	 * @param object $subscription An instance of a WC_Subscription object
	 * @param string $date_type Can be 'start', 'trial_end', 'next_payment', 'last_payment', 'end', 'end_of_prepaid_term' or a custom date type
	 * @param string $datetime A MySQL formated date/time string in the GMT/UTC timezone.
	 */
	public function update_date( $subscription, $date_type, $datetime ) {

		if ( in_array( $date_type, $this->date_types_to_schedule ) ) {

			$action_hook = $this->get_scheduled_action_hook( $subscription, $date_type );

			if ( ! empty( $action_hook ) ) {

				$action_args    = array( 'subscription_id' => $subscription->id );
				$timestamp      = strtotime( $datetime );
				$next_scheduled = wc_next_scheduled_action( $action_hook, $action_args );

				if ( $next_scheduled !== $timestamp ) {

					// Maybe clear the existing schedule for this hook
					if ( false !== $next_scheduled ) {
						wc_unschedule_action( $action_hook, $action_args );
					}

					// Only reschedule if it's in the future
					if ( $timestamp > current_time( 'timestamp', true ) && 'active' == $subscription->get_status() ) {
						wc_schedule_single_action( $datetime, $action_hook, $action_args );
					}
				}
			}
		}
	}

	/**
	 * Delete a date from the action scheduler queue
	 *
	 * @param object $subscription An instance of a WC_Subscription object
	 * @param string $date_type Can be 'start', 'trial_end', 'next_payment', 'last_payment', 'end', 'end_of_prepaid_term' or a custom date type
	 */
	public function delete_date( $subscription, $date_type ) {
		$this->update_date( $subscription, $date_type, 0 );
	}

	/**
	 * When a subscription's status is updated, maybe schedule an event
	 *
	 * @param object $subscription An instance of a WC_Subscription object
	 * @param string $date_type Can be 'start', 'trial_end', 'next_payment', 'last_payment', 'end', 'end_of_prepaid_term' or a custom date type
	 * @param string $datetime A MySQL formated date/time string in the GMT/UTC timezone.
	 */
	public function update_status( $subscription, $new_status, $old_status ) {

		$action_args = array( 'subscription_id' => $subscription->id );

		switch ( $new_status ) {
			case 'active' :

				foreach ( $this->action_hooks as $action_hook => $date_type ) {

					$next_scheduled = wc_next_scheduled_action( $action_hook, $action_args );
					$event_time     = $subscription->get_time( $date_type );

					// Maybe clear the existing schedule for this hook
					if ( false !== $next_scheduled && $next_scheduled != $event_time ) {
						wc_unschedule_action( $action_hook, $action_args );
					}

					if ( 0 != $event_time && $event_time > current_time( 'timestamp', true ) && $next_scheduled != $event_time ) {
						wc_schedule_single_action( $event_time, $action_hook, $action_args );
					}
				}
				break;
			case 'pending-cancel' :

				$end_time     = $subscription->get_time( 'end' ); // This will have been set to the correct date already

				// Now that we have the current times, clear the scheduled hooks
				foreach ( $this->action_hooks as $action_hook => $date_type ) {
					wc_unschedule_action( $action_hook, $action_args );
				}

				$next_scheduled = wc_next_scheduled_action( 'woocommerce_scheduled_subscription_end_of_prepaid_term', $action_args );

				if ( false !== $next_scheduled && $next_scheduled != $end_time ) {
					wc_unschedule_action( 'woocommerce_scheduled_subscription_end_of_prepaid_term', $action_args );
				}

				// The end date was set in WC_Subscriptions::update_dates() to the appropriate value, so we can schedule our action for that time
				if ( $end_time > current_time( 'timestamp', true ) && $next_scheduled != $end_time ) {
					wc_schedule_single_action( $end_time, 'woocommerce_scheduled_subscription_end_of_prepaid_term', $action_args );
				}
				break;
			case 'on-hold' :
			case 'cancelled' :
			case 'switched' :
			case 'expired' :
			case 'trash' :
				foreach ( $this->action_hooks as $action_hook => $date_type ) {
					wc_unschedule_action( $action_hook, $action_args );
				}
				wc_unschedule_action( 'woocommerce_scheduled_subscription_end_of_prepaid_term', $action_args );
				break;
		}
	}

	/**
	 * Get the hook to use in the action scheduler for the date type
	 *
	 * @param string $date_type Can be 'start', 'trial_end', 'next_payment', 'last_payment', 'expiration', 'end_of_prepaid_term' or a custom date type
	 * @param object $subscription An instance of WC_Subscription to get the hook for
	 */
	protected function get_scheduled_action_hook( $subscription, $date_type ) {

		$hook = '';

		switch ( $date_type ) {
			case 'next_payment' :
				$hook = 'woocommerce_scheduled_subscription_payment';
				break;
			case 'trial_end' :
				$hook = 'woocommerce_scheduled_subscription_trial_end';
				break;
			case 'end' :
				// End dates may need either an expiration or end of prepaid term hook, depending on the status
				if ( $subscription->has_status( 'cancelled' ) ) {
					$hook = 'woocommerce_scheduled_subscription_end_of_prepaid_term';
				} elseif ( $subscription->has_status( 'active' ) ) {
					$hook = 'woocommerce_scheduled_subscription_expiration';
				}
				break;
		}

		return apply_filters( 'woocommerce_subscriptions_scheduled_action_hook', $hook, $date_type );
	}
}
