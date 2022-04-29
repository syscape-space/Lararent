<?php

namespace Corp\Themes\RentIt\Widgets;

use Cache;

class TwitterWidget extends \Corp\Http\Widgets\Widgets {
	public function __construct() {

		$args = array(
			'name' => 'rentit twitter',
			'description' => 'It displays a twitter feed ',
			'classname' => 'rentit_twitter'
		);
		parent::__construct( 'rentit_twitter', 'rentit twitter ', $args );

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

            <label class="control-label" for="<?php echo( $this->get_field_id( 'name' ) ); ?>"><?php  echo __('Name:');?>:</label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'name' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'name' ) ); ?>" type="text"
                   value="<?php echo $name ?? ''; ?>">

        </div>
        <div class="form-group">

            <label class="control-label" for="<?php echo( $this->get_field_id( 'numbers' ) ); ?>"><?php  echo __('How many show  Tweets?');?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'numbers' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'numbers' ) ); ?>" type="number"
                   value="<?php echo $numbers ?? ''; ?>">

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
		$instance['name'] = $instance['name'] ?? '';
		$instance['numbers'] = $instance['numbers'] ?? '';



			echo Cache::remember( implode( '', $instance ) . get_class() . app()->getLocale() . 'ghjghj', 1000, function () use ( $instance ) {


				ob_start();
				try {
				$file = file_get_contents( 'http://twitrss.me/twitter_user_to_rss/?user=' . $instance['name'] );
				if ( isset( $file{3} ) ) {
					$movies = new \SimpleXMLElement( $file );

					?>

                    <div class="widget shadow widget-twitter">
                        <h4 class="widget-title"><span><?php echo $instance['title']; ?></span></h4>
                        <div class="widget-content">
                            <div class="recent-tweets">
								<?php

								for ( $i = 0; $i < $instance['numbers']; $i ++ ) {
									?>
                                    <div class="media">
                                        <div class="media-body">
                                            <p><i class="fa fa-twitter"></i> <a
                                                        href="<?php echo( $movies->channel->item[$i]->link ?? '' ); ?>"
                                                        class="tweets_a">@ <?php echo
													( $instance['name'] ); ?></a>
												<?php echo( $movies->channel->item[$i]->title ?? '' ); ?>
                                                <small><?php

													?> </small>
                                        </div>
                                    </div>

									<?php
								} ?>
                            </div>
                        </div>
                    </div>


					<?php
				}
				} catch (\Exception $e){
					//throw new \Exception();
				}

				return ob_get_clean();
			} );

	}
}