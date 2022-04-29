<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14.08.2018
 * Time: 13:13
 */

namespace Corp\Plugins\eCommerce\Repositories;


use App;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Repositories\Repository;

class LocationRepository extends Repository {
	/**
	 * LocationRepository constructor.
	 * @param Location $location
	 */
	public function __construct( Location $location ) {
		$this->model = $location;
	}

	/**
	 * @param $request
	 * @return array
	 */
	public function addLocation( $request ) {


		$data = $request->except( '_token' );

		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		} else {
			$data['alias'] = $this->transliterate( $data['alias'] );
		}


		if ( $this->one( $data['alias'], FALSE ) ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' => __( 'admin.alias-used' ) ];
		}


		$data_translate = [
			'code' => App::getLocale(),
			'status' => $data['status'] ?? 'published',
			App::getLocale() => $data,
			'alias' => $data['alias'],

		];


		$this->model->fill( $data_translate );


		if ( $location = $request->user()->location()->save( $this->model ) ) {

			return [ 'status' => __( 'Location added' ) ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}


	/**
	 * @param $request
	 * @param $location
	 * @return array
	 */
	public function updateLocation( $request, $location ) {


		$data = $request->only( 'title', 'alias' );;
		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		}


		$result = $this->one( $data['alias'], FALSE );

		if ( isset( $result->id ) && ( $result->id != $location->id ) ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' => __( 'admin.alias-used' ) ];
		}


		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'alias' => $data['alias'],


		];


		$location->fill( $data_translate );


		if ( $location->update() ) {

			return [ 'status' => __( 'Location updated' ) ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}


}