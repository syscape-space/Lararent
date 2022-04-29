<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.08.2018
 * Time: 11:22
 */

namespace Corp\Themes\RentIt\Customize;


use Corp\CMS\CustomizeControl;

class TimeOptions extends CustomizeControl {


	public function renderOutput() {
		$value = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $this->id, $this->args['default'] );

		?>


        <div class="row">
            <table id="langs-table" class="table color-table purple-table ">

                <thead>
                <tr>
                    <th><?php echo __( 'Hour' ); ?></th>
                    <th><?php echo __( 'Minute' ); ?></th>
                    <th><?php echo __( 'Format' ); ?></th>
                    <th></th>


                </tr>
                </thead>
                <tbody class="langs-table">


				<?php if ( isset( $value['hour'] ) && isset( $value['minute'] ) && isset( $value['format'] ) ) {


					foreach ( $value['hour'] as $k => $item ) {

						$this->timesTabelInputs( $item, $value['minute'][$k] ?? '', $value['format'][$k] ?? '' );
					}
				} else {
					$this->timesTabelInputs();
				} ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <button type="button" data-tr='<?php $this->timesTabelInputs() ?>'
                    class="add-new-item btn btn-info waves-effect waves-light">
                <span><i class="ion-upload m-r-5"></i> <?php echo __( 'Add new item' ); ?> </span>

            </button>
        </div>


		<?php


	}

	public function timesTabelInputs( $hour = null, $minute = null, $format = null ) {
		?>
        <tr>

            <td class="item_name col-md-3 ">
                <div class="row">
                    <input name="<?php echo $this->id; ?>[hour][]"
                           class="form-control"
                           type="number" value="<?php echo $hour; ?>">
                </div>

            </td>
            <td class="quantity col-md-3">
                <div class="row">
                    <input name="<?php echo $this->id; ?>[minute][]"
                           class="form-control" type="number" value="<?php echo $minute; ?>">
                </div>

            </td>

            <td class="col-md-3">
                <select name="<?php echo $this->id; ?>[format][]" class="form-control">
                    <option <?php selected( $format, '' ); ?> value="">24</option>
                    <option <?php selected( $format, 'AM' ); ?> value="AM">AM</option>
                    <option <?php selected( $format, 'PM' ); ?> value="PM">PM</option>
                </select>
            </td>
            <td width="1%">
                <div class="">
                    <button data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-delete"
                            type="button">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </div>


            </td>

        </tr>
        <tr>

		<?php
	}
}