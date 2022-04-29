<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.09.2018
 * Time: 16:24
 */

namespace Corp\Plugins\eCommerce\Gateways\GatewayCheque;


use Corp\Plugins\eCommerce\Gateways\PaymentGateway;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Repositories\OrderRepository;

/**
 * Cheque Payment Gateway.
 *
 * Provides a Cheque Payment Gateway, mainly for testing purposes.
 *
 * Class GatewayCheque
 * @package Corp\Plugins\eCommerce\Gateways\GatewayCheque
 */
class GatewayCheque extends PaymentGateway {

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		$this->id = 'cheque';
		$this->icon = '';
		$this->order_rep = New OrderRepository( new Order());
		$this->has_fields = false;
		$this->method_title = __( 'Offline Payments method' );
		$this->method_description = __( 'Take payments in person via checks. This offline gateway can also be useful to test purchases.' );

		// Load the settings.
		$this->init_form_fields();

		$this->init_settings();

		// Define user set variables.
		$this->title = $this->get_option( 'title' );
		$this->description = $this->get_option( 'description' );
		$this->instructions = $this->get_option( 'instructions' );

		// Actions.
		//	add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		//add_action( 'woocommerce_thankyou_cheque', array( $this, 'thankyou_page' ) );

		// Customer Emails.
		//add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );
	}

	public function init_form_fields() {

		$this->form_fields = array(
			'enabled' => array(
				'title' => __( 'Enable/Disable' ),
				'type' => 'checkbox',
				'label' => __( 'Enable Offline Paymentss' ),
				'default' => 'no',
			),
			'title' => array(
				'title' => __( 'Title' ),
				'type' => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.' ),
				'default' => __( 'Offline Paymentss' ),
				'desc_tip' => true,
			),
			'description' => array(
				'title' => __( 'Description' ),
				'type' => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your checkout.' ),
				'default' => __( 'Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.' ),
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

	public function get_form_fields_new() {
		return $this->form_fields;
	}

	public function checkout_bottom( $product, $ecommerce_cart ) {
		$form_fields = $this->get_form_fields();
		?>

        <h3><?php echo $this->title ??  $form_fields['title']['title'] ?? '' ?></h3>
        <p><?php echo $this->description ?? $form_fields['description']['description'] ?? '' ?></p>
        <p><?php echo $this->instructions ?? $form_fields['instructions']['description'] ?? '' ?></p>
		<?php
	}

	public function charge( $ecommerce_cart, $request ) {



		$result =  $this->order_rep->AddOrder( json_decode( json_encode( $ecommerce_cart ) ), 'pending' );
		return redirect( $ecommerce_cart['product_url'] )->with( $result );

	}


}