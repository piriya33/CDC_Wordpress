<?php
/**
 * Subscriptions Admin Class
 *
 * Adds a Subscription setting tab and saves subscription settings. Adds a Subscriptions Management page. Adds
 * Welcome messages and pointers to streamline learning process for new users.
 *
 * @package		WooCommerce Subscriptions
 * @subpackage	WC_Subscriptions_Admin
 * @category	Class
 * @author		Brent Shepherd
 * @since		1.0
 */
class WC_Subscriptions_Admin {

	/**
	 * The WooCommerce settings tab name
	 *
	 * @since 1.0
	 */
	public static $tab_name = 'subscriptions';

	/**
	 * The prefix for subscription settings
	 *
	 * @since 1.0
	 */
	public static $option_prefix = 'woocommerce_subscriptions';

	/**
	 * Store an instance of the list table
	 *
	 * @since 1.4.6
	 */
	private static $subscriptions_list_table;

	/**
	 * Store an instance of the list table
	 *
	 * @since 2.0
	 */
	private static $found_related_orders = false;

	/**
	 * Bootstraps the class and hooks required actions & filters.
	 *
	 * @since 1.0
	 */
	public static function init() {

		// Add subscriptions to the product select box
		add_filter( 'product_type_selector', __CLASS__ . '::add_subscription_products_to_select' );

		// Add subscription pricing fields on edit product page
		add_action( 'woocommerce_product_options_general_product_data', __CLASS__ . '::subscription_pricing_fields' );

		// Add subscription shipping options on edit product page
		add_action( 'woocommerce_product_options_shipping', __CLASS__ . '::subscription_shipping_fields' );

		// Add advanced subscription options on edit product page
		add_action( 'woocommerce_product_options_reviews', __CLASS__ . '::subscription_advanced_fields' );

		// And also on the variations section
		add_action( 'woocommerce_product_after_variable_attributes', __CLASS__ . '::variable_subscription_pricing_fields', 10, 3 );

		// Add bulk edit actions for variable subscription products
		add_action( 'woocommerce_variable_product_bulk_edit_actions', __CLASS__ . '::variable_subscription_bulk_edit_actions', 10 );

		// Save subscription meta when a subscription product is changed via bulk edit
		add_action( 'woocommerce_product_bulk_edit_save', __CLASS__ . '::bulk_edit_save_subscription_meta', 10 );

		// Save subscription meta only when a subscription product is saved, can't run on the "'woocommerce_process_product_meta_' . $product_type" action because we need to override some WC defaults
		add_action( 'save_post', __CLASS__ . '::save_subscription_meta', 11 );
		add_action( 'save_post', __CLASS__ . '::save_variable_subscription_meta', 11 );

		// Save variable subscription meta
		add_action( 'woocommerce_process_product_meta_variable-subscription', __CLASS__ . '::process_product_meta_variable_subscription' ); // WC < 2.4
		add_action( 'woocommerce_ajax_save_product_variations', __CLASS__ . '::process_product_meta_variable_subscription' );

		add_action( 'product_variation_linked', __CLASS__ . '::set_variation_meta_defaults_on_bulk_add' );

		add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_subscription_settings_tab', 50 );

		add_action( 'woocommerce_settings_tabs_subscriptions', __CLASS__ . '::subscription_settings_page' );

		add_action( 'woocommerce_update_options_' . self::$tab_name, __CLASS__ . '::update_subscription_settings' );

		add_filter( 'manage_users_columns', __CLASS__ . '::add_user_columns', 11, 1 );

		add_filter( 'manage_users_custom_column', __CLASS__ . '::user_column_values', 11, 3 ); // Fire after default to avoid being broken by plugins #doing_it_wrong

		add_action( 'admin_enqueue_scripts', __CLASS__ . '::enqueue_styles_scripts' );

		add_action( 'woocommerce_admin_field_informational', __CLASS__ . '::add_informational_admin_field' );

		add_filter( 'posts_where', __CLASS__ . '::filter_orders' );

		add_action( 'admin_notices',  __CLASS__ . '::display_renewal_filter_notice' );

		add_shortcode( 'subscriptions', __CLASS__ . '::do_subscriptions_shortcode' );

		add_filter( 'set-screen-option', __CLASS__ . '::set_manage_subscriptions_screen_option', 10, 3 );

		add_filter( 'woocommerce_debug_posting', __CLASS__ . '::add_system_status_items' );

		add_filter( 'woocommerce_payment_gateways_setting_columns', __CLASS__ . '::payment_gateways_rewewal_column' );

		add_action( 'woocommerce_payment_gateways_setting_column_renewals', __CLASS__ . '::payment_gateways_rewewal_support' );

		// Do not display formatted order total on the Edit Order administration screen
		add_filter( 'woocommerce_get_formatted_order_total', __CLASS__ . '::maybe_remove_formatted_order_total_filter', 0, 2 );
	}

	/**
	 * Add the 'subscriptions' product type to the WooCommerce product type select box.
	 *
	 * @param array Array of Product types & their labels, excluding the Subscription product type.
	 * @return array Array of Product types & their labels, including the Subscription product type.
	 * @since 1.0
	 */
	public static function add_subscription_products_to_select( $product_types ) {

		$product_types['subscription']          = __( 'Simple Subscription', 'woocommerce-subscriptions' );
		$product_types['variable-subscription'] = __( 'Variable Subscription', 'woocommerce-subscriptions' );

		return $product_types;
	}

	/**
	 * Output the subscription specific pricing fields on the "Edit Product" admin page.
	 *
	 * @since 1.0
	 */
	public static function subscription_pricing_fields() {
		global $post;

		// Set month as the default billing period
		if ( ! $subscription_period = get_post_meta( $post->ID, '_subscription_period', true ) ) {
		 	$subscription_period = 'month';
		}

		echo '<div class="options_group subscription_pricing show_if_subscription">';

		// Subscription Price
		woocommerce_wp_text_input( array(
			'id'          => '_subscription_price',
			'class'       => 'wc_input_subscription_price',
			// translators: placeholder is a currency symbol / code
			'label'       => sprintf( __( 'Subscription Price (%s)', 'woocommerce-subscriptions' ), get_woocommerce_currency_symbol() ),
			'placeholder' => _x( 'e.g. 9.90', 'example price', 'woocommerce-subscriptions' ),
			'type'        => 'text',
			'custom_attributes' => array(
					'step' => 'any',
					'min'  => '0',
			),
		) );

		// Subscription Period Interval
		woocommerce_wp_select( array(
			'id'          => '_subscription_period_interval',
			'class'       => 'wc_input_subscription_period_interval',
			'label'       => __( 'Subscription Periods', 'woocommerce-subscriptions' ),
			'options'     => wcs_get_subscription_period_interval_strings(),
			)
		);

		// Billing Period
		woocommerce_wp_select( array(
			'id'          => '_subscription_period',
			'class'       => 'wc_input_subscription_period',
			'label'       => __( 'Billing Period', 'woocommerce-subscriptions' ),
			'value'       => $subscription_period,
			'description' => _x( 'for', 'for in "Every month _for_ 12 months"', 'woocommerce-subscriptions' ),
			'options'     => wcs_get_subscription_period_strings(),
			)
		);

		// Subscription Length
		woocommerce_wp_select( array(
			'id'          => '_subscription_length',
			'class'       => 'wc_input_subscription_length',
			'label'       => __( 'Subscription Length', 'woocommerce-subscriptions' ),
			'options'     => wcs_get_subscription_ranges( $subscription_period ),
			)
		);

		// Sign-up Fee
		woocommerce_wp_text_input( array(
			'id'          => '_subscription_sign_up_fee',
			'class'       => 'wc_input_subscription_intial_price',
			// translators: %s is a currency symbol / code
			'label'       => sprintf( __( 'Sign-up Fee (%s)', 'woocommerce-subscriptions' ), get_woocommerce_currency_symbol() ),
			'placeholder' => _x( 'e.g. 9.90', 'example price', 'woocommerce-subscriptions' ),
			'description' => __( 'Optionally include an amount to be charged at the outset of the subscription. The sign-up fee will be charged immediately, even if the product has a free trial or the payment dates are synced.', 'woocommerce-subscriptions' ),
			'desc_tip'    => true,
			'type'        => 'text',
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		) );

		// Trial Length
		woocommerce_wp_text_input( array(
			'id'          => '_subscription_trial_length',
			'class'       => 'wc_input_subscription_trial_length',
			'label'       => __( 'Free Trial', 'woocommerce-subscriptions' ),
		) );

		// Trial Period
		woocommerce_wp_select( array(
			'id'          => '_subscription_trial_period',
			'class'       => 'wc_input_subscription_trial_period',
			'label'       => __( 'Subscription Trial Period', 'woocommerce-subscriptions' ),
			'options'     => wcs_get_available_time_periods(),
			// translators: placeholder is trial period validation message if passed an invalid value (e.g. "Trial period can not exceed 4 weeks")
			'description' => sprintf( _x( 'An optional period of time to wait before charging the first recurring payment. Any sign up fee will still be charged at the outset of the subscription. %s', 'Trial period dropdown\'s description in pricing fields', 'woocommerce-subscriptions' ), self::get_trial_period_validation_message() ),
			'desc_tip'    => true,
			'value'       => WC_Subscriptions_Product::get_trial_period( $post->ID ), // Explicitly set value in to ensure backward compatibility
		) );

		do_action( 'woocommerce_subscriptions_product_options_pricing' );

		wp_nonce_field( 'wcs_subscription_meta', '_wcsnonce' );

		echo '</div>';
		echo '<div class="show_if_subscription clear"></div>';
	}

	/**
	 * Output subscription shipping options on the "Edit Product" admin screen
	 *
	 * @since 2.0
	 */
	public static function subscription_shipping_fields() {
		global $post;

		echo '</div>';
		echo '<div class="options_group subscription_one_time_shipping show_if_subscription show_if_variable-subscription">';

		// Only one Subscription per customer
		woocommerce_wp_checkbox( array(
			'id'          => '_subscription_one_time_shipping',
			'label'       => __( 'One Time Shipping', 'woocommerce-subscriptions' ),
			'description' => __( 'Shipping for subscription products is normally charged on the initial order and all renewal orders. Enable this to only charge shipping once on the initial order. Note: for shipping to be charged on the initial order, the subscription must not have a free trial.', 'woocommerce-subscriptions' ),
			'desc_tip'    => true,
		) );

		do_action( 'woocommerce_subscriptions_product_options_shipping' );

	}

	/**
	 * Output advanced subscription options on the "Edit Product" admin screen
	 *
	 * @since 1.3.5
	 */
	public static function subscription_advanced_fields() {
		global $post;

		echo '</div>';
		echo '<div class="options_group limit_subscription show_if_subscription show_if_variable-subscription">';

		// Only one Subscription per customer
		woocommerce_wp_select( array(
			'id'          => '_subscription_limit',
			'label'       => __( 'Limit Subscription', 'woocommerce-subscriptions' ),
			// translators: placeholders are opening and closing link tags
			'description' => sprintf( __( 'Only allow a customer to have one subscription to this product. %sLearn more%s.', 'woocommerce-subscriptions' ), '<a href="http://docs.woothemes.com/document/subscriptions/store-manager-guide/#limit-subscription">', '</a>' ),
			'options'     => array(
				'no'     => __( 'Do not limit', 'woocommerce-subscriptions' ),
				'active' => __( 'Limit to one active subscription', 'woocommerce-subscriptions' ),
				'any'    => __( 'Limit to one of any status', 'woocommerce-subscriptions' ),
			),
		) );

		do_action( 'woocommerce_subscriptions_product_options_advanced' );

	}

	/**
	 * Output the subscription specific pricing fields on the "Edit Product" admin page.
	 *
	 * @since 1.3
	 */
	public static function variable_subscription_pricing_fields( $loop, $variation_data, $variation ) {
		global $thepostid;

		// Set month as the default billing period
		if ( ! $subscription_period = get_post_meta( $variation->ID, '_subscription_period', true ) ) {
			$subscription_period = 'month';
		}

		// When called via Ajax
		if ( ! function_exists( 'woocommerce_wp_text_input' ) ) {
			require_once( WC()->plugin_path() . '/admin/post-types/writepanels/writepanels-init.php' );
		}

		if ( ! isset( $thepostid ) ) {
			$thepostid = $variation->post_parent;
		}

		include( plugin_dir_path( WC_Subscriptions::$plugin_file ) . 'templates/admin/html-variation-price.php' );

		wp_nonce_field( 'wcs_subscription_variations', '_wcsnonce_save_variations', false );

		do_action( 'woocommerce_variable_subscription_pricing', $loop, $variation_data, $variation );
	}

	/**
	 * Output extra options in the Bulk Edit select box for editing Subscription terms.
	 *
	 * @since 1.3
	 */
	public static function variable_subscription_bulk_edit_actions() {
		global $post;

		if ( WC_Subscriptions_Product::is_subscription( $post->ID ) ) : ?>
			<optgroup label="<?php esc_attr_e( 'Subscription Pricing', 'woocommerce-subscriptions' ); ?>">
				<option value="variable_subscription_sign_up_fee"><?php esc_html_e( 'Subscription Sign-up Fee', 'woocommerce-subscriptions' ); ?></option>
				<option value="variable_subscription_period_interval"><?php esc_html_e( 'Subscription Billing Interval', 'woocommerce-subscriptions' ); ?></option>
				<option value="variable_subscription_period"><?php esc_html_e( 'Subscription Period', 'woocommerce-subscriptions' ); ?></option>
				<option value="variable_subscription_length"><?php esc_html_e( 'Subscription Length', 'woocommerce-subscriptions' ); ?></option>
				<option value="variable_subscription_trial_length"><?php esc_html_e( 'Free Trial Length', 'woocommerce-subscriptions' ); ?></option>
				<option value="variable_subscription_trial_period"><?php esc_html_e( 'Free Trial Period', 'woocommerce-subscriptions' ); ?></option>
			</optgroup>
		<?php endif;
	}

	/**
	 * Save meta data for simple subscription product type when the "Edit Product" form is submitted.
	 *
	 * @param array Array of Product types & their labels, excluding the Subscription product type.
	 * @return array Array of Product types & their labels, including the Subscription product type.
	 * @since 1.0
	 */
	public static function save_subscription_meta( $post_id ) {

		if ( empty( $_POST['_wcsnonce'] ) || ! wp_verify_nonce( $_POST['_wcsnonce'], 'wcs_subscription_meta' ) || ! isset( $_POST['product-type'] ) || ! in_array( $_POST['product-type'], apply_filters( 'woocommerce_subscription_product_types', array( WC_Subscriptions::$name ) ) ) ) {
			return;
		}

		$subscription_price = isset( $_REQUEST['_subscription_price'] ) ? wc_format_decimal( $_REQUEST['_subscription_price'] ) : '';
		$sale_price         = wc_format_decimal( $_REQUEST['_sale_price'] );

		update_post_meta( $post_id, '_subscription_price', $subscription_price );

		// Set sale details - these are ignored by WC core for the subscription product type
		update_post_meta( $post_id, '_regular_price', $subscription_price );
		update_post_meta( $post_id, '_sale_price', $sale_price );

		$date_from = ( isset( $_POST['_sale_price_dates_from'] ) ) ? strtotime( $_POST['_sale_price_dates_from'] ) : '';
		$date_to   = ( isset( $_POST['_sale_price_dates_to'] ) ) ? strtotime( $_POST['_sale_price_dates_to'] ) : '';

		$now = gmdate( 'U' );

		if ( ! empty( $date_to ) && empty( $date_from ) ) {
			$date_from = $now;
		}

		update_post_meta( $post_id, '_sale_price_dates_from', $date_from );
		update_post_meta( $post_id, '_sale_price_dates_to', $date_to );

		// Update price if on sale
		if ( ! empty( $sale_price ) && ( ( empty( $date_to ) && empty( $date_from ) ) || ( $date_from < $now && ( empty( $date_to ) || $date_to > $now ) ) ) ) {
			$price = $sale_price;
		} else {
			$price = $subscription_price;
		}

		update_post_meta( $post_id, '_price', stripslashes( $price ) );

		// Make sure trial period is within allowable range
		$subscription_ranges = wcs_get_subscription_ranges();

		$max_trial_length = count( $subscription_ranges[ $_POST['_subscription_trial_period'] ] ) - 1;

		$_POST['_subscription_trial_length'] = absint( $_POST['_subscription_trial_length'] );

		if ( $_POST['_subscription_trial_length'] > $max_trial_length ) {
			$_POST['_subscription_trial_length'] = $max_trial_length;
		}

		update_post_meta( $post_id, '_subscription_trial_length', $_POST['_subscription_trial_length'] );

		$_REQUEST['_subscription_sign_up_fee']       = wc_format_decimal( $_REQUEST['_subscription_sign_up_fee'] );
		$_REQUEST['_subscription_one_time_shipping'] = isset( $_REQUEST['_subscription_one_time_shipping'] ) ? 'yes' : 'no';

		$subscription_fields = array(
			'_subscription_sign_up_fee',
			'_subscription_period',
			'_subscription_period_interval',
			'_subscription_length',
			'_subscription_trial_period',
			'_subscription_limit',
			'_subscription_one_time_shipping',
		);

		foreach ( $subscription_fields as $field_name ) {
			if ( isset( $_REQUEST[ $field_name ] ) ) {
				update_post_meta( $post_id, $field_name, stripslashes( $_REQUEST[ $field_name ] ) );
			}
		}

	}

	/**
	 * Save meta data for variable subscription product type when the "Edit Product" form is submitted.
	 *
	 * @param array Array of Product types & their labels, excluding the Subscription product type.
	 * @return array Array of Product types & their labels, including the Subscription product type.
	 * @since 2.0
	 */
	public static function save_variable_subscription_meta( $post_id ) {

		if ( empty( $_POST['_wcsnonce'] ) || ! wp_verify_nonce( $_POST['_wcsnonce'], 'wcs_subscription_meta' ) || ! isset( $_POST['product-type'] ) || ! in_array( $_POST['product-type'], apply_filters( 'woocommerce_subscription_variable_product_types', array( 'variable-subscription' ) ) ) ) {
			return;
		}

		if ( isset( $_REQUEST['_subscription_limit'] ) ) {
			update_post_meta( $post_id, '_subscription_limit', stripslashes( $_REQUEST['_subscription_limit'] ) );
		}

		update_post_meta( $post_id, '_subscription_one_time_shipping', stripslashes( isset( $_REQUEST['_subscription_one_time_shipping'] ) ? 'yes' : 'no' ) );

	}

	/**
	 * Calculate and set a simple subscription's prices when edited via the bulk edit
	 *
	 * @param object $product An instance of a WC_Product_* object.
	 * @return null
	 * @since 1.3.9
	 */
	public static function bulk_edit_save_subscription_meta( $product ) {

		if ( ! $product->is_type( 'subscription' ) ) {
			return;
		}

		$price_changed = false;

		$old_regular_price = $product->regular_price;
		$old_sale_price    = $product->sale_price;

		if ( ! empty( $_REQUEST['change_regular_price'] ) ) {

			$change_regular_price = absint( $_REQUEST['change_regular_price'] );
			$regular_price = esc_attr( stripslashes( $_REQUEST['_regular_price'] ) );

			switch ( $change_regular_price ) {
				case 1 :
					$new_price = $regular_price;
				break;
				case 2 :
					if ( strstr( $regular_price, '%' ) ) {
						$percent = str_replace( '%', '', $regular_price ) / 100;
						$new_price = $old_regular_price + ( $old_regular_price * $percent );
					} else {
						$new_price = $old_regular_price + $regular_price;
					}
				break;
				case 3 :
					if ( strstr( $regular_price, '%' ) ) {
						$percent = str_replace( '%', '', $regular_price ) / 100;
						$new_price = $old_regular_price - ( $old_regular_price * $percent );
					} else {
						$new_price = $old_regular_price - $regular_price;
					}
				break;
			}

			if ( isset( $new_price ) && $new_price != $old_regular_price ) {
				$price_changed = true;
				update_post_meta( $product->id, '_regular_price', $new_price );
				update_post_meta( $product->id, '_subscription_price', $new_price );
				$product->regular_price = $new_price;
			}
		}

		if ( ! empty( $_REQUEST['change_sale_price'] ) ) {

			$change_sale_price = absint( $_REQUEST['change_sale_price'] );
			$sale_price = esc_attr( stripslashes( $_REQUEST['_sale_price'] ) );

			switch ( $change_sale_price ) {
				case 1 :
					$new_price = $sale_price;
				break;
				case 2 :
					if ( strstr( $sale_price, '%' ) ) {
						$percent = str_replace( '%', '', $sale_price ) / 100;
						$new_price = $old_sale_price + ( $old_sale_price * $percent );
					} else {
						$new_price = $old_sale_price + $sale_price;
					}
				break;
				case 3 :
					if ( strstr( $sale_price, '%' ) ) {
						$percent = str_replace( '%', '', $sale_price ) / 100;
						$new_price = $old_sale_price - ( $old_sale_price * $percent );
					} else {
						$new_price = $old_sale_price - $sale_price;
					}
				break;
				case 4 :
					if ( strstr( $sale_price, '%' ) ) {
						$percent = str_replace( '%', '', $sale_price ) / 100;
						$new_price = $product->regular_price - ( $product->regular_price * $percent );
					} else {
						$new_price = $product->regular_price - $sale_price;
					}
				break;
			}

			if ( isset( $new_price ) && $new_price != $old_sale_price ) {
				$price_changed = true;
				update_post_meta( $product->id, '_sale_price', $new_price );
				$product->sale_price = $new_price;
			}
		}

		if ( $price_changed ) {
			update_post_meta( $product->id, '_sale_price_dates_from', '' );
			update_post_meta( $product->id, '_sale_price_dates_to', '' );

			if ( $product->regular_price < $product->sale_price ) {
				$product->sale_price = '';
				update_post_meta( $product->id, '_sale_price', '' );
			}

			if ( $product->sale_price ) {
				update_post_meta( $product->id, '_price', $product->sale_price );
			} else {
				update_post_meta( $product->id, '_price', $product->regular_price );
			}
		}
	}

	/**
	 * Save a variable subscription's details when the edit product page is submitted for a variable
	 * subscription product type (or the bulk edit product is saved).
	 *
	 * @param int $post_id ID of the parent WC_Product_Variable_Subscription
	 * @return null
	 * @since 1.3
	 */
	public static function process_product_meta_variable_subscription( $post_id ) {

		if ( ! WC_Subscriptions_Product::is_subscription( $post_id ) || empty( $_POST['_wcsnonce_save_variations'] ) || ! wp_verify_nonce( $_POST['_wcsnonce_save_variations'], 'wcs_subscription_variations' ) ) {
			return;
		}

		// Make sure WooCommerce calculates correct prices
		$_POST['variable_regular_price'] = isset( $_POST['variable_subscription_price'] ) ? $_POST['variable_subscription_price'] : 0;

		// Run WooCommerce core saving routine for WC < 2.4
		if ( ! is_ajax() ) {
			WC_Meta_Box_Product_Data::save_variations( $post_id, get_post( $post_id ) );
		}

		if ( ! isset( $_REQUEST['variable_post_id'] ) ) {
			return;
		}

		$variable_post_ids = $_POST['variable_post_id'];

		$max_loop = max( array_keys( $variable_post_ids ) );

		// Save each variations details
		for ( $i = 0; $i <= $max_loop; $i ++ ) {

			if ( ! isset( $variable_post_ids[ $i ] ) ) {
				continue;
			}

			$variation_id = absint( $variable_post_ids[ $i ] );

			if ( isset( $_POST['variable_subscription_price'] ) && is_array( $_POST['variable_subscription_price'] ) ) {
				$subscription_price = wc_format_decimal( $_POST['variable_subscription_price'][ $i ] );
				update_post_meta( $variation_id, '_subscription_price', $subscription_price );
				update_post_meta( $variation_id, '_regular_price', $subscription_price );
			}

			// Make sure trial period is within allowable range
			$subscription_ranges = wcs_get_subscription_ranges();

			$max_trial_length = count( $subscription_ranges[ $_POST['variable_subscription_trial_period'][ $i ] ] ) - 1;

			$_POST['variable_subscription_trial_length'][ $i ] = absint( $_POST['variable_subscription_trial_length'][ $i ] );

			if ( $_POST['variable_subscription_trial_length'][ $i ] > $max_trial_length ) {
				$_POST['variable_subscription_trial_length'][ $i ] = $max_trial_length;
			}

			// Work around a WPML bug which means 'variable_subscription_trial_period' is not set when using "Edit Product" as the product translation interface
			if ( $_POST['variable_subscription_trial_length'][ $i ] < 0 ) {
				$_POST['variable_subscription_trial_length'][ $i ] = 0;
			}

			$subscription_fields = array(
				'_subscription_sign_up_fee',
				'_subscription_period',
				'_subscription_period_interval',
				'_subscription_length',
				'_subscription_trial_period',
				'_subscription_trial_length',
			);

			foreach ( $subscription_fields as $field_name ) {
				if ( isset( $_POST[ 'variable' . $field_name ][ $i ] ) ) {
					update_post_meta( $variation_id, $field_name, wc_clean( $_POST[ 'variable' . $field_name ][ $i ] ) );
				}
			}
		}

		// Now that all the variation's meta is saved, sync the min variation price
		$variable_subscription = wc_get_product( $post_id );
		$variable_subscription->variable_product_sync();

	}

	/**
	 * Set default values for subscription dropdown fields when bulk adding variations to fix issue #1342
	 *
	 * @param int $variation_id ID the post_id of the variation being added
	 * @return null
	 */
	public static function set_variation_meta_defaults_on_bulk_add( $variation_id ) {

		if ( ! empty( $variation_id ) ) {
			update_post_meta( $variation_id, '_subscription_period', 'month' );
			update_post_meta( $variation_id, '_subscription_period_interval', '1' );
			update_post_meta( $variation_id, '_subscription_length', '0' );
			update_post_meta( $variation_id, '_subscription_trial_period', 'month' );
		}
	}

	/**
	 * Adds all necessary admin styles.
	 *
	 * @param array Array of Product types & their labels, excluding the Subscription product type.
	 * @return array Array of Product types & their labels, including the Subscription product type.
	 * @since 1.0
	 */
	public static function enqueue_styles_scripts() {
		global $post;

		// Get admin screen id
		$screen = get_current_screen();

		$is_woocommerce_screen = ( in_array( $screen->id, array( 'product', 'edit-shop_order', 'shop_order', 'edit-shop_subscription', 'shop_subscription', 'users', 'woocommerce_page_wc-settings' ) ) ) ? true : false;
		$is_activation_screen  = ( get_transient( WC_Subscriptions::$activation_transient ) == true ) ? true : false;

		if ( $is_woocommerce_screen ) {

			$dependencies = array( 'jquery' );

			$woocommerce_admin_script_handle = 'wc-admin-meta-boxes';

			if ( $screen->id == 'product' ) {
				$dependencies[] = $woocommerce_admin_script_handle;
				$dependencies[] = 'wc-admin-product-meta-boxes';
				$dependencies[] = 'wc-admin-variation-meta-boxes';

				$script_params = array(
					'productType'              => WC_Subscriptions::$name,
					'trialPeriodSingular'      => wcs_get_available_time_periods(),
					'trialPeriodPlurals'       => wcs_get_available_time_periods( 'plural' ),
					'subscriptionLengths'      => wcs_get_subscription_ranges(),
					'trialTooLongMessages'     => self::get_trial_period_validation_message( 'separate' ),
					'bulkEditPeriodMessage'    => __( 'Enter the new period, either day, week, month or year:', 'woocommerce-subscriptions' ),
					'bulkEditLengthMessage'    => __( 'Enter a new length (e.g. 5):', 'woocommerce-subscriptions' ),
					'bulkEditIntervalhMessage' => __( 'Enter a new interval as a single number (e.g. to charge every 2nd month, enter 2):', 'woocommerce-subscriptions' ),
				);
			} else if ( 'edit-shop_order' == $screen->id ) {
				$script_params = array(
					'bulkTrashWarning' => __( "You are about to trash one or more orders which contain a subscription.\n\nTrashing the orders will also trash the subscriptions purchased with these orders.", 'woocommerce-subscriptions' ),
				);
			} else if ( 'shop_order' == $screen->id ) {
				$dependencies[] = $woocommerce_admin_script_handle;
				$dependencies[] = 'wc-admin-order-meta-boxes';

				if ( WC_Subscriptions::is_woocommerce_pre( '2.6' ) ) {
					$dependencies[] = 'wc-admin-order-meta-boxes-modal';
				}

				$script_params = array(
					'bulkTrashWarning'  => __( 'Trashing this order will also trash the subscription purchased with the order.', 'woocommerce-subscriptions' ),
					'changeMetaWarning' => __( "WARNING: Bad things are about to happen!\n\nThe payment gateway used to purchase this subscription does not support modifying a subscription's details.\n\nChanges to the billing period, recurring discount, recurring tax or recurring total may not be reflected in the amount charged by the payment gateway.", 'woocommerce-subscriptions' ),
					'removeItemWarning' => __( 'You are deleting a subscription item. You will also need to manually cancel and trash the subscription on the Manage Subscriptions screen.', 'woocommerce-subscriptions' ),
					'roundAtSubtotal'   => esc_attr( get_option( 'woocommerce_tax_round_at_subtotal' ) ),
					'EditOrderNonce'    => wp_create_nonce( 'woocommerce-subscriptions' ),
					'postId'            => $post->ID,
				);
			} else if ( 'users' == $screen->id ) {
				$script_params = array(
					'deleteUserWarning' => __( "Warning: Deleting a user will also delete the user's subscriptions. The user's orders will remain but be reassigned to the 'Guest' user.\n\nDo you want to continue to delete this user and any associated subscriptions?", 'woocommerce-subscriptions' ),
				);
			}

			$script_params['ajaxLoaderImage'] = WC()->plugin_url() . '/assets/images/ajax-loader.gif';
			$script_params['ajaxUrl']         = admin_url( 'admin-ajax.php' );
			$script_params['isWCPre24']       = var_export( WC_Subscriptions::is_woocommerce_pre( '2.4' ), true );

			wp_enqueue_script( 'woocommerce_subscriptions_admin', plugin_dir_url( WC_Subscriptions::$plugin_file ) . 'assets/js/admin/admin.js', $dependencies, filemtime( plugin_dir_path( WC_Subscriptions::$plugin_file ) . 'assets/js/admin/admin.js' ) );
			wp_localize_script( 'woocommerce_subscriptions_admin', 'WCSubscriptions', apply_filters( 'woocommerce_subscriptions_admin_script_parameters', $script_params ) );

			// Maybe add the pointers for first timers
			if ( isset( $_GET['subscription_pointers'] ) && self::show_user_pointers() ) {

				$dependencies[] = 'wp-pointer';

				$pointer_script_params = array(
					// translators: placeholders are for HTML tags. They are 1$: "<h3>", 2$: "</h3>", 3$: "<p>", 4$: "<em>", 5$: "</em>", 6$: "<em>", 7$: "</em>", 8$: "</p>"
					'typePointerContent'  => sprintf( _x( '%1$sChoose Subscription%2$s%3$sThe WooCommerce Subscriptions extension adds two new subscription product types - %4$sSimple subscription%5$s and %6$sVariable subscription%7$s.%8$s', 'used in admin pointer script params in javascript as type pointer content', 'woocommerce-subscriptions' ), '<h3>', '</h3>', '<p>', '<em>', '</em>', '<em>', '</em>', '</p>' ),
					// translators: placeholders are for HTML tags. They are 1$: "<h3>", 2$: "</h3>", 3$: "<p>", 4$: "</p>"
					'pricePointerContent' => sprintf( _x( '%1$sSet a Price%2$s%3$sSubscription prices are a little different to other product prices. For a subscription, you can set a billing period, length, sign-up fee and free trial.%4$s', 'used in admin pointer script params in javascript as price pointer content', 'woocommerce-subscriptions' ), '<h3>', '</h3>', '<p>', '</p>' ),
				);

				wp_enqueue_script( 'woocommerce_subscriptions_admin_pointers', plugin_dir_url( WC_Subscriptions::$plugin_file ) . 'assets/js/admin/admin-pointers.js', $dependencies, WC_Subscriptions::$version );

				wp_localize_script( 'woocommerce_subscriptions_admin_pointers', 'WCSPointers', apply_filters( 'woocommerce_subscriptions_admin_pointer_script_parameters', $pointer_script_params ) );

				wp_enqueue_style( 'wp-pointer' );
			}
		}

		// Maybe add the admin notice
		if ( $is_activation_screen ) {

			$woocommerce_plugin_dir_file = self::get_woocommerce_plugin_dir_file();

			if ( ! empty( $woocommerce_plugin_dir_file ) ) {

				wp_enqueue_style( 'woocommerce-activation', plugins_url( '/assets/css/activation.css', self::get_woocommerce_plugin_dir_file() ), array(), WC_Subscriptions::$version );

				if ( ! isset( $_GET['page'] ) || 'wcs-about' != $_GET['page'] ) {
					add_action( 'admin_notices', __CLASS__ . '::admin_installed_notice' );
				}
			}
			delete_transient( WC_Subscriptions::$activation_transient );
		}

		if ( $is_woocommerce_screen || $is_activation_screen ) {
			wp_enqueue_style( 'woocommerce_admin_styles', WC()->plugin_url() . '/assets/css/admin.css', array(), WC_Subscriptions::$version );
			wp_enqueue_style( 'woocommerce_subscriptions_admin', plugin_dir_url( WC_Subscriptions::$plugin_file ) . 'assets/css/admin.css', array( 'woocommerce_admin_styles' ), WC_Subscriptions::$version );
		}

	}

	/**
	 * Add the "Active Subscriber?" column to the User's admin table
	 */
	public static function add_user_columns( $columns ) {

		if ( current_user_can( 'manage_woocommerce' ) ) {
			// Move Active Subscriber before Orders for aesthetics
			$last_column = array_slice( $columns, -1, 1, true );
			array_pop( $columns );
			$columns['woocommerce_active_subscriber'] = __( 'Active Subscriber?', 'woocommerce-subscriptions' );
			$columns += $last_column;
		}

		return $columns;
	}

	/**
	 * Hooked to the users table to display a check mark if a given user has an active subscription.
	 *
	 * @param string $value The string to output in the column specified with $column_name
	 * @param string $column_name The string key for the current column in an admin table
	 * @param int $user_id The ID of the user to which this row relates
	 * @return string $value A check mark if the column is the active_subscriber column and the user has an active subscription.
	 * @since 1.0
	 */
	public static function user_column_values( $value, $column_name, $user_id ) {

		if ( 'woocommerce_active_subscriber' == $column_name ) {
			if ( wcs_user_has_subscription( $user_id, '', 'active' ) ) {
				$value = '<div class="active-subscriber"></div>';
			} else {
				$value = '<div class="inactive-subscriber">-</div>';
			}
		}

		return $value;
	}


	/**
	 * Outputs the Subscription Management admin page with a sortable @see WC_Subscriptions_List_Table used to
	 * display all the subscriptions that have been purchased.
	 *
	 * @uses WC_Subscriptions_List_Table
	 * @since 1.0
	 */
	public static function subscriptions_management_page() {

		$subscriptions_table = self::get_subscriptions_list_table();
		$subscriptions_table->prepare_items(); ?>
<div class="wrap">
	<div id="icon-woocommerce" class="icon32-woocommerce-users icon32"><br/></div>
	<h2><?php esc_html_e( 'Manage Subscriptions', 'woocommerce-subscriptions' ); ?></h2>
	<?php $subscriptions_table->messages(); ?>
	<?php $subscriptions_table->views(); ?>
	<form id="subscriptions-search" action="" method="get"><?php // Don't send all the subscription meta across ?>
		<?php $subscriptions_table->search_box( __( 'Search Subscriptions', 'woocommerce-subscriptions' ), 'subscription' ); ?>
		<input type="hidden" name="page" value="subscriptions" />
		<?php if ( isset( $_REQUEST['status'] ) ) { ?>
			<input type="hidden" name="status" value="<?php echo esc_attr( $_REQUEST['status'] ); ?>" />
		<?php } ?>
	</form>
	<form id="subscriptions-filter" action="" method="get">
		<?php $subscriptions_table->display(); ?>
	</form>
</div>
		<?php
	}

	/**
	 * Outputs the screen options on the Subscription Management admin page.
	 *
	 * @since 1.3.1
	 */
	public static function add_manage_subscriptions_screen_options() {
		add_screen_option( 'per_page', array(
			'label'   => __( 'Subscriptions', 'woocommerce-subscriptions' ),
			'default' => 10,
			'option'  => self::$option_prefix . '_admin_per_page',
			)
		);
	}

	/**
	 * Sets the correct value for screen options on the Subscription Management admin page.
	 *
	 * @since 1.3.1
	 */
	public static function set_manage_subscriptions_screen_option( $status, $option, $value ) {

		if ( self::$option_prefix . '_admin_per_page' == $option ) {
			return $value;
		}

		return $status;
	}

	/**
	 * Returns the columns for the Manage Subscriptions table, specifically used for adding the
	 * show/hide column screen options.
	 *
	 * @since 1.3.1
	 */
	public static function get_subscription_table_columns( $columns ) {

		$subscriptions_table = self::get_subscriptions_list_table();

		return array_merge( $subscriptions_table->get_columns(), $columns );
	}

	/**
	 * Returns the columns for the Manage Subscriptions table, specifically used for adding the
	 * show/hide column screen options.
	 *
	 * @since 1.3.1
	 */
	public static function get_subscriptions_list_table() {

		if ( ! isset( self::$subscriptions_list_table ) ) {

			if ( ! class_exists( 'WC_Subscriptions_List_Table' ) ) {
				require_once( 'class-wc-subscriptions-list-table.php' );
			}

			self::$subscriptions_list_table = new WC_Subscriptions_List_Table();
		}

		return self::$subscriptions_list_table;
	}

	/**
	 * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
	 *
	 * @uses woocommerce_update_options()
	 * @uses self::get_settings()
	 * @since 1.0
	 */
	public static function update_subscription_settings() {

		if ( empty( $_POST['_wcsnonce'] ) || ! wp_verify_nonce( $_POST['_wcsnonce'], 'wcs_subscription_settings' ) ) {
			return;
		}

		// Make sure automatic payments are on when manual renewals are switched off
		if ( ! isset( $_POST[ self::$option_prefix . '_accept_manual_renewals' ] ) && isset( $_POST[ self::$option_prefix . '_turn_off_automatic_payments' ] ) ) {
			unset( $_POST[ self::$option_prefix . '_turn_off_automatic_payments' ] );
		}

		woocommerce_update_options( self::get_settings() );
	}

	/**
	 * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
	 *
	 * @uses woocommerce_admin_fields()
	 * @uses self::get_settings()
	 * @since 1.0
	 */
	public static function subscription_settings_page() {
		woocommerce_admin_fields( self::get_settings() );
		wp_nonce_field( 'wcs_subscription_settings', '_wcsnonce', false );
	}

	/**
	 * Add the Subscriptions settings tab to the WooCommerce settings tabs array.
	 *
	 * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
	 * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
	 * @since 1.0
	 */
	public static function add_subscription_settings_tab( $settings_tabs ) {

		$settings_tabs[ self::$tab_name ] = __( 'Subscriptions', 'woocommerce-subscriptions' );

		return $settings_tabs;
	}

	/**
	 * Sets default values for all the WooCommerce Subscription options. Called on plugin activation.
	 *
	 * @see WC_Subscriptions::activate_woocommerce_subscriptions
	 * @since 1.0
	 */
	public static function add_default_settings() {
		foreach ( self::get_settings() as $setting ) {
			if ( isset( $setting['default'] ) ) {
				add_option( $setting['id'], $setting['default'] );
			}
		}

	}

	/**
	 * Get all the settings for the Subscriptions extension in the format required by the @see woocommerce_admin_fields() function.
	 *
	 * @return array Array of settings in the format required by the @see woocommerce_admin_fields() function.
	 * @since 1.0
	 */
	public static function get_settings() {
		if ( ! function_exists( 'get_editable_roles' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/user.php' );
		}

		$roles = get_editable_roles();

		foreach ( $roles as $role => $details ) {
			$roles_options[ $role ] = translate_user_role( $details['name'] );
		}

		$available_gateways = array();

		foreach ( WC()->payment_gateways->payment_gateways() as $gateway ) {
			if ( $gateway->supports( 'subscriptions' ) ) {
				$available_gateways[] = sprintf( '%s [<code>%s</code>]', $gateway->title, $gateway->id );
			}
		}

		if ( count( $available_gateways ) == 0 ) {
			// translators: $1-2: opening and closing tags of a link that takes to PayPal settings, $3-4: opening and closing tags of a link that takes to Woo marketplace / Stripe product page
			$available_gateways_description = sprintf( __( 'No payment gateways capable of processing automatic subscription payments are enabled. Please enable the %1$sPayPal Standard%2$s gateway or get the %3$sfree Stripe extension%4$s if you want to process automatic payments.', 'woocommerce-subscriptions' ), '<strong><a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=wc_gateway_paypal' ) . '">', '</a></strong>', '<strong><a href="https://www.woothemes.com/products/stripe/">', '</a></strong>' );
		} elseif ( count( $available_gateways ) == 1 ) {
			// translators: placeholder is name of a gateway
			$available_gateways_description = sprintf( __( 'The %s gateway can process automatic subscription payments.', 'woocommerce-subscriptions' ), '<strong>' . $available_gateways[0] . '</strong>' );
		} elseif ( count( $available_gateways ) > 1 ) {
			// translators: %1$s - a comma separated list of gateway names (e.g. "stripe, paypal, worldpay"), %2$s - one name of gateway (e.g. "authorize.net")
			$available_gateways_description = sprintf( __( 'The %1$s & %2$s gateways can process automatic subscription payments.', 'woocommerce-subscriptions' ), '<strong>' . implode( '</strong>, <strong>', array_slice( $available_gateways, 0, count( $available_gateways ) - 1 ) ) . '</strong>', '<strong>' . array_pop( $available_gateways ) . '</strong>' );
		}

		return apply_filters( 'woocommerce_subscription_settings', array(

			array(
				'name'     => __( 'Button Text', 'woocommerce-subscriptions' ),
				'type'     => 'title',
				'desc'     => '',
				'id'       => self::$option_prefix . '_button_text',
			),

			array(
				'name'     => __( 'Add to Cart Button Text', 'woocommerce-subscriptions' ),
				'desc'     => __( 'A product displays a button with the text "Add to Cart". By default, a subscription changes this to "Sign Up Now". You can customise the button text for subscriptions here.', 'woocommerce-subscriptions' ),
				'tip'      => '',
				'id'       => self::$option_prefix . '_add_to_cart_button_text',
				'css'      => 'min-width:150px;',
				'default'  => __( 'Sign Up Now', 'woocommerce-subscriptions' ),
				'type'     => 'text',
				'desc_tip' => true,
			),

			array(
				'name'     => __( 'Place Order Button Text', 'woocommerce-subscriptions' ),
				'desc'     => __( 'Use this field to customise the text displayed on the checkout button when an order contains a subscription. Normally the checkout submission button displays "Place Order". When the cart contains a subscription, this is changed to "Sign Up Now".', 'woocommerce-subscriptions' ),
				'tip'      => '',
				'id'       => self::$option_prefix . '_order_button_text',
				'css'      => 'min-width:150px;',
				'default'  => __( 'Sign Up Now', 'woocommerce-subscriptions' ),
				'type'     => 'text',
				'desc_tip' => true,
			),

			array( 'type' => 'sectionend', 'id' => self::$option_prefix . '_button_text' ),

			array(
				'name'     => __( 'Roles', 'woocommerce-subscriptions' ),
				'type'     => 'title',
				// translators: placeholders are <em> tags
				'desc'     => sprintf( __( 'Choose the default roles to assign to active and inactive subscribers. For record keeping purposes, a user account must be created for subscribers. Users with the %sadministrator%s role, such as yourself, will never be allocated these roles to prevent locking out administrators.', 'woocommerce-subscriptions' ), '<em>', '</em>' ),
				'id'       => self::$option_prefix . '_role_options',
			),

			array(
				'name'     => __( 'Subscriber Default Role', 'woocommerce-subscriptions' ),
				'desc'     => __( 'When a subscription is activated, either manually or after a successful purchase, new users will be assigned this role.', 'woocommerce-subscriptions' ),
				'tip'      => '',
				'id'       => self::$option_prefix . '_subscriber_role',
				'css'      => 'min-width:150px;',
				'default'  => 'subscriber',
				'type'     => 'select',
				'options'  => $roles_options,
				'desc_tip' => true,
			),

			array(
				'name'     => __( 'Inactive Subscriber Role', 'woocommerce-subscriptions' ),
				'desc'     => __( 'If a subscriber\'s subscription is manually cancelled or expires, she will be assigned this role.', 'woocommerce-subscriptions' ),
				'tip'      => '',
				'id'       => self::$option_prefix . '_cancelled_role',
				'css'      => 'min-width:150px;',
				'default'  => 'customer',
				'type'     => 'select',
				'options'  => $roles_options,
				'desc_tip' => true,
			),

			array( 'type' => 'sectionend', 'id' => self::$option_prefix . '_role_options' ),

			array(
				'name'          => _x( 'Renewals', 'option section heading', 'woocommerce-subscriptions' ),
				'type'          => 'title',
				'desc'          => '',
				'id'            => self::$option_prefix . '_renewal_options',
			),

			array(
				'name'            => __( 'Manual Renewal Payments', 'woocommerce-subscriptions' ),
				'desc'            => __( 'Accept Manual Renewals', 'woocommerce-subscriptions' ),
				'id'              => self::$option_prefix . '_accept_manual_renewals',
				'default'         => 'no',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => sprintf( __( 'With manual renewals, a customer\'s subscription is put on-hold until they login and pay to renew it. %sLearn more%s.', 'woocommerce-subscriptions' ), '<a href="http://docs.woothemes.com/document/subscriptions/store-manager-guide/#accept-manual-renewals">', '</a>' ),
				'checkboxgroup'   => 'start',
				'show_if_checked' => 'option',
			),

			array(
				'desc'            => __( 'Turn off Automatic Payments', 'woocommerce-subscriptions' ),
				'id'              => self::$option_prefix . '_turn_off_automatic_payments',
				'default'         => 'no',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => sprintf( __( 'If you never want a customer to be automatically charged for a subscription renewal payment, you can turn off automatic payments completely. %sLearn more%s.', 'woocommerce-subscriptions' ), '<a href="http://docs.woothemes.com/document/subscriptions/store-manager-guide/#turn-off-automatic-payments">', '</a>' ),
				'checkboxgroup'   => 'end',
				'show_if_checked' => 'yes',
			),

			array( 'type' => 'sectionend', 'id' => self::$option_prefix . '_renewal_options' ),

			array(
				'name'          => _x( 'Miscellaneous', 'options section heading', 'woocommerce-subscriptions' ),
				'type'          => 'title',
				'desc'          => '',
				'id'            => self::$option_prefix . '_miscellaneous',
			),

			array(
				'name'          => __( 'Customer Suspensions', 'woocommerce-subscriptions' ),
				'desc'          => _x( 'suspensions per billing period.', 'there\'s a number immediately in front of this text', 'woocommerce-subscriptions' ),
				'id'            => self::$option_prefix . '_max_customer_suspensions',
				'css'           => 'min-width:50px;',
				'default'       => 0,
				'type'          => 'select',
				'options'       => apply_filters( 'woocommerce_subscriptions_max_customer_suspension_range', array_merge( range( 0, 12 ), array( 'unlimited' => 'Unlimited' ) ) ),
				'desc_tip'      => __( 'Set a maximum number of times a customer can suspend their account for each billing period. For example, for a value of 3 and a subscription billed yearly, if the customer has suspended their account 3 times, they will not be presented with the option to suspend their account until the next year. Store managers will always be able able to suspend an active subscription. Set this to 0 to turn off the customer suspension feature completely.', 'woocommerce-subscriptions' ),
			),

			array(
				'name'          => __( 'Mixed Checkout', 'woocommerce-subscriptions' ),
				'desc'          => __( 'Allow subscriptions and products to be purchased simultaneously.', 'woocommerce-subscriptions' ),
				'id'            => self::$option_prefix . '_multiple_purchase',
				'default'       => 'no',
				'type'          => 'checkbox',
				'desc_tip'      => __( 'Allow subscriptions and products to be purchased in a single transaction.', 'woocommerce-subscriptions' ),
			),

			array(
				'name'          => __( 'Drip Downloadable Content', 'woocommerce-subscriptions' ),
				'desc'          => __( 'Enable dripping for downloadable content on subscription products.', 'woocommerce-subscriptions' ),
				'id'            => self::$option_prefix . '_drip_downloadable_content_on_renewal',
				'default'       => 'no',
				'type'          => 'checkbox',
				'desc_tip'      => sprintf( __( 'Enabling this grants access to new downloadable files added to a product only after the next renewal is processed.%sBy default, access to new downloadable files added to a product is granted immediately to any customer that has an active subscription with that product.', 'woocommerce-subscriptions' ), '<br />' ),
			),

			array( 'type' => 'sectionend', 'id' => self::$option_prefix . '_miscellaneous' ),

			array(
				'name'          => __( 'Payment Gateways', 'woocommerce-subscriptions' ),
				'desc'          => $available_gateways_description,
				'id'            => self::$option_prefix . '_payment_gateways_available',
				'type'          => 'informational',
			),

			array(
				// translators: placeholders are opening and closing link tags
				'desc'          => sprintf( __( 'Other payment gateways can be used to process %smanual subscription renewal payments%s only.', 'woocommerce-subscriptions' ), '<a href="http://docs.woothemes.com/document/subscriptions/renewal-process/">', '</a>' ),
				'id'            => self::$option_prefix . '_payment_gateways_additional',
				'type'          => 'informational',
			),

			array(
				// translators: $1-$2: opening and closing tags. Link to documents->payment gateways, 3$-4$: opening and closing tags. Link to woothemes extensions shop page
				'desc'          => sprintf( __( 'Find new gateways that %1$ssupport automatic subscription payments%2$s in the official %3$sWooCommerce Marketplace%4$s.', 'woocommerce-subscriptions' ), '<a href="' . esc_url( 'http://docs.woothemes.com/document/subscriptions/payment-gateways/' ) . '">', '</a>', '<a href="' . esc_url( 'http://www.woothemes.com/product-category/woocommerce-extensions/' ) . '">', '</a>' ),
				'id'            => self::$option_prefix . '_payment_gateways_additional',
				'type'          => 'informational',
			),

		) );

	}

	/**
	 * Displays instructional information for a WooCommerce setting.
	 *
	 * @since 1.0
	 */
	public static function add_informational_admin_field( $field_details ) {

		if ( isset( $field_details['name'] ) && $field_details['name'] ) {
			echo '<h3>' . esc_html( $field_details['name'] ) . '</h3>';
		}

		if ( isset( $field_details['desc'] ) && $field_details['desc'] ) {
			echo wp_kses_post( wpautop( wptexturize( $field_details['desc'] ) ) );
		}
	}

	/**
	 * Outputs a welcome message. Called when the Subscriptions extension is activated.
	 *
	 * @since 1.0
	 */
	public static function admin_installed_notice() {
		?>
		<div id="message" class="updated woocommerce-message wc-connect woocommerce-subscriptions-activated">
			<div class="squeezer">
				<h4>
					<?php
					// translators: $1-$2: opening and closing <strong> tags, $3-$4: opening and closing <em> tags
					echo wp_kses( sprintf( __( '%1$sWooCommerce Subscriptions Installed%2$s &#8211; %3$sYou\'re ready to start selling subscriptions!%4$s', 'woocommerce-subscriptions' ), '<strong>', '</strong>', '<em>', '</em>' ), array( 'strong' => true, 'em' => true ) );
					?>
				</h4>

				<p class="submit">
					<a href="<?php echo esc_url( self::add_subscription_url() ); ?>" class="button button-primary"><?php esc_html_e( 'Add a Subscription Product', 'woocommerce-subscriptions' ); ?></a>
					<a href="<?php echo esc_url( self::settings_tab_url() ); ?>" class="docs button button-primary"><?php esc_html_e( 'Settings', 'woocommerce-subscriptions' ); ?></a>
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.woothemes.com/products/woocommerce-subscriptions/" data-text="Woot! I can sell subscriptions with #WooCommerce" data-via="WooThemes" data-size="large">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</p>
			</div>
		</div>
		<?php
	}

	/**
	 * Checks whether a user should be shown pointers or not, based on whether a user has previously dismissed pointers.
	 *
	 * @since 1.0
	 */
	public static function show_user_pointers() {
		// Get dismissed pointers
		$dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

		// Pointer has been dismissed
		if ( in_array( 'wcs_pointer', $dismissed ) ) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Returns a URL for adding/editing a subscription, which special parameters to define whether pointers should be shown.
	 *
	 * The 'select_subscription' flag is picked up by JavaScript to set the value of the product type to "Subscription".
	 *
	 * @since 1.0
	 */
	public static function add_subscription_url( $show_pointers = true ) {
		$add_subscription_url = admin_url( 'post-new.php?post_type=product&select_subscription=true' );

		if ( true == $show_pointers ) {
			$add_subscription_url = add_query_arg( 'subscription_pointers', 'true', $add_subscription_url );
		}

		return $add_subscription_url;
	}

	/**
	 * Searches through the list of active plugins to find WooCommerce. Just in case
	 * WooCommerce resides in a folder other than /woocommerce/
	 *
	 * @since 1.0
	 */
	public static function get_woocommerce_plugin_dir_file() {

		$woocommerce_plugin_file = '';

		foreach ( get_option( 'active_plugins', array() ) as $plugin ) {
			if ( substr( $plugin, strlen( '/woocommerce.php' ) * -1 ) === '/woocommerce.php' ) {
				$woocommerce_plugin_file = $plugin;
				break;
			}
		}

		return $woocommerce_plugin_file;
	}

	/**
	 * Filter the "Orders" list to show only orders associated with a specific subscription.
	 *
	 * @param string $where
	 * @param string $request
	 * @return string
	 * @since 2.0
	 */
	public static function filter_orders( $where ) {
		global $typenow, $wpdb;

		if ( is_admin() && 'shop_order' == $typenow ) {

			$related_orders = array();

			if ( isset( $_GET['_subscription_related_orders'] ) && $_GET['_subscription_related_orders'] > 0 ) {

				$subscription_id = absint( $_GET['_subscription_related_orders'] );

				$subscription = wcs_get_subscription( $subscription_id );

				if ( ! wcs_is_subscription( $subscription ) ) {
					// translators: placeholder is a number
					wcs_add_admin_notice( sprintf( __( 'We can\'t find a subscription with ID #%d. Perhaps it was deleted?', 'woocommerce-subscriptions' ), $subscription_id ), 'error' );
					$where .= " AND {$wpdb->posts}.ID = 0";
				} else {
					self::$found_related_orders = true;
					$where .= sprintf( " AND {$wpdb->posts}.ID IN (%s)", implode( ',', array_map( 'absint', array_unique( $subscription->get_related_orders( 'ids' ) ) ) ) );
				}
			}
		}

		return $where;
	}

	/**
	 * Display a notice indicating that the "Orders" list is filtered.
	 * @see self::filter_orders()
	 */
	public static function display_renewal_filter_notice() {

		global $wp_version;

		$query_arg = '_subscription_related_orders';

		if ( isset( $_GET[ $query_arg ] ) && $_GET[ $query_arg ] > 0 && true === self::$found_related_orders ) {

			$initial_order = new WC_Order( absint( $_GET[ $query_arg ] ) );

			if ( version_compare( $wp_version, '4.2', '<' ) ) {
				echo '<div class="updated"><p>';
				printf(
					'<a href="%1$s" class="close-subscriptions-search">&times;</a>',
					esc_url( remove_query_arg( $query_arg ) )
				);
				// translators: placeholders are opening link tag, ID of sub, and closing link tag
				printf( esc_html__( 'Showing orders for %sSubscription %s%s', 'woocommerce-subscriptions' ), '<a href="' . esc_url( get_edit_post_link( absint( $_GET[ $query_arg ] ) ) ) . '">', esc_html( $initial_order->get_order_number() ), '</a>' );
				echo '</p>';
			} else {
				echo '<div class="updated dismiss-subscriptions-search"><p>';
				// translators: placeholders are opening link tag, ID of sub, and closing link tag
				printf( esc_html__( 'Showing orders for %sSubscription %s%s', 'woocommerce-subscriptions' ), '<a href="' . esc_url( get_edit_post_link( absint( $_GET[ $query_arg ] ) ) ) . '">', esc_html( $initial_order->get_order_number() ), '</a>' );
				echo '</p>';
				printf(
					'<a href="%1$s" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></a>',
					esc_url( remove_query_arg( $query_arg ) )
				);
			}

			echo '</div>';
		}
	}

	/**
	 * Returns either a string or array of strings describing the allowable trial period range
	 * for a subscription.
	 *
	 * @since 1.0
	 */
	public static function get_trial_period_validation_message( $form = 'combined' ) {

		$subscription_ranges = wcs_get_subscription_ranges();

		if ( 'combined' == $form ) {
			// translators: number of 1$: days, 2$: weeks, 3$: months, 4$: years
			$error_message = sprintf( __( 'The trial period can not exceed: %1s, %2s, %3s or %4s.', 'woocommerce-subscriptions' ), array_pop( $subscription_ranges['day'] ), array_pop( $subscription_ranges['week'] ), array_pop( $subscription_ranges['month'] ), array_pop( $subscription_ranges['year'] ) );
		} else {
			$error_message = array();
			foreach ( wcs_get_available_time_periods() as $period => $string ) {
				// translators: placeholder is a time period (e.g. "4 weeks")
				$error_message[ $period ] = sprintf( __( 'The trial period can not exceed %s.', 'woocommerce-subscriptions' ), array_pop( $subscription_ranges[ $period ] ) );
			}
		}

		return apply_filters( 'woocommerce_subscriptions_trial_period_validation_message', $error_message );
	}

	/**
	 * Callback for the [subscriptions] shortcode that displays subscription names for a particular user.
	 *
	 * @param array $attributes Shortcode attributes.
	 * @return string
	 */
	public static function do_subscriptions_shortcode( $attributes ) {
		$attributes = wp_parse_args(
			$attributes,
			array(
				'user_id' => 0,
				'status'  => 'active',
			)
		);

		$subscriptions = wcs_get_users_subscriptions( $attributes['user_id'] );

		if ( empty( $subscriptions ) ) {
			return '<ul class="user-subscriptions no-user-subscriptions">
						<li>No subscriptions found.</li>
					</ul>';
		}

		$list = '<ul class="user-subscriptions">';

		foreach ( $subscriptions as $subscription ) {
			if ( 'all' == $attributes['status'] || $subscription->has_status( $attributes['status'] ) ) {
				$list .= sprintf( '<li><a href="%s">Subscription %s</a></li>', $subscription->get_view_order_url(), $subscription->get_order_number() );
			}
		}
		$list .= '</ul>';

		return $list;
	}

	/**
	 * Adds Subscriptions specific details to the WooCommerce System Status report.
	 *
	 * @param array $attributes Shortcode attributes.
	 * @return array
	 */
	public static function add_system_status_items( $debug_data ) {

		$is_wcs_debug = defined( 'WCS_DEBUG' ) ? WCS_DEBUG : false;

		$debug_data['wcs_debug'] = array(
			'name'    => _x( 'WCS_DEBUG', 'label that indicates whether debugging is turned on for the plugin', 'woocommerce-subscriptions' ),
			'note'    => ( $is_wcs_debug ) ? __( 'Yes', 'woocommerce-subscriptions' ) :  __( 'No', 'woocommerce-subscriptions' ),
			'success' => $is_wcs_debug ? 0 : 1,
		);

		$debug_data['wcs_staging'] = array(
			'name'    => _x( 'Subscriptions Mode', 'Live or Staging, Label on WooCommerce -> System Status page', 'woocommerce-subscriptions' ),
			'note'    => '<strong>' . ( ( WC_Subscriptions::is_duplicate_site() ) ? _x( 'Staging', 'refers to staging site', 'woocommerce-subscriptions' ) :  _x( 'Live', 'refers to live site', 'woocommerce-subscriptions' ) ) . '</strong>',
			'success' => ( WC_Subscriptions::is_duplicate_site() ) ? 0 : 1,
		);

		return $debug_data;
	}

	/**
	 * A WooCommerce version aware function for getting the Subscriptions admin settings
	 * tab URL.
	 *
	 * @since 1.4.5
	 * @return string
	 */
	public static function settings_tab_url() {

		$settings_tab_url = admin_url( 'admin.php?page=wc-settings&tab=subscriptions' );

		return apply_filters( 'woocommerce_subscriptions_settings_tab_url', $settings_tab_url );
	}

	/**
	 * Add a column to the Payment Gateway table to show whether the gateway supports automated renewals.
	 *
	 * @since 1.5
	 * @return string
	 */
	public static function payment_gateways_rewewal_column( $header ) {

		$header_new = array_slice( $header, 0, count( $header ) - 1, true ) +
			array( 'renewals' => __( 'Automatic Recurring Payments', 'woocommerce-subscriptions' ) ) + // Ideally, we could add a link to the docs here, but the title is passed through esc_html()
			array_slice( $header, count( $header ) - 1, count( $header ) - ( count( $header ) - 1 ), true );

		return $header_new;
	}

	/**
	 * Check whether the payment gateway passed in supports automated renewals or not.
	 * Automatically flag support for Paypal since it is included with subscriptions.
	 * Display in the Payment Gateway column.
	 *
	 * @since 1.5
	 */
	public static function payment_gateways_rewewal_support( $gateway ) {

		echo '<td class="renewals">';
		if ( ( is_array( $gateway->supports ) && in_array( 'subscriptions', $gateway->supports ) ) || $gateway->id == 'paypal' ) {
			$status_html = '<span class="status-enabled tips" data-tip="' . esc_attr__( 'Supports automatic renewal payments with the WooCommerce Subscriptions extension.', 'woocommerce-subscriptions' ) . '">' . esc_html__( 'Yes', 'woocommerce-subscriptions' ) . '</span>';
		} else {
			$status_html = '-';
		}

		$allowed_html = wp_kses_allowed_html( 'post' );
		$allowed_html['span']['data-tip'] = true;

		/**
		 * Automatic Renewal Payments Support Status HTML Filter.
		 *
		 * @since 2.0
		 * @param string $status_html
		 * @param \WC_Payment_Gateway $gateway
		 */
		echo wp_kses( apply_filters( 'woocommerce_payment_gateways_renewal_support_status_html', $status_html, $gateway ), $allowed_html );

		echo '</td>';
	}

	/**
	 * Do not display formatted order total on the Edit Order administration screen
	 *
	 * @since 1.5.17
	 */
	public static function maybe_remove_formatted_order_total_filter( $formatted_total, $order ) {

		// Check if we're on the Edit Order screen - get_current_screen() only exists on admin pages so order of operations matters here
		if ( is_admin() && function_exists( 'get_current_screen' ) ) {

			$screen = get_current_screen();

			if ( is_object( $screen ) && 'shop_order' == $screen->id ) {
				remove_filter( 'woocommerce_get_formatted_order_total', 'WC_Subscriptions_Order::get_formatted_order_total', 10, 2 );
			}
		}

		return $formatted_total;
	}

	/**
	 * Deprecated due to new meta boxes required for WC 2.2.
	 *
	 * @deprecated 1.5.10
	 */
	public static function add_related_orders_meta_box() {
		_deprecated_function( __METHOD__, '1.5.10', __CLASS__ . '::add_meta_boxes()' );
		self::add_meta_boxes();
	}

	/**
	 * Outputs the contents of the "Renewal Orders" meta box.
	 *
	 * @param object $post Current post data.
	 */
	public static function related_orders_meta_box( $post ) {
		_deprecated_function( __METHOD__, '2.0', 'WCS_Meta_Box_Related_Orders::output()' );
		WCS_Meta_Box_Related_Orders::output();
	}

	/**
	 * Add users with subscriptions to the "Customers" report in WooCommerce -> Reports.
	 *
	 * @param WP_User_Query $user_query
	 */
	public static function add_subscribers_to_customers( $user_query ) {
		_deprecated_function( __METHOD__, '2.0' );
	}

	/**
	 * Set a translation safe screen ID for Subcsription
	 *
	 * @since 1.3.3
	 */
	public static function set_admin_screen_id() {
		_deprecated_function( __METHOD__, '2.0' );
	}

	/**
	 * Once we have set a correct admin page screen ID, we can use it for adding the Manage Subscriptions table's columns.
	 *
	 * @since 1.3.3
	 */
	public static function add_subscriptions_table_column_filter() {
		_deprecated_function( __METHOD__, '2.0' );
	}

	/**
	 * Removes anything that's not a digit or a dot from a string. Sadly it assumes that the decimal separator is a dot.
	 * That however can be changed in WooCommerce settings, surfacing bugs such as 9,90 becoming 990, a hundred fold
	 * increase. Use wc_format_decimal instead.
	 *
	 * Left in for backward compatibility reasons.
	 *
	 * @deprecated 1.5.24
	 */
	private static function clean_number( $number ) {
		_deprecated_function( __METHOD__, '1.5.23', 'wc_format_decimal()' );

		$number = preg_replace( '/[^0-9\.]/', '', $number );

		return $number;
	}

	/**
	 * Filter the "Orders" list to show only renewal orders associated with a specific parent order.
	 *
	 * @param array $request
	 * @return array
	 */
	public static function filter_orders_by_renewal_parent( $request ) {
		_deprecated_function( __METHOD__, '2.0' );
		return $request;
	}

	/**
	 * Registers the "Renewal Orders" meta box for the "Edit Order" page.
	 * @deprecated 2.0
	 */
	public static function add_meta_boxes() {
		_deprecated_function( __METHOD__, '2.0', 'WCS_Admin_Meta_Boxes::add_meta_boxes()' );
	}

	/**
	 * Output the metabox
	 */
	public static function recurring_totals_meta_box( $post ) {
		_deprecated_function( __METHOD__, '2.0' );
	}
}

WC_Subscriptions_Admin::init();
