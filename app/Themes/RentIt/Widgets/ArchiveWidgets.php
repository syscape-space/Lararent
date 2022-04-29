<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.06.2018
 * Time: 15:53
 */

namespace Corp\Themes\RentIt\Widgets;


use App;
use Cache;
use Carbon\Carbon;
use Corp\Http\Widgets\Widgets;
use Corp\Post;
use DB;


class ArchiveWidgets extends Widgets {

	public function __construct() {

		$args = array(
			'name' => 'rentit archive',
			'description' => 'It displays a ARCHIVES list ',
			'classname' => 'rentit_archive'
		);
		parent::__construct( 'rentit_archive', 'RentIt Archive', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		extract($instance);
		?>
        <div class="form-group">

            <label class="control-label" for="<?php echo( $this->get_field_id( 'title' ) ); ?>"><?php  echo e(__('Title:'))?> </label>
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
		$key = base64_encode( implode( '', $instance ) . get_class() . app()->getLocale());

		echo Cache::remember( $key, 100, function () use ( $instance ) {

			ob_start();
			$posts_by_date = Post::with( 'translations' )->get()->groupBy( function ( $date ) {
				return Carbon::parse( $date->created_at )->format( 'Y-m' );
			} );

			?>
            <div class="widget shadow car-categories">
                <h4 class="widget-title"><?php echo e( $instance['title'] ); ?></h4>
                <div class="widget-content">
                    <ul>
						<?php
						if ( is_object( $posts_by_date ) ) {
							foreach ( $posts_by_date as $date => $v ) {
								?>
                                <li>
                                    <span class="arrow"><i class="fa fa-angle-down"></i></span>
                                    <a href="#"><?php echo date( 'Y M', strtotime( $date ) );; ?><span
                                                class="count"><?php echo count( $v ); ?></span></a>

									<?php if ( is_object( $v ) ) { ?>
                                        <ul class="children" style="display: none;">
											<?php foreach ( $v as $post ) { ?>
                                                <li>
                                                    <a href="<?php echo route( 'posts.show', [ 'alias' => $post->alias ] ) ?>"><?php echo e( $post->title ); ?></a>
                                                </li>
											<?php } ?>

                                        </ul>
									<?php } ?>
                                </li>
								<?php

							}
						} ?>


                    </ul>
                </div>
            </div>
			<?php
			return ob_get_clean();
		} );


	}


}