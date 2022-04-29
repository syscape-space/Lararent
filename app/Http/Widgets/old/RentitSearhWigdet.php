<?php
namespace Corp\Http\Widgets;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.06.2018
 * Time: 15:24
 */

class RentitSearhWigdet extends Widgets{

	public  function __construct(){
		//echo '111111111111';
		$args = array(
			'name'        =>  'Rent It Search ',
			'description' => 'It displays a Search form ',
			'classname'   => 'rentit_search'
		);
		parent::__construct( 'rentit_Search', 'Rent It Search', $args );

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

            <label  class="control-label" for="<?php echo ( $this->get_field_id( 'placeholder' ) ); ?>"> Title:</label>
            <input class="widefat  form-control" id="<?php echo ( $this->get_field_id( 'placeholder' ) ); ?>"
                   name="<?php echo ( $this->get_field_name( 'placeholder' ) ); ?>" type="text"
                   value="<?php if ( isset( $placeholder ) ) {
		               echo ( $placeholder);
	               } ?>">

        </div>

		  <div class="form-group">
			<label class="control-label" for="<?php echo ( $this->get_field_id( 'number' ) ); ?>"> Number:</label>
			<input class="widefat  form-control" id="<?php echo ( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo ( $this->get_field_name( 'number' ) ); ?>" type="text"
			       value="<?php if ( isset( $number) ) {
				       echo ( $number );
			       } ?>">
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

		?>
		<div class="widget shadow">
			<div class="widget-search">

				<form action="/" method="get">
					<input name="s" class="form-control" type="text"
					       placeholder="Search">
					<button><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
		<?php


	}

}


function esc_url($d){
	return $d;
}