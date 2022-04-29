<?php

namespace Corp\Themes\RentIt\Http\Controllers\Backend;


use Artisan;
use Cache;
use Corp\Http\Controllers\Admin\AdminController;
use DB;
use Illuminate\Http\Request;
use V\Plugins\PluginManager;
use View;

/**
 * Class DemoImport
 * @package Corp\Themes\RentIt\Http\Controllers\Backend
 */
class DemoImport extends AdminController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */


	/**
	 * DemoImport constructor.
	 */
	public function __construct() {
		parent::__construct( app() );

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';
		$this->baseCms->setAdminJs( 'tinymce', asset( config( 'settings.admin' ) . '/plugins/components/tinymce/js/tinymce/tinymce.js' ), array( 'jquery' ), '1', false, 10 );

	}


	/**
	 * Show page import
	 * @return DemoImport
	 * @throws \Throwable
	 */
	public function index() {//



		if(!auth()->user()->isSuperAdmin()){
			abort(403);
			die();
		}

		$content = view( 'theme:rentit::' . 'DemoImport' )->render();
		$this->vars = array_add( $this->vars, 'content', $content );
		return $this->renderOutput();
	}


	/**
	 * Run demo import
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function import( Request $request ) {
		if(!auth()->user()->isSuperAdmin()){
			abort(403);
			die();
		}
		$result = $this->runDemoImport( $request );

		$pluginThemes = new PluginManager( app() );
		$pluginThemes->bootPlugins( true );


		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.pages.edit', [ 'pages' => $result['id'] ] ) )->with( $result );
		}
		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );


	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public function runDemoImport( Request $request ) {
		if(!auth()->user()->isSuperAdmin()){
			abort(403);
			die();
		}
		Artisan::call( 'migrate' );
		$pluginThemes = new PluginManager( app() );
		$pluginThemes->bootPlugins( true );
		$this->import_sql_from_file( str_replace( 'DemoImport.php', 'demo.sql', __FILE__ ),
			[ 'https://lararent.alfafox.site' ], [ url( '/' ) ]
		);



		return [ 'status' => __( 'the import was successful, you may have to activate some plugins' ) ];

	}


	/**
	 * Run sql from file
	 * @param $file_path
	 * @param $arr1
	 * @param $arr2
	 */
	public function import_sql_from_file( $file_path, $arr1, $arr2 ) {


		$filename = $file_path;
		$fp = fopen( $filename, 'r' );

		$query = '';


		while ( $line = fgets( $fp, 1024000 ) ) {
			if ( substr( $line, 0, 2 ) == '--' OR trim( $line ) == '' ) {
				continue;
			}
			$query .= $line;
			$query = str_replace( $arr1, $arr2, $query );

			if ( substr( trim( $query ), - 1 ) == ';' ) {
				DB::statement( $query );
				$query = '';
			}
		}
	}

}
