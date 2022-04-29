<?php

namespace Corp\Http\Controllers\Admin;

use APP;
use Auth;
use Cache;
use Corp\Http\Controllers\CMSController;
use Eventy;
use Gate;
use Lang;
use View;

class AdminController extends CMSController {
	//

	protected $backendMenu;
	protected $MenuItems;
	protected $p_rep;
	protected $a_rep;
	protected $c_rep;
	protected $menu_rep;
	public $user;
	protected $us_rep;
	protected $rol_rep;

	public $admin_header;
	public $lr_footer;


	protected $admin_footer;
	public $js_path;


	public $css_path;


	protected $template;

	protected $content = FALSE;

	protected $title;

	public $vars;

	public function __construct( $js = false, $css = false ) {

		parent::__construct();
		$this->addImagesSize();

		$this->middleware(function ($request, $next)
		{
			$this->user = Auth::user();
			return $next($request);
		});


	}

	public function renderOutput() {
		$this->vars = array_add( $this->vars, 'title', $this->title );


		$sidebar_left = view( 'admins.' . config( 'settings.admin' ) . '.sidebar-left' )
			->with( [ 'backendMenu' => $this->renderMenu(), 'user' => Auth::user() ] )
			->render();


		$this->vars = array_add( $this->vars, 'sidebar_left', $sidebar_left );

		$content = view( 'admins.' . config( 'settings.admin' ) . '.content' )->render();
		$this->vars = array_add( $this->vars, 'content', $content );


		$this->buildHeader();
		$this->buildFooter();


		return view( $this->template )->with( $this->vars );


	}



	public function renderMenu() {
		$baseCms = app()->make( 'BaseCms' );

		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Dashboard' ),
				'label' => '',
				'url' => route( 'adminIndex' ),
				'icon' => 'fa fa-tachometer',
				'permissions' => [ 'VIEW_ADMIN' ],
				'order' => 1,

			]
		);
		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Posts' ),
				'label' => '',
				'url' => '',
				'icon' => 'icon-screen-desktop',
				'permissions' => ['ADD_POSTS','VIEW_ADMIN_POSTS'] ,
				'order' => 2,
				'sideMenu' => [
					[
						'name' => __( 'admin.All post' ),
						'url' => route( 'admin.posts.index' ),
						'permissions' => 'VIEW_ADMIN_POSTS'
					],
					[
						'name' => __( 'admin.add-new' ),
						'url' => route( 'admin.posts.create' ),
						'permissions' => 'ADD_POSTS'
					],
					[
						'name' => __( 'admin.Categories' ),
						'url' => route( 'admin.categories.index' ),
						'permissions' =>  ['ADD_CATEGORY','VIEW_CATEGORY']
					],
					[
						'name' => __( 'admin.Tags' ),
						'url' => route( 'admin.post_tag.index' ),
						'permissions' =>  ['ADD_CATEGORY','VIEW_CATEGORY']
					],
				]

			]
		);
		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Pages' ),
				'label' => '',
				'url' => '',
				'icon' => 'icon-docs fa-fw',
				'permissions' => ['VIEW_ADMIN_PAGES'] ,
				'order' => 2,
				'sideMenu' => [
					[
						'name' => __( 'admin.All Pages' ),
						'url' => route( 'admin.pages.index' ),
						'permissions' => 'VIEW_ADMIN_POSTS'
					],
					[
						'name' => __( 'admin.add-new' ),
						'url' => route( 'admin.pages.create' ),
						'permissions' => 'ADD_POSTS'
					],


				]

			]
		);
		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Comments' ),
				'label' => '',
				'url' => '',
				'icon' => 'mdi mdi-comment-text-outline',
				'permissions' => ['VIEW_COMMENTS'] ,
				'order' => 2,
				'sideMenu' => [
					[
						'name' => __( 'admin.All comments' ),
						'url' => route( 'admin.comments.index' ),
						'permissions' => 'VIEW_ADMIN_POSTS'
					]


				]

			]
		);

		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Portfolio' ),
				'label' => '',
				'url' => '',
				'icon' => 'icon-docs fa-fw',
				'permissions' => ['ADD_portfolio','VIEW_PORTFOLIO'] ,
				'order' => 2,
				'sideMenu' => [
					[
						'name' => __( 'admin.All portfolio' ),
						'url' => route( 'admin.portfolio.index' ),
						'permissions' => 'VIEW_PORTFOLIO'
					],
					[
						'name' => __( 'admin.add-new' ),
						'url' => route( 'admin.portfolio.create' ),
						'permissions' => ['VIEW_PORTFOLIO']
					],
					[
						'name' => __( 'admin.Portfolio categories' ),
						'url' => route( 'admin.por_categories.index' ),
						'permissions' => ['VIEW_PORTFOLIO_CATEGORY']
					],

				]

			]
		);

		$baseCms->addBackendMenu( [

				'name' => __( 'admin.menu-item-media' ),
				'label' => '',
				'url' => route( 'admin.media.index' ),
				'icon' => 'fa fa-picture-o',
				'permissions' => ['MEDIAS.VIEW'],
				'order' => 3,
				'sideMenu' => [
					[
						'name' => Lang::get( 'admin.menu-item-media-library' ),
						'url' => route( 'admin.media.index' ),
						'permissions' => 'MEDIAS.VIEW'
					],
					[
						'name' => Lang::get( 'admin.regenerateThumbnails' ),
						'url' => route( 'admin.regenerateThumbnails.index' ),
						'permissions' => ['MEDIAS.VIEW']
					],

				]

			]
		);


		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Appearance' ),
				'slug' => 'appearance',
				'label' => '',
				'url' => route( 'admin.menus.index' ),
				'icon' => 'icon-calender ',
				'permissions' =>'VIEW_APPEARANCE' ,
				'order' => 4,
				'sideMenu' => [
					[
						'name' => __( 'admin.Themes' ),
						'url' => route( 'admin.themes.index' ),
						'permissions' => []
					],
					[
						'name' => __( 'admin.Menus' ),
						'url' => route( 'admin.menus.index' ),
						'permissions' => [  ]
					],
					[
						'name' => __( 'admin.Customize' ),
						'url' => route( 'admin.customize.index' ),
						'permissions' => [  ]
					],
					[
						'name' => __( 'admin.Widgets' ),
						'url' => route( 'admin.widgets.index' ),
						'permissions' => [  ]
					],

				]


			]
		);



		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Plugins' ),
				'slug' => 'plugins',
				'label' => '',
				'url' => route( 'admin.menus.index' ),
				'icon' => 'fa fa-plug',
				'permissions' => ['VIEW_PLUGINS'],
				'order' => 5,
				'sideMenu' => [
					[
						'name' => __( 'admin.All Plugins' ),
						'url' => route( 'admin.plugins.index' ),
						'permissions' => [ 'VIEW_PLUGINS']
					],

				]


			]
		);


		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Users' ),
				'label' => '',
				'url' => route( 'admin.media.index' ),
				'icon' => 'fa fa-users',
				'permissions' => [ 'VIEW_USERS' ],
				'order' => 6,
				'sideMenu' => [
					[
						'name' => __( 'admin.all-users' ),
						'url' => route( 'admin.users.index' ),
						'permissions' => [ 'VIEW_USERS' ]
					],
					[
						'name' => __( 'admin.permissions' ),
						'url' => route( 'admin.permissions.index' ),
						'permissions' => [ 'VIEW_USERS' ]

					],


				]

			]
		);
		$baseCms->addBackendMenu( [

				'name' => __( 'admin.Options' ),
				'label' => '',
				'url' => route( 'admin.options.index' ),
				'icon' => 'icon-magic-wand icons',
				'permissions' =>  'VIEW_OPTIONS',
				'order' => 7,

			]
		);
		return 	Eventy::filter('admin.getBackendMenu',  $baseCms->getBackendMenu());


	}


	public function addImagesSize() {
		$this->baseCms->setImagesSize( [
			'thumbnail-870x370' => [
				'width' => 870,
				'height' => 370,

			],
			'thumbnail-260x260' => [
				'width' => 260,
				'height' => 260,

			],
			'thumbnail-70x70' => [
				'width' => 70,
				'height' => 70,

			],
		] );
	}

	/**
	 * @param $name
	 * @param null $arr
	 * @return string
	 * @throws \Throwable
	 */
	public function getTemplate( $name, $arr = null ) {
		if ( !View::exists( 'admins.' . config( 'settings.admin' ) . '.' . $name ) ) {
			return false;
		}
		if ( is_array( $arr ) ) {
			return view( 'admins.' . config( 'settings.admin' ) . '.' . $name )
				->with( $arr )
				->render();
		} else {
			return view( 'admins.' . config( 'settings.admin' ) . '.' . $name )
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

		$str .= '  <script src="' . $js . '"></script>' . "\r\n";


		return $str;


	}

	public function includeCss( $css ) {

		return '<link href="' .  $css . '" rel="stylesheet">' . "\r\n";


	}

	/**
	 *
	 */
	public function buildHeader() {
		/**
		 * It's' unminify version
		 */

//		$this->baseCms->setAdminCss('bootstrap',asset(config('settings.admin') .'/bootstrap/dist/css/bootstrap.min.css'),[],null,1);
//		$this->baseCms->setAdminCss('font-awesome',asset(config('settings.admin') .'/less/icons/components-font-awesome/css/font-awesome.css'),[],null,2);
//		$this->baseCms->setAdminCss('chartist',asset(config('settings.admin') .'/plugins/components/chartist-js/dist/chartist.min.css'),[],null,3);
//		$this->baseCms->setAdminCss('chartist-plugin-tooltip-master',asset(config('settings.admin') .'/plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css'),[],null,4);
//		$this->baseCms->setAdminCss('animate',asset(config('settings.admin') .'/css/animate.css'),[],null,1);
//		$this->baseCms->setAdminCss('buttons-data-tables',asset(config('settings.admin') .'/css/buttons.dataTables.min.css'),[],null,1);
//		$this->baseCms->setAdminCss('main-style',asset(config('settings.admin') .'/css/style.css'),[],null,20);
//		$this->baseCms->setAdminCss('main',asset(config('settings.admin') .'/css/main.css'),[],null,21);
//		$this->baseCms->setAdminCss('color-default',asset(config('settings.admin') .'/css/colors/default.css'),[],null,20);
//
//		$this->baseCms->setAdminCss('custom',asset(config('settings.admin') .'/custom.css'),[],null,22);
//		$this->baseCms->setAdminCss('dropzone',asset(config('settings.admin') .'/plugins/components/dropzone-master/dist/dropzone.css'),[],null,10);
//		$this->baseCms->setAdminCss('alertify',asset(config('settings.admin') .'/plugins/alertify/css/alertify.min.css'),[],null,10);
//		$this->baseCms->setAdminCss('Magnific',asset(config('settings.admin') .'/plugins/components/Magnific-Popup-master/dist/magnific-popup.css'),[],null,10);
//

		$this->baseCms->setAdminCss('admin',asset(config('settings.admin') .'/css/admin.min.css'),[],null,20);
		$this->baseCms->setAdminCss('color-green-dark',asset(config('settings.admin') .'/css/colors/green-dark.css'),[],null,20);


		$css = $this->baseCms->getAdminCss();

		$css = $css->sortBy( 'priority' );
		$css = sortDeps( $css->toArray() );

		$header = '';
		if ( is_array( $css ) ) {
			foreach ( $css as $k => $v ) {
				$header .= $this->includeCss( $v['path'] );
			}
		//	dump($header);

		}


		$this->vars = array_add( $this->vars, 'lr_header', $header );
	}

	/**
	 *  we added here scripts to footer and header
	 */
	public function buildFooter() {
		$this->baseCms->setAdminJs('jquery', asset(config('settings.admin') .'/js/admin.min.js'),
			array( ), '1',  false ,1);
		$this->baseCms->localizedAdminJs('jquery','medialibrary_obj',[
			'ajaxUrl' => route('media_media_popup'),
			'store' => route('admin.media.store')
		]);



	/*	$this->baseCms->setAdminJs('jquery', asset(config('settings.admin') .'/plugins/components/jquery/dist/jquery.min.js'),
			array( ), '1',  false ,1);
		$this->baseCms->setAdminJs('medialibrary', asset(config('settings.admin') .'/js/medialibrary.js'),
			array( 'jquery'), '1', true, 2, []);


		$this->baseCms->localizedAdminJs('medialibrary','medialibrary_obj',[
			'ajaxUrl' => route('media_media_popup'),
			'store' => route('admin.media.store')
		]);

		$this->baseCms->setAdminJs( 'dropzone-master', asset( config( 'settings.admin' ) . '/plugins/components/dropzone-master/dist/dropzone.js' ),array( 'jquery' ), '1', true, 10 );



		$this->baseCms->setAdminJs( 'bootstrap', asset( config( 'settings.admin' ) . '/bootstrap/dist/js/bootstrap.min.js' ),
			array( 'jquery' ), '1', true, 2 );
		$this->baseCms->setAdminJs( 'jquery-slimscroll', asset( config( 'settings.admin' ) . '/js/jquery.slimscroll.js' ),
			array( 'jquery' ), '1', true, 3 );

		$this->baseCms->setAdminJs( 'sidebarmenu', asset( config( 'settings.admin' ) . '/js/sidebarmenu.js' ),
			array( 'jquery' ), '1', true, 3 );
		$this->baseCms->setAdminJs( 'cubuc-custom', asset( config( 'settings.admin' ) . '/js/custom.js' ),
			array( 'jquery', 'waves', 'jquery-slimscroll' ),  '1', true, 5 );

		$this->baseCms->setAdminJs( 'waves', asset( config( 'settings.admin' ) . '/js/waves.js' ),
			array( 'jquery' ), '1', true, 4 );
//	$this->baseCms->setAdminJs( 'sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2',
//			array( 'jquery' ), '1', true, 4 );
		$this->baseCms->setAdminJs( 'Magnific-Popup-master', asset( config( 'settings.admin' ) . '/plugins/components/Magnific-Popup-master/dist/jquery.magnific-popup.js' ),array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'Magnific-Popup-init', asset( config( 'settings.admin' ) . '/plugins/components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js' ),array( 'jquery' ), '1', true, 10 );
*/


		$js = $this->baseCms->getAdminJs();
		//dump($js);

		$js = $js->sortBy( 'priority' );


		//$admin_js = sortDeps( $js->toArray() );
		$admin_js = sortDeps( $js->toArray() );
		$footer = '';
		$header = '';

		if ( is_array( $admin_js ) ) {
			foreach ( $admin_js as $k => $v ) {
				if ( $v['in_footer'] ) {

					$footer .= $this->includeJs( $v['path'] , $v['object_name'] ?? false,  $v['obj'] ?? false);
				} else {
					$header .= $this->includeJs( $v['path'] ,$v['object_name'] ?? false,  $v['obj'] ?? false);
				}

			}
		}


		$footer .=  view( 'admins.' . config( 'settings.admin' ) . '.mediaLibraryModal'  )
			->render();
		$this->vars = array_add( $this->vars, 'lr_footer', $footer );
		$this->vars['lr_header'] .=  $header;



	}




}
