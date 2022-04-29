<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.11.2018
 * Time: 12:26
 */

namespace Corp\Themes\RentIt\Modules;


use Corp\Plugins\PageBuilder\Classes\BaseModule;
use Illuminate\View\ViewName;

class FAQContainer extends BaseModule {
/*
	public function show( $module = false ) {

		$id = isset( $module->name ) ? $module->name : 'faq_container__0';
		//$markersData = '';

		if ( isset( $module->value ) ) {
			return $module->value;
		}
		return view( 'theme:rentit::modules.FAQContainer' )->with( compact( 'id' ) )->render();


	}*/
	public function show( $module = false, $options = false ) {
		$content = $this->content;


		$id = isset( $module->name ) ? $module->name : 'faq_container__0';




		if ( isset( $content{6} ) ) {
			ob_start();
			eval( '?> ' . $content . ' <?php ' );
			return ob_get_clean();
		} else {

			if ( isset( $options['type'] ) && $options['type'] == 'php' ) {
				return file_get_contents( app( 'view' )->getFinder()->find( ViewName::normalize( 'theme:rentit::modules.FAQContainer' ) ) );
			}

			return view( 'theme:rentit::modules.FAQContainer' )->with(
				compact( 'id' ) )->render();

		}


	}


	public function options() {
		return [

		];
	}
}