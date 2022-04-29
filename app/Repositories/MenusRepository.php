<?php

namespace Corp\Repositories;

use Corp\Locations_menu;
use Corp\Menu;
use Gate;
use Cache;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class MenusRepository extends Repository {

	protected $locations = FALSE;

	public function __construct( Menu $menu, Locations_menu $locations ) {
		$this->model = $menu;
		$this->locations = $locations;
	}


	public function addMenu( $request ) {
		if ( Gate::denies( 'save', $this->model ) ) {
			abort( 404 );
		}

		Cache::forget('header-menu');
		$location = $request->only( 'location' );
		$data = $request->only( 'id', 'title', 'output' );

		//dd($request->location);

		if ( empty( $data ) ) {
			return [ 'error' => __('admin.not-have-dates') ];

		}


		$old_locations = Locations_menu::where( 'locations', 'header-menu' )->get();


		// unattahc old
		if ( $old_locations ) {
			foreach ( $old_locations as $v ) {

				$old_menu = Menu::where( 'id', $v->menu_id )->first();
				$old_menu->location = 0;
				$old_menu->save();

			}
		}


		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'location' => $data['location'] ?? 0,


		];


		if ( $this->model->fill( $data_translate )->save() ) {

			$locationsModels = [];
			if ( $request->locations ) {
				foreach ( $request->locations as $location ) {
					Locations_menu::where( 'locations', $location )->delete();
					$locationsModels[] = new Locations_menu( [
						'menu_id' => $this->model->id,
						'locations' => $location
					] );
				}
			}
			$this->model->locations()->saveMany( $locationsModels );


			return [ 'status' => Lang::get( 'admin.menu-added', [ 'menu' => $request->title ] ), 'id' => $this->model->id ];

		}


	}

	public function updateMenu( $request, $menu ) {
		if ( Gate::denies( 'update', $this->model ) ) {
			abort( 404 );
		}
		Cache::forget('header-menu');
		$menu = Menu::find( $request->id );


		if ( !isset( $menu->title ) ) {
			$menu = Menu::find( $request->id )->first();
		}


		$data = $request->only( 'id', 'title', 'output' );


		if ( empty( $data ) ) {
			return [ 'error' => __('admin.not-have-dates') ];

		}

		$menu->locations()->delete();

		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'location' => $data['location'] ?? 0,
		];
		if ( $menu->fill( $data_translate )->update() ) {
			//	dd($request->locations);

			$locationsModels = [];

			if ( $request->locations ) {
				foreach ( $request->locations as $location ) {
					Locations_menu::where( 'locations', $location )->delete();
					$locationsModels[] = new Locations_menu( [ 'menu_id' => $menu->id, 'locations' => $location ] );
				}

				$menu->locations()->saveMany( $locationsModels );
			}
			return [ 'status' => Lang::get( 'admin.menu-save', [ 'menu' => $request->title ] ) ];

		}


	}


	public function deleteMenu( $menu ) {
		if ( Gate::denies( 'delete', $this->model ) ) {
			abort( 404 );
		}
		$title = $menu->title;
		$menu->locations()->delete();
		if ( $menu->delete() ) {
			return [ 'status' => Lang::get( 'admin.menu-deleted', ['menu' => $title] ) ];
		}
	}


}