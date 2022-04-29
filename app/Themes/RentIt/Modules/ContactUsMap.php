<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.11.2018
 * Time: 12:26
 */

namespace Corp\Themes\RentIt\Modules;


use Corp\Plugins\eCommerce\Models\Product;
use Corp\Plugins\PageBuilder\Classes\BaseModule;
use Corp\Themes\RentIt\MapLocations;

class ContactUsMap extends BaseModule {

	public function show( $module = false ) {
		$product = new Product();
		$mapLocations = new MapLocations($product);
		$markersData = $mapLocations->generateObject();

		$id = isset( $module->name ) ? $module->name : 'contact_us_map__0';
		//$markersData = '';
		return view( 'theme:rentit::modules.ContactUsMap' )->with( compact( 'id','markersData' ) )->render();

		if ( isset( $module->value ) ) {
			return $module->value;
		}




	}


	public function options() {
		return [

		];
	}
}