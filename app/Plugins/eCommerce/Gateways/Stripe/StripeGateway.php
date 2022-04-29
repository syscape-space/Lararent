<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.09.2018
 * Time: 16:48
 */

namespace Corp\Plugins\eCommerce\Gateways\Stripe;


use Corp\Plugins\eCommerce\Gateways\PaymentGateway;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Repositories\OrderRepository;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use Session;


class StripeGateway extends PaymentGateway {

    protected  $order_rep;

	public function __construct() {
		$this->id = 'stripe';
		$this->order_rep = New OrderRepository( new Order());
		$this->icon = '';
		$this->has_fields = false;
		$this->method_title = __( 'Strip payment method' );
		$this->method_description = __( 'Take payments in person via Cards.' );

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
				'default' => __( 'Stripe payments' ),
				'desc_tip' => true,
			),
			'enable_test_mode' => array(
				'title' => __( 'enable test mode?' ),
				'type' => 'checkbox',
				'description' => __( 'This controls the title which the user sees during checkout.' ),
				'default' => 'no',
				'desc_tip' => true,
			),
			'STRIPE_PUB_KEY' => array(
				'title' => __( 'Publishable key' ),
				'type' => 'text',
				'description' => __( '' ),
				'default' => '',
				'desc_tip' => true,
			),
			'STRIPE_SECRET_KEY' => array(
				'title' => __( 'Secret key' ),
				'type' => 'text',
				'description' => __( '' ),
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

	protected function  STRIPE_PUB_KEY(){
		if($this->settings['enable_test_mode'] == 'on'){
			return 'pk_test_hO7AvW6Ws6nDAlX8TheHP4E6';
		}
		$res = $this->settings['STRIPE_PUB_KEY'] ?? '';

        return $res;

    }
    public function STRIPE_SECRET_KEY(){
	    if($this->settings['enable_test_mode'] == 'on'){
		    return 'sk_test_pkdHCUuUGZaxA1Xv0C3HLo3l';
	    }
	    $res = $this->settings['STRIPE_SECRET_KEY'] ?? '';

	    return $res;
    }


	public function checkout_bottom( $product, $ecommerce_cart ) {

		?>
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?php echo $this->STRIPE_PUB_KEY();  ?>"
                data-image="//stripe.com/img/documentation/checkout/marketplace.png"
                data-name="<?php echo $_SERVER['HTTP_HOST'] ?>"
                data-description="<?php echo $product->title; ?>"
                data-amount="$ecommerce_cart['total_price']}}00">
        </script>
		<?php
	}


	public function charge( $ecommerce_cart, $request ) {

		//try {

			Stripe::setApiKey(  $this->STRIPE_SECRET_KEY());


			$customer = Customer::create( array(
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken
			) );

			$ecommerce_cart = Session::get( 'ecommerce_cart' );
			$charge = Charge::create( array(
				'customer' => $customer->id,
				'amount' => $ecommerce_cart['total_price'] . '00',
				'currency' => getCurrencyCode()
			) );


			$ecommerce_cart = Session::get( 'ecommerce_cart' );

			$result =  $this->order_rep->AddOrder( json_decode( json_encode( $ecommerce_cart ) ) ,'paid');




			return redirect( $ecommerce_cart['product_url'] )->with( $result );
		//} catch ( \Exception $ex ) {
		//	return $ex->getMessage();
		//}

	}


}