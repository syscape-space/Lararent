<?php

namespace Corp\Plugins\eCommerce\Http\Controllers;

use Gate;
use Corp\Coupon;
use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Repositories\CouponRepository;
use Corp\Plugins\eCommerce\Requests\CouponRequest;
use Corp\Plugins\eCommerce\Requests\LocationRequest;

class CouponsController extends eCommercePlugin {


	private $cop_rep;

	public function __construct( CouponRepository $couponRepository ) {
		parent::__construct( app() );
		$this->cop_rep = $couponRepository;

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Coupon $coupons ) {
		//
		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}



		$this->title = __( 'Locations' );
		$coupons = $coupons->all();


		$content = $this->getTemplate( 'coupons.all-coupons', compact( 'coupons' ) );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create( Coupon $coupon) {
		//
		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$this->title = __( 'Locations create' );


		$content = $this->getTemplate( 'coupons.change' );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( CouponRequest $request ) {
		//

		if ( !Gate::allows( 'EDIT_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$result = $this->cop_rep->addCoupon( $request );

		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.ecommerce.coupons.edit', [ 'location' => $result['id'] ] ) )->with( $result );
		}
		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {

		$coupon = Coupon::where( 'id', $id )->first();
		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$this->title = __( 'Coupon Update' ) . $coupon->code;


		$content = $this->getTemplate( 'coupons.change', compact( 'coupon' ) );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( CouponRequest $request, $id ) {
		//
		if ( !Gate::allows( 'EDIT_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$coupon = Coupon::where( 'id', $id )->first();
		$result = $this->cop_rep->updateCoupon( $request, $coupon );

		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.ecommerce.coupons.edit', [ 'location' => $result['id'] ] ) )->with( $result );
		}
		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
		if ( !Gate::allows( 'EDIT_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$coupon = Location::where( 'id', $id )->first();
		if ( $coupon->delete() ) {

			return \Response::json( [ 'success' => true ] );
		} else {
			return \Response::json( [ 'error' => true ] );
		}

	}
}
