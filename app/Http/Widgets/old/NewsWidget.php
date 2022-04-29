<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.06.2018
 * Time: 15:53
 */

namespace Corp\Http\Widgets;


use Corp\Post;

class  NewsWidget extends Widgets {

	public function __construct() {
		//echo '111111111111';
		$args = array(
			'name' => 'Last news',
			'description' => 'It displays a news ',
			'classname' => 'last_news',
		);
		parent::__construct( 'last_news', 'Last news', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		//  dd($instance);
	//	extract( $instance );

		?>
        <div class="form-group">

            <label class="control-label" for="<?php echo( $this->get_field_id( 'title' ) ); ?>"> Title:</label>
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
		extract( $args );
		extract( $instance );


		$posts = Post::all();


		?>
        <div class="widget shadow car-categories">
            <h4 class="widget-title"><?php echo $instance['title'] ?? ''; ?></h4>
            <div class="widget-content">
                <ul>
					<?php foreach ( $posts as $post ) { ?>
                        <li><a href="<?php  echo route('posts.show',['alias' => $post->alias]); ?>"><?php  echo $post->title; ?></a></li>
					<?php } ?>


                </ul>
            </div>
        </div>
		<?php


	}
}