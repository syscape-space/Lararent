<?php

namespace Corp\Themes\RentIt\Widgets;

use Cache;

class SearchWidget extends \Corp\Http\Widgets\Widgets {
	public function __construct() {

		$args = array(
			'name' => 'rentit twitter',
			'description' => 'It displays a search form ',
			'classname' => 'rentit_twitter'
		);
		parent::__construct( 'rentit_search', 'rentit search form ', $args );

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


		?>
        <div class="widget shadow">
            <div class="widget-search">
                <form action="<?php  echo route('search'); ?>" method="get">
                    <input name="s" class="form-control" type="text" placeholder="Search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>

            </div>
        </div>
		<?php

		return false;
	}
}