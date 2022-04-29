<?php

namespace Corp\Http\Widgets;

use Corp\Widget;
use Cache;
use App;


/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.06.2018
 * Time: 15:20
 */
class Widgets {
	/**
	 * Root ID for all widgets of this type.
	 *
	 * @var mixed|string
	 */
	public $id_base;

	/**
	 * Name for this widget type.
	 * *
	 * @var string
	 */
	public $name;

	/**
	 * Alt option name for this widget type.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $alt_option_name;

	/**
	 * Option array passed to lr_register_sidebar_widget().
	 *
	 * @since 2.8.0
	 * @var array
	 */
	public $widget_options;

	/**
	 * Option array passed to lr_register_widget_control().
	 *
	 * @since 2.8.0
	 * @var array
	 */
	public $control_options;
	/**
	 * Unique ID number of the current instance.
	 *
	 * @since 2.8.0
	 * @var bool|int
	 */
	public $number = false;

	/**
	 * Unique ID string of the current instance (id_base-number).
	 *
	 * @since 2.8.0
	 * @var bool|string
	 */
	public $id = false;

	/**
	 * Whether the widget data has been updated.
	 *
	 * Set to true when the data is updated after a POST submit - ensures it does
	 * not happen twice.
	 *
	 * @since 2.8.0
	 * @var bool
	 */
	public $updated = false;


	/***
	 * Widgets constructor.
	 * @param $id_base
	 * @param $name
	 * @param array $widget_options
	 * @param array $control_options
	 */
	public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() ) {
		$this->id_base = empty( $id_base ) ? preg_replace( '/(lr_)?widget_/', '', strtolower( get_class( $this ) ) ) : strtolower( $id_base );
		$this->name = $name;
		$this->option_name = 'widget_' . $this->id_base;
		$this->widget_options = array_merge( $widget_options, array(
			'classname' => $this->option_name,
			'customize_selective_refresh' => false
		) );
		$this->control_options = array_merge( $control_options, array( 'id_base' => $this->id_base ) );
	}


	/**
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {
		die( 'function lr_Widget::widget() must be over-ridden in a sub-class.' );
	}

	/**
	 * Retrieves the form callback. *
	 *
	 *
	 * @return callable Form callback.
	 */

	public function _get_form_callback() {
		//	var_dump(array($this, 'form_callback'));
		return array( $this, 'form_callback' );
	}

	/**
	 * Sets the internal order number for the widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param int $number The unique order number of this widget instance compared to other
	 *                    instances of the same class.
	 */
	public function _set( $number ) {

		$this->number = $number;
		$this->id = $this->id_base . '-' . $number;
	}

	/**
	 * @param int $widget_args
	 * @param null $widget_id
	 * @return string
	 */
	public function form_callback( $widget_args = - 1, $widget_id = null, $output = null ) {

		$return = false;
		$instance = false;
		if ( is_numeric( $widget_args ) ) {
			$widget_args = array( 'number' => $widget_args );
		}

		$widget_args = lr_parse_args( $widget_args, array( 'number' => - 1 ) );



		$widget = unserialize( $output );
		$all_instances =  $widget['widget-' . $widget['id_base']];

		if ( - 1 == $widget_args['number'] ) {
			// We echo out a form where 'number' can be set later
			$this->_set( '__i__' );
			$instance = array();
		} else {


			$this->_set( $widget_args['number'] );

			if ( isset( $all_instances[$widget_args['number']] ) ) {
				$instance = $all_instances[$widget_args['number']];
			}

		}


		if ( false !== $instance ) {


			$return = $this->form( $instance );


		}
		return $return;
	}


	/**
	 * Updates a particular instance of a widget.
	 *
	 * This function should check that `$new_instance` is set correctly. The newly-calculated
	 * value of `$instance` should be returned. If false is returned, the instance won't be
	 * saved/updated.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            lr_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 * @return string Default return is 'noform'.
	 */
	public function form( $instance ) {
		echo '<p class="no-options-widget">' . __( 'There are no options for this widget.' ) . '</p>';
		return 'noform';
	}


	public function get_field_id( $field_name ) {
		return 'widget-' . $this->id_base . '-' . $this->number . '-' . trim( str_replace( array(
				'[]',
				'[',
				']'
			), array( '', '-', '' ), $field_name ), '-' );
	}


	/**
	 * Constructs name attributes for use in form() fields
	 *
	 * This function should be used in form() methods to create name attributes for fields
	 * to be saved by update()
	 *
	 * @since 2.8.0
	 * @since 4.4.0 Array format field names are now accepted.
	 *
	 * @param string $field_name Field name
	 * @return string Name attribute for $field_name
	 */
	public function get_field_name( $field_name ) {
		if ( false === $pos = strpos( $field_name, '[' ) ) {
			return 'widget-' . $this->id_base . '[' . $this->number . '][' . $field_name . ']';
		} else {
			return 'widget-' . $this->id_base . '[' . $this->number . '][' . substr_replace( $field_name, '][', $pos, strlen( '[' ) );
		}
	}

	/**
	 * Retrieves the settings for all instances of the widget class.
	 *
	 * @since 2.8.0
	 *
	 * @return array Multi-dimensional array of widget instance settings.
	 */
	public function get_settings( $widget_id = null ) {


		if ( $widget_id ) {

		//	return Cache::remember( 'Widgets_id_' .$widget_id, 10, function () use($widget_id) {
			$widget = Widget::with('translations')->where( 'id', $widget_id )->first();


			$widget = unserialize( $widget->output );
			return $widget['widget-' . $widget['id_base']];
			//} );

		}

	}


	/**
	 * Generates the actual widget content (Do NOT override).
	 *
	 * Finds the instance and calls lr_Widget::widget().
	 *
	 * @since 2.8.0
	 *
	 * @param array $args Display arguments. See lr_Widget::widget() for information
	 *                               on accepted arguments.
	 * @param int|array $widget_args {
	 *     Optional. Internal order number of the widget instance, or array of multi-widget arguments.
	 *     Default 1.
	 *
	 * @type int $number Number increment used for multiples of the same widget.
	 * }
	 */
	public function display_callback($args, $widget_args = 1, $widget_id, $widget_output
	) {


		/*if ( is_numeric( $widget_args ) ) {
			$widget_args = array( 'number' => $widget_args );
		}
*/
		$widget_args = lr_parse_args( $widget_args, array( 'number' => - 1 ) );


		$this->_set( $widget_args['number'] );

		$widget = unserialize( $widget_output );

		$instances = $widget['widget-' . $widget['id_base']];


		$instance = [];
		if(isset($instances[0])) {
            foreach ($instances as $k => $v) {
                $instance = $v;

            }
        }

		$this->widget( $args, $instance );


		//	dump(array_key_exists( $this->number, $instances ));
		if (isset($instances[0]) && array_key_exists( $this->number, $instances ) ) {
			$instance = $instances[$this->number];

			/**
			 * Filters the settings for a particular widget instance.
			 *
			 * Returning false will effectively short-circuit display of the widget.
			 *
			 * @since 2.8.0
			 *
			 * @param array $instance The current widget instance's settings.
			 * @param lr_Widget $this The current widget instance.
			 * @param array $args An array of default widget arguments.
			 */

			if ( false === $instance ) {
				return;
			}


		}
	}

	/**
	 * Registers an instance of the widget class.
	 *
	 * @since 2.8.0
	 *
	 * @param integer $number Optional. The unique order number of this widget instance
	 *                        compared to other instances of the same class. Default -1.
	 */
	public	function _register_one(
		$number = - 1
	) {
		lr_register_sidebar_widget( $this->id, $this->name, $this->_get_display_callback(), $this->widget_options, array( 'number' => $number ) );
		_register_widget_update_callback( $this->id_base, $this->_get_update_callback(), $this->control_options, array( 'number' => - 1 ) );
		_register_widget_form_callback( $this->id, $this->name, $this->_get_form_callback(), $this->control_options, array( 'number' => $number ) );
	}





}



/*
 *
 *
 */