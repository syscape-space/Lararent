<?php

namespace Corp\Themes\RentIt\Widgets;

use Cache;
use Eventy;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Log;

class TagsWidgets extends \Corp\Http\Widgets\Widgets {
	public function __construct() {

		$args = array(

			'description' => 'It displays a tag cloud ',
			'classname' => 'rentit_tags'
		);
		parent::__construct( 'rentit_tags', 'rentit Tag ', $args );;


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

		$key = md5(   $args['id']. implode( '', $instance ) . get_class() . App::getLocale() );
		printf($args['before_widget'],'widget-tag-cloud');


		?>

<!--        <div class="widget widget-tag-cloud">-->
			<?php
			echo Cache::remember( 'tag'. $key, 60, function () use ( $instance ) {
				ob_start();
				$instance['title'] = $instance['title'] ?? '';
				$tags = DB::select( 'SELECT t.alias,
       tt.title
FROM
  (SELECT tag_id,
          COUNT(tag_post.tag_id) AS tag_count
   FROM tag_post
   GROUP BY tag_id
   ORDER BY tag_count DESC ) AS tp
LEFT JOIN tags AS t ON tp.tag_id = t.id
LEFT JOIN tag_translations AS tt ON tt.tag_id = t.id
WHERE tt.locale = :lang
ORDER BY tag_count DESC;
  ', [ 'lang' => App::getLocale() ] );;
				if ( $tags ) {
					?>

                    <h4 class="widget-title"><span><?php echo e( $instance['title'] ); ?></span></h4>
                    <ul>
						<?php
						foreach ( $tags as $tag ) { ?>
                            <li><a href="<?php  echo route('postsTag',['alias' => $tag->alias]) ?>"><?php echo $tag->title; ?></a></li>
						<?php }
						?>

                    </ul>

					<?php
				}
				return ob_get_clean();
			} );

		 echo	$args['after_widget'];

	}
}