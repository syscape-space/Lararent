<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.09.2018
 * Time: 16:24
 */

namespace Corp\Plugins\eCommerce\Emails;


/**
 * Cheque Payment Gateway.
 *
 * Provides a Cheque Payment Gateway, mainly for testing purposes.
 *
 * Class GatewayCheque
 * @package Corp\Plugins\eCommerce\Gateways\GatewayCheque
 */
class EmailNewOrder extends EmailGateway {

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		$this->id = 'EmailNewOrder';
		$this->icon = '';
		$this->blade = 'plugin:eCommerce::emails.new_order';
		$this->has_fields = false;
		$this->method_title = __( 'New order' );
		$this->method_description = __( 'Sent email when created new order' );

		// Load the settings.
		$this->init_form_fields();

		$this->init_settings();

		// Define user set variables.
		$this->title = $this->get_option( 'title' );
		$this->recipients = $this->get_option( 'recipients' );
		$this->subject = $this->get_option( 'subject' );
		$this->enabled = $this->get_option( 'enabled' );


	}

	public function init_form_fields() {

		$this->form_fields = array(


			'subject' => array(
				'title' => __( 'Subject:' ),
				'type' => 'text',
				'description' => __( '
                    Avaible placeholders:
                    {site_title}
                    {order_date}
                    {order_number}' ),
				'default' => __( '[{site_title}]: New order #{order_number}' ),
				'desc_tip' => true,
			),
			'recipients' => array(
				'title' => __( 'recipients' ),
				'type' => 'text',
				'description' => __( 'recipients' ),
				'default' => getOption('admin_email'),
				'desc_tip' => true,
			),
			'enabled' => array(
				'title' => __( 'Enable/Disable' ),
				'type' => 'checkbox',
				'label' => __( 'Enable this email notification' ),
				'default' => 'on',
			),
		);
	}

	public function get_form_fields_new() {
		return $this->form_fields;
	}




}