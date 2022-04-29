<?php

namespace Corp\Plugins\eCommerce\Http\Controllers;

use Gate;
use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Repositories\LocationRepository;
use Corp\Plugins\eCommerce\Requests\LocationRequest;
use http\Env\Response;
use Illuminate\Http\Request;

class LocationController extends eCommercePlugin {


	private  $loc_rep;

	public function __construct(LocationRepository $loc_rep) {
		parent::__construct( app() );
		$this->loc_rep = $loc_rep;

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Location $location ) {
		//
		if ( !Gate::allows( 'VIEW_LOCATION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}


		$this->title = __('Locations');

		$locations= $location->with( 'translations')->orderBy('created_at','DESC')->get();


		$content = $this->getTemplate( 'locations.all-locations', compact( 'locations' ) );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Location $location) {
		//
		if ( !Gate::allows( 'VIEW_LOCATION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$this->title = __('Locations create');


		$content = $this->getTemplate( 'locations.change' );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( LocationRequest $request ) {
		//


		if ( !Gate::allows( 'EDIT_LOCATION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$result = $this->loc_rep->addLocation( $request );

		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.locations.edit', [ 'location' => $result['id'] ] ) )->with( $result );
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
		if ( !Gate::allows( 'VIEW_LOCATION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$location = Location::where('id',$id)->first();

		$this->title = __('Locations Update') . $location->title;


		$content = $this->getTemplate( 'locations.change', compact('location') );

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
	public function update( LocationRequest $request, $id ) {
		//
		if ( !Gate::allows( 'EDIT_LOCATION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}


		$location = Location::where('id',$id)->first();
		$result = $this->loc_rep->updateLocation( $request, $location );

		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.locations.edit', [ 'location' => $result['id'] ] ) )->with( $result );
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
		if ( !Gate::allows( 'EDIT_LOCATION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}


	$location = Location::where('id',$id)->first();
		if($location->delete()){

			return \Response::json(['success'=> true]);
		} else {
			return \Response::json(['error'=> true]);
		}

	}
}
