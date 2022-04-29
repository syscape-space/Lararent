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
use Corp\Http\Widgets\Widgets;
use Corp\Post;
use DB;


class PostsWidgets extends Widgets {

	public function __construct() {

		$args = array(
			'name' => 'rentit_posts',
			'description' => 'It displays a Categories ',
			'classname' => 'rentit_posts'
		);
		parent::__construct( 'rentit_posts', 'rentit_posts', $args );

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

            <label class="control-label" for="<?php echo( $this->get_field_id( 'title' ) ); ?>"> <?php  echo e(__('Title:'))?></label>
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


		echo Cache::remember( 'RentItPostsWidgets', 100, function () {
			$posts = Post::with( 'translations', 'comments', 'meta' )->orderBy( 'created_at', 'DESC' )->limit( 3 )->get();

//
//		$popular_post = Post::with( 'translations', 'comments', 'meta' )->select( 'posts.*',
//			'post_translations.title',
//			'post_translations.text',
//			'post_translations.desc',
//			'post_translations.keywords',
//			'post_translations.meta_desc',
//			'post_translations.locale',
//			'metas.name',
//			'metas.value' )->
//		leftJoin( 'post_translations', 'posts.ID', '=', 'post_translations.post_id' )
//		                   ->leftJoin( 'metas', 'posts.ID', '=', 'metas.metable_id' )
//		                   ->where( "metable_type", "Corp\\Post" )->where( 'locale', App::getlocale() )
//		                   ->orderBy( 'metas.value', 'ASC' )
//		                   ->take( 3 )
//		                   ->get();
//


			//dump( $popular_post2 );

			$popular_post = Post::with( 'translations', 'comments', 'meta' )->limit( 3 )->get()->sortByDesc( function ( $post ) {
				return $post->meta->where( 'name', 'rentIt_visitors' )->first()->value ?? 0;

		} );


			return view( 'theme:rentit::widgets.post-widgets', compact( 'posts', 'popular_post' ) )->render();


		} );

	}


}