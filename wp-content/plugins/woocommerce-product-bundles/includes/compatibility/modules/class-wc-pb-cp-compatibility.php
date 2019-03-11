<?php
/**
 * WC_PB_CP_Compatibility class
 *
 * @author   SomewhereWarm <info@somewherewarm.gr>
 * @package  WooCommerce Product Bundles
 * @since    4.14.3
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Composite Products Compatibility.
 *
 * @version  5.8.0
 */
class WC_PB_CP_Compatibility {

	/**
	 * Context-setting Component.
	 *
	 * @var WC_CP_Component
	 */
	private static $current_component = false;

	/**
	 * Add hooks.
	 */
	public static function init() {

		/*
		 * Form Data.
		 */

		add_filter( 'woocommerce_rebuild_posted_composite_form_data', array( __CLASS__, 'rebuild_composited_bundle_form_data' ), 10, 3 );
		add_filter( 'woocommerce_posted_composite_configuration', array( __CLASS__, 'get_composited_bundle_configuration' ), 10, 3 );

		/*
		 * Prices.
		 */

		add_filter( 'woocommerce_get_composited_product_price', array( __CLASS__, 'composited_bundle_price' ), 10, 3 );

		/*
		 * Templates.
		 */

		add_action( 'woocommerce_composite_show_composited_product_bundle', array( __CLASS__, 'composite_show_product_bundle' ), 10, 3 );

		/*
		 * Cart and Orders.
		 */

		// Validate bundle type component selections.
		add_action( 'woocommerce_composite_component_validation_add_to_cart', array( __CLASS__, 'validate_component_configuration' ), 10, 8 );
		add_action( 'woocommerce_composite_component_validation_add_to_order', array( __CLASS__, 'validate_component_configuration' ), 10, 8 );

		// Apply component prefix to bundle input fields.
		add_filter( 'woocommerce_product_bundle_field_prefix', array( __CLASS__, 'bundle_field_prefix' ), 10, 2 );

		// Hook into composited product add-to-cart action to add bundled items since 'woocommerce-add-to-cart' action cannot be used recursively.
		add_action( 'woocommerce_composited_add_to_cart', array( __CLASS__, 'add_bundle_to_cart' ), 10, 6 );

		// Link bundled cart/order items with composite.
		add_filter( 'woocommerce_cart_item_is_child_of_composite', array( __CLASS__, 'bundled_cart_item_is_child_of_composite' ), 10, 5 );
		add_filter( 'woocommerce_order_item_is_child_of_composite', array( __CLASS__, 'bundled_order_item_is_child_of_composite' ), 10, 4 );

		// Tweak the appearance of bundle container items in various templates.
		add_filter( 'woocommerce_cart_item_name', array( __CLASS__, 'composited_bundle_in_cart_item_title' ), 9, 3 );
		add_filter( 'woocommerce_composite_container_cart_item_data_value', array( __CLASS__, 'composited_bundle_cart_item_data_value' ), 10, 3 );
		add_filter( 'woocommerce_cart_item_quantity', array( __CLASS__, 'composited_bundle_in_cart_item_quantity' ), 11, 2 );
		add_filter( 'woocommerce_composited_cart_item_quantity_html', array( __CLASS__, 'composited_bundle_checkout_item_quantity' ), 10, 2 );
		add_filter( 'woocommerce_order_item_visible', array( __CLASS__, 'composited_bundle_order_item_visible' ), 10, 2 );
		add_filter( 'woocommerce_order_item_name', array( __CLASS__, 'composited_bundle_order_table_item_title' ), 9, 2 );
		add_filter( 'woocommerce_component_order_item_meta_description', array( __CLASS__, 'composited_bundle_order_item_description' ), 10, 3 );
		add_filter( 'woocommerce_composited_order_item_quantity_html', array( __CLASS__, 'composited_bundle_order_table_item_quantity' ), 11, 2 );

		// Disable edit-in-cart feature if part of a composite.
		add_filter( 'woocommerce_bundle_is_editable_in_cart', array( __CLASS__, 'composited_bundle_not_editable_in_cart' ), 10, 3 );

		// Value & weight aggregation in packages.
		add_filter( 'woocommerce_bundle_container_cart_item', array( __CLASS__, 'composited_bundle_container_cart_item' ), 10, 3 );
		add_filter( 'woocommerce_composited_package_item', array( __CLASS__, 'composited_bundle_container_package_item' ), 10, 3 );

		// Use custom callback to add bundles to orders in 'WC_CP_Order::add_composite_to_order'.
		add_filter( 'woocommerce_add_component_to_order_callback', array( __CLASS__, 'add_composited_bundle_to_order_callback' ), 10, 6 );

		/*
		 * REST API.
		 */

		add_filter( 'woocommerce_parsed_rest_composite_order_item_configuration', array( __CLASS__, 'parse_composited_rest_bundle_configuration' ), 10, 3 );
	}

	/*
	|--------------------------------------------------------------------------
	| Permalink Args.
	|--------------------------------------------------------------------------
	*/

	/**
	 * Add form data for composited bundles to support cart-item editing and order-item editing in CP.
	 *
	 * @since  5.8.0
	 *
	 * @param  array  $form_data
	 * @param  array  $configuration
	 * @return array
	 *
	 */
	public static function rebuild_composited_bundle_form_data( $form_data, $configuration ) {

		if ( ! empty( $configuration ) && is_array( $configuration ) ) {
			foreach ( $configuration as $component_id => $component_configuration ) {

				if ( isset( $component_configuration[ 'type' ] ) && $component_configuration[ 'type' ] === 'bundle' && ! empty( $component_configuration[ 'stamp' ] ) && is_array( $component_configuration[ 'stamp' ] ) ) {

					$bundle_args = WC_PB()->cart->rebuild_posted_bundle_form_data( $component_configuration[ 'stamp' ] );

					foreach ( $bundle_args as $key => $value ) {
						$form_data[ 'component_' . $component_id . '_' . $key ] = $value;
					}
				}
			}
		}

		return $form_data;
	}

	/**
	 * Get posted data for composited bundles.
	 *
	 * @since  5.8.0
	 *
	 * @param  array                 $configuration
	 * @param  WC_Product_Composite  $composite
	 * @return array
	 *
	 */
	public static function get_composited_bundle_configuration( $configuration, $composite ) {

		if ( empty( $configuration ) || ! is_array( $configuration ) ) {
			return $configuration;
		}

		foreach ( $configuration as $component_id => $component_configuration ) {

			if ( empty( $component_configuration[ 'product_id' ] ) ) {
				continue;
			}

			$component_option = $composite->get_component_option( $component_id, $component_configuration[ 'product_id' ] );

			if ( ! $component_option ) {
				continue;
			}

			$composited_product = $component_option->get_product();

			if ( ! $composited_product->is_type( 'bundle' ) ) {
				continue;
			}

			WC_PB_Compatibility::$bundle_prefix = $component_id;
			$configuration[ $component_id ][ 'stamp' ] = WC_PB()->cart->get_posted_bundle_configuration( $composited_product );
			WC_PB_Compatibility::$bundle_prefix = '';
		}

		return $configuration;
	}

	/*
	|--------------------------------------------------------------------------
	| Prices.
	|--------------------------------------------------------------------------
	*/

	/**
	 * Composited bundle price.
	 *
	 * @param  double         $price
	 * @param  array          $args
	 * @param  WC_CP_Product  $composited_product
	 * @return double
	 */
	public static function composited_bundle_price( $price, $args, $composited_product ) {

		$product = $composited_product->get_product();

		if ( 'bundle' === $product->get_type() ) {

			$composited_product->add_filters();

			$price = $product->calculate_price( $args );

			if ( '' === $price ) {
				if ( $product->contains( 'priced_individually' ) && isset( $args[ 'min_or_max' ] ) && 'max' === $args[ 'min_or_max' ] && INF === $product->get_max_raw_price() ) {
					$price = INF;
				} else {
					$price = 0.0;
				}
			}

			$composited_product->remove_filters();
		}

		return $price;
	}

	/*
	|--------------------------------------------------------------------------
	| Templates.
	|--------------------------------------------------------------------------
	*/

	/**
	 * Hook into 'woocommerce_composite_show_composited_product_bundle' to show bundle type product content.
	 *
	 * @param  WC_Product  $product
	 * @param  string      $component_id
	 * @param  WC_Product  $composite
	 * @return void
	 */
	public static function composite_show_product_bundle( $product, $component_id, $composite ) {

		if ( $product->contains( 'subscriptions' ) ) {

			?><div class="woocommerce-error"><?php
				echo __( 'This item cannot be purchased at the moment.', 'woocommerce-product-bundles' );
			?></div><?php

			return false;
		}

		if ( class_exists( 'WC_CP_Admin_Ajax' ) && WC_CP_Admin_Ajax::is_composite_edit_request() ) {
			$product->set_layout( 'tabular' );
		}

		$product_id   = $product->get_id();
		$composite_id = $composite->get_id();

		WC_PB_Compatibility::$compat_product = $product;
		WC_PB_Compatibility::$bundle_prefix  = $component_id;

		$component          = $composite->get_component( $component_id );
		$composited_product = $component->get_option( $product_id );
		$quantity_min       = $composited_product->get_quantity_min();
		$quantity_max       = $composited_product->get_quantity_max( true );
		$availability       = $composited_product->get_availability();
		$tax_ratio          = WC_PB_Product_Prices::get_tax_ratios( $product );

		/** Filter documented in CP file 'includes/wc-cp-template-functions.php'. */
		$custom_data = apply_filters( 'woocommerce_composited_product_custom_data', array( 'price_tax' => $tax_ratio, 'image_data' => $composited_product->get_image_data() ), $product, $component_id, $component, $composite );

 		wc_get_template( 'composited-product/bundle-product.php', array(
			'product_id'         => $product_id,
			'product'            => $product,
			'composite_id'       => $composite_id,
			'quantity_min'       => $quantity_min,
			'quantity_max'       => $quantity_max,
			'custom_data'        => $custom_data,
			'bundle_price_data'  => $product->get_bundle_price_data(),
			'bundled_items'      => $product->get_bundled_items(),
			'component_id'       => $component_id,
			'availability'       => $availability,
			'composited_product' => $composited_product,
			'composite_product'  => $composite
		), false, WC_PB()->plugin_path() . '/templates/' );

		WC_PB_Compatibility::$compat_product = '';
		WC_PB_Compatibility::$bundle_prefix  = '';
	}

	/*
	|--------------------------------------------------------------------------
	| Cart and Orders.
	|--------------------------------------------------------------------------
	*/

	/**
	 * Hook into 'woocommerce_composite_component_add_to_cart_validation' to validate composited bundles.
	 *
	 * @param  WC_CP_Component  $component
	 * @param  array            $component_validation_data
	 * @param  int              $composite_quantity
	 * @param  array            $configuration
	 * @param  string           $context
	 * @return void
	 */
	public static function validate_component_configuration( $component, $component_validation_data, $composite_quantity, $configuration, $context ) {

		$component_id       = $component->get_id();
		$component_option   = $component->get_option( $component_validation_data[ 'product_id' ] );

		if ( ! $component_option ) {
			return;
		}

		$composited_product = $component_option->get_product();

		if ( ! $composited_product || ! $composited_product->is_type( 'bundle' ) ) {
			return;
		}

		// Disallow bundles with subscriptions.
		if ( $composited_product->contains( 'subscriptions' ) ) {

			$reason = sprintf( __( '&quot;%s&quot; cannot be purchased.', 'woocommerce-composite-products' ), $composited_product->get_title() );

			if ( 'add-to-cart' === $context ) {
				$notice = sprintf( __( '&quot;%1$s&quot; cannot be added to your cart. %2$s', 'woocommerce-composite-products' ), $component->get_composite()->get_title(), $reason );
			} elseif ( 'cart' === $context ) {
				$notice = sprintf( __( '&quot;%1$s&quot; cannot be purchased. %2$s', 'woocommerce-composite-products' ), $component->get_composite()->get_title(), $reason );
			} else {
				$notice = $reason;
			}

			throw new Exception( $notice );
		}

		if ( ! isset( $component_validation_data[ 'quantity' ] ) || ! $component_validation_data[ 'quantity' ] > 0 ) {
			return;
		}

		$bundle_configuration = array();

		WC_PB_Compatibility::$bundle_prefix = $component_id;

		if ( isset( $configuration[ $component_id ][ 'stamp' ] ) ) {
			$bundle_configuration = $configuration[ $component_id ][ 'stamp' ];
		} else {
			$bundle_configuration = WC_PB()->cart->get_posted_bundle_configuration( $composited_product );
		}

		add_filter( 'woocommerce_add_error', array( __CLASS__, 'component_bundle_error_message_context' ) );
		self::$current_component = $component;

		$is_valid = WC_PB()->cart->validate_bundle_configuration( $composited_product, $component_validation_data[ 'quantity' ], $bundle_configuration, $context );

		remove_filter( 'woocommerce_add_error', array( __CLASS__, 'component_bundle_error_message_context' ) );
		self::$current_component = false;

		WC_PB_Compatibility::$bundle_prefix = '';

		if ( ! $is_valid ) {
			throw new Exception();
		}
	}

	/**
	 * Sets a prefix for unique bundles.
	 *
	 * @param  string  $prefix
	 * @param  int     $product_id
	 * @return string
	 */
	public static function bundle_field_prefix( $prefix, $product_id ) {

		if ( ! empty( WC_PB_Compatibility::$bundle_prefix ) ) {
			$prefix = 'component_' . WC_PB_Compatibility::$bundle_prefix . '_';
		}

		return $prefix;
	}

	/**
	 * Hook into 'woocommerce_composited_add_to_cart' to trigger 'WC_PB()->cart->bundle_add_to_cart()'.
	 *
	 * @param  string  $cart_item_key
	 * @param  int     $product_id
	 * @param  int     $quantity
	 * @param  int     $variation_id
	 * @param  array   $variation
	 * @param  array   $cart_item_data
	 */
	public static function add_bundle_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
		WC_PB()->cart->bundle_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data );
	}

	/**
	 * Used to link bundled cart items with the composite container product.
	 *
	 * @param  boolean  $is_child
	 * @param  string   $cart_item_key
	 * @param  array    $cart_item_data
	 * @param  string   $composite_key
	 * @param  array    $composite_data
	 * @return boolean
	 */
	public static function bundled_cart_item_is_child_of_composite( $is_child, $cart_item_key, $cart_item_data, $composite_key, $composite_data ) {

		if ( $parent = wc_pb_get_bundled_cart_item_container( $cart_item_data ) ) {
			if ( isset( $parent[ 'composite_parent' ] ) && $parent[ 'composite_parent' ] === $composite_key ) {
				$is_child = true;
			}
		}

		return $is_child;
	}

	/**
	 * Used to link bundled order items with the composite container product.
	 *
	 * @param  boolean   $is_child
	 * @param  array     $order_item
	 * @param  array     $composite_item
	 * @param  WC_Order  $order
	 * @return boolean
	 */
	public static function bundled_order_item_is_child_of_composite( $is_child, $order_item, $composite_item, $order ) {

		if ( $parent = wc_pb_get_bundled_order_item_container( $order_item, $order ) ) {
			if ( isset( $parent[ 'composite_parent' ] ) && $parent[ 'composite_parent' ] === $composite_item[ 'composite_cart_key' ] ) {
				$is_child = true;
			}
		}

		return $is_child;
	}

	/**
	 * Edit composited bundle container cart title.
	 *
	 * @param  string  $content
	 * @param  array   $cart_item
	 * @param  string  $cart_item_key
	 * @return string
	 */
	public static function composited_bundle_in_cart_item_title( $content, $cart_item, $cart_item_key ) {

		if ( wc_pb_is_bundle_container_cart_item( $cart_item ) && wc_cp_is_composited_cart_item( $cart_item ) ) {

			$hide_title = WC_Product_Bundle::group_mode_has( $cart_item[ 'data' ]->get_group_mode(), 'component_multiselect' );

			/**
			 * 'woocommerce_composited_bundle_container_cart_item_hide_title' filter.
			 *
			 * @param  boolean  $hide_title
			 * @param  array    $cart_item
			 * @param  string   $cart_item_key
			 */
			$hide_title = apply_filters( 'woocommerce_composited_bundle_container_cart_item_hide_title', $hide_title, $cart_item, $cart_item_key );

			if ( $hide_title ) {

				$bundled_cart_items = wc_pb_get_bundled_cart_items( $cart_item );

				if ( empty( $bundled_cart_items ) ) {
					$content = __( 'No selection', 'woocommerce-product-bundles' );
				} else {
					$content = '';
				}
			}
		}

		return $content;
	}

	public static function composited_bundle_cart_item_data_value( $title, $cart_item, $cart_item_key ) {

		if ( wc_pb_is_bundle_container_cart_item( $cart_item ) && wc_cp_is_composited_cart_item( $cart_item ) ) {

			$hide_title = WC_Product_Bundle::group_mode_has( $cart_item[ 'data' ]->get_group_mode(), 'component_multiselect' );

			/**
			 * 'woocommerce_composited_bundle_container_cart_item_hide_title' filter.
			 *
			 * @param  boolean  $hide_title
			 * @param  array    $cart_item
			 * @param  string   $cart_item_key
			 */
			$hide_title = apply_filters( 'woocommerce_composited_bundle_container_cart_item_hide_title', $hide_title, $cart_item, $cart_item_key );

			if ( $hide_title ) {

				$bundled_cart_items = wc_pb_get_bundled_cart_items( $cart_item );

				if ( empty( $bundled_cart_items ) ) {

					$title = __( 'No selection', 'woocommerce-product-bundles' );

				} else {

					$title       = '';
					$bundle_meta = WC_PB()->display->get_bundle_container_cart_item_data( $cart_item );

					foreach ( $bundle_meta as $meta ) {
						$title .= $meta[ 'value' ] . '<br/>';
					}

				}
			}
		}

		return $title;
	}

	/**
	 * Aggregate value and weight of bundled items in shipping packages when a bundle is composited.
	 *
	 * @param  array                 $cart_item
	 * @param  WC_Product_Composite  $container_cart_item_key
	 * @return array
	 */
	public static function composited_bundle_container_cart_item( $cart_item, $bundle ) {

		if ( $container_cart_item = wc_cp_get_composited_cart_item_container( $cart_item ) ) {

			if ( false === $cart_item[ 'data' ]->needs_shipping() ) {

				$component_id     = $cart_item[ 'composite_item' ];
				$component_option = $container_cart_item[ 'data' ]->get_component_option( $component_id, $cart_item[ 'product_id' ] );

				if ( $component_option && false === $component_option->is_shipped_individually() ) {
					$cart_item[ 'data' ]->add_meta_data( '_wc_cp_composited_value', $cart_item[ 'data' ]->get_price( 'edit' ), true );
					$cart_item[ 'data' ]->add_meta_data( '_wc_cp_composited_weight', 0.0, true );
				}
			}
		}

		return $cart_item;
	}

	/**
	 * Aggregate value and weight of bundled items in shipping packages when a bundle is composited.
	 *
	 * @param  array   $cart_item
	 * @param  string  $cart_item_key
	 * @param  string  $container_cart_item_key
	 * @return array
	 */
	public static function composited_bundle_container_package_item( $cart_item, $cart_item_key, $container_cart_item_key ) {

		if ( wc_pb_is_bundle_container_cart_item( $cart_item ) ) {

			if ( $cart_item[ 'data' ]->meta_exists( '_wc_cp_composited_value' ) ) {

				$composited_bundle_value  = $cart_item[ 'data' ]->get_meta( '_wc_cp_composited_value', true );
				$composited_bundle_weight = $cart_item[ 'data' ]->get_meta( '_wc_cp_composited_weight', true );

				$bundle     = unserialize( serialize( $cart_item[ 'data' ] ) );
				$bundle_qty = $cart_item[ 'quantity' ];

				// Aggregate weights.

				$bundled_weight = 0;

				// Aggregate prices.

				$bundled_value = 0;

				$bundle_totals = array(
					'line_subtotal'     => $cart_item[ 'line_subtotal' ],
					'line_total'        => $cart_item[ 'line_total' ],
					'line_subtotal_tax' => $cart_item[ 'line_subtotal_tax' ],
					'line_tax'          => $cart_item[ 'line_tax' ],
					'line_tax_data'     => $cart_item[ 'line_tax_data' ]
				);

				foreach ( wc_pb_get_bundled_cart_items( $cart_item, WC()->cart->cart_contents, true ) as $child_item_key ) {

					$child_cart_item_data   = WC()->cart->cart_contents[ $child_item_key ];
					$bundled_product        = $child_cart_item_data[ 'data' ];
					$bundled_product_qty    = $child_cart_item_data[ 'quantity' ];
					$bundled_product_value  = $bundled_product->get_meta( '_wc_pb_bundled_value', true );
					$bundled_product_weight = $bundled_product->get_meta( '_wc_pb_bundled_weight', true );

					// Aggregate price.
					if ( $bundled_product_value ) {

						$bundled_value += $bundled_product_value * $bundled_product_qty;

						$bundle_totals[ 'line_subtotal' ]     += $child_cart_item_data[ 'line_subtotal' ];
						$bundle_totals[ 'line_total' ]        += $child_cart_item_data[ 'line_total' ];
						$bundle_totals[ 'line_subtotal_tax' ] += $child_cart_item_data[ 'line_subtotal_tax' ];
						$bundle_totals[ 'line_tax' ]          += $child_cart_item_data[ 'line_tax' ];

						$child_item_line_tax_data = $child_cart_item_data[ 'line_tax_data' ];

						$bundle_totals[ 'line_tax_data' ][ 'total' ]    = array_merge( $bundle_totals[ 'line_tax_data' ][ 'total' ], $child_item_line_tax_data[ 'total' ] );
						$bundle_totals[ 'line_tax_data' ][ 'subtotal' ] = array_merge( $bundle_totals[ 'line_tax_data' ][ 'subtotal' ], $child_item_line_tax_data[ 'subtotal' ] );
					}

					// Aggregate weight.
					if ( $bundled_product_weight ) {
						$bundled_weight += $bundled_product_weight * $bundled_product_qty;
					}
				}

				$cart_item = array_merge( $cart_item, $bundle_totals );

				if ( $bundled_value > 0 ) {
					$bundle->add_meta_data( '_wc_cp_composited_value', (double) $composited_bundle_value + $bundled_value / $bundle_qty, true );
				}

				if ( $bundled_weight > 0 ) {
					$bundle->add_meta_data( '_wc_cp_composited_weight', (double) $composited_bundle_weight + $bundled_weight / $bundle_qty, true );
				}

				$cart_item[ 'data' ] = $bundle;
			}
		}

		return $cart_item;
	}

	/**
	 * Bundles are not directly editable in cart if part of a composite.
	 * They inherit the setting of their container and can only be edited within that scope of their container - @see 'composited_bundle_permalink_args()'.
	 *
	 * @param  boolean            $editable
	 * @param  WC_Product_Bundle  $bundle
	 * @param  array              $cart_item
	 * @return boolean
	 */
	public static function composited_bundle_not_editable_in_cart( $editable, $bundle, $cart_item ) {

		if ( is_array( $cart_item ) && wc_cp_is_composited_cart_item( $cart_item ) ) {
			$editable = false;
		}

		return $editable;
	}

	/**
	 * Add some contextual info to bundle validation messages.
	 *
	 * @param  string $message
	 * @return string
	 */
	public static function component_bundle_error_message_context( $message ) {

		if ( false !== self::$current_component ) {
			$message = sprintf( __( 'Please check your &quot;%1$s&quot; configuration: %2$s', 'woocommerce-composite-products' ), self::$current_component->get_title( true ), $message );
		}

		return $message;
	}

	/**
	 * Edit composited bundle container cart qty.
	 *
	 * @param  int     $quantity
	 * @param  string  $cart_item_key
	 * @return int
	 */
	public static function composited_bundle_in_cart_item_quantity( $quantity, $cart_item_key ) {

		if ( isset( WC()->cart->cart_contents[ $cart_item_key ] ) ) {

			$cart_item = WC()->cart->cart_contents[ $cart_item_key ];

			if ( wc_pb_is_bundle_container_cart_item( $cart_item ) && wc_cp_is_composited_cart_item( $cart_item ) ) {

				$hide_qty = WC_Product_Bundle::group_mode_has( $cart_item[ 'data' ]->get_group_mode(), 'component_multiselect' );

				/**
				 * 'woocommerce_composited_bundle_container_cart_item_hide_quantity' filter.
				 *
				 * @param  boolean  $hide_qty
				 * @param  array    $cart_item
				 * @param  string   $cart_item_key
				 */
				if ( apply_filters( 'woocommerce_composited_bundle_container_cart_item_hide_quantity', $hide_qty, $cart_item, $cart_item_key ) ) {
					$quantity = '';
				}
			}
		}

		return $quantity;
	}

	/**
	 * Edit composited bundle container cart qty.
	 *
	 * @param  int     $quantity
	 * @param  string  $cart_item
	 * @param  string  $cart_item_key
	 * @return int
	 */
	public static function composited_bundle_checkout_item_quantity( $quantity, $cart_item, $cart_item_key = false ) {

		if ( wc_pb_is_bundle_container_cart_item( $cart_item ) && wc_cp_is_composited_cart_item( $cart_item ) ) {

			$hide_qty = WC_Product_Bundle::group_mode_has( $cart_item[ 'data' ]->get_group_mode(), 'component_multiselect' );

			/**
			 * 'woocommerce_composited_bundle_container_cart_item_hide_quantity' filter.
			 *
			 * @param  boolean  $hide_qty
			 * @param  array    $cart_item
			 * @param  string   $cart_item_key
			 */
			if ( apply_filters( 'woocommerce_composited_bundle_container_cart_item_hide_quantity', $hide_qty, $cart_item, $cart_item_key ) ) {
				$quantity = '';
			}
		}

		return $quantity;
	}

	/**
	 * Visibility of composited bundle containers in orders.
	 * Hide containers without children and a zero price (all optional).
	 *
	 * @param  boolean  $visible
	 * @param  array    $order_item
	 * @return boolean
	 */
	public static function composited_bundle_order_item_visible( $visible, $order_item ) {

		if ( wc_pb_is_bundle_container_order_item( $order_item ) && wc_cp_maybe_is_composited_order_item( $order_item ) ) {

			if ( ! empty( $order_item[ 'bundle_group_mode' ] ) && WC_Product_Bundle::group_mode_has( $order_item[ 'bundle_group_mode' ], 'component_multiselect' ) ) {

				$bundled_items = maybe_unserialize( $order_item[ 'bundled_items' ] );

				if ( empty( $bundled_items ) && $order_item[ 'line_subtotal' ] == 0 ) {
					$visible = false;
				}
			}
		}

		return $visible;
	}

	/**
	 * Edit composited bundle container order item title.
	 *
	 * @param  string  $content
	 * @param  array   $order_item
	 * @return string
	 */
	public static function composited_bundle_order_table_item_title( $content, $order_item ) {

		if ( wc_pb_is_bundle_container_order_item( $order_item ) && wc_cp_maybe_is_composited_order_item( $order_item ) ) {

			$hide_title = ! empty( $order_item[ 'bundle_group_mode' ] ) && WC_Product_Bundle::group_mode_has( $order_item[ 'bundle_group_mode' ], 'component_multiselect' );

			/**
			 * 'woocommerce_composited_bundle_container_order_item_hide_title' filter.
			 *
			 * @param  boolean  $hide_title
			 * @param  array    $order_item
			 */
			if ( apply_filters( 'woocommerce_composited_bundle_container_order_item_hide_title', $hide_title, $order_item ) ) {
				$content = '';
			}
		}

		return $content;
	}

	/**
	 * Edit composited bundle container order item qty.
	 *
	 * @param  string  $content
	 * @param  array   $order_item
	 * @return string
	 */
	public static function composited_bundle_order_table_item_quantity( $quantity, $order_item ) {

		if ( wc_pb_is_bundle_container_order_item( $order_item ) && wc_cp_maybe_is_composited_order_item( $order_item ) ) {

			$hide_qty = ! empty( $order_item[ 'bundle_group_mode' ] ) && WC_Product_Bundle::group_mode_has( $order_item[ 'bundle_group_mode' ], 'component_multiselect' );

			/**
			 * 'woocommerce_composited_bundle_container_order_item_hide_quantity' filter.
			 *
			 * @param  boolean  $hide_qty
			 * @param  array    $order_item
			 */
			if ( apply_filters( 'woocommerce_composited_bundle_container_order_item_hide_quantity', $hide_qty, $order_item ) ) {
				$quantity = '';
			}
		}

		return $quantity;
	}

	/**
	 * Prevents bundle container item meta from showing up.
	 *
	 * @since  5.8.0
	 *
	 * @param  string         $desc
	 * @param  array          $desc_array
	 * @param  WC_Order_Item  $item
	 * @return string
	 */
	public static function composited_bundle_order_item_description( $desc, $desc_array, $order_item ) {

		$hide_title = ! empty( $order_item[ 'bundle_group_mode' ] ) && WC_Product_Bundle::group_mode_has( $order_item[ 'bundle_group_mode' ], 'component_multiselect' );

		/**
		 * 'woocommerce_composited_bundle_container_order_item_hide_title' filter.
		 *
		 * @param  boolean  $hide_title
		 * @param  array    $order_item
		 */
		if ( apply_filters( 'woocommerce_composited_bundle_container_order_item_hide_title', $hide_title, $order_item ) ) {
			$desc = '';
		}

		return $desc;
	}

	/**
	 * Use custom callback to add bundles to orders in 'WC_CP_Order::add_composite_to_order'.
	 *
	 * @since  5.8.0
	 *
	 * @param  array                 $callback
	 * @param  WC_CP_Component       $component
	 * @param  WC_Product_Composite  $composite
	 * @param  WC_Order              $order
	 * @param  integer               $quantity
	 * @param  array                 $args
	 */
	public static function add_composited_bundle_to_order_callback( $callback, $component, $composite, $order, $quantity, $args ) {

		$component_configuration = $args[ 'configuration' ][ $component->get_id() ];

		if ( empty( $component_configuration[ 'stamp' ] ) ) {
			return $callback;
		}

		$component_option_id = $component_configuration[ 'product_id' ];
		$component_option    = $component->get_option( $component_option_id );

		if ( $component_option->get_product()->is_type( 'bundle' ) ) {
			return array( __CLASS__, 'add_composited_bundle_to_order' );
		}

		return $callback;
	}

	/**
	 * Custom callback for adding bundles to orders in 'WC_CP_Order::add_composite_to_order'.
	 *
	 * @since  5.8.0
	 *
	 * @param  array                 $callback
	 * @param  WC_CP_Component       $component
	 * @param  WC_Product_Composite  $composite
	 * @param  WC_Order              $order
	 * @param  integer               $quantity
	 * @param  array                 $args
	 */
	public static function add_composited_bundle_to_order( $component, $composite, $order, $quantity, $args ) {

		$component_configuration = $args[ 'configuration' ][ $component->get_id() ];
		$component_option_id     = $component_configuration[ 'product_id' ];
		$component_quantity      = isset( $component_configuration[ 'quantity' ] ) ? absint( $component_configuration[ 'quantity' ] ) : $component->get_quantity();
		$component_option        = $component->get_option( $component_option_id );

		$bundle_args = array(
			'configuration' => $component_configuration[ 'stamp' ]
		);

		return WC_PB()->order->add_bundle_to_order( $component_option->get_product(), $order, $quantity = 1, $bundle_args );
	}

	/*
	|--------------------------------------------------------------------------
	| REST API.
	|--------------------------------------------------------------------------
	*/

	/**
	 * Parse posted bundle configuration in composite configuration array.
	 *
	 * @param  array                  $configuration
	 * @param  WC_Product_Composite   $composite
	 * @param  WC_Order_Item_Product  $item
	 * @return array
	 */
	public static function parse_composited_rest_bundle_configuration( $configuration, $composite, $item ) {

		if ( empty( $configuration ) || ! is_array( $configuration ) ) {
			return $configuration;
		}

		foreach ( $configuration as $component_id => $component_configuration ) {

			if ( empty( $component_configuration[ 'product_id' ] ) ) {
				continue;
			}

			$component_option = $composite->get_component_option( $component_id, $component_configuration[ 'product_id' ] );

			if ( ! $component_option ) {
				continue;
			}

			$composited_product = $component_option->get_product();

			if ( ! $composited_product->is_type( 'bundle' ) ) {
				continue;
			}

			unset( $configuration[ $component_id ][ 'bundle_configuration' ] );
			$configuration[ $component_id ][ 'stamp' ] = WC_PB_REST_API::parse_posted_bundle_configuration( $composited_product, $component_configuration[ 'bundle_configuration' ] );
		}

		return $configuration;
	}
}

WC_PB_CP_Compatibility::init();
