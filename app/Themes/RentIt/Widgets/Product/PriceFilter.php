<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.09.2018
 * Time: 15:51
 */

namespace Corp\Themes\RentIt\Widgets\Product;


use Corp\Http\Widgets\Widgets;

class PriceFilter extends Widgets {
	public function __construct() {
		$args = array( 'description' => __( 'It displays Price Filter' ),
			'classname' => 'rentitPriceFilters' );
		parent::__construct( 'rentitPriceFilters', __( 'rentit price Filter ' ), $args );;
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
                   for="<?php echo( $this->get_field_id( 'button' ) ); ?>"><?php echo e( __( 'Button text:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'button' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'button' ) ); ?>" type="text"
                   value="<?php echo $button ?? ''; ?>">

        </div>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'min' ) ); ?>"><?php echo e( __( 'min:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'min' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'min' ) ); ?>" type="text"
                   value="<?php echo $min ?? ''; ?>">

        </div>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'max' ) ); ?>"><?php echo e( __( 'max:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'max' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'max' ) ); ?>" type="text"
                   value="<?php echo $max ?? ''; ?>">

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
		$instance['button'] = $instance['button'] ?? __('Filter');
		$instance['min'] = $instance['min'] ?? '0';

		$instance['max'] = $instance['max'] ?? '310';





?>



        <?php

        if(isset(request()->price_filter) && request()->price_filter){
            $priceRange = explode(',', request()->price_filter);

        }
        ?>
        <aside id="rentit_price_filter_class-2" class="widget shadow rentit_card-widget
        widget-filter-price"><h1 class="widget-title"><?php  echo $instance['title']; ?></h1><div class="widget-content">
                <div class="">
                    <form action="<?php  echo route('products.index');  ?>" method="get">
                        <div id="slider-range"></div>
                        <input data-min="<?php  echo (int)$instance['min']; ?>"
                               data-max="<?php  echo (int)$instance['max']; ?>"
                               data-value_min="<?php  echo  $priceRange[0] ??  (int)$instance['min']   ?>"
                               data-value_max="<?php  echo  $priceRange[1] ??  (int)$instance['max'] ?>"
                               value="" type="text"
                               id="amount" readonly />
                        <input name="price_filter" type="hidden" id="amout_rating" value="">
                        <button type="submit" class="btn btn-theme btn-theme-dark">
	                        <?php  echo $instance['button']; ?> </button>
                    </form>
                </div>
            </div></aside>
<?php

	}
}