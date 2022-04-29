<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\MenuRequest;
use Corp\Menu;
use Corp\Repositories\MenusRepository;
use Gate;


class MenusController extends AdminController {


	public function __construct( MenusRepository $menu_rep ) {

		parent::__construct();


		$this->baseCms->setAdminCss( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/skins/square/_all.css' ), [], null, 10 );
		$this->baseCms->setAdminJs( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'icheck-init', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.init.js' ), array( 'jquery' ), '1', true, 10 );

		$this->baseCms->setAdminJs( 'jquery-menu-editor', asset( config( 'settings.admin' ) . '/plugins/jquery-menu-editor.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'iconset-fontawesome', asset( config( 'settings.admin' ) . '/plugins/bs-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'bootstrap-iconpicker', asset( config( 'settings.admin' ) . '/plugins/bs-iconpicker/js/bootstrap-iconpicker.js' ), array( 'jquery' ), '1', true, 10 );

		$this->menu_rep = $menu_rep;

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		if ( !Gate::allows( 'VIEW_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$menus = $this->getMenu() ? $this->getMenu()->all() : null;
		$menu = $this->getMenu() ? $this->getMenu()->sortByDesc( 'updated_at' )->first() : null;
		$location_slug = [];
		if ( $menu ) {

			$locations = $menu->locations()->get();

			foreach ( $locations as $location ) {
				$location_slug[] = $location->locations;
			}
			$location_slug = array_unique( $location_slug );
		}
		//	dump(json_decode('[{"text":"Home","href":"http://home.com","icon":"fa fa-home","target":"_top","title":"My Home"},{"text":"Opcion2","href":"","icon":"fa fa-bar-chart-o","target":"_self","title":""},{"text":"Opcion3","href":"","icon":"fa fa-cloud-upload","target":"_self","title":""},{"text":"Opcion4","href":"","icon":"fa fa-crop","target":"_self","title":""},{"text":"Opcion6","href":"","icon":"fa fa-map-marker","target":"_self","title":"","children":[{"text":"Opcion7","href":"","icon":"fa fa-search","target":"_self","title":"","children":[{"text":"Opcion7-1","href":"","icon":"fa fa-plug","target":"_self","title":"","children":[{"text":"Opcion7-1-1","href":"","icon":"fa fa-filter","target":"_self","title":""}]}]}]},{"text":"hujkhjkjhk","icon":"","text2":"","href":"","target":"_self","title":"","children":[{"text":"text2","icon":"","text2":"","href":"","target":"_self","title":""}]}]'));

		$this->title = 'Lararent';
		$content = view( 'admins.' . config( 'settings.admin' ) . '.menus' )
			->with(
				[
					'menu' => $menu,
					'locations_arr' => $location_slug,
					'menus' => $menus
				] )
			->render();
		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//

		if ( !Gate::allows( 'VIEW_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$menus = $this->getMenu() ? $this->getMenu()->sortByDesc( 'created_at' )->all() : null;

		$location_slug = array();
		$this->title = 'Lararent';
		$content = view( 'admins.' . config( 'settings.admin' ) . '.menus' )
			->with(
				[
					'locations_arr' => $location_slug,
					'menus' => $menus
				]
			)
			->render();
		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( MenuRequest $request ) {
		//

		if ( !Gate::allows( 'EDIT_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$result = $this->menu_rep->addMenu( $request );

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
	public function edit( Menu $menu ) {
		//

		if ( !Gate::allows( 'VIEW_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$menus = $this->getMenu() ? $this->getMenu()->sortByDesc( 'created_at' )->all() : null;

		$locations = $menu->locations()->get();

		$location_slug = [];
		foreach ( $locations as $location ) {
			$location_slug[] = $location->locations;
		}
		$location_slug = array_unique( $location_slug );

		//	dump(json_decode('[{"text":"Home","href":"http://home.com","icon":"fa fa-home","target":"_top","title":"My Home"},{"text":"Opcion2","href":"","icon":"fa fa-bar-chart-o","target":"_self","title":""},{"text":"Opcion3","href":"","icon":"fa fa-cloud-upload","target":"_self","title":""},{"text":"Opcion4","href":"","icon":"fa fa-crop","target":"_self","title":""},{"text":"Opcion6","href":"","icon":"fa fa-map-marker","target":"_self","title":"","children":[{"text":"Opcion7","href":"","icon":"fa fa-search","target":"_self","title":"","children":[{"text":"Opcion7-1","href":"","icon":"fa fa-plug","target":"_self","title":"","children":[{"text":"Opcion7-1-1","href":"","icon":"fa fa-filter","target":"_self","title":""}]}]}]},{"text":"hujkhjkjhk","icon":"","text2":"","href":"","target":"_self","title":"","children":[{"text":"text2","icon":"","text2":"","href":"","target":"_self","title":""}]}]'));

		$this->title = 'Lararent';
		$content = view( 'admins.' . config( 'settings.admin' ) . '.menus' )
			->with( [
				'menu' => $menu,
				'menus' => $menus,
				'locations_arr' => $location_slug
			] )
			->render();
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
	public function update( MenuRequest $request, Menu $menu_id ) {
		//
		if ( !Gate::allows( 'EDIT_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$result = $this->menu_rep->updateMenu( $request, $menu_id );

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
	public function destroy( Menu $menu ) {
		//

		if ( !Gate::allows( 'EDIT_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$result = $this->menu_rep->deleteMenu( $menu );

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			return redirect( '/admin/menus' )->with( $result );
		}
		return redirect( '/admin/menus' )->with( $result );

	}

	public function getMenu() {
		//

		return $this->menu_rep->get();


	}
}
