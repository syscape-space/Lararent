<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.08.2018
 * Time: 16:33
 */

namespace Corp\Themes\RentIt\Widgets;

use Corp\Http\Widgets\Widgets;
use Corp\Menu;
use Cache;

class MenuWidget extends Widgets {
	public function __construct() {

		$args = array(
			'name' => __( "RentIt Menu" ),
			'description' => __( "It displays a twitter feed" ),
			'classname' => 'rentit_menu'
		);
		parent::__construct( 'rentit_menu', __( "RentIt Menu" ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {

		extract( $instance );
		$menu = $menu ?? '';
		?>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'title' ) ); ?>"><?php echo e( __( 'Title:' ) ) ?></label>
            <input class="widefat  form-control" id="<?php echo( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo $title ?? ''; ?>">

        </div>
        <div class="form-group">
			<?php

			$menus = Menu::with( 'translations' )->get();

			?>
            <label class="control-label"
                   for="<?php echo( $this->get_field_id( 'menu' ) ); ?>"><?php echo e( __( 'Select menu:' ) ) ?>
            </label>

            <select id="<?php echo( $this->get_field_id( 'menu' ) ); ?>"
                    name="<?php echo( $this->get_field_name( 'menu' ) ); ?>"
                    class="form-control">
                <option> ---</option>
				<?php if ( $menus ) {
					foreach ( $menus as $item ) {


						?>
                        <option <?php if ( $menu == $item->id ) { ?> selected <?php } ?>
                                value="<?php echo e( $item->id ); ?>"><?php echo e( $item->title ); ?></option>
						<?php
					}
				} ?>


            </select>
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
		$instance['menu'] = $instance['menu'] ?? 0;


		printf($args['before_widget'],'');

		$key = md5( $args['id'] . implode( '', $instance ) . get_class() . app()->getLocale() );

		?>

			<?php echo Cache::remember( 'menu' . $key, 5, function () use ( $instance ) {
				ob_start();

			$menu = Menu::with( 'translations' )->where( 'id', $instance['menu'] )->first();
				?>
                <div class="widget widget-categories">
                    <h4 class="widget-title"><?php echo $instance['title']; ?></h4>
					<?php if ( isset($menu->output) && $menu->output ) {
						$res = json_decode( $menu->output );

						?>
                        <ul>
							<?php if ( $res ) {
								foreach ( $res as $r ) {
									?>
                                    <li><a href="<?php echo e( $r->href ); ?>"><?php echo e( $r->text ); ?></a></li>
									<?php
								}
							} ?>


                        </ul>
					<?php } ?>
                </div>
				<?php
				return ob_get_clean();
			} );
			?>

		<?php
		echo	$args['after_widget'];

	}
}