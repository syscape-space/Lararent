<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.10.2018
 * Time: 16:26
 */

namespace Corp\Themes\RentIt\Widgets\Product;


use Corp\Http\Widgets\Widgets;

class DetailReservation extends Widgets {
	public function __construct() {
		$args = array(
			'description' => __( 'It displays Detail Reservation' ),
			'classname' => 'DetailReservation'
		);
		parent::__construct( 'DetailReservation',
			__( 'Detail Reservation' ), $args );;
	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		extract( $instance );
		?>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'title' ) ); ?>"><?php echo e( __( 'Title:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo $title ?? ''; ?>">

        </div>

        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'text' ) ); ?>"><?php echo e( __( 'Text:' ) ) ?></label>
            <textarea class="widefat  form-control" id="<?php echo( $this->get_field_id( 'text' ) ); ?>"
                      name="<?php echo( $this->get_field_name( 'text' ) ); ?>" type="text"
            ><?php echo $text ?? ''; ?></textarea>

        </div>

		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		$instance['title'] = $instance['title'] ?? '';
		$instance['text'] = $instance['text'] ?? '';



		?>

        <div class="widget shadow widget-details-reservation">
            <h4 class="widget-title"><?php echo $instance['title']; ?></h4>
            <div class="widget-content">

            </div>
        </div>


		<?php

	}
}