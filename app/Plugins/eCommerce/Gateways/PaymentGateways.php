<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.09.2018
 * Time: 14:58
 */

namespace Corp\Plugins\eCommerce\Gateways;



use Corp\Plugins\eCommerce\Gateways\Stripe\PayPalGateway;

class PaymentGateways {

	/**
	 * Payment gateway classes.
	 *
	 * @var array
	 */
	public $payment_gateways = array();

	/**
	 * The single instance of the class.
	 *
	 * @var Payment_Gateways
	 * @since 2.1.0
	 */
	protected static $_instance = null;

	/**
	 * Main Payment_Gateways Instance.
	 *
	 * Ensures only one instance of Payment_Gateways is loaded or can be loaded.
	 *
	 * @since 2.1
	 * @return Payment_Gateways Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 2.1
	 */
	public function __clone() {
		die( __( 'Cloning is forbidden.' ));
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 2.1
	 */
	public function __wakeup() {
		die( __( 'Unserializing instances of this class is forbidden.' ));

	}

	/**
	 * Initialize payment gateways.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Load gateways and hook in functions.
	 */
	public function init() {
		$load_gateways = array(
			GatewayCheque\GatewayCheque::class,
			Stripe\StripeGateway::class,
			PayPal\PayPalGateway::class
		);

		$order_end = 999;

		// Load gateways in order.
		foreach ( $load_gateways as $gateway ) {
			$load_gateway = is_string( $gateway ) ? new $gateway() : $gateway;


				$this->payment_gateways[ $order_end ] = $load_gateway;
				$order_end++;

		}

		ksort( $this->payment_gateways );
	}

	/**
	 * Get gateways.
	 *
	 * @return array
	 */
	public function payment_gateways() {
		$_available_gateways = array();

		if ( count( $this->payment_gateways ) > 0 ) {
			foreach ( $this->payment_gateways as $gateway ) {
				$_available_gateways[ $gateway->id ] = $gateway;
			}
		}

		return $_available_gateways;
	}

	/**
	 * Get array of registered gateway ids
	 *
	 * @since 2.6.0
	 * @return array of strings
	 */
	public function get_payment_gateway_ids() {
		return collect( $this->payment_gateways)->pluck('id');
	}

	/**
	 * Get available gateways.
	 *
	 * @return array
	 */
	public function get_available_payment_gateways() {
		$_available_gateways = array();

		foreach ( $this->payment_gateways as $gateway ) {
			if ( $gateway->is_available() ) {



				//if ( ! is_add_payment_method_page() ) {
				//	$_available_gateways[ $gateway->id ] = $gateway;
				//} elseif ( $gateway->supports( 'add_payment_method' ) || $gateway->supports( 'tokenization' ) ) {
					$_available_gateways[ $gateway->id ] = $gateway;
				//}
			}
		}

		return  $_available_gateways;
	}

	/**
	 * Set the current, active gateway.
	 *
	 * @param array $gateways Available payment gateways.
	 */
	public function set_current_gateway( $gateways ) {
		// Be on the defensive.
		if ( ! is_array( $gateways ) || empty( $gateways ) ) {
			return;
		}
//
//		if ( is_user_logged_in() ) {
//			$default_token = Payment_Tokens::get_customer_default_token( get_current_user_id() );
//			if ( ! is_null( $default_token ) ) {
//				$default_token_gateway = $default_token->get_gateway_id();
//			}
//		}
//
//		$current = ( isset( $default_token_gateway ) ? $default_token_gateway : WC()->session->get( 'chosen_payment_method' ) );
//
//		if ( $current && isset( $gateways[ $current ] ) ) {
//			$current_gateway = $gateways[ $current ];
//
//		} else {
//			$current_gateway = current( $gateways );
//		}
//
//		// Ensure we can make a call to set_current() without triggering an error.
//		if ( $current_gateway && is_callable( array( $current_gateway, 'set_current' ) ) ) {
//			$current_gateway->set_current();
//		}
	}

	/**
	 * Save options in admin.
	 */
	public function process_admin_options() {
	/*	$gateway_order = isset( $_POST['gateway_order'] ) ? clean( wp_unslash( $_POST['gateway_order'] ) ) : ''; // WPCS: input var ok, CSRF ok.
		$order         = array();

		if ( is_array( $gateway_order ) && count( $gateway_order ) > 0 ) {
			$loop = 0;
			foreach ( $gateway_order as $gateway_id ) {
				$order[ esc_attr( $gateway_id ) ] = $loop;
				$loop++;
			}
		}

		update_option( 'woocommerce_gateway_order', $order );*/
	}
}