<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.09.2018
 * Time: 20:38
 */

namespace Corp\Themes\RentIt\Widgets\Product;


use Corp\Http\Widgets\Widgets;

class Testimonials extends Widgets  {

	public function __construct() {
		$args = array( 'description' => __( 'It displays Testimonials' ),
			'classname' => 'rentitTestimonials' );
		parent::__construct( 'rentitTestimonials',
            __( 'rentit Testimonials ' ), $args );;
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


        <div class="widget shadow">
            <div class="widget-title"><?php  echo $instance['title']; ?></div>
            <div class="testimonials-carousel">
                <div class="owl-carousel" id="testimonials">
                    <?php  echo $instance['text'] ; ?>
                </div>
            </div>
        </div>
		<?php

	}
}