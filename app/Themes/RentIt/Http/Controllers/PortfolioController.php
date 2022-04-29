<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use Cache;
use Corp\PorCategory;
use Corp\Portfolio;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\RentItTheme;
use Illuminate\Http\Request;

class PortfolioController extends RentItTheme {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public $portfolio_id;
	public $cat_id;


	public function __construct( PostsRepository $portfolio_rep ) {
		parent:: __construct();


		setFrontendJs( 'comment-reply', asset( config( 'settings.theme' ) . '/assets/js/comment-reply.js' ) )
			->setFrontendJs( 'myscripts', asset( config( 'settings.theme' ) . '/assets/js/myscripts.js' ) )
			->setFrontendJs( 'isotope', asset( config( 'settings.theme' ) . '/assets/plugins/isotope/jquery.isotope.min.js' ) );

		$this->js_path[] = '/assets/js/comment-reply.js';
		$this->js_path[] = '/assets/js/myscripts.js';
		$this->post_rep = $portfolio_rep;

		$this->template = 'theme:rentit::layouts.full-page';

	}


	/**
	 * For  post  list
	 * @param bool $cat_alias
	 * @return PostsController|string
	 * @throws \Throwable
	 */
	public function index( Request $request, $cat_alias = FALSE ) {
		//

		$page_title = __( 'Portfolio POST PAGE' );

		$categories = PorCategory::with( 'translations' )->latest()->get();

		// get portfolios with pagination
		$post_per_page = get_theme_mod( 'rentit_portfolio_count_per_page', 8 );


		if ( isset( $cat_alias{1} ) ) {


			$portfolios = Portfolio::with( 'translations', 'user', 'porCategories', 'porCategories.translations' )->
			whereRaw( "id in(SELECT pcp.portfolio_id 
FROM por_category_portfolio
 AS pcp LEFT JOIN por_categories
 AS et ON 
 pcp.por_category_id = et.id
 WHERE et.alias =?)
", [ e( $cat_alias ) ] )
			                       ->whereNotNull( 'published_at' )
			                       ->where( 'published_at', '<', new \DateTime() )
			                       ->latest( 'published_at' )
			                       ->paginate( $post_per_page );

		} else {

			$portfolios = Portfolio::with( 'translations', 'user', 'porCategories', 'porCategories.translations' )
			                       ->whereNotNull( 'published_at' )
			                       ->where( 'published_at', '<', new \DateTime() )
			                       ->latest( 'published_at' )
			                       ->paginate( $post_per_page );
		}


		$this->title = 'Lararent';

		$style = $request->style ?? '3';
		$class = 'col-md-4 col-sm-6';
		if ( $style == 4 ) {
			$class = 'col-md-3 col-sm-6';
		}
		$content = $this->getTemplate( 'portfolio.all-portfolio',
			compact( 'portfolios', 'categories', 'class', 'style' ) );


		$footer = $this->getTemplate( 'footer' );

		$breadcrumbs = $this->getTemplate( 'breadcrumbs', [ 'title' => $page_title ] );

		$this->vars = array_add( $this->vars, 'breadcrumbs', $breadcrumbs );


		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );


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
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show( Request $request, Portfolio $portfolio_obj, $portfolio_alias ) {
		//


		$this->title = 'Lararent';


		// we cache content
		list( $content, $portfolio_id ) = Cache::remember( 'portfolio_content' . $portfolio_alias, 1000, function () use ( $portfolio_obj, $portfolio_alias ) {

			$portfolio = $portfolio_obj->select( 'id', 'img', 'created_at' )->
			with( array(
				'translations' => function ( $query ) {
					$query->select( 'title', 'text', 'keywords', 'meta_desc', 'portfolio_id', 'details',
						'locale' );
				},
				'meta' => function ( $query ) {
					$query->select( 'value', 'name', 'metable_id' );

				}
			,
				'porCategories'
			,
				'porCategories.translations'
			) )
			                           ->where( 'alias', $portfolio_alias )->first();


			$page_title = '';

			$meta = getProductMetas( $portfolio );

			$gallery_media = isset( $meta['gallery_media'] ) ? explode( ',', $meta['gallery_media'] ) : [];


			$categories = $portfolio->porCategories->modelKeys();
			$relatedPortfolio = $portfolio_obj->with( 'translations', 'porCategories', 'porCategories.translations' )->whereHas( 'porCategories', function ( $q ) use ( $categories ) {
				$q->whereIn( 'por_categories.id', $categories );
			} )->where( 'id', '<>', $portfolio->id )->limit( 4 )->get();

			$older = $portfolio_obj->where( 'id', '<', $portfolio->id )->first();
			$newer = $portfolio_obj->where( 'id', '>', $portfolio->id )->first();


			$breadcrumbs = $this->getTemplate( 'breadcrumbs', [ 'title' => 'yurtyu' ] );


			$content = $this->getTemplate( 'portfolio.single',
				compact(
					'portfolio',
					'gallery_media', 'relatedPortfolio',
					'older', 'newer', 'breadcrumbs' )

			);

			$portfolio_id = $portfolio->id;
			return [ $content, $portfolio_id ];
		} );
		$this->portfolio_id = $portfolio_id;


		$this->vars = array_add( $this->vars, 'content', $content );


		return $this->renderOutput();

	}


}
