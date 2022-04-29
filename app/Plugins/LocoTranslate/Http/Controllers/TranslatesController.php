<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.08.2018
 * Time: 19:05
 */

namespace Corp\Plugins\LocoTranslate\Http\Controllers;


use Cache;
use Corp\Http\Traits\GetThemesPlugins;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\TermsRepository;
use Corp\Plugins\LocoTranslate\LocoTranslatePlugin;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;


class TranslatesController extends LocoTranslatePlugin {

	use GetThemesPlugins;
	/**
	 * @var product rep
	 */
	public $product_rep;


	/**
	 * CategoryController constructor.
	 * @param TermsRepository $terms
	 */
	public function __construct( TermsRepository $terms ) {
		parent::__construct( app() );
		$this->c_rep = $terms;
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

		$this->baseCms->setAdminJs( 'tinymce', asset( config( 'settings.admin' ) . '/plugins/components/tinymce/js/tinymce/tinymce.js' ), array( 'jquery' ), '1', false, 10 );


	}

	/**
	 * @param Term $category
	 * @param Request $request
	 * @return CategoryController
	 * @throws \Throwable
	 */
	public function index( Request $request ) {

		if ( !Gate::allows( 'VIEW_TRANSLATES' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}



		$plugins_list = $this->getAllPlugins();
		$themes_list = $this->getAllThemes();
		$content = $this->getTemplate( 'loco', compact( 'plugins_list', 'themes_list' ) );
		$this->vars = array_add( $this->vars, 'content', $content );
//
		return $this->renderOutput();
	}


	/**
	 * Theme language edit
	 * @param $path
	 * @param Request $request
	 * @return TranslatesController
	 * @throws \Throwable
	 */
	public function theme( $path, Request $request ) {

		if ( !Gate::allows( 'VIEW_TRANSLATES' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}




		// get default en.json
		//	dump(app_path() . DIRECTORY_SEPARATOR . "Themes" . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . 'lang\\' . $request->lang);
		if ( !file_exists( app_path() . DIRECTORY_SEPARATOR . "Themes" . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . 'lang'.DIRECTORY_SEPARATOR. 'en.json' ) ) {

			dd( 'this theme not have en.json file' );
		}

		$keys = $this->getUpdatedKeys( $path, $request->lang, 'Themes' );

		$content = $this->getTemplate( 'theme', compact( 'path', 'keys', 'request' ) );
		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}


	/**
	 * Save language to json
	 * @param Request $request
	 * @param $path
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function storeTheme( Request $request, $path ) {


		if ( !Gate::allows( 'EDIT_TRANSLATES' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}


		//echo $path;

		//dd( $request->language );
		$k_w = array_combine( $request->keys, $request->words );

		//	$arr_lang = [];
		foreach ( $k_w as $k => $v ) {
			$k_w[$k] = $v ?? '';
		}

		$json = json_encode( $k_w );

		File::put( app_path() . DIRECTORY_SEPARATOR . "Themes" . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . $request->language . '.json', $json );


		return back()->with( [ 'status' => __( 'admin.saved' ) ] );


	}


	/**
	 * Translate  plugin by slug
	 * @param $path
	 * @param Request $request
	 * @return TranslatesController
	 * @throws \Throwable
	 */
	public function editPlugin( $path, Request $request ) {
		// get default en.json
		if ( !Gate::allows( 'VIEW_TRANSLATES' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}

		$file = app_path() . DIRECTORY_SEPARATOR . "Plugins" . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . 'lang'. DIRECTORY_SEPARATOR .'en.json';
		if ( !file_exists( $file ) ) {
			dd( 'file not found ' . $file );
			$fp = fopen( $file, "w" ); //
			fwrite( $fp, "" );
			fclose( $fp );
		}


		$keys = $this->getUpdatedKeys( $path, $request->lang );
		$content = $this->getTemplate( 'plugin', compact( 'path', 'keys', 'request' ) );
		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	public function storePlugin( Request $request, $path ) {
		if ( !Gate::allows( 'EDIT_TRANSLATES' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}
		//echo $path;

		//dd( $request->language );
		$k_w = array_combine( $request->keys, $request->words );

		//	$arr_lang = [];
		foreach ( $k_w as $k => $v ) {
			$k_w[$k] = $v ?? '';
		}

		$json = json_encode( $k_w );

		File::put( app_path() . DIRECTORY_SEPARATOR . "Plugins" . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . $request->language . '.json', $json );


		return back()->with( [ 'status' => __( 'admin.saved' ) ] );

	}


	/**
	 * @param Request $request
	 * @return TranslatesController
	 * @throws \Throwable
	 */
	public function editAdmin( Request $request ) {

		if ( !Gate::allows( 'VIEW_TRANSLATES' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}

		$lang = $request->lang ?? getOption( 'LANG', 'en' );


		//dump( $lang );
		//$keys_en = include( base_path() . '/resources/lang/en/admin.php' );
		if ( file_exists( base_path() . '/resources/lang/' . $lang . '/admin.php' ) ) {
			$keys = include( base_path() . '/resources/lang/' . $lang . '/admin.php' );
		} else {
			$keys = include( base_path() . '/resources/lang/en/admin.php' );
		}
		//$keys = array_merge($keys,$keys_en);
		// search admin keys in resources
		$new_keys = $this->getAdminsKeys();

		foreach ( $new_keys as $item ) {
			if ( !in_array( $item, $keys ) ) {
				$keys[$item] = $item;
			}
		}


		if ( $request->lang && $request->lang != 'en' ) {
			$file = base_path() . '\resources\lang\\' . $request->lang . '\admin.php';
			if ( file_exists( $file ) ) {
				$keys_n = include( base_path() . '\resources\lang\\' . $request->lang . '\admin.php' );
				foreach ( $keys_n as $k => $v ) {
					$keys[$k] = $v;
				}
			}
		}


		$content = $this->getTemplate( 'admin', compact( 'keys', 'request' ) );
		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();

	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */

	function storeAdmin( Request $request ) {


		// if this plugin
		if($request->slug){
			$this->storePlugin($request,$request->slug);
			return back()->with( [ 'status' => __( 'admin.saved' ) ] );

		}
		if ( !Gate::allows( 'EDIT_TRANSLATES' ) ) {
			return back()->withErrors([__('You don\'t have access to change this post')]);
			abort( 403 );
		}
		$k_w = array_combine( $request->keys, $request->words );

		//	$arr_lang = [];
		foreach ( $k_w as $k => $v ) {
			$k_w[$k] = $v ?? '';
		}
		$path = base_path() .  '\resources\lang' . DIRECTORY_SEPARATOR . $request->language;
		$path = str_replace('\\',DIRECTORY_SEPARATOR,$path);
		$file = base_path() . '\resources\lang' .  DIRECTORY_SEPARATOR . $request->language . '\admin.php';
		$file = str_replace('\\',DIRECTORY_SEPARATOR,$file);
		if ( !file_exists( $path ) ) {
			//dd($path);
			File::makeDirectory( $path );
		}
		File::put( $file, '<?php return ' . var_export( $k_w, true ) . ';' );

		return back()->with( [ 'status' => __( 'admin.saved' ) ] );

	}

	/**
	 * Ww get updated keys with current language value
	 * @param $path
	 * @param $lang
	 * @param string $type
	 * @return array
	 */
	public function getUpdatedKeys( $path, $lang, $type = 'Plugins' ) {
		$file = app_path() . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . 'lang'.DIRECTORY_SEPARATOR . $lang . '.json';


		if ( !file_exists( $file ) ) {
			$file = app_path() . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . 'lang'. DIRECTORY_SEPARATOR .'en.json';

		}
		$CurrentLang = File::get( $file );


		$keys = $this->getKeys( $path, $type );

		$new_keys = [];

		if ( is_array( $keys ) ) {
			foreach ( $keys as $k => $v ) {


				$new_keys[$v] = '';
			}
		}
		$arrCurrentLang = json_decode( $CurrentLang );

		if ( is_object( $arrCurrentLang ) ) {

			foreach ( $arrCurrentLang as $k => $v ) {
				$new_keys[$k] = $v;

			}
		}

		return $new_keys;
	}

	/**
	 * @param $path
	 * @return array
	 */
	public function getKeys( $path, $folder = "Themes" ) {
		$finder = new Finder();
		$finder->files()->in( app_path() . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $path )->contains( '__(' );

		$keys = [];
		foreach ( $finder as $file ) {
			// dumps the absolute path
			$content = File::get( $file->getRealPath() );
			preg_match_all( '/__\([\' "]+(.*?)[\' "]+\)/', $content, $math );
			if ( isset( $math[1] ) ) {

				$keys = array_merge( $keys, $math[1] );

			}
		}
		$keys = array_unique( $keys );
		foreach ( $keys as $k => $v ) {
			if ( $v == '' ) {
				unset( $keys[$k] );
			}

		}
		return $keys;
	}

	public function getAdminsKeys() {
		$path = base_path() . '/resources/views/admins/cubic';


		$finder = new Finder();
		$finder->files()->in( $path )->contains( '__(' );
		$keys = [];
		foreach ( $finder as $file ) {
			// dumps the absolute path
			$content = File::get( $file->getRealPath() );
			preg_match_all( '/__\([\' "]+(.*?)[\' "]+\)/', $content, $math );
			if ( isset( $math[1] ) ) {

				$keys = array_merge( $keys, $math[1] );
				//dump($file->getRealPath());
//				foreach ($math[1] as $k =>$v){
//
//					if(preg_match('#admin\.#',$v)){
//
//						$content = preg_replace("/__\([' \"]+({$v})[' \"]+\)/",'__(\'admin.$1\')', $content);
//						$content = str_replace('admin.admin','admin',$content);
//						//File::put($file->getRealPath(),$content);
//
//						//var_dump($file->getRealPath());
//					}
//				}

			}
		}
		$keys = array_unique( $keys );
		foreach ( $keys as $k => $v ) {

			if ( $v == '' ) {
				unset( $keys[$k] );
			} else {
				$keys[$k] = str_replace( 'admin.', '', $v );
			}

		}

		return $keys;

	}


}