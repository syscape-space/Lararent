<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.11.2018
 * Time: 21:13
 */

namespace Corp\Themes\RentIt\Modules;


use Corp\Plugins\PageBuilder\Classes\BaseModule;
use Illuminate\View\ViewName;

/**
 * Class Breadcrumbs
 * @package Corp\Themes\RentIt\Modules
 */
class Breadcrumbs extends BaseModule {


	/**
	 * @param bool $module
	 * @param bool $options
	 * @return bool|string
	 * @throws \Throwable
	 */
	public function show( $module = false, $options = false ) {
		$content = $this->content;
		$page = $this->page;

		$text_position = 'text-center';

		if ( isset( $module->variables{1} ) ) {
			$variables = unserialize( $module->variables );


			if ( isset( $variables['alignment'] ) ) {
				if ( $variables['alignment'] == 'alignment-left' ) {
					$text_position = 'text-left';
				} elseif ( $variables['alignment'] == 'alignment-right' ) {
					$text_position = 'text-right';
				}
			}
			if ( isset( $variables['page_title']{2} ) ) {
				$page->title = $variables['page_title'];
			}
		}

		$id = isset( $module->name ) ? $module->name : 'breadcrumbs__0';


		if ( isset( $content{6} ) ) {
			ob_start();
			eval( '?> ' . $content . ' <?php ' );
			return ob_get_clean();
		} else {

			if ( isset( $options['type'] ) && $options['type'] == 'php' ) {
				return file_get_contents( app( 'view' )->getFinder()->find( ViewName::normalize( 'theme:rentit::modules.breadcrumbs' ) ) );
			}

			return view( 'theme:rentit::modules.breadcrumbs' )->with( compact( 'id', 'page', 'content', 'text_position' ) )->render();

		}



	}


	/**
	 * @return array of options
	 */
	public function options() {
		return [
			'params' => array(
				[
					'type' => 'select',
					'param_name' => 'alignment',
					'title' => __( 'Select Alignment' ),
					'value' => [
						'alignment-center' => __( 'Alignment center' ),
						'alignment-left' => __( 'Alignment left' ),
						'alignment-right' => __( 'Alignment right' )
					],
				],
				[
					'title' => __( 'Page title' ),
					'type' => 'text',
					'param_name' => 'page_title',
					'value' => ''
				]
			)

		];
	}

}