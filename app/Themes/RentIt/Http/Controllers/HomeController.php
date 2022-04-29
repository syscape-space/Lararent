<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use Cache;
use Corp\Meta;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\ProductRepository;
use Corp\Post;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\MapLocations;
use Corp\Themes\RentIt\RentItTheme;
use Illuminate\Http\Request;


class HomeController extends RentItTheme {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */


	public function __construct( PostsRepository $post_rep ) {
		parent:: __construct();


		setFrontendJs( 'comment-reply', asset( config( 'settings.theme' ) . '/assets/js/comment-reply.js' ) )
			->setFrontendJs( 'myscripts', asset( config( 'settings.theme' ) . '/assets/js/myscripts.js' ) );

		$this->js_path[] = '/assets/js/comment-reply.js';
		$this->js_path[] = '/assets/js/myscripts.js';
		$this->post_rep = $post_rep;

		// hide footer
		$this->vars = array_add( $this->vars, 'hide_widgets', 1 );
		$this->template = 'theme:rentit::layouts.full-page';

	}


	public function index( MapLocations $mapLocations, $template = 'home1' ) {



		$this->description = __('home description');

		$this->title = getOption('blogname').' > '.getOption('blogdescription');

		try {
			$meta = Meta::where( 'metable_type', 'Corp\Plugins\eCommerce\Models\Product' )
			            ->where( 'name', 'rentit_lat_long' )
			            ->where( 'value', '>', 0 )
			            ->get();


			$markersData = $mapLocations->generateObject();

			$locations = Location::with( 'translations' )->get();

			$terms = Term::whereRaw( "id in(
			SELECT term_id FROM `ec_terms_product`
GROUP BY term_id)
			" )->with( 'translations', 'products', 'products.translations', 'products.meta', 'products.meta.translations' )->get();


			$posts = Post::where( 'published_at', '<', new \DateTime() )->latest( 'published_at' )->limit( 2 )->get();


			$footer = $this->getTemplate( 'footer' );

			$content = $this->getTemplate( 'templates.' . $template,
				compact( 'locations', 'meta', 'markersData', 'terms', 'posts' )
			);
			$this->vars = array_add( $this->vars, 'content', $content );
			$this->vars = array_add( $this->vars, 'footer', $footer );
		} catch (\Exception $e){

		}
		return $this->renderOutput();
	}

	/**
	 * Home page 2
	 * @param MapLocations $mapLocations
	 * @return HomeController|string
	 */
	public function index2( MapLocations $mapLocations ) {

		return $this->index( $mapLocations, 'home2' );
	}


	/**
	 * Home page 3
	 * @param MapLocations $mapLocations
	 * @return HomeController|string
	 */
	public function index3( MapLocations $mapLocations ) {

		return $this->index( $mapLocations, 'home3' );
	}

	/**
	 * Home page 4
	 * @param MapLocations $mapLocations
	 * @return HomeController|string
	 */
	public function index4( MapLocations $mapLocations ) {

		return $this->index( $mapLocations, 'home4' );
	}

	/**
	 * Home page 5
	 * @param MapLocations $mapLocations
	 * @return HomeController|string
	 */
	public function index5( MapLocations $mapLocations ) {

		return $this->index( $mapLocations, 'home5' );
	}

	/**
	 * Home page 6
	 * @param MapLocations $mapLocations
	 * @return HomeController|string
	 */
	public function index6( MapLocations $mapLocations, ProductRepository $productRepository, Request $request ) {
		$this->title = getOption('blogname').' > '.getOption('blogdescription');

		$this->template = 'theme:rentit::layouts.home6-layout';


		$locations = Location::with( 'translations' )->get();
		$markersData = $mapLocations->generateObject();


		$posts_per_page = get_theme_mod( 'rentit_product_display', 6 );

		$products = $productRepository->getProducts( $request, false, $posts_per_page );

		$content = $this->getTemplate( 'templates.home6',
			compact( 'products', 'markersData', 'locations', 'request' ) );
		$this->vars = array_add( $this->vars, 'content', $content );

		/**
		 * Save request to session
		 */
		if ( $request->all() ) {
			foreach ( $request->all() as $k => $v ) {
				session( [ e( $k ) => strip_tags( e( $v ) ) ] );
			}
		}


		return $this->renderOutput();
	}


}
