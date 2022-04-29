<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.08.2018
 * Time: 11:22
 */

namespace Corp\Themes\RentIt\Customize;


use Corp\CMS\CustomizeControl;

class SocialButtonsHeader extends CustomizeControl {


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
                        <div class="col-md-2">
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

                            </div>
                        </div>
                        <div class=" col-md-10  ">
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

                    </div>

					<?php
					$i ++;
				}
				?>
            </div>
			<?php
		}  else { ?>
            <div class="form-group social-button-items-all">
            <label><?php echo $this->args['label'] ?? '' ?></label>
            <p><?php echo $this->args['description'] ?? '' ?></p>

            <div class="social-button-items">

                <div class="col-md-2">
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

                    </div>
                </div>
                <div class=" col-md-10  ">
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
<!--                <input name="--><?php //echo $this->id; ?><!--[text][]" type="text"-->
<!--                       placeholder="--><?php //echo __( 'Paste your  button text' ) ?><!--" class="form-control"-->
<!--                       value="">-->

            </div>
            </div>


			<?php
		}

	}

}