<?php

namespace Corp\Themes\RentIt\Widgets;

use Corp\Http\Widgets\Widgets;

class AboutUsWidget extends Widgets {
	public function __construct() {
		$args = array( 'description' => __( 'It displays About us section' ), 'classname' => 'rentit_about_us' );
		parent::__construct( 'rentit_about_us', __( 'rentit About us ' ), $args );;
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
                   for="<?php echo( $this->get_field_id( 'text' ) ); ?>"><?php echo e( __( 'Text:' ) ) ?></label>


            <textarea id="<?php echo( $this->get_field_id( 'text' ) ); ?>"
                      name="<?php echo( $this->get_field_name( 'text' ) ); ?>"
                      class="widefat  form-control">
            <?php echo $text ?? ''; ?>
        </textarea>
            <div class="form-group about_us">
                <br>
                <!-- Example 1 -->
                <div class="social-icon-group-all">


					<?php if ( isset( $instance['social'] ) && isset( $instance['social']['url'] ) ) {
						$arr = array_combine( $instance['social']['icon'], $instance['social']['url'] );
						$i = 0;
						foreach ( $arr as $k => $v ) {
							?>
                            <div class="entry input-group  social-icon-group ">
                  <span class="input-group-btn">
                        <button
                                name="<?php echo( $this->get_field_name( 'social' ) ); ?>[icon][]"
                                class="btn btn-block btn-info"
                                data-iconset="fontawesome"
                                data-icon="<?php echo e( $k ); ?>"
                                role="iconpicker">

                        </button>
                    </span>
                                <input name="<?php echo( $this->get_field_name( 'social' ) ); ?>[url][]" type="text"
                                       placeholder="<?php echo e( __( 'Paste your social url' ) ); ?>"
                                       class="form-control"
                                       value="<?php echo e( $v ); ?>">

                                <span class="input-group-btn">
                                   <?php if ( $i > 0 ) { ?>
                                       <button class="btn btn-danger btn-delete" type="button">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
	                                   <?php
                                   } else { ?>
                                       <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
	                                   <?php
                                   } ?>
                    </span>

                            </div>
							<?php
							$i ++;
						}
					} else {
						?>

                        <div class="entry input-group  social-icon-group ">
                  <span class="input-group-btn">
                        <button
                                name="<?php echo( $this->get_field_name( 'social' ) ); ?>[icon][]"
                                class="btn btn-block btn-info"
                                data-iconset="fontawesome"
                                data-icon=""
                                role="iconpicker">

                        </button>
                    </span>
                            <input name="<?php echo( $this->get_field_name( 'social' ) ); ?>[url][]"
                                   type="text"
                                   placeholder="<?php echo e( __( 'Paste your social url' ) ); ?>"
                                   class="form-control" value="">

                            <span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                    </span>

                        </div>
						<?php
					} ?>


                </div>
            </div>


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
		?>
        <div class="col-md-3">
            <div class="widget">
                <h4 class="widget-title"><?php echo e( $instance['title'] ); ?></h4>
                <p><?php echo( $instance['text'] ); ?></p>
				<?php
				$arr = null;

                $arr = array_combine( $instance['social']['icon'] ?? [], $instance['social']['url'] ?? []);

				?>
                <ul class="social-icons">

					<?php if ( $arr ) {
						foreach ( $arr as $k => $v ) {
							?>
                            <li><a href="<?php  echo $v; ?>" class="facebook"><i class="fa <?php  echo $k; ?>"></i></a></li>
							<?php
						}
					} ?>


                </ul>
            </div>
        </div>
		<?php
	}
}
