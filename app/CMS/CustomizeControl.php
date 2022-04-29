<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.08.2018
 * Time: 14:51
 */

namespace Corp\CMS;


class CustomizeControl {
	/**
	 * Control ID.
	 * @var string
	 */
	public $id;
	public $manager;

	public $args;

	public function __construct( $manager, $id, $args = array() ) {

		$this->manager = $manager;
		$this->id = $id;
		$this->args = $args;
		$this->args['default'] = $args['default'] ?? null;

	}

	public function renderOutput() {

		if ( isset( $this->args['type'] ) ) {

			switch ( $this->args['type'] ) {
				case 'text':
					$this->text();
					break;
				case 'number':
					$this->number();
					break;
				case 'textarea':
					$this->textarea();
					break;
				case 'checkbox':
					$this->checkbox( $this->args );
					break;
				case 'switchery':
					$this->switchery( $this->args );
					break;
				case 'colorPicker':
					$this->colorPicker( $this->args );
					break;
				case 'mediaImg':
					$this->mediaImg( $this->args );
					break;
				case 'select':
					$this->select();
					break;
				default:
					$this->text();
					break;

			}
		}


	}


	public function text() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );

		?>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo $this->id; ?>"><?php echo $this->args['label'] ?? '' ?>
            </label>
            <br>
            <span><?php  echo $this->args['description'] ?? '' ?>
                </span>
            <input class="widefat  form-control" id="<?php echo $this->id; ?>"
                   name="<?php echo $this->id; ?>" type="text"
                   value="<?php echo $value ?>">

        </div>


		<?php
	}

	public function number() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );


		?>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo $this->id; ?>"><?php echo $this->args['label'] ?? '' ?>
            </label>
            <span><?php  echo $this->args['description'] ?? '' ?>
                </span>
            <input class="widefat  form-control" id="<?php echo $this->id; ?>"
                   name="<?php echo $this->id; ?>" type="number"
                   value="<?php echo $value ?>">

        </div>


		<?php
	}

	public function textarea() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );

		?>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo $this->id; ?>"><?php echo $this->args['label'] ?? '' ?>
            </label>
            <textarea class="form-control" id="<?php echo $this->id; ?>"
                      name="<?php echo $this->id; ?>"><?php echo $value ?></textarea>


        </div>


		<?php
	}

	public function checkbox( $args ) {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );
		//$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id);

		?>
        <div class="form-group">


            <div class="checkbox <?php echo $args['class'] ?? '' ?>">
                <input <?php checked( true, $value ) ?> name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>"
                                                        type="checkbox">
                <label for="<?php echo $this->id; ?>"> <?php echo $this->args['label'] ?? '' ?> </label>
            </div>


        </div>


		<?php
	}

	public function switchery( $args ) {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );

		?>
        <div class="form-group">


            <label class="control-label"
                   for="<?php echo $this->id; ?>"><?php echo $this->args['label'] ?? '' ?>
            </label>
            <input <?php checked( 'on', $value ) ?>
                    name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>"
                    type="checkbox" class="js-switch" data-color="<?php echo $this->args['options']['color'] ?? '' ?>"/>


        </div>


		<?php
	}

	public function colorPicker() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );

		?>
        <div class="form-group">


            <label class="control-label"
                   for="<?php echo $this->id; ?>"><?php echo $this->args['label'] ?? '' ?>
            </label>
            <input name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" type="text"
                   class="colorpicker form-control" value="<?php echo $value; ?>"/>

        </div>


		<?php
	}

	public function mediaImg() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );

		?>
        <div class="form-group">


            <label class="control-label"
                   for="<?php echo $this->id; ?>"><?php echo $this->args['label'] ?? '' ?>
            </label>


            <div class="img-bg">


                <div class="img placeholder <?php if ( isset( $value{0} ) ) { ?> dn <?php } ?>">
					<?php echo __( 'admin.No image selected' ); ?>
                </div>

				<?php

				if ( isset( $value{0} ) ) { ?>
                    <img class="img-responsive" src="<?php echo the_image_url( $value, 'thumbnail-260x260' ) ?>">
				<?php }


				?>
            </div>
            <input type="hidden" name="<?php echo $this->id; ?>" value="<?php  echo $value; ?>" class="featured_image_id">
            <br>
            <button type="button"
                    class="btn btn-danger  media-library-delete  <?php if ( !isset( $value{0} ) ) { ?> dn <?php } ?>  "
            >
                <i class="fa fa-times-circle"></i>
				<?php echo __( 'admin.Remove image' ); ?>

            </button>
            <button type="button" class="btn btn-success  media-library-select  "
            >
                <i class="fa fa-plus"></i>
				<?php echo __( 'admin.Select image' ); ?>


            </button>
        </div>


		<?php
	}


	public function select() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );

		?>
        <div class="form-group">



            <label class="control-label"
                   for="<?php echo $this->id; ?>"><?php echo $this->args['label'] ?? '' ?>
            </label>

            <select name="<?php echo $this->id; ?>" class="form-control">

				<?php if ( isset( $this->args['choices'] ) && is_array( $this->args['choices'] ) ) {
					foreach ( $this->args['choices'] as $k => $item ) {


						?>
                    <option <?php  selected($k,$value ) ?> value="<?php  echo e($k); ?>"><?php  echo e($item); ?></option>

					<?php }
				} ?>
            </select>

        </div>


		<?php
	}

}