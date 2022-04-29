<?php

namespace Corp\Http\Controllers\Admin;

use App;
use Auth;
use Cache;
use Corp\Category;
use Corp\Country;
use Corp\Http\Requests\PostRequest;
use Corp\PorCategory;
use Corp\Portfolio;
use Corp\Repositories\CategoriesRepository;
use Corp\Repositories\PortfolioRepository;
use Corp\Tag;
use Gate;
use Illuminate\Http\Request;


class PortfolioController extends AdminController {


	public function __construct( PortfolioRepository $p_rep, CategoriesRepository $c_rep, Category $category ) {
		$this->middleware( 'auth' );


		parent::__construct();

		$this->baseCms->setAdminCss( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/skins/square/_all.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-tagsinput', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-datetimepicker', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css' ), [], null, 10 );


				$this->baseCms->setAdminJs( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'icheck-init', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.init.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'moment-with-locales', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/moment-with-locales.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'bootstrap-datetimepicker', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js' ),
			array( 'jquery', 'moment-with-locales' ), '2', true, 10 );
		$this->baseCms->setAdminJs( 'typeahead', asset( config( 'settings.admin' ) . '/js/typeahead.bundle.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'tagsinput', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'tinymce', asset( config( 'settings.admin' ) . '/plugins/components/tinymce/js/tinymce/tinymce.js' ), array( 'jquery' ), '1', false, 10 );


		$this->p_rep = $p_rep;
		$this->c_rep = $c_rep;
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request,  Portfolio $portfolio ) {
		//


		if ( !Gate::allows( 'VIEW_PORTFOLIO' ) ) {
			return back();
			abort( 403 );
		}

		$this->title =  __( 'admin.All portfolio' );;

		$portfolios = $portfolio->with('translations','user');
		if ( $request->search ) {

			$portfolios = $portfolios->whereHas(
				'translations',
				function ( $query ) use ( $request ) {
					$query->where( 'title', 'like', '%' . $request->search . '%' );
					$query->where( 'locale', App::getLocale() );
				}
			);
		}
		$portfolios = $portfolios->paginate(config('lararent.item_per_page',10));



		$content = $this->getTemplate( '.portfolio.all', compact( 'portfolios','request' ) );


		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create( PorCategory $category ) {
		//
		if ( !Gate::allows( 'VIEW_PORTFOLIO' ) ) {
			return back();
			abort( 403 );
		}

		$this->title = 'Lararent';

		$categories = $this->c_rep->transliterateAll( $category->with( 'translations' )->get()->groupBy( 'parent_id' ) );

		$category_list = buildUlCheckboxOptions( buildTree( $categories->toArray(), 0 ) );


		$tags = Tag::with( 'translations' )->get();


		$content = $this->getTemplate( '.portfolio.portfolio-add',
			[
				'category_list' => $category_list,
				'tags' => $tags,
			] );


		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( PostRequest $request ) {
		//

		if ( !Gate::allows( 'ADD_PORTFOLIO' ) ) {
			return back()->withErrors([__('You don\'t have access to add portfolio')]);
			abort( 403 );
		}


		$result = $this->p_rep->addPortfolio( $request );

		//	dd($result);
		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.portfolio.edit', [ 'portfolio' => $result['id'] ] ) )->with( $result );
		}
		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );
	}


	/**
	 * Show the form for editing Post.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( PorCategory $category, $id ) {
		//


		$portfolio = Portfolio::where( 'id', $id )->first();


		//	dump($portfolio->translations()->first()->getAttributes());



		$categories = $this->c_rep->transliterateAll( $category->with( 'translations' )->get() );

		// we get array of categories id that attach to post you also can use array_pluck
		$post_categories = [];

		foreach ( $portfolio->porCategories as $k => $v ) {
			$post_categories[] = $categories->find( $v->id )->id;


		}


		$categories = $categories->groupBy( 'parent_id' );

		$category_list = buildUlCheckboxOptions( buildTree( $categories->toArray(), 0 ), $post_categories );


		$this->title = 'Lararent';
		$meta = getProductMetas( $portfolio );


		$content = $this->getTemplate( '.portfolio.portfolio-add',
			compact( 'portfolio', 'category_list' , 'meta') );


		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();


	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( PostRequest $request, Portfolio $portfolio ) {
		//

		if ( !Gate::allows( 'UPDATE_PORTFOLIO' ) ) {
			return back()->withErrors([__('You don\'t have access to change this')]);
			abort( 403 );
		}




		$result = $this->p_rep->updatePortfolio( $request, $portfolio );
		//dd($request);

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			return back()->with( $result );
		}

		return back()->with( $result );

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Portfolio $portfolio, \Illuminate\Http\Request $request ) {
		//

		abort_unless( Gate::allows( 'DELETE_portfolio' ), 403 );

		$result = $this->p_rep->deletePortfolio( $portfolio );

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			if ( $request->ajax() && $request->ajax_load_page ) {
				return json_encode( $request );
			}
			return back()->with( $result );
		}
		if ( $request->ajax() ) {
			return json_encode( $request );
		}
		return redirect( '/admin' )->with( $result );

	}


	/**
	 * @param Request $request
	 * @param Portfolio $portfolio
	 * @return array
	 */
	public function Clone( Request $request, Portfolio $portfolio ) {
		if (Gate::allows( 'ADD_PORTFOLIO' ) ) {




		$old = $portfolio->with( 'translations', 'porCategories', 'user' )->where( 'id', (int) $request->portfolio )->first();


		list($alias, $i) = $this->p_rep->generateAlias( $old->alias );

		$request->request->add( $old->getAttributes() );
		$request->request->add( $old->translations()->first()->getAttributes() );
		$request->request->add( [ 'alias' => $alias ] );
		$request->request->add( [ 'title' => $old->title . ' ' . $i ] );
		$request->request->add( [ 'category_id' => $old->PorCategories->pluck( 'id' )->toArray() ] );


		$result = $this->p_rep->addPortfolio( $request );

		$portfolio = $portfolio->where( 'id', $result['id'] )->first();
		//	dump($portfolio);
		return $this->getTemplate( '.portfolio.portfolio_item', compact( 'portfolio' ) );

		}

	}


}
