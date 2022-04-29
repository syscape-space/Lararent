<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.11.2018
 * Time: 14:12
 */

namespace Corp\Plugins\PageBuilder\Classes;

/**
 * Class BaseModule
 * @package Corp\Plugins\PageBuilder\Classes
 */
class BaseModule {
	public $id;
	public $page;
	public $content;
	public $variables;


	/**
	 * BaseModule constructor.
	 * @param $page
	 * @param bool $content
	 */
	public function __construct( $page, $content = false ) {
		$this->page = $page;
		$this->content = $content;
	}


	/**
     * render all options
	 * @param $module
	 */
	public function renderOptions( $module ) {
		$options = $this->options();
		if(!isset($module->variables)) return;

		$this->variables = unserialize( $module->variables );

		if ( isset( $options['params'][0] ) ) {
			foreach ( $options['params'] as $item ) {
				$this->renderOutput( $item );
			}
		}


	}

	/**
     * render type
	 * @param $item
	 */
	public function renderOutput( $item ) {
		switch ( $item['type'] ) {
			case 'text':
				$this->text( $item );
				break;
			case 'select':
				$this->select( $item );
				break;
			default:
				$this->text( $item );
				break;
		}
	}


	/**
     * Return text fields
	 * @param $params
	 */
	public function text( $params ) {

		$new_value = isset( $this->variables[$params['param_name']] ) ? $this->variables[$params['param_name']] : '';
		?>
        <div class="form-group">

            <label class="control-label"
                   for="<?php echo substr( strrchr( __CLASS__, "\\" ), 1 ) . '_' . $params['param_name'] ?>"><?php echo $params['title']; ?>
            </label>
            <input class="widefat  form-control"
                   id="<?php echo substr( strrchr( __CLASS__, "\\" ), 1 ) . '_' . $params['param_name'] ?>"
                   name="<?php echo $params['param_name'] ?>" type="text"
                   value="<?php echo $new_value; ?>">

        </div>

		<?php
	}

	/**
     * Return select
	 * @param $params
	 */
	public function select( $params ) {


		$new_value = isset( $this->variables[$params['param_name']] ) ? $this->variables[$params['param_name']] : '';
		?>

        <div class="form-group">


            <label class="control-label"
                   for="<?php echo substr( strrchr( __CLASS__, "\\" ), 1 ) . '_' . $params['param_name'] ?>">
				<?php echo $params['title']; ?>
            </label>


            <select id="<?php echo substr( strrchr( __CLASS__, "\\" ), 1 ) . '_' . $params['param_name'] ?>"
                    name="<?php echo $params['param_name'] ?>" class="form-control">

				<?php

				//   dump($params['value']);

				if ( is_array( $params['value'] ) ) {
					foreach ( $params['value'] as $k => $item ) {


						?>
                        <option <?php selected( $k, $new_value ) ?>
                                value="<?php echo( $k ); ?>"><?php echo( $item ); ?></option>

					<?php }
				} ?>
            </select>

        </div>

		<?php
	}
}