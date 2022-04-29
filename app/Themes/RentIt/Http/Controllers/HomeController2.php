<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use Cache;
use Corp\Http\Controllers\Controller;
use Corp\Meta;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\ProductRepository;
use Corp\Post;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\MapLocations;
use Corp\Themes\RentIt\RentItTheme;
use Illuminate\Http\Request;


class HomeController2 extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */


	public function index( MapLocations $mapLocations, $template = 'home1' ) {
		//

		echo __('testtst');

	}




}
