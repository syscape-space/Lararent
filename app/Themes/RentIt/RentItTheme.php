<?php

namespace Corp\Themes\RentIt;


use App;
use Auth;
use Cache;
use Corp\Http\Customize\CustomizeManager;
use Corp\Plugins\PageBuilder\Classes\RegisterModule;
use Corp\Themes\RentIt\Customize\CustomizerInit;
use Eventy;
use Illuminate\Support\Facades\Log;
use Request;
use Route;
use V\Plugins\Theme;

Class RentItTheme extends Theme {
	private static $_instance = null;


	public $name = 'RentIt theme';

	/**
	 * @var string
	 */
	public $namespace = 'rentit';
	public $backendMenu;


	public function __construct() {
		parent:: __construct();

		$this->template = 'theme:rentit::index';


		// add menu item to admin area
		Eventy::addFilter( 'admin.getBackendMenu', function ( $menu ) {
			$key = $menu->search( function ( $item, $key ) {
				return $item['slug'] ?? '' == 'appearance';
			} );

			$menu = $menu->toArray();
			if ( $key > 0 ) {
				( $menu[$key]['sideMenu'][] = [
					'name' => __( 'Import demo data' ),
					'url' => route( 'RentItRunDemoImport' ),
					'permissions' => [ 'INSTALL_PLUGIN' ]
				] );
			}

			return $menu;
		} );


		// add image sizes

		$this->baseCms->setImagesSize( [
			'thumbnail-600x426' => [
				'width' => 600,
				'height' => 426,

			],
			'thumbnail-570x270' => [
				'width' => 570,
				'height' => 270,

			],
			'thumbnail-370x220' => [
				'width' => 370,
				'height' => 220,

			],
			'thumbnail-270x220' => [
				'width' => 270,
				'height' => 220,

			],
			'thumbnail-600x400' => [
				'width' => 600,
				'height' => 400,

			],



		] );


		Eventy::addAction( 'save-widget', function ( $name ) {
			Log::debug( 'An informational message.' . $name );

		}, 20, 1 );

	}


	/**
	 * here we can enable routes and views
	 */
	public function boot() {

		new CustomizerInit();


		$RegisterModule = RegisterModule::getInstance();

		$RegisterModule->setModule(
			'breadcrumbs',
			__( 'Breadcrumbs' ),
			'Corp\Themes\RentIt\Modules\Breadcrumbs',
			asset( config( 'settings.theme' ) ) . '/img/modules/breadcrumbs.png',
			'php'
		);


		$RegisterModule->setModule(
			'page_section_with_container',
			__( 'Page section with container' ),
			'Corp\Themes\RentIt\Modules\PageSectionWithContainer',
			asset( config( 'settings.theme' ) ) . '/img/modules/content-with-photo.png',
			'html'
		);


		$RegisterModule->setModule(
			'login_section',
			__( 'Login form' ),
			'Corp\Themes\RentIt\Modules\LoginSection',
			asset( config( 'settings.theme' ) ) . '/img/modules/login-section.png',
			'php'
		);

		$RegisterModule->setModule(
			'contact_us',
			__( 'Contact Us' ),
			'Corp\Themes\RentIt\Modules\ContactUs',
			asset( config( 'settings.theme' ) ) . '/img/modules/ContactUs.png',
			'html'
		);


		$RegisterModule->setModule(
			'contact_us_map',
			__( 'Contact Us Map' ),
			'Corp\Themes\RentIt\Modules\ContactUsMap',
			asset( config( 'settings.theme' ) ) . '/img/modules/ContactUsMap.png',
			'html'
		);

		$RegisterModule->setModule(
			'contact_us_faq',
			__( 'Contact Us FAQ' ),
			'Corp\Themes\RentIt\Modules\ContactUsFAQ',
			asset( config( 'settings.theme' ) ) . '/img/modules/contact-faq.jpg',
			'html'
		);


		$RegisterModule->setModule(
			'faq_container',
			__( 'FAQ container with sidebar' ),
			'Corp\Themes\RentIt\Modules\FAQContainer',
			asset( config( 'settings.theme' ) ) . '/img/modules/FAQContainer.jpg',
			'php'
		);


		require_once __DIR__ . '/functions.php';
		$this->middleware( 'web' );


		// TODO: Implement boot() method.
		$this->enableRoutes();
		$this->enableViews();
		$this->
		baseCms
			->setFrontendCss( 'bootstrap', asset( config( 'settings.theme' ) . '/assets/css/all-css.min.css' ) )
		//	->setFrontendCss( 'rentit-theme', asset( config( 'settings.theme' ) . '/assets/css/theme-blue-1.css' ) )
			  /* ->setFrontendCss( 'bootstrap', asset( config( 'settings.theme' ) . '/assets/plugins/bootstrap/css/bootstrap.min.css' ) )
			   ->setFrontendCss( 'bootstrap-select', asset( config( 'settings.theme' ) . '/assets/plugins/bootstrap-select/css/bootstrap-select.min.css' ) )
			   //	->setFrontendCss( 'jquery-ui', asset( config( 'settings.theme' ) . '/assets/plugins/jquery-ui/jquery-ui-1.12.1.custom/jquery-ui.css' ) )
			   ->setFrontendCss( 'font-awesome', asset( config( 'settings.theme' ) . '/assets/plugins/fontawesome/css/font-awesome.min.css' ) )
			   ->setFrontendCss( 'prettyPhoto', asset( config( 'settings.theme' ) . '/assets/plugins/prettyphoto/css/prettyPhoto.css' ) )
			   ->setFrontendCss( 'owl-carousel', asset( config( 'settings.theme' ) . '/assets/plugins/owl-carousel2/assets/owl.carousel.min.css' ) )
			   ->setFrontendCss( 'owl-theme-default', asset( config( 'settings.theme' ) . '/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css' ) )
			   ->setFrontendCss( 'animate', asset( config( 'settings.theme' ) . '/assets/plugins/animate/animate.min.css' ) )
			   ->setFrontendCss( 'swiper', asset( config( 'settings.theme' ) . '/assets/plugins/swiper/css/swiper.min.css' ) )
			   ->setFrontendCss( 'bootstrap-datetimepicker', asset( config( 'settings.theme' ) . '/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css' ) )
			   ->setFrontendCss( 'rentit-theme', asset( config( 'settings.theme' ) . '/assets/css/theme.css' ) )
			   ->setFrontendCss( 'renit-main', asset( config( 'settings.theme' ) . '/assets/main.css' ) )*/
			   ->setFrontendCss( 'assets/css/inc/awesome-bootstrap-checkbox.css', asset( config( 'settings.theme' ) . '/assets/css/inc/awesome-bootstrap-checkbox.css' ) )



		;

		$this->
		baseCms


			//->setFrontendJs( 'jquery', asset( config( 'settings.theme' ). '/assets/js/all-js.min.js' ), [], 1, false, 2 )

			   ->setFrontendJs( 'jquery', asset( config( 'settings.theme' ). '/assets/plugins/jquery/jquery-1.11.1.min.js' ), [], 1, false, 2 )



			->setFrontendJs( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', [ 'jquery' ], 1, true, 2 )

			->setFrontendJs( 'all-js', asset( config( 'settings.theme' ). '/assets/js/all-js.min.js' ), ['jquery'], 1, true, 2 )



                /*
            ->setFrontendJs( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', [ 'jquery' ], 1, true, 2 )
			->setFrontendJs( 'bootstrap', asset( config( 'settings.theme' ) . '/assets/plugins/bootstrap/js/bootstrap.min.js' ), [ 'jquery' ], 1, true, 2 )
			*/
           // ->setFrontendJs( 'bootstrap-select', asset( config( 'settings.theme' ) . '/assets/plugins/bootstrap-select/js/bootstrap-select.min.js' ), [ 'jquery' ], 1, true, 3 )
		//	->setFrontendJs( 'superfish', asset( config( 'settings.theme' ) . '/assets/plugins/superfish/js/superfish.min.js' ), [ 'jquery' ], 1, true, 4 )
		//	->setFrontendJs( 'prettyPhoto', asset( config( 'settings.theme' ) . '/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js' ), [ 'jquery' ], 1, true, 5 )
		//	->setFrontendJs( 'owl-carousel', asset( config( 'settings.theme' ) . '/assets/plugins/owl-carousel2/owl.carousel.min.js' ), [ 'jquery' ], 1, true, 6 )
			//->setFrontendJs( 'jquery-sticky', asset( config( 'settings.theme' ) . '/assets/plugins/jquery.sticky.min.js' ), [ 'jquery' ], 1, true, 7 )
			//->setFrontendJs( 'jquery-easing', asset( config( 'settings.theme' ) . '/assets/plugins/jquery.easing.min.js' ), [ 'jquery' ], 1, true, 8 )
			//->setFrontendJs( 'smoothscroll', asset( config( 'settings.theme' ) . '/assets/plugins/jquery.smoothscroll.min.js' ), [ 'jquery' ], 1, true, 9 )

          //  ->setFrontendJs( 'swiper-jquery', asset( config( 'settings.theme' ) . '/assets/plugins/swiper/js/swiper.jquery.min.js' ), [ 'jquery' ], 1, true, 10 )
			//->setFrontendJs( 'moment-with-locales', asset( config( 'settings.theme' ) . '/assets/plugins/datetimepicker/js/moment-with-locales.min.js' ), [ 'jquery' ], 1, true, 11 )
		//	->setFrontendJs( 'bootstrap-datetimepicker', asset( config( 'settings.theme' ) . '/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js' ), [ 'jquery' ], 1, true, 12 )
			->setFrontendJs( 'rentit-theme', asset( config( 'settings.theme' ) . '/assets/js/theme.js' ), [ 'jquery' ], 1, true, 13 )
			->setFrontendJs( 'lang', asset( '/js/lang.js' ) )
			//->setFrontendJs( 'theme-ajax-mail', asset( config( 'settings.theme' ) . '/assets/js/theme-ajax-mail.js' ), [ 'jquery' ] )
			->setFrontendJs( 'rentit-map-init', asset( config( 'settings.theme' ) . '/assets/js/map_init.js' ), [ 'jquery' ] )
			->setFrontendJs( 'maps-google', 'https://maps.googleapis.com/maps/api/js?key=' . get_theme_mod( 'google_api_key' ) . '&&#038;libraries=places&#038;callback=initialize_map&#038;ver=3',
				[ 'rentit-map-init' ], 1, true, 14 )
			->setFrontendJs( 'rentit-main', asset( config( 'settings.theme' ) . '/assets/js/main.js' ), [
				'jquery',
				'rentit-theme'
			], 1, true, 15 )


			->localizedFrontendJs( 'rentit-main', 'rentit_obj',
				[
					'news_letter_widget' => route( 'NewsLetterWidget' ),
					'PreviewReservation' => route( 'PreviewReservation' ),
					'date_format' => get_theme_mod( 'rentit_calendar_format', 'MM/DD/YYYY' ),
					'lang' => get_theme_mod( 'rentit_calendar_lang', '' ),
					'last_cat' => "popular-cars",
					'global_map_styles' => '',
					'lat' => '34.800155',
					'longu' => '33.030800',
					'zum' => '10',
					'theme_url' => url( 'rentit' ),
					'currency' => "$",
					'currency_pos' => "left",
					'coupon' => route( 'FrontendCheckoutCoupon' )

				]
			);



		if ( Request::is( 'admin/customize' ) ) {

			$this->
			baseCms
				->setAdminJs( 'rentit-admin', asset( config( 'settings.theme' ) ) . '/assets/js/admin.js' );
		}

		$this->
		baseCms
			->setAdminJs( 'rentit-widgets', asset( config( 'settings.theme' ) ) . '/assets/js/widgets.js' );

		// add editor link to single product
		Eventy::addAction( 'adminbar.edit', function ( $controllerAction ) {

			if ( $controllerAction == "ProductsController@show" ) {

				?>
                <a class="ab-item"
                   href="<?php echo route( 'admin.products.edit', [ 'id' => app( 'request' )->route()->controller->product_id ] ); ?>">
					<?php echo __( 'Edit product' ); ?>
                </a>
				<?php
			}
		}, 20, 1 );

		Eventy::addAction( 'adminbar.center', function ( $controllerAction ) {

			if ( $controllerAction == 'PageController@show' && app( 'request' )->route()->controller->error != 'true' ) {
				?>
                <div data-id="<?php echo app( 'request' )->route()->controller->page_id; ?>"
                     data-type="page"
                     data-embellishmentid="3"
                     class="pb-admin-page-date" style="display: none;">

                </div>
                <li id="" class=""><a class="ab-item live_edit" tabindex="-1"
                                      href="<?php echo request()->url(); ?>?live_edit=1"><?php echo __( 'Live edit' ) ?></a>
                </li>
				<?php
			}
		}, 20, 1 );

		// add editor link to portfolio product
		Eventy::addAction( 'adminbar.edit', function ( $controllerAction ) {

			if ( $controllerAction == "PortfolioController@show" ) {

				?>
                <a class="ab-item"
                   href="<?php echo route( 'admin.portfolio.edit', [ 'id' => app( 'request' )->route()->controller->portfolio_id ] ); ?>">
					<?php echo __( 'Edit portfolio' ); ?>
                </a>
				<?php
			}
		}, 20, 1 );

		Eventy::addFilter( 'lr.menu', function ( $menu ) {
			$text = '<li>
                                    <ul class="social-icons">';
			$new_arr = '';
			if ( get_theme_mod( 'rentit_header_icons', true ) ) {
				$all_arr = get_theme_mod( 'rentit_header_icons' );

				if ( $all_arr['url'] ?? false ) {
					foreach ( $all_arr['url'] as $k => $v ) {
						$new_arr .= '  <li><a target="_blank" href="' . $all_arr['url'][$k] . '" 
  class="facebook"><i class="fa ' . $all_arr['icon'][$k] . '"></i></a></li>
                                       ';


					}
				}
			}
			$text .= $new_arr . '</ul>
                                </li></ul>';

			return str_replace_last( '</ul>', $text, $menu );
		}, 20, 1 );


	}

	/**
	 * will be run when theme is activated
	 */
	public function onActivate() {
		Log::notice( 'activate rettit' );
	}

	/**
	 * we register new Widgets in admin area
	 */
	public function setWidgets() {
		/*
		 * we make new sidebars
		 */
		$this->baseCms->registerSidebar(
			array(
				'name' => __( 'sidebar' ),
				'id' => 'rentit-sidebar',
				'before_widget' => '<div  class="widget  %s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h1><div class="widget-content">',
			)
		);
		$this->baseCms->registerSidebar(
			array(
				'name' => __( 'Footer area' ),
				'id' => 'rentit-footer-sidebar',
				'before_widget' => '<div class="col-md-3"><div class="widget %s">',
				'after_widget' => '</div></div>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h4 class="widget-title">',
			)
		);
		$this->baseCms->registerSidebar(
			array(
				'name' => __( 'sidebar shop' ),
				'id' => 'rentit-sidebar-shop',
				'before_widget' => '<div  class="widget  %s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h1><div class="widget-content">',
			)
		);
		$this->baseCms->registerSidebar(
			array(
				'name' => __( 'sidebar single product' ),
				'id' => 'rentit-single-product',
				'before_widget' => '<div  class="widget  %s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h1><div class="widget-content">',
			)
		);
		$this->baseCms->registerSidebar(
			array(
				'name' => __( 'sidebar single page' ),
				'id' => 'rentit-single-page',
				'before_widget' => '<div  class="widget  %s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h1><div class="widget-content">',
			)
		);


		/*
		 * Register all widgets
		 */
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\CategoriesWidgets' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\PostsWidgets' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\ArchiveWidgets' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\FlickrImagesWidget' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\TwitterWidget' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\TagsWidgets' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\AboutUsWidget' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\SearchWidget' );


		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\NewsLetterWidget' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\MenuWidget' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\Product\ProductFilter' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\Product\PriceFilter' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\Product\Testimonials' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\Product\HelpingCenter' );
		$this->baseCms->addWidgets( 'Corp\Themes\RentIt\Widgets\Product\DetailReservation' );


	}



}


