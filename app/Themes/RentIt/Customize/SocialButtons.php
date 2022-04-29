<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.08.2018
 * Time: 11:22
 */

namespace Corp\Themes\RentIt\Customize;


use Corp\CMS\CustomizeControl;

class SocialButtons extends CustomizeControl {


	public function renderOutput() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );


		$new_arr = [];

		if ( $value['url'] ?? false ) {
			?>

            <div class="form-group social-button-items-all">
                <label><?php echo $this->args['label'] ?? '' ?></label>
                <p><?php echo $this->args['description'] ?? '' ?></p><?php
				$i = 0;
				foreach ( $value['url'] as $k => $v ) {
					?>


                    <div class="social-button-items">
                        <div class="col-md-5">
                            <div class="entry input-group  social-icon-group row ">
			        <span class="input-group-btn">
			            <button
                                name="<?php echo $this->id; ?>[icon][]"
                                class="btn btn-block btn-info"
                                data-iconset="fontawesome"
                                data-icon="<?php echo $value['icon'][$k] ?? ''; ?>"
                                role="iconpicker">
			                </button>
		        	</span>
                                <select name="<?php echo $this->id; ?>[type][]" class="form-control">
                                    <option value=""><?php echo __( 'Select button style' ); ?></option>
                                    <option <?php selected( $value['type'][$k], 'facebook' ); ?>
                                            value="facebook"><?php echo __( 'facebook' ); ?></option>
                                    <option <?php selected( $value['type'][$k], 'twitter' ); ?>
                                            value="twitter"><?php echo __( 'twitter' ); ?></option>
                                    <option <?php selected( $value['type'][$k], 'pinterest' ); ?>
                                            value="pinterest"><?php echo __( 'pinterest' ); ?></option>
                                    <option <?php selected( $value['type'][$k], 'google' ); ?>
                                            value="google"><?php echo __( 'google' ); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-md-7  ">
                            <div class="row entry input-group  social-icon-group">
                                <input name="<?php echo $this->id; ?>[url][]" type="text"
                                       placeholder="<?php echo __( 'Paste your social url' ) ?>" class="form-control"
                                       value="<?php echo $value['url'][$k] ?? ''; ?>">

                                <span class="input-group-btn">

                                <?php if ( $i > 0 ) { ?>
                                    <button class="btn btn-danger btn-delete" type="button">
                                     <span class="glyphicon glyphicon-minus"></span>
                                </button>
                                <?php } else { ?>
                                    <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                                <?php } ?>
                        </span>

                            </div>

                        </div>
                        <input name="<?php echo $this->id; ?>[text][]" type="text"
                               placeholder="<?php echo __( 'Paste your  button text' ) ?>" class="form-control"
                               value="<?php echo $value['text'][$k] ?? ''; ?>">

                    </div>

					<?php
					$i ++;
				}
				?>
            </div>
			<?php
		}  else { ?>

            <div class="social-button-items">
                <div class="col-md-5">
                    <div class="entry input-group  social-icon-group row ">
			        <span class="input-group-btn">
			            <button
                                name="<?php echo $this->id; ?>[icon][]"
                                class="btn btn-block btn-info"
                                data-iconset="fontawesome"
                                data-icon="fa-facebook"
                                role="iconpicker">
			                </button>
		        	</span>
                        <select name="<?php echo $this->id; ?>[type][]" class="form-control">
                            <option value=""><?php echo __( 'Select button style' ); ?></option>
                            <option value="facebook"><?php echo __( 'facebook' ); ?></option>
                            <option value="twitter"><?php echo __( 'twitter' ); ?></option>
                            <option value="pinterest"><?php echo __( 'pinterest' ); ?></option>
                            <option value="google"><?php echo __( 'google' ); ?></option>
                        </select>
                    </div>
                </div>
                <div class=" col-md-7  ">
                    <div class="row entry input-group  social-icon-group">
                        <input name="<?php echo $this->id; ?>[url][]" type="text"
                               placeholder="<?php echo __( 'Paste your social url' ) ?>" class="form-control"
                               value="">

                        <span class="input-group-btn">
                                 <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>

                    </div>

                </div>
                <input name="<?php echo $this->id; ?>[text][]" type="text"
                       placeholder="<?php echo __( 'Paste your  button text' ) ?>" class="form-control"
                       value="">

            </div>


			<?php
		}

	}

}