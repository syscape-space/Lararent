<?php

namespace Corp\Plugins\eCommerce\Emails;


class EmailsGateways {

	/**
	 * email gateway classes.
	 *
	 * @var array
	 */
	public $email_gateways = array();

	/**
	 * The single instance of the class.
	 *
	 * @var email_Gateways
	 * @since 2.1.0
	 */
	protected static $_instance = null;

	/**
	 * Main email_Gateways Instance.
	 *
	 * Ensures only one instance of email_Gateways is loaded or can be loaded.
	 *
	 * @since 2.1
	 * @return email_Gateways Main instance
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
		die( __( 'Cloning is forbidden.' ) );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 2.1
	 */
	public function __wakeup() {
		die( __( 'Unserializing instances of this class is forbidden.' ) );

	}

	/**
	 * Initialize email gateways.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Load gateways and hook in functions.
	 */
	public function init() {
		$load_gateways = array(
			EmailNewOrder::class
		);

		$order_end = 999;

		// Load gateways in order.
		foreach ( $load_gateways as $gateway ) {
			$load_gateway = is_string( $gateway ) ? new $gateway() : $gateway;


			$this->email_gateways[$order_end] = $load_gateway;
			$order_end ++;

		}

		ksort( $this->email_gateways );
	}

	/**
	 * Get gateways.
	 *
	 * @return array
	 */
	public function email_gateways() {
		$_available_gateways = array();

		if ( count( $this->email_gateways ) > 0 ) {
			foreach ( $this->email_gateways as $gateway ) {
				$_available_gateways[$gateway->id] = $gateway;
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
	public function get_email_gateway_ids() {
		return collect( $this->email_gateways )->pluck( 'id' );
	}

	/**
	 * Get available gateways.
	 *
	 * @return array
	 */
	public function get_available_email_gateways() {
		$_available_gateways = array();

		foreach ( $this->email_gateways as $gateway ) {
			if ( $gateway->is_available() ) {


				$_available_gateways[$gateway->id] = $gateway;

			}
		}

		return $_available_gateways;
	}

	/**
	 * Set the current, active gateway.
	 *
	 * @param array $gateways Available email gateways.
	 */
	public function set_current_gateway( $gateways ) {
		// Be on the defensive.
		if ( !is_array( $gateways ) || empty( $gateways ) ) {
			return;
		}

	}


}