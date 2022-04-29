<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.10.2018
 * Time: 19:03
 */

namespace Corp\Themes\RentIt\Http\Controllers\Ajax;


use Corp\Http\Controllers\Controller;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Cache;

class PreviewReservation extends Controller {

	public function show( Request $request ) {


		$key = base64_encode(  get_class() . app()->getLocale());

		$locations =   Cache::remember( $key, 100, function () {
			$all_locations = Location::with( 'translations' )->get();
			if($all_locations) {
				$arr_location = [];
				foreach ( $all_locations as $v ) {
					$arr_location[$v->alias] = $v->title;
				}
				return $arr_location;
			}
		});

		$order_rep = new OrderRepository(new Order());
		list( $ecommerce_cart['total_price'], $ecommerce_cart['names'] )  =  $order_rep->totalPrice( $request );

		$star_date = ( $request->PickingUpDate . ' ' . $request->PickingUpHour );
		$end_date = ( $request->DroppingOffDate . ' ' . $request->DroppingOffHour );


		$days = rentit_DateDiff( 'd', strtotime( $star_date ), strtotime( $end_date ) );
		$hour = rentit_DateDiff( 'h', strtotime( $star_date ), strtotime( $end_date ) );

		if ( $days < 1 ) {
			$days = 1;
		}

		return view( 'theme:rentit::ajax.PreviewReservation' )
			->with( compact( 'request','locations','ecommerce_cart','days' ) )->render();
	}


}