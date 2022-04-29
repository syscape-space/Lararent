<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14.08.2018
 * Time: 13:13
 */

namespace Corp\Plugins\eCommerce\Repositories;


use App;
use Corp\Coupon;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Repositories\Repository;

class CouponRepository extends Repository {
	/**
	 * LocationRepository constructor.
	 * @param Location $location
	 */
	public function __construct( Coupon $coupon ) {
		$this->model = $coupon;
	}

	/**
	 * @param $request
	 * @return array
	 */
	public function addCoupon( $request ) {


		//dd($request->all());
		$data = $request->except( '_token' );

		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}



		if ( $this->one( $data['code'], FALSE ) ) {
			$request->merge( array( 'code' => $data['code'] ) );
			$request->flash();

			return [ 'error' => __( 'Coupon code already used' ) ];
		}





		$this->model->fill( $data);


		if ( $location = $request->user()->location()->save( $this->model ) ) {

			return [ 'status' => __( 'Coupon added' ) ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}
	public function one( $alias, $attr = array() ) {
		$result = $this->model->where( 'code', $alias )->first();

		return $result;
	}

	/**
	 * @param $request
	 * @param $location
	 * @return array
	 */
	public function updateCoupon( $request, $coupon ) {


		$data = $request->except( '_token' );


		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}




		$result = $this->one( $data['code'], FALSE );

		if ( isset( $result->id ) && ( $result->id != $coupon->id ) ) {
			$request->merge( array( 'code' => $data['code'] ) );
			$request->flash();

			return [ 'error' => __( 'admin.alias-used' ) ];
		}




		$coupon->fill( $data);


		if ( $coupon->update() ) {

			return [ 'status' => __( 'Coupon updated' ) ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}


}