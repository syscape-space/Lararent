<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Http\Traits\GetThemesPlugins;
use Corp\Plugin;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\Yaml\Yaml;
use V\Plugins\PluginManager;

class PluginController extends AdminController {

	use GetThemesPlugins;

	public function __construct() {
		parent::__construct();
		$this->baseCms->setAdminCss( 'icheck-all', asset( config( 'settings.admin' ) . '/plugins/components/icheck/skins/all.css' ), [], null, 10 );
		$this->baseCms->setAdminJs( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'icheck-init', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.init.js' ), array( 'jquery' ), '1', true, 10 );


		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		if ( !Gate::allows( 'VIEW_PLUGINS' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}


		$this->title = __('admin.Plugins');


		$content = $this->getTemplate( '.plugins.plugins', [ 'plugins' => $this->getAllPlugins() ] );

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
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Plugin $plugin, Request $request, App $app ) {

		if ( !Gate::allows( 'EDIT_PLUGINS' ) ) {
		abort( 403 );
			die();

		}




		if ( $request->file( 'file' ) ) {
			return $this->uploadNewPlugin( $request, $plugin );

		} elseif ( $request->delete ?? false ) {

			return $this->deletePlugin( $plugin, $request );

		} elseif ( $request->deactivate ?? false ) {

			return $this->deactivatePlugin( $plugin, $request );

		} elseif ( $request->alias ) {
			// we Activate plugin

			$this->activatePlugin( $plugin, $request->alias );


		}


		return json_encode( [ 'status' => 1 ] );
	}


	public function deletePlugin( $plugin, $request ) {
		if ( !Gate::allows( 'EDIT_PLUGINS' ) ) {
			abort( 403 );
			die();

		}

		// we deleted plugin directory and row in DB
		File::deleteDirectory( app_path() . DIRECTORY_SEPARATOR . 'Plugins/' . $request->alias );

		if ( $old_plugin = $plugin->where( 'alias', $request->alias )->first() ) {
			$old_plugin->delete();
		}
		return json_encode( [ 'status' => 1 ] );
	}

	/**
	 *
	 */
	public function deactivatePlugin( $plugin, $request ) {
		if ( !Gate::allows( 'EDIT_PLUGINS' ) ) {
			abort( 403 );
			die();

		}

		// we deactivate plugin
		if ( $plugin = $plugin->where( 'alias', $request->alias )->first() ) {
			$plugin->update( [ 'activated' => false ] );
		}

		return json_encode( [ 'status' => 1 ] );
	}

	/**
	 * @param $plugin Model Plugin
	 *
	 */
	public function activatePlugin( $plugin, $alias ) {
		if ( !Gate::allows( 'EDIT_PLUGINS' ) ) {
			abort( 403 );
			die();

		}

		if ( $plugin_old = $plugin->where( 'alias', $alias )->first() ) {
			$plugin_old->update( [ 'activated' => true ] );
		} else {

			$data = [
				'alias' => $alias,
				'activated' => true,
			];
			$plugin->fill( $data )->save();

		}


		// make action when plugin activated
		$pluginThemes = new PluginManager( app() );
		$pluginThemes->bootPlugins( true );
	}

	/**
	 * @param $request
	 * @param $plugin
	 * @return string
	 * @throws \Throwable
	 */
	public function uploadNewPlugin( $request, $plugin ) {
		if ( !Gate::allows( 'EDIT_PLUGINS' ) ) {
			abort( 403 );
			die();

		}

		$file = $request->file( 'file' );


		if ( $file->isValid() && $file->getMimeType() == 'application/zip' ) {

			$path = app_path() . DIRECTORY_SEPARATOR . 'Plugins';
			$file->move( $path, $file->getClientOriginalName() );

			$plugin_file = $path . DIRECTORY_SEPARATOR . $file->getClientOriginalName();

			$zip = new \ZipArchive;
			$res = $zip->open( $plugin_file );
			//var_dump($res);
			if ( $res === TRUE ) {
				$zip->extractTo( $path );
				$zip->close();

				unlink( $plugin_file );

				$folder_name = str_replace( '.zip', '', $file->getClientOriginalName() );

				if ( file_exists( $path . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'plugin.yaml' ) ) {


					$arr = Yaml::parse( file_get_contents( $path . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'plugin.yaml' ) );
					$arr['activated'] = true;
					$content = $this->getTemplate( '.plugins.item', [ 'plugin' => $arr ] );


					// activate plugin in DB

					$this->activatePlugin( $plugin, $folder_name );
					return json_encode( [
						'location' => $folder_name,
						'plugin' => $content
					] );
				} else {
					File::deleteDirectory( $path . DIRECTORY_SEPARATOR . $folder_name );
				}


				return json_encode( [ 'location' => $folder_name ] );
			}


		}
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
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
