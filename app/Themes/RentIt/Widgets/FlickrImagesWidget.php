<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.07.2018
 * Time: 14:22
 */

namespace Corp\Themes\RentIt\Widgets;
use Cache;
class FlickrImagesWidget extends \Corp\Http\Widgets\Widgets {
	public function __construct() {

		$args = array(
			'name' => 'rentit Flickr Images ',
			'description' => 'It displays a ARCHIVES list ',
			'classname' => 'rentit_archive'
		);
		parent::__construct( 'rentit_archive', 'rentit Flickr Images', $args );

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

            <label class="control-label" for="<?php echo( $this->get_field_id( 'title' ) ); ?>"><?php  echo e(__('Title:'))?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo $title ?? ''; ?>">

        </div>
        <div class="form-group">

            <label class="control-label" for="<?php echo( $this->get_field_id( 'number' ) ); ?>">
	            <?php  echo __('How many show images?:(max 10)');?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'number' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'number' ) ); ?>" type="number"
                   value="<?php echo $number ?? ''; ?>">

        </div>
        <div class="form-group">

            <label class="control-label" for="<?php echo( $this->get_field_id( 'user_id' ) ); ?>">
	            <?php  echo __(' user id fliker');?>  </label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'user_id' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'user_id' ) ); ?>" type="text"
                   value="<?php echo $user_id ?? ''; ?>">

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
		$instance['number'] = $instance['number'] ?? '';
		$instance['user_id'] = $instance['user_id'] ?? '';


		echo Cache::remember( 'Widgets_FLICKR' . $instance['title'], 100, function () use ( $instance ) {
			ob_start();

			$number = $instance['number'];
			$user_id = $instance['user_id'];
			$title = $instance['title'];
			$url = 'http://www.flickr.com/badge_code_v2.gne?count=' . (int) $number . '&display=latest&size=s&layout=x&source=user&user=' . $user_id;

			try {
				$request = file_get_contents( $url );
			} catch (\Exception $e){

            }
            if(isset($request)) {
	            preg_match_all( '/src="(.*?\.jpg)"/', $request, $img_arr );
	            preg_match_all( '/href="(.*?)"/', $request, $href_arr );
	            ?>
                <div class="widget widget-flickr-feed">

                    <h4 class="widget-title"><span><?php echo( $title ); ?></span></h4>
                    <ul>
			            <?php

			            foreach ( $img_arr[1] as $k => $item ) {


				            ?>
                            <li><a target="_blank" href="<?php echo( $href_arr[1][$k] ); ?>"><img
                                            src="<?php echo( $item ); ?>"
                                            alt=""></a></li>
				            <?php

			            } ?>
                    </ul>
                </div>
	            <?php
            }
			return ob_get_clean();


		} );


	}
}