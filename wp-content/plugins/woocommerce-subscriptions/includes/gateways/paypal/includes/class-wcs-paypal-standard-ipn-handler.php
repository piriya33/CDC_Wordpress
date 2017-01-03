<?php
/**
 * PayPal Standard IPN Handler
 *
 * Handles IPN requests from PayPal for PayPal Standard Subscription transactions
 *
 * Example IPN payloads https://gist.github.com/thenbrent/3037967
 *
 * @link https://developer.paypal.com/docs/classic/ipn/integration-guide/IPNandPDTVariables/#id08CTB0S055Z
 *
 * @package		WooCommerce Subscriptions
 * @subpackage	Gateways/PayPal
 * @category	Class
 * @author		Prospress
 * @since		2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WCS_PayPal_Standard_IPN_Handler extends WC_Gateway_Paypal_IPN_Handler {

	/** @var Array transaction types this class can handle */
	protected $transaction_types = array(
		'subscr_signup',  // Subscription started
		'subscr_payment', // Subscription payment received
		'subscr_cancel',  // Subscription canceled
		'subscr_eot',     // Subscription expired
		'subscr_failed',  // Subscription payment failed
		'subscr_modify',  // Subscription modified

		// The PayPal docs say these are for Express Checkout recurring payments but they are also sent for PayPal Standard subscriptions
		'recurring_payment_skipped',   // Recurring payment skipped; it will be retried up to 3 times, 5 days apart
		'recurring_payment_suspended', // Recurring payment suspended. This transaction type is sent if PayPal tried to collect a recurring payment, but the related recurring payments profile has been suspended.
		'recurring_payment_suspended_due_to_max_failed_payment', // Recurring payment failed and the related recurring payment profile has been suspended
	);

	/**
	 * Constructor from WC_Gateway_Paypal_IPN_Handler
	 */
	public function __construct( $sandbox = false, $receiver_email = '' ) {
		$this->receiver_email = $receiver_email;
		$this->sandbox        = $sandbox;
	}

	/**
	 * There was a valid response
	 *
	 * Based on the IPN Variables documented here: https://developer.paypal.com/docs/classic/ipn/integration-guide/IPNandPDTVariables/#id091EB0901HT
	 *
	 * @param array $transaction_details Post data after wp_unslash
	 * @since 2.0
	 */
	public function valid_response( $transaction_details ) {
		global $wpdb;

		$transaction_details = stripslashes_deep( $transaction_details );

		if ( ! $this->validate_transaction_type( $transaction_details['txn_type'] ) ) {
			return;
		}

		$transaction_details['txn_type'] = strtolower( $transaction_details['txn_type'] );

		$this->process_ipn_request( $transaction_details );

	}

	/**
	 * Process a PayPal Standard Subscription IPN request
	 *
	 * @param array $transaction_details Post data after wp_unslash
	 * @since 2.0
	 */
	protected function process_ipn_request( $transaction_details ) {

		// Get the subscription ID and order_key with backward compatibility
		$subscription_id_and_key = self::get_order_id_and_key( $transaction_details, 'shop_subscription' );
		$subscription            = wcs_get_subscription( $subscription_id_and_key['order_id'] );
		$subscription_key        = $subscription_id_and_key['order_key'];

		// For the purposes of processing the IPN, we need to force the ability to update subscription statuses by unhooking the function enforcing strict PayPal support on S- prefixed subscription ids
		remove_filter( 'woocommerce_subscription_payment_gateway_supports', 'WCS_PayPal_Supports::add_feature_support_for_subscription', 10 );

		// We have an invalid $subscription, probably because invoice_prefix has changed since the subscription was first created, so get the subscription by order key
		if ( ! isset( $subscription->id ) ) {
			$subscription = wcs_get_subscription( wc_get_order_id_by_order_key( $subscription_key ) );
		}

		if ( 'recurring_payment_suspended_due_to_max_failed_payment' == $transaction_details['txn_type'] && empty( $subscription ) ) {
			WC_Gateway_Paypal::log( 'Returning as "recurring_payment_suspended_due_to_max_failed_payment" transaction is for a subscription created with Express Checkout' );
			return;
		}

		if ( empty( $subscription ) ) {
			WC_Gateway_Paypal::log( 'Subscription IPN Error: Could not find matching Subscription.' );
			exit;
		}

		if ( $subscription->order_key != $subscription_key ) {
			WC_Gateway_Paypal::log( 'Subscription IPN Error: Subscription Key does not match invoice.' );
			exit;
		}

		if ( isset( $transaction_details['ipn_track_id'] ) ) {

			// Make sure the IPN request has not already been handled
			$handled_ipn_requests = get_post_meta( $subscription->id, '_paypal_ipn_tracking_ids', true );

			if ( empty( $handled_ipn_requests ) ) {
				$handled_ipn_requests = array();
			}

			// The 'ipn_track_id' is not a unique ID and is shared between different transaction types, so create a unique ID by prepending the transaction type
			$ipn_id = $transaction_details['txn_type'] . '_' . $transaction_details['ipn_track_id'];

			if ( in_array( $ipn_id, $handled_ipn_requests ) ) {
				WC_Gateway_Paypal::log( 'Subscription IPN Error: IPN ' . $ipn_id . ' message has already been correctly handled.' );
				exit;
			}

			// Make sure we're not in the process of handling this IPN request on a server under extreme load and therefore, taking more than a minute to process it (which is the amount of time PayPal allows before resending the IPN request)
			$ipn_lock_transient_name = 'wcs_pp_' . $ipn_id; // transient names need to be less than 45 characters and the $ipn_id will be around 30 characters, e.g. subscr_payment_5ab4c38e1f39d

			if ( 'in-progress' == get_transient( $ipn_lock_transient_name ) && 'recurring_payment_suspended_due_to_max_failed_payment' !== $transaction_details['txn_type'] ) {

				WC_Gateway_Paypal::log( 'Subscription IPN Error: an older IPN request with ID ' . $ipn_id . ' is still in progress.' );

				// We need to send an error code to make sure PayPal does retry the IPN after our lock expires, in case something is actually going wrong and the server isn't just taking a long time to process the request
				status_header( 503 );
				exit;
			}

			// Set a transient to block IPNs with this transaction ID for the next 5 minutes
			set_transient( $ipn_lock_transient_name, 'in-progress', apply_filters( 'woocommerce_subscriptions_paypal_ipn_request_lock_time', 5 * MINUTE_IN_SECONDS ) );

		}

		if ( isset( $transaction_details['txn_id'] ) ) {

			// Make sure the IPN request has not already been handled
			$handled_transactions = get_post_meta( $subscription->id, '_paypal_transaction_ids', true );

			if ( empty( $handled_transactions ) ) {
				$handled_transactions = array();
			}

			$transaction_id = $transaction_details['txn_id'];

			if ( isset( $transaction_details['txn_type'] ) ) {
				$transaction_id .= '_' . $transaction_details['txn_type'];
			}

			// The same transaction ID is used for different payment statuses, so make sure we handle it only once. See: http://stackoverflow.com/questions/9240235/paypal-ipn-unique-identifier
			if ( isset( $transaction_details['payment_status'] ) ) {
				$transaction_id .= '_' . $transaction_details['payment_status'];
			}

			if ( in_array( $transaction_id, $handled_transactions ) ) {
				WC_Gateway_Paypal::log( 'Subscription IPN Error: transaction ' . $transaction_id . ' has already been correctly handled.' );
				exit;
			}
		}

		$is_renewal_sign_up_after_failure = false;

		// If the invoice ID doesn't match the default invoice ID and contains the string '-wcsfrp-', the IPN is for a subscription payment to fix up a failed payment
		if ( in_array( $transaction_details['txn_type'], array( 'subscr_signup', 'subscr_payment' ) ) && false !== strpos( $transaction_details['invoice'], '-wcsfrp-' ) ) {

			$renewal_order = wc_get_order( substr( $transaction_details['invoice'], strrpos( $transaction_details['invoice'], '-' ) + 1 ) );

			// check if the failed signup has been previously recorded
			if ( $renewal_order->id != get_post_meta( $subscription->id, '_paypal_failed_sign_up_recorded', true ) ) {
				$is_renewal_sign_up_after_failure = true;
			}
		}

		// If the invoice ID doesn't match the default invoice ID and contains the string '-wcscpm-', the IPN is for a subscription payment method change
		if ( 'subscr_signup' == $transaction_details['txn_type'] && false !== strpos( $transaction_details['invoice'], '-wcscpm-' ) ) {
			$is_payment_change = true;
		} else {
			$is_payment_change = false;
		}

		// Ignore IPN messages when the payment method isn't PayPal
		if ( 'paypal' != $subscription->payment_method ) {

			// The 'recurring_payment_suspended' transaction is actually an Express Checkout transaction type, but PayPal also send it for PayPal Standard Subscriptions suspended by admins at PayPal, so we need to handle it *if* the subscription has PayPal as the payment method, or leave it if the subscription is using a different payment method (because it might be using PayPal Express Checkout or PayPal Digital Goods)
			if ( 'recurring_payment_suspended' == $transaction_details['txn_type'] ) {

				WC_Gateway_Paypal::log( '"recurring_payment_suspended" IPN ignored: recurring payment method is not "PayPal". Returning to allow another extension to process the IPN, like PayPal Digital Goods.' );
				return;

			} elseif ( false === $is_renewal_sign_up_after_failure && false === $is_payment_change ) {

				WC_Gateway_Paypal::log( 'IPN ignored, recurring payment method has changed.' );
				exit;

			}
		}

		if ( $is_renewal_sign_up_after_failure || $is_payment_change ) {

			// Store the old profile ID on the order (for the first IPN message that comes through)
			$existing_profile_id = wcs_get_paypal_id( $subscription );

			if ( empty( $existing_profile_id ) || $existing_profile_id !== $transaction_details['subscr_id'] ) {
				update_post_meta( $subscription->id, '_old_paypal_subscriber_id', $existing_profile_id );
				update_post_meta( $subscription->id, '_old_payment_method', $subscription->payment_method );
			}
		}

		// Save the profile ID if it's not a cancellation/expiration request
		if ( isset( $transaction_details['subscr_id'] ) && ! in_array( $transaction_details['txn_type'], array( 'subscr_cancel', 'subscr_eot' ) ) ) {
			wcs_set_paypal_id( $subscription, $transaction_details['subscr_id'] );

			if ( wcs_is_paypal_profile_a( $transaction_details['subscr_id'], 'out_of_date_id' ) && 'disabled' != get_option( 'wcs_paypal_invalid_profile_id' ) ) {
				update_option( 'wcs_paypal_invalid_profile_id', 'yes' );
			}
		}

		$is_first_payment = ( $subscription->get_completed_payment_count() < 1 ) ? true : false;

		if ( $subscription->has_status( 'switched' ) ) {
			WC_Gateway_Paypal::log( 'IPN ignored, subscription has been switched.' );
			exit;
		}

		switch ( $transaction_details['txn_type'] ) {
			case 'subscr_signup':

				// Store PayPal Details on Subscription and Order
				$this->save_paypal_meta_data( $subscription, $transaction_details );
				$this->save_paypal_meta_data( $subscription->order, $transaction_details );

				// When there is a free trial & no initial payment amount, we need to mark the order as paid and activate the subscription
				if ( ! $is_payment_change && ! $is_renewal_sign_up_after_failure && 0 == $subscription->order->get_total() ) {
					// Safe to assume the subscription has an order here because otherwise we wouldn't get a 'subscr_signup' IPN
					$subscription->order->payment_complete(); // No 'txn_id' value for 'subscr_signup' IPN messages
					update_post_meta( $subscription->id, '_paypal_first_ipn_ignored_for_pdt', 'true' );
				}

				// Payment completed
				if ( $is_payment_change ) {

					// Set PayPal as the new payment method
					WC_Subscriptions_Change_Payment_Gateway::update_payment_method( $subscription, 'paypal' );

					// We need to cancel the subscription now that the method has been changed successfully
					if ( 'paypal' == get_post_meta( $subscription->id, '_old_payment_method', true ) ) {
						self::cancel_subscription( $subscription, get_post_meta( $subscription->id, '_old_paypal_subscriber_id', true ) );
					}

					$subscription->add_order_note( _x( 'IPN subscription payment method changed to PayPal.', 'when it is a payment change, and there is a subscr_signup message, this will be a confirmation message that PayPal accepted it being the new payment method', 'woocommerce-subscriptions' ) );

				} else {

					$subscription->add_order_note( __( 'IPN subscription sign up completed.', 'woocommerce-subscriptions' ) );

				}

				if ( $is_payment_change ) {
					WC_Gateway_Paypal::log( 'IPN subscription payment method changed for subscription ' . $subscription->id );
				} else {
					WC_Gateway_Paypal::log( 'IPN subscription sign up completed for subscription ' . $subscription->id );
				}

				break;

			case 'subscr_payment':

				if ( 0.01 == $transaction_details['mc_gross'] && 1 == $subscription->get_completed_payment_count() ) {
					WC_Gateway_Paypal::log( 'IPN ignored, treating IPN as secondary trial period.' );
					exit;
				}

				if ( ! $is_first_payment && ! $is_renewal_sign_up_after_failure ) {

					if ( $subscription->has_status( 'active' ) ) {
						remove_action( 'woocommerce_subscription_on-hold_paypal', 'WCS_PayPal_Status_Manager::suspend_subscription' );
						$subscription->update_status( 'on-hold' );
						add_action( 'woocommerce_subscription_on-hold_paypal', 'WCS_PayPal_Status_Manager::suspend_subscription' );
					}

					// Generate a renewal order to record the payment (and determine how much is due)
					$renewal_order = wcs_create_renewal_order( $subscription );

					// Set PayPal as the payment method (we can't use $renewal_order->set_payment_method() here as it requires an object we don't have)
					$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
					$renewal_order->set_payment_method( $available_gateways['paypal'] );
				}

				if ( 'completed' == strtolower( $transaction_details['payment_status'] ) ) {
					// Store PayPal Details
					$this->save_paypal_meta_data( $subscription, $transaction_details );

					// Subscription Payment completed
					$subscription->add_order_note( __( 'IPN subscription payment completed.', 'woocommerce-subscriptions' ) );

					WC_Gateway_Paypal::log( 'IPN subscription payment completed for subscription ' . $subscription->id );

					// First payment on order, process payment & activate subscription
					if ( $is_first_payment ) {

						$subscription->order->payment_complete( $transaction_details['txn_id'] );

						// Store PayPal Details on Order
						$this->save_paypal_meta_data( $subscription->order, $transaction_details );

						// IPN got here first or PDT will never arrive. Normally PDT would have arrived, so the first IPN would not be the first payment. In case the the first payment is an IPN, we need to make sure to not ignore the second one
						update_post_meta( $subscription->id, '_paypal_first_ipn_ignored_for_pdt', 'true' );

					// Ignore the first IPN message if the PDT should have handled it (if it didn't handle it, it will have been dealt with as first payment), but set a flag to make sure we only ignore it once
					} elseif ( $subscription->get_completed_payment_count() == 1 && '' !== WCS_PayPal::get_option( 'identity_token' ) && 'true' != get_post_meta( $subscription->id, '_paypal_first_ipn_ignored_for_pdt', true ) && false === $is_renewal_sign_up_after_failure ) {

						WC_Gateway_Paypal::log( 'IPN subscription payment ignored for subscription ' . $subscription->id . ' due to PDT previously handling the payment.' );

						update_post_meta( $subscription->id, '_paypal_first_ipn_ignored_for_pdt', 'true' );

					// Process the payment if the subscription is active
					} elseif ( ! $subscription->has_status( array( 'cancelled', 'expired', 'switched', 'trash' ) ) ) {

						if ( true === $is_renewal_sign_up_after_failure && is_object( $renewal_order ) ) {

							update_post_meta( $subscription->id, '_paypal_failed_sign_up_recorded', $renewal_order->id );

							// We need to cancel the old subscription now that the method has been changed successfully
							if ( 'paypal' == get_post_meta( $subscription->id, '_old_payment_method', true ) ) {

								$profile_id = get_post_meta( $subscription->id, '_old_paypal_subscriber_id', true );

								// Make sure we don't cancel the current profile
								if ( $profile_id !== $transaction_details['subscr_id'] ) {
									self::cancel_subscription( $subscription, $profile_id );
								}

								$subscription->add_order_note( __( 'IPN subscription failing payment method changed.', 'woocommerce-subscriptions' ) );
							}
						}

						try {

							// to cover the case when PayPal drank too much coffee and sent IPNs early - needs to happen before $renewal_order->payment_complete
							$update_dates = array();

							if ( $subscription->get_time( 'trial_end' ) > gmdate( 'U' ) ) {
								$update_dates['trial_end'] = gmdate( 'Y-m-d H:i:s', gmdate( 'U' ) - 1 );
								WC_Gateway_Paypal::log( sprintf( 'IPN subscription payment for subscription %d: trial_end is in futute (date: %s) setting to %s.', $subscription->id, $subscription->get_date( 'trial_end' ), $update_dates['trial_end'] ) );
							} else {
								WC_Gateway_Paypal::log( sprintf( 'IPN subscription payment for subscription %d: trial_end is in past (date: %s).', $subscription->id, $subscription->get_date( 'trial_end' ) ) );
							}

							if ( $subscription->get_time( 'next_payment' ) > gmdate( 'U' ) ) {
								$update_dates['next_payment'] = gmdate( 'Y-m-d H:i:s', gmdate( 'U' ) - 1 );
								WC_Gateway_Paypal::log( sprintf( 'IPN subscription payment for subscription %d: next_payment is in future (date: %s) setting to %s.', $subscription->id, $subscription->get_date( 'next_payment' ), $update_dates['next_payment'] ) );
							} else {
								WC_Gateway_Paypal::log( sprintf( 'IPN subscription payment for subscription %d: next_payment is in past (date: %s).', $subscription->id, $subscription->get_date( 'next_payment' ) ) );
							}

							if ( ! empty( $update_dates ) ) {
								$subscription->update_dates( $update_dates );
							}
						} catch ( Exception $e ) {
							WC_Gateway_Paypal::log( sprintf( 'IPN subscription payment exception subscription %d: %s.', $subscription->id, $e->getMessage() ) );
						}

						remove_action( 'woocommerce_subscription_activated_paypal', 'WCS_PayPal_Status_Manager::reactivate_subscription' );

						try {
							$renewal_order->payment_complete( $transaction_details['txn_id'] );
						} catch ( Exception $e ) {
							WC_Gateway_Paypal::log( sprintf( 'IPN subscription payment exception calling $renewal_order->payment_complete() for subscription %d: %s.', $subscription->id, $e->getMessage() ) );
						}

						$renewal_order->add_order_note( __( 'IPN subscription payment completed.', 'woocommerce-subscriptions' ) );

						add_action( 'woocommerce_subscription_activated_paypal', 'WCS_PayPal_Status_Manager::reactivate_subscription' );

						wcs_set_paypal_id( $renewal_order, $transaction_details['subscr_id'] );
					}
				} elseif ( in_array( strtolower( $transaction_details['payment_status'] ), array( 'pending', 'failed' ) ) ) {

					// Subscription Payment completed
					// translators: placeholder is payment status (e.g. "completed")
					$subscription->add_order_note( sprintf( _x( 'IPN subscription payment %s.', 'used in order note', 'woocommerce-subscriptions' ), $transaction_details['payment_status'] ) );

					if ( ! $is_first_payment ) {

						update_post_meta( $renewal_order->id, '_transaction_id', $transaction_details['txn_id'] );

						// translators: placeholder is payment status (e.g. "completed")
						$renewal_order->add_order_note( sprintf( _x( 'IPN subscription payment %s.', 'used in order note', 'woocommerce-subscriptions' ), $transaction_details['payment_status'] ) );

						$subscription->payment_failed();
					}

					WC_Gateway_Paypal::log( 'IPN subscription payment failed for subscription ' . $subscription->id );

				} else {

					WC_Gateway_Paypal::log( 'IPN subscription payment notification received for subscription ' . $subscription->id  . ' with status ' . $transaction_details['payment_status'] );

				}

				break;

			// Admins can suspend subscription at PayPal triggering this IPN
			case 'recurring_payment_suspended':

				if ( $subscription->has_status( 'active' ) ) {

					// We don't need to suspend the subscription at PayPal because it's already on-hold there
					remove_action( 'woocommerce_subscription_on-hold_paypal', 'WCS_PayPal_Status_Manager::suspend_subscription' );

					$subscription->update_status( 'on-hold', __( 'IPN subscription suspended.', 'woocommerce-subscriptions' ) );

					add_action( 'woocommerce_subscription_on-hold_paypal', 'WCS_PayPal_Status_Manager::suspend_subscription' );

					WC_Gateway_Paypal::log( 'IPN subscription suspended for subscription ' . $subscription->id );

				} else {

					WC_Gateway_Paypal::log( sprintf( 'IPN "recurring_payment_suspended" ignored for subscription %d. Subscription already %s.', $subscription->id, $subscription->get_status() ) );

				}

				break;

			case 'subscr_cancel':

				// Make sure the subscription hasn't been linked to a new payment method
				if ( wcs_get_paypal_id( $subscription ) != $transaction_details['subscr_id'] ) {

					WC_Gateway_Paypal::log( 'IPN subscription cancellation request ignored - new PayPal Profile ID linked to this subscription, for subscription ' . $subscription->id );

				} else {

					$subscription->cancel_order( __( 'IPN subscription cancelled.', 'woocommerce-subscriptions' ) );

					WC_Gateway_Paypal::log( 'IPN subscription cancelled for subscription ' . $subscription->id );

				}

				break;

			case 'subscr_eot': // Subscription ended, either due to failed payments or expiration

				WC_Gateway_Paypal::log( 'IPN EOT request ignored for subscription ' . $subscription->id );
				break;

			case 'subscr_failed': // Subscription sign up failed
			case 'recurring_payment_suspended_due_to_max_failed_payment': // Recurring payment failed

				$ipn_failure_note = __( 'IPN subscription payment failure.', 'woocommerce-subscriptions' );

				if ( ! $is_first_payment && ! $is_renewal_sign_up_after_failure && $subscription->has_status( 'active' ) ) {
					// Generate a renewal order to record the failed payment
					$renewal_order = wcs_create_renewal_order( $subscription );

					// Set PayPal as the payment method
					$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
					$renewal_order->set_payment_method( $available_gateways['paypal'] );
					$renewal_order->add_order_note( $ipn_failure_note );
				}

				WC_Gateway_Paypal::log( 'IPN subscription payment failure for subscription ' . $subscription->id );

				// Subscription Payment completed
				$subscription->add_order_note( $ipn_failure_note );

				try {
					$subscription->payment_failed();
				} catch ( Exception $e ) {
					WC_Gateway_Paypal::log( sprintf( 'IPN subscription payment failure, unable to process payment failure. Exception: %s ', $e->getMessage() ) );
				}

				break;
		}

		// Store the transaction IDs to avoid handling requests duplicated by PayPal
		if ( isset( $transaction_details['ipn_track_id'] ) ) {
			$handled_ipn_requests[] = $ipn_id;
			update_post_meta( $subscription->id, '_paypal_ipn_tracking_ids', $handled_ipn_requests );
		}

		if ( isset( $transaction_details['txn_id'] ) ) {
			$handled_transactions[] = $transaction_id;
			update_post_meta( $subscription->id, '_paypal_transaction_ids', $handled_transactions );
		}

		// And delete the transient that's preventing other IPN's being processed
		if ( isset( $ipn_lock_transient_name ) ) {
			delete_transient( $ipn_lock_transient_name );
		}

		// Log completion
		$log_message = 'IPN subscription request processed for ' . $subscription->id;

		if ( isset( $ipn_id ) && ! empty( $ipn_id ) ) {
			$log_message .= sprintf( ' (%s)', $ipn_id );
		}

		WC_Gateway_Paypal::log( $log_message );

		// Prevent default IPN handling for subscription txn_types
		exit;
	}

	/**
	 * Return valid transaction types
	 *
	 * @since 2.0
	 */
	public function get_transaction_types() {
		return $this->transaction_types;
	}

	/**
	 * Checks a set of args and derives an Order ID with backward compatibility for WC < 1.7 where 'custom' was the Order ID.
	 *
	 * @since 2.0
	 */
	public static function get_order_id_and_key( $args, $order_type = 'shop_order' ) {

		$order_id = $order_key = '';

		if ( isset( $args['subscr_id'] ) ) { // PayPal Standard IPN message
			$subscription_id = $args['subscr_id'];
		} elseif ( isset( $args['recurring_payment_id'] ) ) { // PayPal Express Checkout IPN, most likely 'recurring_payment_suspended_due_to_max_failed_payment', for a PayPal Standard Subscription
			$subscription_id = $args['recurring_payment_id'];
		} else {
			$subscription_id = '';
		}

		// First try and get the order ID by the subscription ID
		if ( ! empty( $subscription_id ) ) {

			$posts = get_posts( array(
				'numberposts'      => 1,
				'orderby'          => 'ID',
				'order'            => 'ASC',
				'meta_key'         => '_paypal_subscription_id',
				'meta_value'       => $subscription_id,
				'post_type'        => $order_type,
				'post_status'      => 'any',
				'suppress_filters' => true,
			) );

			if ( ! empty( $posts ) ) {
				$order_id  = $posts[0]->ID;
				$order_key = get_post_meta( $order_id, '_order_key', true );
			}
		}

		// Couldn't find the order ID by subscr_id, so it's either not set on the order yet or the $args doesn't have a subscr_id, either way, let's get it from the args
		if ( empty( $order_id ) && isset( $args['custom'] ) ) {
			// WC < 1.6.5
			if ( is_numeric( $args['custom'] ) && 'shop_order' == $order_type ) {

				$order_id  = $args['custom'];
				$order_key = $args['invoice'];

			} else {

				$order_details = json_decode( $args['custom'] );

				if ( is_object( $order_details ) ) { // WC 2.3.11+ converted the custom value to JSON, if we have an object, we've got valid JSON

					if ( 'shop_order' == $order_type ) {
						$order_id  = $order_details->order_id;
						$order_key = $order_details->order_key;
					} elseif ( isset( $order_details->subscription_id ) ) {
						// Subscription created with Subscriptions 2.0+
						$order_id  = $order_details->subscription_id;
						$order_key = $order_details->subscription_key;
					} else {
						// Subscription created with Subscriptions < 2.0
						$subscriptions = wcs_get_subscriptions_for_order( $order_details->order_id, array( 'order_type' => array( 'parent' ) ) );

						if ( ! empty( $subscriptions ) ) {
							$subscription = array_pop( $subscriptions );
							$order_id  = $subscription->id;
							$order_key = $subscription->order_key;
						}
					}
				} elseif ( preg_match( '/^a:2:{/', $args['custom'] ) && ! preg_match( '/[CO]:\+?[0-9]+:"/', $args['custom'] ) && ( $order_details = maybe_unserialize( $args['custom'] ) ) ) {  // WC 2.0 - WC 2.3.11, only allow serialized data in the expected format, do not allow objects or anything nasty to sneak in

					if ( 'shop_order' == $order_type ) {
						$order_id  = $order_details[0];
						$order_key = $order_details[1];
					} else {

						// Subscription, but we didn't have the subscription data in old, serialized value, so we need to pull it based on the order
						$subscriptions = wcs_get_subscriptions_for_order( $order_details[0], array( 'order_type' => array( 'parent' ) ) );

						if ( ! empty( $subscriptions ) ) {
							$subscription = array_pop( $subscriptions );
							$order_id  = $subscription->id;
							$order_key = $subscription->order_key;
						}
					}
				} else { // WC 1.6.5 - WC 2.0 or invalid data

					$order_id  = str_replace( WCS_PayPal::get_option( 'invoice_prefix' ), '', $args['invoice'] );
					$order_key = $args['custom'];

				}
			}
		}

		return array( 'order_id' => (int) $order_id, 'order_key' => $order_key );
	}

	/**
	 * Cancel a specific PayPal Standard Subscription Profile with PayPal.
	 *
	 * Used when switching payment methods with PayPal Standard to make sure that
	 * the old subscription's profile ID is cancelled, not the new one.
	 *
	 * @param WC_Subscription A subscription object
	 * @param string A PayPal Subscription Profile ID
	 * @since 2.0
	 */
	protected static function cancel_subscription( $subscription, $old_paypal_subscriber_id ) {

		// No need to cancel billing agreements
		if ( wcs_is_paypal_profile_a( $old_paypal_subscriber_id, 'billing_agreement' ) ) {
			return;
		}

		$current_profile_id = wcs_get_paypal_id( $subscription->id );

		// Update the subscription using the old profile ID
		wcs_set_paypal_id( $subscription, $old_paypal_subscriber_id );

		// Call update_subscription_status() directly as we don't want the notes added by WCS_PayPal_Status_Manager::cancel_subscription()
		WCS_PayPal_Status_Manager::update_subscription_status( $subscription, 'Cancel' );

		// Restore the current profile ID
		wcs_set_paypal_id( $subscription, $current_profile_id );
	}

	/**
	 * Check for a valid transaction type
	 *
	 * @param  string $txn_type
	 * @since 2.0
	 */
	protected function validate_transaction_type( $txn_type ) {
		if ( in_array( strtolower( $txn_type ), $this->get_transaction_types() ) ) {
			return true;
		} else {
			return false;
		}
	}
}
