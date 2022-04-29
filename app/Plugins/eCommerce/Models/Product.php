<?php

namespace Corp\Plugins\eCommerce\Models;

use DB;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
	public $table = 'ec_products';
	use SoftDeletes; //

	use Translatable;
	public $translatedAttributes = [ 'title', 'desc', 'text', 'keywords', 'meta_desc' ];

	protected $fillable = [ 'img', 'alias', 'status', 'published_at', 'price' ];

	public function user() {
		return $this->belongsTo( 'Corp\User' );
	}

	public function terms() {

		return $this->belongsToMany( Term::class, 'ec_terms_product' );
	}
	public function booking() {

		return $this->hasMany( Booking::class, 'product_id' );
	}

	public function orders() {
		return $this->hasMany( Order::class );
	}

	public function Season() {
		return $this->hasMany( Season::class, 'product_id' );
	}

	public function meta() {
		return $this->morphMany( 'Corp\Meta', 'metable' );
	}

	public function seasons() {

		return $this->hasMany( Season::class );
	}

	/*
	 *
	 */
	public function getPriceWithSeason( $star_date = false, $end_date = false ) {
		$star_dates = strtotime( session( 'PickingUpDate' ) . ' ' . session( 'PickingUpHour' ) );
		$end_dates = strtotime( session( 'DroppingOffDate' ) . ' ' . session( 'DroppingOffHour' ) );

		$star_date = ( $star_date !== false ) ? strtotime( $star_date ) : $star_dates ?? 0;
		$end_date = ( $end_date !== false ) ? strtotime( $end_date ) : $end_dates ?? 0;
		$days = rentit_DateDiff( 'd', ( $star_date ), ( $end_date ) );
		if ( $days < 1 ) {
			$days = 1;
		}


		$product_id = $this->id;
		$price = collect( DB::select( "
select *, COALESCE(t1.cost, t1.base_price, `ec_products`.`price`) AS final_cost from `ec_products` left join
(
SELECT ec_season.cost,
ec_season.base_price,
ec_season.product_id
FROM ec_season
WHERE
ec_season.startDate <= '" . (int) $star_date . "' and ec_season.endDate >= '" . (int) $end_date . "'
and  ec_season.Duration = (
SELECT MAX(s2.Duration)
FROM ec_season s2
WHERE
s2.startDate <= '" . (int) $star_date . "'  and s2.endDate >= '" . (int) $end_date . "'
and  s2.Duration <=  " . (int) $days . "  AND
s2.product_id = ec_season.product_id )
)
AS t1 on `t1`.`product_id` = `ec_products`.`id`

WHERE ec_products.id  = " . (int) $product_id . "
		" ) )->first();


		return $price->final_cost ?? $price->price;
	}


	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeGetRentedProduct( $query ) {
		return $query->select(
			'ec_products.*',
			'ec_bookings.PickingUpDate',
			'ec_bookings.DroppingOffDate',
			'ec_orders.status',
			'ec_orders.total_price'
		)->with( 'translations' )->whereRaw( "ec_products.id in(
			SELECT ec_bookings.product_id
FROM ec_bookings 
WHERE   user_id = ?)
			", [ auth()->user()->id ] )->leftJoin( 'ec_bookings', 'ec_products.id', '=', 'ec_bookings.product_id' )
		             ->leftJoin( 'ec_orders', 'ec_bookings.order_id', '=', 'ec_orders.id' );

	}

}
