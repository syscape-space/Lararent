<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.08.2018
 * Time: 16:28
 */

namespace Corp\Themes\RentIt\Widgets;


use Corp\Http\Widgets\Widgets;
use Corp\Themes\RentIt\RentItTheme;

class NewsLetterWidget extends Widgets {

	public function __construct() {

		$args = array(
			'name' => __( "RentIt News Letter" ),
			'description' => __( "It displays a twitter feed" ),
			'classname' => 'rentit_news_letter'
		);
		parent::__construct( 'rentit_news_letter', __( "RentIt News Letter" ), $args );

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
                   for="<?php echo( $this->get_field_id( 'desc' ) ); ?>"><?php echo e( __( 'Description:' ) ) ?></label>
            <textarea class="widefat  form-control" id="<?php echo( $this->get_field_id( 'desc' ) ); ?>"
                      name="<?php echo( $this->get_field_name( 'desc' ) ); ?>" type="text"
            ><?php echo $desc ?? ''; ?></textarea>


        </div>


        <p><?php __( 'Specify api key and ID list' ); ?></p>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'id' ) ); ?>"><?php echo __( 'ID list:' ); ?>:</label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'id' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'id' ) ); ?>" type="text"
                   value="<?php echo $id ?? ''; ?>">

        </div>

        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'key' ) ); ?>"><?php echo __( 'API key' ); ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'key' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'key' ) ); ?>" type="text"
                   value="<?php echo $key ?? ''; ?>">

        </div>

        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'placeholder ' ) ); ?>"><?php echo __( 'placeholder ' ); ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'placeholder ' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'placeholder ' ) ); ?>" type="text"
                   value="<?php echo $placeholder ?? __( 'Enter Your Mail and Get $10 Cash' ); ?>">

        </div>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'button ' ) ); ?>"><?php echo __( 'Button text ' ); ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'button ' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'button ' ) ); ?>" type="text"
                   value="<?php echo $button ?? __( 'Subscribe' ); ?>">

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




		?>
        <div class="col-md-3">
            <div class="widget">
                <h4 class="widget-title"><?php  echo $instance['title'] ?? ''; ?></h4>
                <p><?php  echo $instance['desc'] ?? ''; ?></p>
                <form class="mail-chimp" action="#"  method="post"
                      data-id="<?php  echo $instance['id'] ?? ''; ?>"
                      data-key="<?php  echo $instance['key'] ?? ''; ?>"


                >
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="<?php  echo $instance['placeholder '] ?? __('Enter Your Mail and Get $10 Cash'); ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-theme btn-theme-transparent"><?php  echo $instance['button '] ?? __('Subscribe'); ?></button>
                    </div>
                    <div class="result">

                    </div>
                </form>
            </div>
        </div>
		<?php


	}
}
