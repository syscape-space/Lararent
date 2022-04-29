<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Collection;
use Corp\Repositories\Dependencies;
use Corp\Widget;
use Eventy;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class WidgetsController extends AdminController {
	public function __construct() {

		parent::__construct();
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

		$this->baseCms->setAdminJs('bootstrap-iconpicker-iconset-all',  asset(config('settings.admin') .'/plugins/bootstrap-iconpicker-master/dist/js/bootstrap-iconpicker-iconset-all.min.js'),
			array( 'jquery' ), '1', true );
		$this->baseCms->setAdminJs('bootstrap-iconpicker',  asset(config('settings.admin') .'/plugins/bootstrap-iconpicker-master/dist/js/bootstrap-iconpicker.min.js'),
			array( 'jquery' ), '1', true );

		$this->css_path[] = '/plugins/bootstrap-iconpicker-master/dist/css/bootstrap-iconpicker.min.css';


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

		$this->title = __('admin.widgets');
			$Widgets = Widget::with('translations')->get();

			$content = view( 'admins.' . config( 'settings.admin' ) . '.widgets' )
				->with(
					[
						'widgets' => $Widgets,
						'sidebars' => $this->baseCms->getDynamicSidebars(),
						'registeredWidgets' => $this->registeredWidgets()
					] )
				->render();


			$this->vars = array_add( $this->vars, 'content', $content );

			return $this->renderOutput();

	}

	public function registeredWidgets() {
		if ( !Gate::allows( 'VIEW_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}


		return view( 'admins.' . config( 'settings.admin' ) . '.widgets_registered' )
			->with( 'RegisteredWidgets', $this->baseCms->getRegisteredWidgets() )
			->render();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
		if ( !Gate::allows( 'EDIT_APPEARANCE' ) ) {
		//	return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );
			die();


		}


		if(isset($request->sidebar)){
			Cache::forget('dynamicSidebar_id_' .$request->sidebar);

		}
		if ( $request->delete_widget == 1 && isset( $request->saved_id ) ) {
			Widget::where( 'id', $request->saved_id )->delete();

		} elseif ( $request->action == 'widgets-order' ) {

			$widgets = new Widget();


			foreach ( $request->sidebars as $k => $v ) {
				$w = explode( ',', $v );
				if ( !isset( $w[0]{0} ) ) {
					continue;
				}

				$i = 0;
				foreach ( $w as $item ) {


					$widget = Widget::find( $item );
					if ( $widget ) {

						$widget->position = $i;
						$widget->sidebar = $k;
						$widget->update();
						$i ++;
					}

				}


			}

		} // save widgets
		elseif ( $request->action == 'save-widget' ) {

			// update saved widget
			$data = [
				'sidebar' => $request->sidebar,
				'output' => serialize( $request->all() ),
				'position' => $request->get( 'multi_number' ),
				'widget_id' => $request->get( 'widget_number' ),
				'name' => $request->name,
				'callback' => $request->callback

			];
			if ( $data['position'] < 1 ) {
				return false;
			}

			Eventy::action( 'save-widget', $request->callback );


			if ( isset( $request->saved_id{0} ) ) {


				$widgets = Widget::where( 'id', $request->saved_id )->first();


				$data['code'] = App::getLocale();
				$data[App::getLocale()] = $data;

				if ( $widgets->fill( $data )->update() ) {
					echo( $request->saved_id );
				}
			} else {
				// save new widget
				$widgets = new Widget();
				$data['code'] = App::getLocale();
				$data[App::getLocale()] = $data;

				if ( $widgets->fill( $data )->save() ) {
					echo( $widgets->id );
				}
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(
		$id
	) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(
		$id
	) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(
		Request $request, $id
	) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
