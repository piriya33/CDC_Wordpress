<?php
/**
 * Individual Subscription Product API
 *
 * An API for accessing details of a subscription product.
 *
 * @package		WooCommerce Subscriptions
 * @subpackage	WC_Subscriptions_Product
 * @category	Class
 * @author		Brent Shepherd
 * @since		1.0
 */
class WC_Subscriptions_Product {

	/* cache the check on whether the session has an order awaiting payment for a given product */
	protected static $order_awaiting_payment_for_product = array();

	/* cache whether a given product is purchasable or not to save running lots of queries for the same product in the same request */
	protected static $is_purchasable_cache = array();

	protected static $subscription_meta_fields = array(
		'_subscription_price',
		'_subscription_sign_up_fee',
		'_subscription_period',
		'_subscription_period_interval',
		'_subscription_length',
		'_subscription_trial_period',
		'_subscription_trial_length',
	);

	/**
	 * Set up the class, including it's hooks & filters, when the file is loaded.
	 *
	 * @since 1.0
	 **/
	public static function init() {

		// Because the standard price meta field is empty, we need to output our custom subscription description
		add_filter( 'woocommerce_grouped_price_html', __CLASS__ . '::get_grouped_price_html', 10, 2 );

		// Gravity Forms Add-ons
		add_filter( 'woocommerce_gform_base_price', __CLASS__ . '::get_gravity_form_prices', 10, 2 );
		add_filter( 'woocommerce_gform_total_price', __CLASS__ . '::get_gravity_form_prices', 10, 2 );
		add_filter( 'woocommerce_gform_variation_total_price', __CLASS__ . '::get_gravity_form_prices', 10, 2 );

		add_filter( 'woocommerce_product_class', __CLASS__ . '::set_subscription_variation_class', 10, 4 );

		// Make sure a subscriptions price is included in subscription variations when required
		add_filter( 'woocommerce_available_variation', __CLASS__ . '::maybe_set_variations_price_html', 10, 3 );

		// Prevent users from deleting subscription products - it causes too many problems with WooCommerce and other plugins
		add_filter( 'user_has_cap', __CLASS__ . '::user_can_not_delete_subscription', 10, 3 );

		// Make sure subscription products in the trash can be restored
		add_filter( 'post_row_actions', __CLASS__ . '::subscription_row_actions', 10, 2 );

		// Remove the "Delete Permanently" bulk action on the Edit Products screen
		add_filter( 'bulk_actions-edit-product', __CLASS__ . '::subscription_bulk_actions', 10 );

		// Do not allow subscription products to be automatically purged on the 'wp_scheduled_delete' hook
		add_action( 'wp_scheduled_delete', __CLASS__ . '::prevent_scheduled_deletion', 9 );

		// Trash variations instead of deleting them to prevent headaches from deleted products
		add_action( 'wp_ajax_woocommerce_remove_variation', __CLASS__ . '::remove_variations', 9, 2 );
		add_action( 'wp_ajax_woocommerce_remove_variations', __CLASS__ . '::remove_variations', 9, 2 );

		// Handle bulk edits to subscription data in WC 2.4
		add_action( 'woocommerce_bulk_edit_variations', __CLASS__ . '::bulk_edit_variations', 10, 4 );
	}

	/**
	 * Returns the sign up fee (including tax) by filtering the products price used in
	 * @see WC_Product::get_price_including_tax( $qty )
	 *
	 * @return string
	 */
	public static function get_sign_up_fee_including_tax( $product, $qty = 1 ) {

		add_filter( 'woocommerce_get_price', __CLASS__ . '::get_sign_up_fee_filter', 100, 2 );

		$sign_up_fee_including_tax = $product->get_price_including_tax( $qty );

		remove_filter( 'woocommerce_get_price', __CLASS__ . '::get_sign_up_fee_filter', 100, 2 );

		return $sign_up_fee_including_tax;
	}

	/**
	 * Returns the raw sign up fee value (ignoring tax) by filtering the products price.
	 *
	 * @return string
	 */
	public static function get_sign_up_fee_filter( $price, $product ) {

		return self::get_sign_up_fee( $product );
	}

	/**
	 * Returns the sign up fee (excluding tax) by filtering the products price used in
	 * @see WC_Product::get_price_excluding_tax( $qty )
	 *
	 * @return string
	 */
	public static function get_sign_up_fee_excluding_tax( $product, $qty = 1 ) {

		add_filter( 'woocommerce_get_price', __CLASS__ . '::get_sign_up_fee_filter', 100, 2 );

		$sign_up_fee_excluding_tax = $product->get_price_excluding_tax( $qty );

		remove_filter( 'woocommerce_get_price', __CLASS__ . '::get_sign_up_fee_filter', 100, 2 );

		return $sign_up_fee_excluding_tax;
	}

	/**
	 * Override the WooCommerce "Add to Cart" text with "Sign Up Now".
	 *
	 * @since 1.0
	 */
	public static function add_to_cart_text( $button_text, $product_type = '' ) {
		global $product;

		if ( self::is_subscription( $product ) || in_array( $product_type, array( 'subscription', 'subscription-variation' ) ) ) {
			$button_text = get_option( WC_Subscriptions_Admin::$option_prefix . '_add_to_cart_button_text', __( 'Sign Up Now', 'woocommerce-subscriptions' ) );
		}

		return $button_text;
	}

	/**
	 * Checks a given product to determine if it is a subscription.
	 * When the received arg is a product object, make sure it is passed into the filter intact in order to retain any properties added on the fly.
	 *
	 * @param int|WC_Product $product_id Either a product object or product's post ID.
	 * @since 1.0
	 */
	public static function is_subscription( $product_id ) {

		$is_subscription = false;

		if ( is_object( $product_id ) ) {
			$product    = $product_id;
			$product_id = $product->id;
		} elseif ( is_numeric( $product_id ) ) {
			$product = wc_get_product( $product_id );
		}

		if ( is_object( $product ) && $product->is_type( array( 'subscription', 'subscription_variation', 'variable-subscription' ) ) ) {
			$is_subscription = true;
		}

		return apply_filters( 'woocommerce_is_subscription', $is_subscription, $product_id, $product );
	}

	/**
	 * Output subscription string as the price html for grouped products and make sure that
	 * sign-up fees are taken into account for price.
	 *
	 * @since 1.3.4
	 */
	public static function get_grouped_price_html( $price, $grouped_product ) {

		$child_prices = array();
		$contains_subscription = false;

		foreach ( $grouped_product->get_children() as $child_product_id ) {

			if ( self::is_subscription( $child_product_id ) ) {

				$contains_subscription = true;

				$child_product = wc_get_product( $child_product_id );

				$child_price = $child_product->get_price();
				$sign_up_fee = $child_product->get_sign_up_fee();
				$has_trial   = ( self::get_trial_length( $child_product ) > 0 ) ? true : false;

				// Make sure we have the *real* price (i.e. total initial payment)
				if ( $has_trial && $sign_up_fee > 0 ) {
					$child_price = $sign_up_fee;
				} else {
					$child_price += $sign_up_fee;
				}

				$child_prices[] = $child_price;

			} else {

				$child_prices[] = get_post_meta( $child_product_id, '_price', true );

			}
		}

		if ( ! $contains_subscription ) {
			return $price;
		} else {
			$price = '';
		}

		$child_prices = array_unique( $child_prices );

		if ( ! empty( $child_prices ) ) {
			$min_price = min( $child_prices );
		} else {
			$min_price = '';
		}

		if ( sizeof( $child_prices ) > 1 ) {
			$price .= $grouped_product->get_price_html_from_text();
		}

		$price .= wc_price( $min_price );

		return $price;
	}

	/**
	 * Output subscription string in Gravity Form fields.
	 *
	 * @since 1.1
	 */
	public static function get_gravity_form_prices( $price, $product ) {

		if ( self::is_subscription( $product ) ) {
			$price = self::get_price_string( $product, array( 'price' => $price, 'subscription_length' => false, 'sign_up_fee' => false, 'trial_length' => false ) );
		}

		return $price;
	}

	/**
	 * Returns a string representing the details of the subscription.
	 *
	 * For example "$20 per Month for 3 Months with a $10 sign-up fee".
	 *
	 * @param WC_Product|int $product A WC_Product object or ID of a WC_Product.
	 * @param array $inclusions An associative array of flags to indicate how to calculate the price and what to include, values:
	 *			'tax_calculation'     => false to ignore tax, 'include_tax' or 'exclude_tax' To indicate that tax should be added or excluded respectively
	 *			'subscription_length' => true to include subscription's length (default) or false to exclude it
	 *			'sign_up_fee'         => true to include subscription's sign up fee (default) or false to exclude it
	 *			'price'               => string a price to short-circuit the price calculations and use in a string for the product
	 * @since 1.0
	 */
	public static function get_price_string( $product, $include = array() ) {
		global $wp_locale;

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) ) {
			return;
		}

		$include = wp_parse_args( $include, array(
				'tax_calculation'     => get_option( 'woocommerce_tax_display_shop' ),
				'subscription_price'  => true,
				'subscription_period' => true,
				'subscription_length' => true,
				'sign_up_fee'         => true,
				'trial_length'        => true,
			)
		);

		$include = apply_filters( 'woocommerce_subscriptions_product_price_string_inclusions', $include, $product );

		$base_price = self::get_price( $product );

		if ( true === $include['sign_up_fee'] ) {
			$sign_up_fee = self::get_sign_up_fee( $product );
		} elseif ( false !== $include['sign_up_fee'] ) { // Allow override of product's sign-up fee
			$sign_up_fee = $include['sign_up_fee'];
		} else {
			$sign_up_fee = 0;
		}

		if ( false != $include['tax_calculation'] ) {

			if ( in_array( $include['tax_calculation'], array( 'exclude_tax', 'excl' ) ) ) { // Subtract Tax

				if ( isset( $include['price'] ) ) {
					$price = $include['price'];
				} else {
					$price = $product->get_price_excluding_tax( 1, $include['price'] );
				}

				if ( true === $include['sign_up_fee'] ) {
					$sign_up_fee = self::get_sign_up_fee_excluding_tax( $product );
				}
			} else { // Add Tax

				if ( isset( $include['price'] ) ) {
					$price = $include['price'];
				} else {
					$price = $product->get_price_including_tax();
				}

				if ( true === $include['sign_up_fee'] ) {
					$sign_up_fee = self::get_sign_up_fee_including_tax( $product );
				}
			}
		} else {

			if ( isset( $include['price'] ) ) {
				$price = $include['price'];
			} else {
				$price = wc_price( $base_price );
			}
		}

		$price .= ' <span class="subscription-details">';

		$billing_interval    = self::get_interval( $product );
		$billing_period      = self::get_period( $product );
		$subscription_length = self::get_length( $product );
		$trial_length        = self::get_trial_length( $product );
		$trial_period        = self::get_trial_period( $product );

		if ( is_numeric( $sign_up_fee ) ) {
			$sign_up_fee = wc_price( $sign_up_fee );
		}

		if ( $include['subscription_length'] ) {
			$ranges = wcs_get_subscription_ranges( $billing_period );
		}

		if ( $include['subscription_length'] && 0 != $subscription_length ) {
			$include_length = true;
		} else {
			$include_length = false;
		}

		$subscription_string = '';

		if ( $include['subscription_price'] && $include['subscription_period'] ) { // Allow extensions to not show price or billing period e.g. Name Your Price
			if ( $include_length && $subscription_length == $billing_interval ) {
				$subscription_string = $price; // Only for one billing period so show "$5 for 3 months" instead of "$5 every 3 months for 3 months"
			} elseif ( WC_Subscriptions_Synchroniser::is_product_synced( $product ) && in_array( $billing_period, array( 'week', 'month', 'year' ) ) ) {
				$payment_day = WC_Subscriptions_Synchroniser::get_products_payment_day( $product );
				switch ( $billing_period ) {
					case 'week':
						$payment_day_of_week = WC_Subscriptions_Synchroniser::get_weekday( $payment_day );
						if ( 1 == $billing_interval ) {
							// translators: 1$: recurring amount string, 2$: day of the week (e.g. "$10 every Wednesday")
							$subscription_string = sprintf( __( '%1$s every %2$s', 'woocommerce-subscriptions' ), $price, $payment_day_of_week );
						} else {
							// translators: 1$: recurring amount string, 2$: period, 3$: day of the week (e.g. "$10 every 2nd week on Wednesday")
							$subscription_string = sprintf( __( '%1$s every %2$s on %3$s', 'woocommerce-subscriptions' ), $price, wcs_get_subscription_period_strings( $billing_interval, $billing_period ), $payment_day_of_week );
						}
						break;
					case 'month':
						if ( 1 == $billing_interval ) {
							if ( $payment_day > 27 ) {
								// translators: placeholder is recurring amount
								$subscription_string = sprintf( __( '%s on the last day of each month', 'woocommerce-subscriptions' ), $price );
							} else {
								// translators: 1$: recurring amount, 2$: day of the month (e.g. "23rd") (e.g. "$5 every 23rd of each month")
								$subscription_string = sprintf( __( '%1$s on the %2$s of each month', 'woocommerce-subscriptions' ), $price, WC_Subscriptions::append_numeral_suffix( $payment_day ) );
							}
						} else {
							if ( $payment_day > 27 ) {
								// translators: 1$: recurring amount, 2$: interval (e.g. "3rd") (e.g. "$10 on the last day of every 3rd month")
								$subscription_string = sprintf( __( '%1$s on the last day of every %2$s month', 'woocommerce-subscriptions' ), $price, WC_Subscriptions::append_numeral_suffix( $billing_interval ) );
							} else {
								// translators: 1$: <price> on the, 2$: <date> day of every, 3$: <interval> month (e.g. "$10 on the 23rd day of every 2nd month")
								$subscription_string = sprintf( __( '%1$s on the %2$s day of every %3$s month', 'woocommerce-subscriptions' ), $price, WC_Subscriptions::append_numeral_suffix( $payment_day ), WC_Subscriptions::append_numeral_suffix( $billing_interval ) );
							}
						}
						break;
					case 'year':
						if ( 1 == $billing_interval ) {
							// translators: 1$: <price> on, 2$: <date>, 3$: <month> each year (e.g. "$15 on March 15th each year")
							$subscription_string = sprintf( __( '%1$s on %2$s %3$s each year', 'woocommerce-subscriptions' ), $price, $wp_locale->month[ $payment_day['month'] ], WC_Subscriptions::append_numeral_suffix( $payment_day['day'] ) );
						} else {
							// translators: 1$: recurring amount, 2$: month (e.g. "March"), 3$: day of the month (e.g. "23rd") (e.g. "$15 on March 15th every 3rd year")
							$subscription_string = sprintf( __( '%1$s on %2$s %3$s every %4$s year', 'woocommerce-subscriptions' ), $price, $wp_locale->month[ $payment_day['month'] ], WC_Subscriptions::append_numeral_suffix( $payment_day['day'] ), WC_Subscriptions::append_numeral_suffix( $billing_interval ) );
						}
						break;
				}
			} else {
				// translators: 1$: recurring amount, 2$: subscription period (e.g. "month" or "3 months") (e.g. "$15 / month" or "$15 every 2nd month")
				$subscription_string = sprintf( _n( '%1$s / %2$s', ' %1$s every %2$s', $billing_interval, 'woocommerce-subscriptions' ), $price, wcs_get_subscription_period_strings( $billing_interval, $billing_period ) );
			}
		} elseif ( $include['subscription_price'] ) {
			$subscription_string = $price;
		} elseif ( $include['subscription_period'] ) {
			// translators: billing period (e.g. "every week")
			$subscription_string = sprintf( __( 'every %s', 'woocommerce-subscriptions' ), wcs_get_subscription_period_strings( $billing_interval, $billing_period ) );
		}

		// Add the length to the end
		if ( $include_length ) {
			// translators: 1$: subscription string (e.g. "$10 up front then $5 on March 23rd every 3rd year"), 2$: length (e.g. "4 years")
			$subscription_string = sprintf( __( '%1$s for %2$s', 'woocommerce-subscriptions' ), $subscription_string, $ranges[ $subscription_length ] );
		}

		if ( $include['trial_length'] && 0 != $trial_length ) {
			$trial_string = wcs_get_subscription_trial_period_strings( $trial_length, $trial_period );
			// translators: 1$: subscription string (e.g. "$15 on March 15th every 3 years for 6 years"), 2$: trial length (e.g.: "with 4 months free trial")
			$subscription_string = sprintf( __( '%1$s with %2$s free trial', 'woocommerce-subscriptions' ), $subscription_string, $trial_string );
		}

		if ( $include['sign_up_fee'] && self::get_sign_up_fee( $product ) > 0 ) {
			// translators: 1$: subscription string (e.g. "$15 on March 15th every 3 years for 6 years with 2 months free trial"), 2$: signup fee price (e.g. "and a $30 sign-up fee")
			$subscription_string = sprintf( __( '%1$s and a %2$s sign-up fee', 'woocommerce-subscriptions' ), $subscription_string, $sign_up_fee );
		}

		$subscription_string .= '</span>';

		return apply_filters( 'woocommerce_subscriptions_product_price_string', $subscription_string, $product, $include );
	}

	/**
	 * Returns the price per period for a product if it is a subscription.
	 *
	 * @param mixed $product A WC_Product object or product ID
	 * @return float The price charged per period for the subscription, or an empty string if the product is not a subscription.
	 * @since 1.0
	 */
	public static function get_price( $product ) {

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) || ( ! isset( $product->subscription_price ) && empty( $product->product_custom_fields['_subscription_price'][0] ) ) ) {
			$subscription_price = '';
		} else {
			$subscription_price = isset( $product->subscription_price ) ? $product->subscription_price : $product->product_custom_fields['_subscription_price'][0];
		}

		return apply_filters( 'woocommerce_subscriptions_product_price', $subscription_price, $product );
	}

	/**
	 * Returns the subscription period for a product, if it's a subscription.
	 *
	 * @param mixed $product A WC_Product object or product ID
	 * @return string A string representation of the period, either Day, Week, Month or Year, or an empty string if product is not a subscription.
	 * @since 1.0
	 */
	public static function get_period( $product ) {

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) || ( ! isset( $product->subscription_period ) && empty( $product->product_custom_fields['_subscription_period'][0] ) ) ) {
			$subscription_period = '';
		} else {
			$subscription_period = isset( $product->subscription_period ) ? $product->subscription_period : $product->product_custom_fields['_subscription_period'][0];
		}

		return apply_filters( 'woocommerce_subscriptions_product_period', $subscription_period, $product );
	}

	/**
	 * Returns the subscription interval for a product, if it's a subscription.
	 *
	 * @param mixed $product A WC_Product object or product ID
	 * @return string A string representation of the period, either Day, Week, Month or Year, or an empty string if product is not a subscription.
	 * @since 1.0
	 */
	public static function get_interval( $product ) {

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) || ( ! isset( $product->subscription_period_interval ) && empty( $product->product_custom_fields['_subscription_period_interval'][0] ) ) ) {
			$subscription_period_interval = 1;
		} else {
			$subscription_period_interval = isset( $product->subscription_period_interval ) ? $product->subscription_period_interval : $product->product_custom_fields['_subscription_period_interval'][0];
		}

		return apply_filters( 'woocommerce_subscriptions_product_period_interval', $subscription_period_interval, $product );
	}

	/**
	 * Returns the length of a subscription product, if it is a subscription.
	 *
	 * @param mixed $product A WC_Product object or product ID
	 * @return int An integer representing the length of the subscription, or 0 if the product is not a subscription or the subscription continues for perpetuity
	 * @since 1.0
	 */
	public static function get_length( $product ) {

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) || ( ! isset( $product->subscription_length ) && empty( $product->product_custom_fields['_subscription_length'][0] ) ) ) {
			$subscription_length = 0;
		} else {
			$subscription_length = isset( $product->subscription_length ) ? $product->subscription_length : $product->product_custom_fields['_subscription_length'][0];
		}

		return apply_filters( 'woocommerce_subscriptions_product_length', $subscription_length, $product );
	}

	/**
	 * Returns the trial length of a subscription product, if it is a subscription.
	 *
	 * @param mixed $product A WC_Product object or product ID
	 * @return int An integer representing the length of the subscription trial, or 0 if the product is not a subscription or there is no trial
	 * @since 1.0
	 */
	public static function get_trial_length( $product ) {

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) || ( ! isset( $product->subscription_trial_length ) && empty( $product->product_custom_fields['_subscription_trial_length'][0] ) ) ) {
			$subscription_trial_length = 0;
		} else {
			$subscription_trial_length = isset( $product->subscription_trial_length ) ? $product->subscription_trial_length : $product->product_custom_fields['_subscription_trial_length'][0];
		}

		return apply_filters( 'woocommerce_subscriptions_product_trial_length', $subscription_trial_length, $product );
	}

	/**
	 * Returns the trial period of a subscription product, if it is a subscription.
	 *
	 * @param mixed $product A WC_Product object or product ID
	 * @return string A string representation of the period, either Day, Week, Month or Year, or an empty string if product is not a subscription or there is no trial
	 * @since 1.2
	 */
	public static function get_trial_period( $product ) {

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) ) {
			$subscription_trial_period = '';
		} elseif ( ! isset( $product->subscription_trial_period ) && empty( $product->product_custom_fields['_subscription_trial_period'][0] ) ) { // Backward compatibility
			$subscription_trial_period = self::get_period( $product );
		} else {
			$subscription_trial_period = isset( $product->subscription_trial_period ) ? $product->subscription_trial_period : $product->product_custom_fields['_subscription_trial_period'][0];
		}

		return apply_filters( 'woocommerce_subscriptions_product_trial_period', $subscription_trial_period, $product );
	}

	/**
	 * Returns the sign-up fee for a subscription, if it is a subscription.
	 *
	 * @param mixed $product A WC_Product object or product ID
	 * @return float The value of the sign-up fee, or 0 if the product is not a subscription or the subscription has no sign-up fee
	 * @since 1.0
	 */
	public static function get_sign_up_fee( $product ) {

		if ( ! is_object( $product ) ) {
			$product = WC_Subscriptions::get_product( $product );
		}

		if ( ! self::is_subscription( $product ) || ( ! isset( $product->subscription_sign_up_fee ) && empty( $product->product_custom_fields['_subscription_sign_up_fee'][0] ) ) ) {
			$subscription_sign_up_fee = 0;
		} else {
			$subscription_sign_up_fee = isset( $product->subscription_sign_up_fee ) ? $product->subscription_sign_up_fee : $product->product_custom_fields['_subscription_sign_up_fee'][0];
		}

		return apply_filters( 'woocommerce_subscriptions_product_sign_up_fee', $subscription_sign_up_fee, $product );
	}

	/**
	 * Takes a subscription product's ID and returns the date on which the first renewal payment will be processed
	 * based on the subscription's length and calculated from either the $from_date if specified, or the current date/time.
	 *
	 * @param int $product_id The product/post ID of a subscription product
	 * @param mixed $from_date A MySQL formatted date/time string from which to calculate the expiration date, or empty (default), which will use today's date/time.
	 * @param string $type The return format for the date, either 'mysql', or 'timezone'. Default 'mysql'.
	 * @param string $timezone The timezone for the returned date, either 'site' for the site's timezone, or 'gmt'. Default, 'site'.
	 * @since 2.0
	 */
	public static function get_first_renewal_payment_date( $product_id, $from_date = '', $timezone = 'gmt' ) {

		$first_renewal_timestamp = self::get_first_renewal_payment_time( $product_id, $from_date, $timezone );

		if ( $first_renewal_timestamp > 0 ) {
			$first_renewal_date = date( 'Y-m-d H:i:s', $first_renewal_timestamp );
		} else {
			$first_renewal_date = 0;
		}

		return apply_filters( 'woocommerce_subscriptions_product_first_renewal_payment_date', $first_renewal_date, $product_id, $from_date, $timezone );
	}

	/**
	 * Takes a subscription product's ID and returns the date on which the first renewal payment will be processed
	 * based on the subscription's length and calculated from either the $from_date if specified, or the current date/time.
	 *
	 * @param int $product_id The product/post ID of a subscription product
	 * @param mixed $from_date A MySQL formatted date/time string from which to calculate the expiration date, or empty (default), which will use today's date/time.
	 * @param string $type The return format for the date, either 'mysql', or 'timezone'. Default 'mysql'.
	 * @param string $timezone The timezone for the returned date, either 'site' for the site's timezone, or 'gmt'. Default, 'site'.
	 * @since 2.0
	 */
	public static function get_first_renewal_payment_time( $product_id, $from_date = '', $timezone = 'gmt' ) {

		if ( ! self::is_subscription( $product_id ) ) {
			return 0;
		}

		$from_date_param = $from_date;

		$billing_interval = self::get_interval( $product_id );
		$billing_length   = self::get_length( $product_id );
		$trial_length     = self::get_trial_length( $product_id );

		if ( $billing_interval !== $billing_length || $trial_length > 0 ) {

			if ( empty( $from_date ) ) {
				$from_date = gmdate( 'Y-m-d H:i:s' );
			}

			// If the subscription has a free trial period, the first renewal is the same as the expiration of the free trial
			if ( $trial_length > 0 ) {

				$first_renewal_timestamp = strtotime( self::get_trial_expiration_date( $product_id, $from_date ) );

			} else {

				$from_timestamp = strtotime( $from_date );
				$billing_period = self::get_period( $product_id );

				if ( 'month' == $billing_period ) {
					$first_renewal_timestamp = wcs_add_months( $from_timestamp, $billing_interval );
				} else {
					$first_renewal_timestamp = strtotime( "+ $billing_interval {$billing_period}s", $from_timestamp );
				}

				if ( 'site' == $timezone ) {
					$first_renewal_timestamp += ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
				}
			}
		} else {
			$first_renewal_timestamp = 0;
		}

		return apply_filters( 'woocommerce_subscriptions_product_first_renewal_payment_time', $first_renewal_timestamp, $product_id, $from_date_param, $timezone );
	}

	/**
	 * Takes a subscription product's ID and returns the date on which the subscription product will expire,
	 * based on the subscription's length and calculated from either the $from_date if specified, or the current date/time.
	 *
	 * @param mixed $product_id The product/post ID of the subscription
	 * @param mixed $from_date A MySQL formatted date/time string from which to calculate the expiration date, or empty (default), which will use today's date/time.
	 * @since 1.0
	 */
	public static function get_expiration_date( $product_id, $from_date = '' ) {

		$subscription_length = self::get_length( $product_id );

		if ( $subscription_length > 0 ) {

			if ( empty( $from_date ) ) {
				$from_date = gmdate( 'Y-m-d H:i:s' );
			}

			if ( self::get_trial_length( $product_id ) > 0 ) {
				$from_date = self::get_trial_expiration_date( $product_id, $from_date );
			}

			$expiration_date = gmdate( 'Y-m-d H:i:s', wcs_add_time( $subscription_length, self::get_period( $product_id ), strtotime( $from_date ) ) );

		} else {

			$expiration_date = 0;

		}

		return apply_filters( 'woocommerce_subscriptions_product_expiration_date', $expiration_date, $product_id, $from_date );
	}

	/**
	 * Takes a subscription product's ID and returns the date on which the subscription trial will expire,
	 * based on the subscription's trial length and calculated from either the $from_date if specified,
	 * or the current date/time.
	 *
	 * @param int $product_id The product/post ID of the subscription
	 * @param mixed $from_date A MySQL formatted date/time string from which to calculate the expiration date (in UTC timezone), or empty (default), which will use today's date/time (in UTC timezone).
	 * @since 1.0
	 */
	public static function get_trial_expiration_date( $product_id, $from_date = '' ) {

		$trial_period = self::get_trial_period( $product_id );
		$trial_length = self::get_trial_length( $product_id );

		if ( $trial_length > 0 ) {

			if ( empty( $from_date ) ) {
				$from_date = gmdate( 'Y-m-d H:i:s' );
			}

			if ( 'month' == $trial_period ) {
				$trial_expiration_date = date( 'Y-m-d H:i:s', wcs_add_months( strtotime( $from_date ), $trial_length ) );
			} else { // Safe to just add the billing periods
				$trial_expiration_date = date( 'Y-m-d H:i:s', strtotime( "+ {$trial_length} {$trial_period}s", strtotime( $from_date ) ) );
			}
		} else {

			$trial_expiration_date = 0;

		}

		return apply_filters( 'woocommerce_subscriptions_product_trial_expiration_date', $trial_expiration_date, $product_id, $from_date );
	}

	/**
	 * Checks the classname being used for a product variation to see if it should be a subscription product
	 * variation, and if so, returns this as the class which should be instantiated (instead of the default
	 * WC_Product_Variation class).
	 *
	 * @return string $classname The name of the WC_Product_* class which should be instantiated to create an instance of this product.
	 * @since 1.3
	 */
	public static function set_subscription_variation_class( $classname, $product_type, $post_type, $product_id ) {

		if ( 'product_variation' === $post_type && 'variation' === $product_type ) {

			$terms = get_the_terms( get_post( $product_id )->post_parent, 'product_type' );

			$parent_product_type = ! empty( $terms ) && isset( current( $terms )->slug ) ? current( $terms )->slug : '';

			if ( 'variable-subscription' === $parent_product_type ) {
				$classname = 'WC_Product_Subscription_Variation';
			}
		}

		return $classname;
	}

	/**
	 * Ensures a price is displayed for subscription variation where WC would normally ignore it (i.e. when prices are equal).
	 *
	 * @return array $variation_details Set of name/value pairs representing the subscription.
	 * @since 1.3.6
	 */
	public static function maybe_set_variations_price_html( $variation_details, $variable_product, $variation ) {

		if ( 'variable-subscription' == $variable_product->product_type && empty( $variation_details['price_html'] ) ) {
			$variation_details['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
		}

		return $variation_details;
	}

	/**
	 * Do not allow any user to delete a subscription product if it is associated with an order.
	 *
	 * Those with appropriate capabilities can still trash the product, but they will not be able to permanently
	 * delete the product if it is associated with an order (i.e. been purchased).
	 *
	 * @since 1.4.9
	 */
	public static function user_can_not_delete_subscription( $allcaps, $caps, $args ) {
		global $wpdb;

		if ( isset( $args[0] ) && in_array( $args[0], array( 'delete_post', 'delete_product' ) ) && isset( $args[2] ) && ( ! isset( $_GET['action'] ) || 'untrash' != $_GET['action'] ) ) {

			$user_id = $args[2];
			$post_id = $args[2];
			$product = wc_get_product( $post_id );

			if ( false !== $product && 'trash' == $product->post->post_status && $product->is_type( array( 'subscription', 'variable-subscription', 'subscription_variation' ) ) ) {

				$product_id = ( $product->is_type( 'subscription_variation' ) ) ? $product->post->ID : $post_id;

				$subscription_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `{$wpdb->prefix}woocommerce_order_itemmeta` WHERE `meta_key` = '_product_id' AND `meta_value` = %d", $product_id ) );

				if ( $subscription_count > 0 ) {
					$allcaps[ $caps[0] ] = false;
				}
			}
		}

		return $allcaps;
	}

	/**
	 * Make sure the 'untrash' (i.e. "Restore") row action is displayed.
	 *
	 * In @see self::user_can_not_delete_subscription() we prevent a store manager being able to delete a subscription product.
	 * However, WooCommerce also uses the `delete_post` capability to check whether to display the 'trash' and 'untrash' row actions.
	 * We want a store manager to be able to trash and untrash subscriptions, so this function adds them again.
	 *
	 * @return array $actions Array of actions that can be performed on the post.
	 * @return array $post Array of post values for the current product (or post object if it is not a product).
	 * @since 1.4.9
	 */
	public static function subscription_row_actions( $actions, $post ) {
		global $the_product;

		if ( ! empty( $the_product ) && ! isset( $actions['untrash'] ) && $the_product->is_type( array( 'subscription', 'variable-subscription', 'subscription_variation' ) ) ) {

			$post_type_object = get_post_type_object( $post->post_type );

			if ( 'trash' == $post->post_status && current_user_can( $post_type_object->cap->edit_post, $post->ID ) ) {
				$actions['untrash'] = "<a
				title='" . esc_attr__( 'Restore this item from the Trash', 'woocommerce-subscriptions' ) . "'
				href='" . wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $post->ID ) ), 'untrash-post_' . $post->ID ) . "'>" . __( 'Restore', 'woocommerce-subscriptions' ) . '</a>';
			}
		}

		return $actions;
	}

	/**
	 * Remove the "Delete Permanently" action from the bulk actions select element on the Products admin screen.
	 *
	 * Because any subscription products associated with an order can not be permanently deleted (as a result of
	 * @see self::user_can_not_delete_subscription() ), leaving the bulk action in can lead to the store manager
	 * hitting the "You are not allowed to delete this item" brick wall and not being able to continue with the
	 * deletion (or get any more detailed information about which item can't be deleted and why).
	 *
	 * @return array $actions Array of actions that can be performed on the post.
	 * @since 1.4.9
	 */
	public static function subscription_bulk_actions( $actions ) {

		unset( $actions['delete'] );

		return $actions;
	}

	/**
	 * Hooked to the @see 'wp_scheduled_delete' WP-Cron scheduled task to rename the '_wp_trash_meta_time' meta value
	 * as '_wc_trash_meta_time'. This is the flag used by WordPress to determine which posts should be automatically
	 * purged from the trash. We want to make sure Subscriptions products are not automatically purged (but still want
	 * to keep a record of when the product was trashed).
	 *
	 * @since 1.4.9
	 */
	public static function prevent_scheduled_deletion() {
		global $wpdb;

		$query = "UPDATE $wpdb->postmeta
					INNER JOIN $wpdb->posts ON $wpdb->postmeta.post_id = $wpdb->posts.ID
					SET $wpdb->postmeta.meta_key = '_wc_trash_meta_time'
					WHERE $wpdb->postmeta.meta_key = '_wp_trash_meta_time'
					AND $wpdb->posts.post_type IN ( 'product', 'product_variation')
					AND $wpdb->posts.post_status = 'trash'";

		$wpdb->query( $query );
	}

	/**
	 * Trash subscription variations - don't delete them permanently.
	 *
	 * This is hooked to 'wp_ajax_woocommerce_remove_variation' & 'wp_ajax_woocommerce_remove_variations'
	 * before WooCommerce's WC_AJAX::remove_variation() or WC_AJAX::remove_variations() functions are run.
	 * The WooCommerce functions will still run after this, but if the variation is a subscription, the
	 * request will either terminate or in the case of bulk deleting, the variation's ID will be removed
	 * from the $_POST.
	 *
	 * @since 1.4.9
	 */
	public static function remove_variations() {

		if ( isset( $_POST['variation_id'] ) ) { // removing single variation

			check_ajax_referer( 'delete-variation', 'security' );
			$variation_ids = array( $_POST['variation_id'] );

		} else {  // removing multiple variations

			check_ajax_referer( 'delete-variations', 'security' );
			$variation_ids = (array) $_POST['variation_ids'];

		}

		foreach ( $variation_ids as $index => $variation_id ) {

			$variation_post = get_post( $variation_id );

			if ( $variation_post && $variation_post->post_type == 'product_variation' ) {

				$variation_product = wc_get_product( $variation_id );

				if ( $variation_product && $variation_product->is_type( 'subscription_variation' ) ) {

					wp_trash_post( $variation_id );

					// Prevent WooCommerce deleting the variation
					if ( isset( $_POST['variation_id'] ) ) {
						die();
					} else {
						unset( $_POST['variation_ids'][ $index ] );
					}
				}
			}
		}
	}

	/**
	 * If a product is being marked as not purchasable because it is limited and the customer has a subscription,
	 * but the current request is to resubscribe to the subscription, then mark it as purchasable.
	 *
	 * @since 2.0
	 * @return bool
	 */
	public static function is_purchasable( $is_purchasable, $product ) {
		global $wp;

		if ( ! isset( self::$is_purchasable_cache[ $product->id ] ) ) {

			self::$is_purchasable_cache[ $product->id ] = $is_purchasable;

			if ( self::is_subscription( $product->id ) && 'no' != $product->limit_subscriptions && ! wcs_is_order_received_page() && ! wcs_is_paypal_api_page() ) {

				if ( ( ( 'active' == $product->limit_subscriptions && wcs_user_has_subscription( 0, $product->id, 'on-hold' ) ) || wcs_user_has_subscription( 0, $product->id, $product->limit_subscriptions ) ) && ! self::order_awaiting_payment_for_product( $product->id ) ) {
					self::$is_purchasable_cache[ $product->id ] = false;
				}
			}
		}

		return self::$is_purchasable_cache[ $product->id ];
	}

	/**
	 * Save variation meta data when it is bulk edited from the Edit Product screen
	 *
	 * @param string $bulk_action The bulk edit action being performed
	 * @param array $data An array of data relating to the bulk edit action. $data['value'] represents the new value for the meta.
	 * @param int $variable_product_id The post ID of the parent variable product.
	 * @param array $variation_ids An array of post IDs for the variable prodcut's variations.
	 * @since 1.5.29
	 */
	public static function bulk_edit_variations( $bulk_action, $data, $variable_product_id, $variation_ids ) {

		if ( WC_Subscriptions::is_woocommerce_pre( '2.5' ) ) {
			// Pre 2.5 we don't have the product type information available so we have to check if it is a subscription - downside here is this only works if the product has already been saved
			if ( ! self::is_subscription( $variable_product_id ) ) {
				return;
			}
		} else {
			// Since 2.5 we have the product type information available so we don't have to wait for the product to be saved to check if it is a subscription
			if ( empty( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'bulk-edit-variations' ) || 'variable-subscription' !== $_POST['product_type'] ) {
				return;
			}
		}

		$meta_key = str_replace( 'variable', '', $bulk_action );

		// Update the subscription price when updating regular price on a variable subscription product
		if ( '_regular_price' == $meta_key ) {
			$meta_key = '_subscription_price';
		}

		if ( in_array( $meta_key, self::$subscription_meta_fields ) ) {
			foreach ( $variation_ids as $variation_id ) {
				update_post_meta( $variation_id, $meta_key, stripslashes( $data['value'] ) );
			}
		} else if ( in_array( $meta_key, array( '_regular_price_increase', '_regular_price_decrease' ) ) ) {
			$operator = ( '_regular_price_increase' == $meta_key ) ? '+' : '-';
			$value    = wc_clean( $data['value'] );

			foreach ( $variation_ids as $variation_id ) {
				 $subscription_price = get_post_meta( $variation_id, '_subscription_price', true );

				if ( '%' === substr( $value, -1 ) ) {
					$percent = wc_format_decimal( substr( $value, 0, -1 ) );
					$subscription_price += ( ( $subscription_price / 100 ) * $percent ) * "{$operator}1";
				} else {
					$subscription_price += $value * "{$operator}1";
				}

				update_post_meta( $variation_id, '_subscription_price', $subscription_price );
			}
		}
	}

	/**
	 * Check if the current session has an order awaiting payment for a subscription to a specific product line item.
	 *
	 * @return 2.0.13
	 * @return bool
	 **/
	protected static function order_awaiting_payment_for_product( $product_id ) {
		global $wp;

		if ( ! isset( self::$order_awaiting_payment_for_product[ $product_id ] ) ) {

			self::$order_awaiting_payment_for_product[ $product_id ] = false;

			if ( ! empty( WC()->session->order_awaiting_payment ) || isset( $_GET['pay_for_order'] ) ) {

				$order_id = ! empty( WC()->session->order_awaiting_payment ) ? WC()->session->order_awaiting_payment : $wp->query_vars['order-pay'];
				$order    = wc_get_order( absint( $order_id ) );

				if ( is_object( $order ) && $order->has_status( array( 'pending', 'failed' ) ) ) {
					foreach ( $order->get_items() as $item ) {
						if ( $item['product_id'] == $product->id || $item['variation_id'] == $product->id ) {

							$subscriptions = wcs_get_subscriptions( array(
								'order_id'   => $order->id,
								'product_id' => $product->id,
							) );

							if ( ! empty( $subscriptions ) ) {
								$subscription = array_pop( $subscriptions );

								if ( $subscription->has_status( array( 'pending', 'on-hold' ) ) ) {
									self::$order_awaiting_payment_for_product[ $product_id ] = true;
								}
							}
							break;
						}
					}
				}
			}
		}

		return self::$order_awaiting_payment_for_product[ $product_id ];
	}

	/**
	 * Calculates a price (could be per period price or sign-up fee) for a subscription less tax
	 * if the subscription is taxable and the prices in the store include tax.
	 *
	 * Based on the WC_Product::get_price_excluding_tax() function.
	 *
	 * @param float $price The price to adjust based on taxes
	 * @param WC_Product $product The product the price belongs too (needed to determine tax class)
	 * @since 1.0
	 */
	public static function calculate_tax_for_subscription( $price, $product, $deduct_base_taxes = false ) {
		_deprecated_function( __METHOD__, '1.5.8', 'WC_Product::get_price_including_tax()' );

		if ( $product->is_taxable() ) {

			$tax = new WC_Tax();

			$base_tax_rates = $tax->get_shop_base_rate( $product->tax_class );
			$tax_rates      = $tax->get_rates( $product->get_tax_class() ); // This will get the base rate unless we're on the checkout page

			if ( $deduct_base_taxes && wc_prices_include_tax() ) {

				$base_taxes = $tax->calc_tax( $price, $base_tax_rates, true );
				$taxes      = $tax->calc_tax( $price - array_sum( $base_taxes ), $tax_rates, false );

			} elseif ( get_option( 'woocommerce_prices_include_tax' ) == 'yes' ) {

				$taxes = $tax->calc_tax( $price, $base_tax_rates, true );

			} else {

				$taxes = $tax->calc_tax( $price, $base_tax_rates, false );

			}

			$tax_amount = $tax->get_tax_total( $taxes );

		} else {

			$tax_amount = 0;

		}

		return $tax_amount;
	}


	/**
	 * Deprecated in favour of native get_price_html() method on the Subscription Product classes (e.g. WC_Product_Subscription)
	 *
	 * Output subscription string as the price html
	 *
	 * @since 1.0
	 * @deprecated 1.5.18
	 */
	public static function get_price_html( $price, $product ) {
		_deprecated_function( __METHOD__, '1.5.18', __CLASS__ . '::get_price_string()' );

		if ( self::is_subscription( $product ) ) {
			$price = self::get_price_string( $product, array( 'price' => $price ) );
		}

		return $price;
	}

	/**
	 * Deprecated in favour of native get_price_html() method on the Subscription Product classes (e.g. WC_Product_Subscription)
	 *
	 * Set the subscription string for products which have a $0 recurring fee, but a sign-up fee
	 *
	 * @since 1.3.4
	 * @deprecated 1.5.18
	 */
	public static function get_free_price_html( $price, $product ) {
		_deprecated_function( __METHOD__, '1.5.18', __CLASS__ . '::get_price_string()' );

		// Check if it has a sign-up fee (we already know it has no recurring fee)
		if ( self::is_subscription( $product ) && self::get_sign_up_fee( $product ) > 0 ) {
			$price = self::get_price_string( $product, array( 'price' => $price ) );
		}

		return $price;
	}
}

WC_Subscriptions_Product::init();
