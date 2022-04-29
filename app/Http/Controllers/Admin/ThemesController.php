<?php

namespace Corp\Http\Controllers\Admin;
use Image;
use File;
use Gate;
use Yaml;

use Corp\Http\Traits\GetThemesPlugins;
use Corp\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\Finder\Finder;
use V\Plugins\PluginManager;

class ThemesController extends AdminController {
use GetThemesPlugins;


	public function __construct() {

		parent::__construct();

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		if ( !Gate::allows( 'VIEW_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$this->title = __('admin.Themes');


		$themes = $this->getAllThemes();
		$content = $this->getTemplate( '.themes.themes', [ 'themes' => $themes ] );


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
	public function store( Theme $theme, Request $request, App $app ) {
		//
		if ( !Gate::allows( 'EDIT_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}




		if ( $request->file( 'file' ) ) {
			return $this->uploadNewTheme( $theme, $request );

		} elseif ( $request->delete ?? false  && isset($request->alias{2})) {
			File::deleteDirectory( app_path() . DIRECTORY_SEPARATOR . 'Themes' . DIRECTORY_SEPARATOR .  $request->alias );

			if ( $old_theme = $theme->where( 'alias', $request->alias )->first() ) {
				$old_theme->delete();
			}
			return json_encode( [ 'status' => 1 ] );

		} elseif ( $request->alias ) {


			// remove all ols flags and now not one theme is activated
			$theme->where( 'activated', true )->update( [ 'activated' => false ] );


			if ( $prev_theme = $theme->where( 'alias', $request->alias )->first() ) {
				$prev_theme->update( [ 'activated' => true ] );

			} else {

				$theme->alias = $request->alias;
				$theme->activated = true;
				$theme->sitings = '';
				$theme->save();
			}
		}
		$pluginThemes = new PluginManager( app() );

		$pluginThemes->bootThemes( true );
		return json_encode( [ 'status' => 1 ] );


	}

	public function uploadNewTheme( $theme, $request ) {
		if ( !Gate::allows( 'EDIT_APPEARANCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}


		$file = $request->file( 'file' );
		if ( $file->isValid() && $file->getMimeType() == 'application/zip' ) {
			$path = app_path() . DIRECTORY_SEPARATOR . 'Themes';
			$file->move( $path, $file->getClientOriginalName() );

			$theme_file = $path . DIRECTORY_SEPARATOR . $file->getClientOriginalName();

			$zip = new \ZipArchive;
			$res = $zip->open( $theme_file );
			if ( $res === TRUE ) {
				$zip->extractTo( $path );
				$zip->close();

				unlink( $theme_file );
				$folder_name = str_replace( '.zip', '', $file->getClientOriginalName() );

				if ( file_exists( $path . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'theme.yaml' ) ) {
					$arr = Yaml::parse( file_get_contents( $path . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'theme.yaml' ) );


					if ( file_exists( $path . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'screenshot.png' ) ) {
						$arr['screenshot'] = (string) Image::make( $path . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'screenshot.png' )->encode( 'data-url' );
					}
					$arr['pathname'] = $folder_name;
//
					$content = $this->getTemplate( '.themes.item', [ 'theme' => $arr ] );
//					$this->activatePlugin( $plugin, $folder_name );

					return json_encode( [
						'location' => $folder_name,
						'theme' => $content
					] );

				} else {
					File::deleteDirectory( $path . DIRECTORY_SEPARATOR . $folder_name );
				}


			}
		}

		return false;
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
