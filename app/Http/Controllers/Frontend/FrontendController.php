<?php

namespace Corp\Http\Controllers\Frontend;

use Auth;
use Cache;
use Corp\Http\Controllers\CMSController;
use Request;
use View;

class FrontendController extends CMSController {
	//
	public $footer;
	protected $js_path;
	protected $css_path;
	protected $frontend_css;
	protected $frontend_js;
	protected $keywords;

	public function __construct() {
		parent::__construct();


	}

	public function renderOutput() {


		$this->vars = array_add( $this->vars, 'title', $this->title );
		$this->vars = array_add( $this->vars, 'keywords', $this->keywords );
		$this->vars = array_add( $this->vars, 'description', $this->description );


		$this->buildHeader();
		$this->buildFooter();


		if ( View::exists( $this->template ) ) {
			return view( $this->template )->with( $this->vars );
		} else {
			return 'view "' . $this->template . '" not found in ' . get_parent_class( $this );
		}


	}


	/**
	 * @param $name
	 * @param null $arr
	 * @return string
	 * @throws \Throwable
	 */
	public function getTemplate( $name, $arr = null ) {

		$view = "theme:rentit::products.single";
		if ( !View::exists( $view . '.' . $name ) ) {
			return false;
		}
		if ( is_array( $arr ) ) {
			return view( $view. '.' . $name )
				->with( $arr )
				->render();
		} else {
			return view( $view . '.' . $name )
				->render();
		}


		if ( !View::exists( 'themes.' . config( 'settings.theme' ) . '.' . $name ) ) {
			return false;
		}
		if ( is_array( $arr ) ) {
			return view( 'themes.' . config( 'settings.theme' ) . '.' . $name )
				->with( $arr )
				->render();
		} else {
			return view( 'themes.' . config( 'settings.theme' ) . '.' . $name )
				->render();
		}
	}

	/**
	 * include js with obect name and php array
	 * @param $js
	 * @param bool $object_name
	 * @param bool $obj
	 */
	public function includeJs( $js, $object_name = false, $obj = false ) {
		$str = '';
		if ( $obj && is_array( $obj ) && !empty( $object_name ) ) {

			foreach ( (array) $obj as $key => $value ) {
				if ( !is_scalar( $value ) ) {
					continue;
				}

				$obj[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8' );
			}
			$script = "var $object_name = " . json_encode( $obj ) . ';';

			$str .= '<script>' . $script . '</script>' . "\r\n";;
		}

		$str .= '  <script src="' .  $js . '"></script>' . "\r\n";




		return $str;


	}

	public function includeCss( $css ) {

		return '<link href="' . $css . '" rel="stylesheet">' . "\r\n";


	}

	/**
	 *
	 */
	public function buildHeader() {
		$header = '';
		if ( is_array( $this->css_path ) ) {
			foreach ( $this->css_path as $k => $v ) {
				$header .= $this->includeCss( $v );
			}

		}
		if ( $user = Auth::user() ) {
			if ( $user->isSuperAdmin()    && !isset($_GET['lr_preview_customize'])) {
				$header .= " <link href=\"" . asset( config( 'settings.admin' ) ) . "/css/admin-bar.css\" rel=\"stylesheet\">";
			}
		}


		$basecms = app()->make( 'BaseCms' );
		$css = $basecms->getFrontendCss();
		$css = $css->sortBy( 'priority' );


		//$admin_js = sortDeps( $js->toArray() );
		$css = sortDeps( $css->toArray() );

		if ( is_array( $css ) ) {
			foreach ( $css as $k => $v ) {
				$header .= $this->includeCss( $v['path'] );
			}


		}



		$this->vars = array_add( $this->vars, 'lr_header', $header );


	}

	public function buildFooter() {

		$footer = '';

		if ( is_array( $this->js_path ) ) {
			foreach ( $this->js_path as $k => $v ) {
				$footer .= $this->includeJs( $v );

			}


		}
		$basecms = app()->make( 'BaseCms' );


		$js = $basecms->getFrontendJs();



		$js = $js->sortBy( 'priority' );


		//$admin_js = sortDeps( $js->toArray() );
		$admin_js = sortDeps( $js->toArray() );

		$footer = '';
		$header = '';

		if ( is_array( $admin_js ) ) {

			//dump($admin_js);
			foreach ( $admin_js as $k => $v ) {
				if ( $v['in_footer'] ) {
					$footer .= $this->includeJs( $v['path'] , $v['object_name'], $v['obj'] );
				} else {

					$header .= $this->includeJs( $v['path'] );
				}

			}
		}





		if ( $user = Auth::user() ) {
			if ( $user->isSuperAdmin()  && !isset($_GET['lr_preview_customize']) ) {
				$footer .= " <script type='text/javascript' src='" . asset( config( 'settings.admin' ) ) . "/js/admin-bar.js'></script>";

				$footer .= view( 'admins.' . config( 'settings.admin' ) . '.adminbar', compact( 'user' ) )->render();
			}
		}
		$this->vars = array_add( $this->vars, 'lr_footer', $footer );
		$this->vars['lr_header'] .=  $header;



	}


}
