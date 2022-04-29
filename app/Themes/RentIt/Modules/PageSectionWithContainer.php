<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.11.2018
 * Time: 12:26
 */

namespace Corp\Themes\RentIt\Modules;


use Corp\Plugins\PageBuilder\Classes\BaseModule;

class PageSectionWithContainer extends BaseModule {

	public function show( $module = false ) {

		$id = isset( $module->name ) ? $module->name : 'page_section_with_container__0';

		if ( isset( $module->value ) ) {
			return $module->value;
		}



		return view( 'theme:rentit::modules.PageSectionWithContainer' )->with( compact( 'id' ) )->render();
	}


	public function options() {
		return [
			'type' => 'select',
			'param_name' => 'alignment',
			'value' => [
				'alignment-center' => __('Alignment center'),
				'alignment-left' => __('Alignment left'),
				'alignment-right' => __('Alignment right')
			]
		];
	}
}