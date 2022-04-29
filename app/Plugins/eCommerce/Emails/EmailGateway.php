<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.09.2018
 * Time: 14:40
 */

namespace Corp\Plugins\eCommerce\Emails;


use Corp\Option;

abstract class EmailGateway {


	/**
	 * The plugin ID. Used for option names.
	 *
	 * @var string
	 */
	public $plugin_id = 'ecommerce_emails_';
	/**
	 * Set if the place order button should be renamed on selection.
	 *
	 * @var string
	 */
	public $order_button_text;

	/**
	 * Yes or no based on whether the method is enabled.
	 *
	 * @var string
	 */
	public $enabled = 'yes';

	/**
	 * Payment method title for the frontend.
	 *
	 * @var string
	 */
	public $title;

	/**
	 * Payment method description for the frontend.
	 *
	 * @var string
	 */
	public $description;

	/**
	 * Chosen payment method id.
	 *
	 * @var bool
	 */
	public $chosen;

	/**
	 * Gateway title.
	 *
	 * @var string
	 */
	public $method_title = '';

	/**
	 * Gateway description.
	 *
	 * @var string
	 */
	public $method_description = '';

	/**
	 * True if the gateway shows fields on the checkout.
	 *
	 * @var bool
	 */
	public $has_fields;

	/**
	 * Countries this gateway is allowed for.
	 *
	 * @var array
	 */
	public $countries;

	/**
	 * Available for all counties or specific.
	 *
	 * @var string
	 */
	public $availability;

	/**
	 * Icon for the gateway.
	 *
	 * @var string
	 */
	public $icon;

	/**
	 * Supported features such as 'default_credit_card_form', 'refunds'.
	 *
	 * @var array
	 */
	public $supports = array( 'products' );

	/**
	 * Maximum transaction amount, zero does not define a maximum.
	 *
	 * @var int
	 */
	public $max_amount = 0;

	/**
	 * Optional URL to view a transaction.
	 *
	 * @var string
	 */
	public $view_transaction_url = '';

	/**
	 * Optional label to show for "new payment method" in the payment
	 * method/token selection radio selection.
	 *
	 * @var string
	 */
	public $new_method_label = '';

	/**
	 * Form option fields.
	 *
	 * @var array
	 */
	public $form_fields = array();


	/**
	 * Contains a users saved tokens for this gateway.
	 *
	 * @var array
	 */

	public $settings;

	protected $tokens = array();

	public $need_checkout_page = false;

	public function init_form_fields() {
	}

	public function generate_account_details_html() {
	}


	public function init_settings() {
		$opt = Option::with( 'translations' )->where( 'name', $this->get_option_key() )->first();
		if ( isset( $opt->translation_value ) ) {
			$this->settings = unserialize( $opt->translation_value );
		}


		// If there are no settings defined, use defaults.
		if ( !is_array( $this->settings ) ) {
			$form_fields = $this->get_form_fields();
			$this->settings = array_merge( array_fill_keys( array_keys( $form_fields ), '' ), collect( $form_fields )->pluck( 'default' )->toArray() );
		}


		$this->enabled = ( isset( $this->settings['enabled'] ) && $this->settings['enabled'] == 'on' ) ? 'on' : 'no';

	}

	public function get_option_key() {
		return $this->plugin_id . $this->id . '_settings';
	}


	/**
	 * Get option from DB.
	 *
	 * Gets an option from the settings API, using defaults if necessary to prevent undefined notices.
	 *
	 * @param  string $key Option key.
	 * @param  mixed $empty_value Value when empty.
	 * @return string The value specified for the option or a default value for the option.
	 */
	public function get_option( $key, $empty_value = null ) {
		if ( empty( $this->settings ) ) {
			$this->init_settings();
		}


		// Get option default if unset.

		if ( !isset( $this->settings[$key] ) || $this->settings[$key] == '' ) {

			$form_fields = $this->get_form_fields();

			$this->settings[$key] = isset( $form_fields[$key] ) ? $this->get_field_default( $form_fields[$key] ) : '';


		}

		if ( !is_null( $empty_value ) && '' === $this->settings[$key] ) {

			$this->settings[$key] = $empty_value;
		}

		return $this->settings[$key];
	}

	/**
	 * Get the form fields after they are initialized.
	 *
	 * @return array of options
	 */
	public function get_form_fields() {
		return array_map( array( $this, 'set_defaults' ), $this->form_fields );
	}


	/**
	 * Set default required properties for each field.
	 *
	 * @param array $field Setting field array.
	 * @return array
	 */
	protected function set_defaults( $field ) {
		if ( !isset( $field['default'] ) ) {
			$field['default'] = '';
		}
		return $field;
	}

	/**
	 * Return the gateway's title.
	 *
	 * @return string
	 */
	public function get_title() {
		return $this->title;
	}


	/**
	 * Return the description for admin screens.
	 *
	 * @return string
	 */
	public function get_method_description() {
		return $this->method_description;
	}


	/**
	 * Get a fields default value. Defaults to "" if not set.
	 *
	 * @param  array $field Field key.
	 * @return string
	 */
	public function get_field_default( $field ) {
		return empty( $field['default'] ) ? '' : $field['default'];
	}


	/**
	 * @return string
	 */
	public function formGroup( $prifex, $key, $args = [] ) {

		if(isset($this->settings[$key]) && !empty($this->settings[$key])){
			$value =  $this->settings[$key] ;
		} else {
			$value = $args['default'] ?? '';
        }

  //      dump($value);
		?>
        <div class="form-group col-md-4">
            <label for="<?php echo e( $key ) ?>"><?php echo e( $args['title'] ?? '' ); ?></label>
			<?php if ( isset( $args['description']{0} ) ) { ?>
			<small><?php echo e($args['description']); ?></small>

            <?php } ?>
			<?php if ( $args['type'] == 'checkbox' ) {
			    ?>

                <br>

                <input <?php checked( 'on', $value ?? $args['default']  ) ?>
                        name="<?php echo e( $key ) ?>"
                        id="<?php echo e( $key ) ?>"
                        type="checkbox" class="js-switch"

                        data-color="#13dafe"

                />


			<?php } elseif ( $args['type'] == 'text' ) {


				?>
                <input name="<?php echo e( $key ) ?>" type="text"
                       class="form-control"
                       id="<?php echo e( $key ) ?>"
                       value="<?php echo $value; ?>"

                >
			<?php } elseif ( $args['type'] == 'textarea' ) { ?>
                <textarea name="<?php echo e( $key ) ?>" type="text"
                          class="form-control"
                          id="<?php echo e( $key ) ?>"
                ><?php echo $value; ?></textarea>
			<?php } ?>
        </div>
		<?php

	}

	public function is_available() {

		$is_available = ( 'on' === $this->enabled );

//
//		if ( WC()->cart && 0 < $this->get_order_total() && 0 < $this->max_amount && $this->max_amount < $this->get_order_total() ) {
//			$is_available = false;
//		}

		return $is_available;
	}


	public function charge( $ecommerce_cart, $request ) {

		return [];
	}
}