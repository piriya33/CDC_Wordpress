<?php
/**
 * WC_PB_MMI_Cart class
 *
 * @author   SomewhereWarm <info@somewherewarm.com>
 * @package  WooCommerce Product Bundles
 * @since    6.4.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cart-related functions and filters.
 *
 * @class    WC_PB_MMI_Cart
 * @version  6.4.0
 */
class WC_PB_MMI_Cart {

	/**
	 * Setup hooks.
	 */
	public static function init() {

		// Add-to-Cart validation.
		add_action( 'woocommerce_add_to_cart_bundle_validation', array( __CLASS__, 'add_to_cart_validation' ), 10, 4 );

		// Cart validation.
		add_action( 'woocommerce_check_cart_items', array( __CLASS__, 'cart_validation' ), 15 );
	}

	/*
	|--------------------------------------------------------------------------
	| Filter hooks.
	|--------------------------------------------------------------------------
	*/

	/**
	 * Add-to-Cart validation.
	 *
	 * @param  bool                 $result
	 * @param  int                  $bundle_id
	 * @param  WC_PB_Stock_Manager  $stock_data
	 * @param  array                $configuration
	 * @return boolean
	 */
	public static function add_to_cart_validation( $is_valid, $bundle_id, $stock_data, $configuration = array() ) {

		if ( $is_valid ) {

			$bundle = $stock_data->product;

			$items_min = $bundle->get_min_bundle_size();
			$items_max = $bundle->get_max_bundle_size();

			$items          = $stock_data->get_items();
			$items_selected = 0;

			foreach ( $items as $item ) {
				$item_id         = isset( $item->bundled_item ) && $item->bundled_item ? $item->bundled_item->item_id : false;
				$item_qty        = $item_id && isset( $configuration[ $item_id ] ) && isset( $configuration[ $item_id ][ 'quantity' ] ) ? $configuration[ $item_id ][ 'quantity' ] : $item->quantity;
				$items_selected += $item_qty;
			}

			$items_invalid = false;

			if ( $items_min !== '' && $items_selected < $items_min ) {
				$items_invalid = true;
			} else if ( $items_max !== '' && $items_selected > $items_max ) {
				$items_invalid = true;
			}

			if ( $items_invalid ) {

				$bundle_title = $bundle->get_title();
				$action       = sprintf( __( '&quot;%s&quot; cannot be added to the cart', 'woocommerce-product-bundles' ), $bundle_title );
				$status       = '';

				if ( $items_min === $items_max ) {
					$resolution = sprintf( _n( 'please choose 1 item', 'please choose %s items', $items_min, 'woocommerce-product-bundles' ), $items_min );
				} elseif ( $items_selected < $items_min ) {
					$resolution = sprintf( _n( 'please choose at least 1 item', 'please choose at least %s items', $items_min, 'woocommerce-product-bundles' ), $items_min );
				} else {
					$resolution = sprintf( _n( 'please limit your selection to 1 item', 'please choose up to %s items', $items_max, 'woocommerce-product-bundles' ), $items_max );
				}

				if ( $items_selected === 1 ) {
					$status = __( ' (you have chosen 1)', 'woocommerce-product-bundles' );
				} elseif ( $items_selected > 1 ) {
					$status = sprintf( __( ' (you have chosen %s)', 'woocommerce-product-bundles' ), $items_selected );
				}

				$message = sprintf( _x( '%1$s &ndash; %2$s%3$s.', 'add-to-cart validation error: action, resolution, status', 'woocommerce-product-bundles' ), $action, $resolution, $status );

				wc_add_notice( $message, 'error' );

				$is_valid = false;
			}
		}

		return $is_valid;
	}

	/**
	 * Cart validation.
	 */
	public static function cart_validation() {

		foreach ( WC()->cart->cart_contents as $cart_item_key => $cart_item ) {

			if ( wc_pb_is_bundle_container_cart_item( $cart_item ) ) {

				$configuration  = isset( $cart_item[ 'stamp' ] ) ? $cart_item[ 'stamp' ] : false;
				$items_selected = 0;

				$bundle = $cart_item[ 'data' ];

				$items_min = $bundle->get_min_bundle_size();
				$items_max = $bundle->get_max_bundle_size();

				if ( $configuration ) {
					foreach ( $configuration as $item_id => $item_configuration ) {
						$item_qty   = isset( $item_configuration[ 'quantity' ] ) ? $item_configuration[ 'quantity' ] : 0;
						$items_selected += $item_qty;
					}
				}

				$items_invalid = false;

				if ( $items_min !== '' && $items_selected < $items_min ) {
					$items_invalid = true;
				} else if ( $items_max !== '' && $items_selected > $items_max ) {
					$items_invalid = true;
				}

				if ( $items_invalid ) {

					$bundle_title = $bundle->get_title();
					$action       = sprintf( __( '&quot;%s&quot; cannot be purchased', 'woocommerce-product-bundles' ), $bundle_title );

					if ( $items_min === $items_max ) {
						$resolution = sprintf( _n( 'please choose 1 item', 'please choose %s items', $items_min, 'woocommerce-product-bundles' ), $items_min );
					} elseif ( $items_selected < $items_min ) {
						$resolution = sprintf( _n( 'please choose at least 1 item', 'please choose at least %s items', $items_min, 'woocommerce-product-bundles' ), $items_min );
					} else {
						$resolution = sprintf( _n( 'please limit your selection to 1 item', 'please choose up to %s items', $items_max, 'woocommerce-product-bundles' ), $items_max );
					}

					$message = sprintf( _x( '%1$s &ndash; %2$s.', 'cart validation error: action, resolution', 'woocommerce-product-bundles' ), $action, $resolution );

					wc_add_notice( $message, 'error' );

					$is_valid = false;
				}
			}
		}
	}
}

WC_PB_MMI_Cart::init();
