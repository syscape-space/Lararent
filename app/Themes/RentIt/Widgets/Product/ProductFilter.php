<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.09.2018
 * Time: 14:57
 */

namespace Corp\Themes\RentIt\Widgets\Product;


use Corp\Http\Widgets\Widgets;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Models\Term;
use Cache;

class ProductFilter extends  Widgets {
	public function __construct() {
		$args = array( 'description' => __( 'It displays Product Filter' ),
			'classname' => 'rentit_productFilters' );
		parent::__construct( 'rentit_productFilters', __( 'rentit Product Filter ' ), $args );;
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
		$instance['text'] = $instance['text'] ?? '';
		$instance['social'] = $instance['social'] ?? [];
		$key = base64_encode( serialize( $instance['title'] ) . get_class() . app()->getLocale() );


	//	echo  Cache::remember($key, 100, function () use ($instance) {


            $locations = Location::with( 'translations' )->get();
			$times = rentit_get_times();

			$terms = Term::with( 'translations' )->get();

			$category_list = [];
			$group_list = [];
			foreach ( $terms as $term ) {
				if ( $term->type == 'category' ) {
					$category_list[] = $term;
				} else {
					$group_list[] = $term;
				}


			}
			$title = $instance['title'];

			echo view( 'theme:rentit::widgets.productFilter',
				compact('locations', 'times', 'category_list', 'group_list','title'))->render();



		//});



	}
}