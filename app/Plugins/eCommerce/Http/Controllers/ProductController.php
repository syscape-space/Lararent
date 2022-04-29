<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.08.2018
 * Time: 19:05
 */

namespace Corp\Plugins\eCommerce\Http\Controllers;


use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Models\Product;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\ProductRepository;
use Corp\Plugins\eCommerce\Requests\ProductRequest;
use Gate;
use Illuminate\Http\Request;


class ProductController extends eCommercePlugin {

	public $product_rep;
	public $user_n;

	//public  $auth

	public function __construct( ProductRepository $p_r ) {
		parent::__construct( app() );


		$this->product_rep = $p_r;
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


		// register js css

		$this->baseCms->setAdminCss( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/skins/square/_all.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'custom-select', asset( config( 'settings.admin' ) . '/plugins/components/custom-select/custom-select.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-select', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-select/bootstrap-select.min.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-iconpicker', asset( config( 'settings.admin' ) . '/plugins/bootstrap-iconpicker-master/dist/css/bootstrap-iconpicker.min.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-datepicker/', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css' ), [], null, 10 );

		$this->baseCms->setAdminJs( 'moment', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/moment-with-locales.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'bootstrap-datepicker', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js' ), array(
			'jquery',
			'moment'
		), '1', true, 10 );

		$this->baseCms->setAdminJs( 'bootstrap-iconpicker-iconset-all', asset( config( 'settings.admin' ) . '/plugins/bootstrap-iconpicker-master/dist/js/bootstrap-iconpicker-iconset-all.min.js' ),
			array( 'jquery' ), '1', false );

		$this->baseCms->setAdminJs( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'icheck-init', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.init.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'custom-select', asset( config( 'settings.admin' ) . '/plugins/components/custom-select/custom-select.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'bootstrap-select', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-select/bootstrap-select.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'tinymce', asset( config( 'settings.admin' ) . '/plugins/components/tinymce/js/tinymce/tinymce.js' ), array( 'jquery' ), '1', false, 10 );

		$this->baseCms->setAdminJs( 'bootstrap-iconpicker', asset( config( 'settings.admin' ) . '/plugins/bootstrap-iconpicker-master/dist/js/bootstrap-iconpicker.min.js' ),
			array( 'jquery' ), '1', true );;


	}


	/**
	 * Show all products
	 * @param Product $product
	 * @return ProductController|\Illuminate\Http\RedirectResponse
	 * @throws \Throwable
	 */
	public function index( Request $request, Product $product ) {
		$this->title = __( 'eCommerce Products' );

		$products = $product->with( 'translations' )->orderBy( 'created_at', 'desc' );


		if ( $request->search ) {
			$products = $products->whereHas(
				'translations',
				function ( $query ) use ( $request ) {
					$query->where( 'title', 'like', '%' . $request->search . '%' );
					$query->where( 'locale', app()->getLocale() );
				}
			);
		}
		$products = $products->paginate( config( 'lararent.item_per_page', 10 ) );

		if ( !$this->user->can( "viewAll", $product ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to see this page' ) ] );

			abort( 403 );
		}


		$content = $this->getTemplate( 'products.products', compact( 'products', 'request' ) );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create( Term $term ) {


		if ( !Gate::allows( 'product.viewAll' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to create this' ) ] );
			abort( 403 );
		}


		$this->title = __( 'eCommerce Product create' );
		$category_list = $term->with( 'translations' )->where( 'type', 'category' )->get()->groupBy( 'parent_id' );
		$category_list = buildUlCheckboxOptions( buildTree( $category_list->toArray(), 0 ) );

		$group_list = $term->with( 'translations' )->where( 'type', 'group' )->get()->groupBy( 'parent_id' );
		$group_list = buildUlCheckboxOptions( buildTree( $group_list->toArray(), 0 ) );
		$seasonDiscount = $this->getTemplate( 'products.tabs.discounts-seasons' );

		$season_new_row = $this->getTemplate( 'products.tabs.season',
			compact( 'seasonDiscount' ) );

		$locations = Location::with( 'translations' )->get();

		$content = $this->getTemplate( 'products.add', compact( 'category_list', 'group_list', 'locations', 'season_new_row' ) );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( ProductRequest $request ) {


		if ( !$this->user->can( "create", Product::class ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to create product' ) ] );
		}


		abort_unless( $this->user->can( "create", Product::class ), 403 );


		$result = $this->product_rep->addProduct( $request );


		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.products.edit', [ 'posts' => $result['id'] ] ) )->with( $result );
		}
		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );
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
	 * Show the form for editing Post.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Term $term, $id ) {

		$product = Product::with( 'Season' )->where( 'id', $id )->first();

		if ( !$this->user->can( "view", $product ) ) {
			return back();
			abort( 403 );
		}


		// we get array of categories id that attach to post you also can use array_pluck
		$post_categories = [];

		foreach ( $product->terms as $k => $v ) {


			$post_categories[] = $v->id;


		}

		$terms = $term->with( 'translations' )->get();
		$category_list = [];
		$group_list = [];
		foreach ( $terms as $term ) {
			if ( $term->type == 'category' ) {
				$category_list[] = $term->toArray();
			} else {
				$group_list[] = $term->toArray();
			}


		}


		$category_list = buildUlCheckboxOptions( buildTree( $category_list, 0 ), $post_categories );
		$group_list = buildUlCheckboxOptions( buildTree( $group_list, 0 ), $post_categories );


		$meta = $product->meta()->get();
		$product_meta = [];
		foreach ( $meta as $item ) {
			if ( $item->value == '' ) {
				$product_meta[$item->name] = $item->translation_value;

			} else {
				$product_meta[$item->name] = $item->value;
			}

		}


		$locations = Location::with( 'translations' )->get();


		// seasond
		$seasonDiscount = $this->getTemplate( 'products.tabs.discounts-seasons' );


		$seasons = $product->Season->groupBy( 'startDate' )->toArray();

		$season_new_row = $this->getTemplate( 'products.tabs.season',
			compact( 'seasonDiscount' ) );


		$content = $this->getTemplate( 'products.add',
			compact(
				'seasonDiscount',
				'product',
				'category_list',
				'group_list',
				'product_meta',
				'locations',
				'season_new_row',
				'seasons'
			) );

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
	public function update( ProductRequest $request, $id ) {
		//


		$product = Product::where( 'id', $id )->first();
		if ( !$this->user->can( "update", $product ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to edit this product' ) ] );

			abort( 403 );
		}
		$result = $this->product_rep->updateProduct( $request, $product );
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
	public function destroy( $id, \Illuminate\Http\Request $request ) {

		$product = Product::where( 'id', $id )->first();
		abort_unless( $this->user->can( "delete", $product ), 403 );
		$result = $this->product_rep->deleteProduct( $product );


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
	 * We clone product
	 * @param Request $request
	 * @return string
	 * @throws \Throwable
	 */
	public function clone( Request $request ) {
        if ( !$this->user->can( "create", Product::class ) ) {
            return back()->withErrors( [ __( 'You don\'t have access to create product' ) ] );
        }


        $product = new Product();


		$old = $product->with( 'translations', 'user', 'terms' )->where( 'id', (int) $request->product )->first();


		list( $alias, $i ) = $this->product_rep->generateAlias( $alias ?? $old->alias );


		$result = $product->withTrashed()->where( 'alias', $alias )->first();


		$request->request->add( $old->getAttributes() );
		$request->request->add( $old->translations()->first()->getAttributes() );
		$request->request->add( [ 'alias' => $alias ] );
		$request->request->add( [ 'title' => $old->title . ' ' . $i ] );


		$request->request->add( [ 'category_id' => $old->terms->pluck( 'id' )->toArray() ] );

		$meta = $old->meta()->get();
		$product_meta = [];
		foreach ( $meta as $item ) {
			if ( $item->value == '' ) {
				$product_meta[$item->name] = $item->translation_value;
				$request->request->add( [ $item->name => json_decode( $item->translation_value, true ) ?? $item->translation_value ] );
			} else {
				$request->request->add( [ $item->name => json_decode( $item->value, true ) ?? $item->value ] );
				$product_meta[$item->name] = $item->value;
			}

		}
		$request->request->add( [ '_rental_resource_' => $request->_rental_resource ?? '' ] );


		$seasons = $old->Season->groupBy( 'startDate' )->toArray();


		$result = $this->product_rep->addproduct( $request );


		$product = $product->where( 'id', $result['id'] )->first();

		return $this->getTemplate( 'products.product_item', compact( 'product' ) );


	}

}