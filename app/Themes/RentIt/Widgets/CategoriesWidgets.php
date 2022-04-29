<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.06.2018
 * Time: 15:53
 */

namespace Corp\Themes\RentIt\Widgets;


use Corp\Category;
use Corp\Http\Widgets\Widgets;
use Cache;

class  CategoriesWidgets extends Widgets {

	public function __construct() {
		//echo '111111111111';
		$args = array(
			'name' => 'Categories',
			'description' => 'It displays a Categories ',
			'classname' => 'Categories',
		);
		parent::__construct( 'Categories', 'RentIt Categories', $args );

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

		$key = base64_encode( implode( '', $instance ) . get_class() . app()->getLocale());

		echo Cache::remember($key, 100, function () use ($instance){

			ob_start();

			$categories = Category::with( 'translations' )->withCount( 'posts' )->get()->groupBy( 'parent_id' );
			$catt_arr = buildTree( $categories->toArray(), 0 );

			?>
            <div class="widget shadow car-categories">
                <h4 class="widget-title"><?php echo $instance['title'] ?? ''; ?></h4>
                <div class="widget-content">
                    <ul>
						<?php echo( $this->buildCats( $catt_arr ) ); ?>
                    </ul>

                </div>
            </div>

			<?php
			return ob_get_clean();
		} );


	}


	/**
	 * @param array $tree
	 * @param null $category_id
	 * @param int $Level
	 * @param int $prev_id
	 * @return string
	 */
	public function buildCats( array $tree, $category_id = null, int $Level = 0, $prev_id = 0 ) {

		$text = '';

		foreach ( $tree as $k => $item ) {
			$title = isset( $item['title'] ) ? $item['title'] : $item['alias'];
			$Level = $item['parent_id'] != 0 ? $Level : 0;
			if ( $prev_id['parent_id'] == 0 ) {
				$Level = 1;
			}


			if($item['posts_count'] > 0 ||  isset($item['children']) ) {
				if ( isset( $item['children'] ) ) {

					$text .= '<li> 
<span class="arrow"><i class="fa fa-angle-down"></i></span><a href="' . route( 'postsCat', [ 'cat_alias' => $item['alias'] ] ) . '">' . $title . "</a>\n\r";
					$text .= '<ul class="children" style="display: none;">';
					$text .= $this->buildCats( $item['children'], $category_id, ++ $Level, $item );
					$text .= '</ul></li>';

				} else {
					if ( $Level > 0 && $item['parent_id'] > 0 ) {

						$text .= ' <li><a href="' . route( 'postsCat', [ 'cat_alias' => $item['alias'] ] ) . '">' . $title . '<span class="count">' . $item['posts_count'] . '</span></a></li>';
					} else {
						$text .= ' <li><a href="' . route( 'postsCat', [ 'cat_alias' => $item['alias'] ] ) . '">' . $title . '</a></li>';
					}
				}
			}

		}
		return $text;
	}
}