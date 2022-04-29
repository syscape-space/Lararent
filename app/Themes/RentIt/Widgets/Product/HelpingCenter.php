<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.09.2018
 * Time: 20:42
 */

namespace Corp\Themes\RentIt\Widgets\Product;


use Corp\Http\Widgets\Widgets;

class HelpingCenter extends Widgets {

	public function __construct() {
		$args = array(
			'description' => __( 'It displays Helping Center' ),
			'classname' => 'rentitHelpingCenter'
		);
		parent::__construct( 'rentitHelpingCenter',
			__( 'rentit Helping Center ' ), $args );;
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
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'phone' ) ); ?>"><?php echo e( __( 'Phone:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'phone' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'phone' ) ); ?>" type="text"
                   value="<?php echo $phone ?? ''; ?>">

        </div>

        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'email' ) ); ?>"><?php echo e( __( 'Email:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'email' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'email' ) ); ?>" type="text"
                   value="<?php echo $email ?? ''; ?>">

        </div>

        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'button' ) ); ?>"><?php echo e( __( 'Button text:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'button' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'button' ) ); ?>" type="text"
                   value="<?php echo $button ?? ''; ?>">

        </div>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'url' ) ); ?>"><?php echo e( __( 'Url in button:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'url' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'url' ) ); ?>" type="text"
                   value="<?php echo $url ?? ''; ?>">

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

		$instance = lr_parse_args( $instance, [
			'title' => '',
			'text' => '',
			'phone' => '',
			'email' => '',
			'button' => '',
			'url' => ''
		] );


		?>


        <div class="widget shadow widget-helping-center">
            <h4 class="widget-title"><?php echo $instance['title']; ?></h4>
            <div class="widget-content">
                <p><?php echo $instance['text']; ?></p>
                <h5 class="widget-title-sub"><?php echo $instance['phone']; ?></h5>
                <p><a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a></p>
				<?php if ( isset( $instance['button']{1} ) ) { ?>
                    <div class="button">
                        <a href="<?php echo $instance['url'] ?>"
                           class="btn btn-block btn-theme btn-theme-dark"><?php echo $instance['button'] ?></a>
                    </div>
				<?php } ?>
            </div>
        </div>
		<?php

	}
}