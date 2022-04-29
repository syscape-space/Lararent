<?php

namespace Corp\Http\Controllers\Admin;


use Gate;
use Config;
use Corp\Http\Customize\CustomizeManager;
use Illuminate\Http\Request;

class CustomizeController extends AdminController {
	public function __construct() {
		parent::__construct();

		$this->baseCms->setAdminCss( 'styleswitcher', asset( config( 'settings.admin' ) . '/plugins/components/switchery/dist/switchery.min.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'jquery-clockpicker.',
			asset( config( 'settings.admin' ) . '/plugins/components/clockpicker/dist/jquery-clockpicker.min.css' ), [ 'bootstrap' ], null, 10 );
		$this->baseCms->setAdminCss( 'jquery-asColorPicker-master', asset( config( 'settings.admin' ) . '/plugins/components/jquery-asColorPicker-master/css/asColorPicker.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-iconpicker', asset( config( 'settings.admin' ) . '/plugins/bootstrap-iconpicker-master/dist/css/bootstrap-iconpicker.min.css' ), [], null, 10 );

		$this->baseCms->setAdminJs( 'styleswitcher', asset( config( 'settings.admin' ) . '/plugins/components/switchery/dist/switchery.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'jquery-asColorPicker-master',
			asset( config( 'settings.admin' ) . '/plugins/components/jquery-asColorPicker-master/libs/jquery-asColor.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'jquery-asColorPicker',
			asset( config( 'settings.admin' ) . '/plugins/components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'asGradient',
			asset( config( 'settings.admin' ) . '/plugins/components/jquery-asColorPicker-master/libs/jquery-asGradient.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'bootstrap-iconpicker', asset( config( 'settings.admin' ) . '/plugins/bootstrap-iconpicker-master/dist/js/bootstrap-iconpicker.min.js' ),
			array( 'jquery' ), '1', true );

		$this->baseCms->setAdminJs( 'bootstrap-iconpicker-iconset-all',
			asset( config( 'settings.admin' ) . '/plugins/bootstrap-iconpicker-master/dist/js/bootstrap-iconpicker-iconset-all.min.js' ),
			array( 'jquery' ), '1', true );


		$this->template = 'admins.' . config( 'settings.admin' ) . '.layouts.customize';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request ) {
		//
		if ( !Gate::allows( 'VIEW_CUSTOMIZE' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}


		$Customize = app()->make( 'CustomizeManager' );

		$this->title = __('admin.Customize');

		$Customize->startPreview();


		if ( !isset( $_SESSION ) ) {
			session_start();
		}
		$_SESSION['lr_theme_options'] = null;

		$panels = $Customize->getPanels();

		array_add( $this->vars, 'customize', $Customize->getPanels() );


		$url = url( '/' );
		if ( $request->url ) {
			$url = $request->url;

		}
		$content = $this->getTemplate( 'customize.content', compact( 'panels', 'url' ) );


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
	public function store( Request $request ) {
		//



		$config = Config::get( 'themeoptions' );


		// if this preview mode
		if ( isset( $request->preview ) && $request->preview ) {

			$old_config = $config[session( 'lr_active_theme_slug' )];

			if ( !isset( $_SESSION ) ) {
				session_start();
			}

			$_SESSION['lr_theme_options'] = $request->all();

			return response( $request->all(), 200 )
				->header( 'Content-Type', 'application/json' );


		} // save theme options
		else {
			if ( !Gate::allows( 'EDIT_CUSTOMIZE' ) ) {
				abort( 403 );
				die();
			}


			$Customize = app()->make( 'CustomizeManager' );
			$controls = $Customize->getControl();

			// if checkbox is unchecked we add it to the request with false
			foreach ($controls as $k => $control){
				if($control['type'] == 'checkbox'){

					if(!$request->$k){
						$request->request->add([$k => false]); //add request

					}
				}
			}


			$config[session( 'lr_active_theme_slug' )] = $request->all();

			$lang = app()->getLocale();
			//dd($lang);
			$config[session( 'lr_active_theme_slug' ) . '_' . $lang] = $request->all();
			//$config = array_merge( $config, $config_lang );
			$fp = fopen( base_path() . '/config/themeoptions.php', 'w' );
			fwrite( $fp, '<?php return ' . var_export( $config, true ) . ';' );
			fclose( $fp );


			$arr[session( 'lr_active_theme_slug' )] = $request->all();
			return response( $arr, 200 )
				->header( 'Content-Type', 'application/json' );
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
