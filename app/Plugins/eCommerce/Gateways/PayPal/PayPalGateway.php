<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.09.2018
 * Time: 16:48
 */

namespace Corp\Plugins\eCommerce\Gateways\PayPal;


use Corp\Plugins\eCommerce\Gateways\PaymentGateway;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Repositories\OrderRepository;
use Session;


class PayPalGateway extends PaymentGateway {

	protected $order_rep;

	public function __construct() {
		$this->id = 'PayPal';
		$this->order_rep = New OrderRepository( new Order() );
		$this->icon = '';
		$this->has_fields = false;
		$this->method_title = __( 'PayPal payment method' );
		$this->method_description = __( 'Take payments in person via PayPal.' );

		// Load the settings.
		$this->init_form_fields();

		$this->init_settings();

		// Define user set variables.
		$this->title = $this->get_option( 'title' );
		$this->description = $this->get_option( 'description' );
		$this->instructions = $this->get_option( 'instructions' );
	}


	public function init_form_fields() {

		$this->form_fields = array(
			'enabled' => array(
				'title' => __( 'Enable/Disable' ),
				'type' => 'checkbox',
				'label' => __( 'Enable check payments' ),
				'default' => 'no',
			),
			'title' => array(
				'title' => __( 'Title' ),
				'type' => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.' ),
				'default' => __( 'PayPal payments' ),
				'desc_tip' => true,
			),
			'enable_test_mode' => array(
				'title' => __( 'enable test mode?' ),
				'type' => 'checkbox',
				'description' => __( 'This controls the title which the user sees during checkout.' ),
				'default' => 'no',
				'desc_tip' => true,
			),
			'email' => array(
				'title' => __( 'Insert your PayPal email' ),
				'type' => 'text',
				'description' => __( 'You need business account, and indicate the email to which you want to accept payments ' ),
				'default' => '',
				'desc_tip' => true,
			),

			'description' => array(
				'title' => __( 'Description' ),
				'type' => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your checkout.' ),
				'default' => __( 'you can pay via card like visa (stripe)' ),
				'desc_tip' => true,
			),
			'instructions' => array(
				'title' => __( 'Instructions' ),
				'type' => 'textarea',
				'description' => __( 'Instructions that will be added to the thank you page and emails.' ),
				'default' => '',
				'desc_tip' => true,
			),

		);
	}


	public function charge( $ecommerce_cart, $request ) {

		//try {


		$ecommerce_cart = Session::get( 'ecommerce_cart' );


		$enableSandbox = false;
		if ( $this->settings['enable_test_mode'] == 'on' ) {
			$enableSandbox = true;
		}


// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
		$paypalConfig = [
			'email' => $this->settings['email'], // 'leonn366-facilitator@gmail.com',
			'return_url' => route( 'PayOk' ),
			'cancel_url' => route( 'PayCancel' ),
			'notify_url' => route( 'PayNotifyController' )
		];

		$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
		$itemName = 'Test Item';
		$itemAmount = $ecommerce_cart['total_price'];


		// Grab the post data so that we can set up the query string for PayPal.
		// Ideally we'd use a whitelist here to check nothing is being injected into
		// our post data.


		$result = $this->order_rep->AddOrder( json_decode( json_encode( $ecommerce_cart ) ), 'pending' );

		if ( $result['id'] == false ) {
			return redirect( 'back' )->with( $result );

		}
		$data = [
			'no_note' => '1',
			'cmd' => '_xclick',
			'lc' => ' UK',
			'bn' => 'PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest',
			'first_name' => $ecommerce_cart['name'],
			'last_name' => $ecommerce_cart['name'],
			'payer_email' => $ecommerce_cart['email'],
			'item_number' => $result['id'] ?? '0', // order number
		];

		// Set the PayPal account.
		$data['business'] = $paypalConfig['email'];

		// Set the PayPal return addresses.
		$data['return'] = stripslashes( $paypalConfig['return_url'] );
		$data['cancel_return'] = stripslashes( $paypalConfig['cancel_url'] );
		$data['notify_url'] = stripslashes( $paypalConfig['notify_url'] );

		// Set the details about the product being purchased, including the amount
		// and currency so that these aren't overridden by the form data.
		$data['item_name'] = $itemName;
		$data['amount'] = $itemAmount;
		$data['currency_code'] = strtoupper( getCurrencyCode() );

		// Add any custom fields for the query string.

		// Build the query string from the data.
		$queryString = http_build_query( $data );


		Session::put( 'paypal_gt_res', [
			'url' => $ecommerce_cart['product_url'],
			'result' => $result
		] );

		session( [ 'key' => 'value' ] );


		Session::put( 'paypal_gt_res', [
			'url' => $ecommerce_cart['product_url'],
			'result' => $result
		] );
		if ( !isset( $_SESSION ) ) {
			session_start();
		}

		$_SESSION["paypal_gt_res"] = [
			'url' => $ecommerce_cart['product_url'],
			'result' => $result
		];


		// Redirect to paypal IPN
		header( 'location:' . $paypalUrl . '?' . $queryString );


	}


}