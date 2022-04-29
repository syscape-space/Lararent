<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.08.2018
 * Time: 19:05
 */

namespace Corp\Plugins\eCommerce\Http\Controllers;


use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\TermsRepository;
use Corp\Plugins\eCommerce\Requests\CategoryRequest;
use Gate;
use Illuminate\Http\Request;


class CategoryController extends eCommercePlugin {

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
	public function index( Term $category, Request $request ) {

		if ( !Gate::allows( 'VIEW_PRODUCT_CATEGORY' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to see this' ) ] );
			abort( 403 );
		}



		$type = $request->group ? 'group' : 'category';


		$categories = $category->with( 'translations')->where('type',$type)->get()->groupBy( 'parent_id' );



		$arr = buildTree( $categories->toArray(), 0 );

		$form = $this->getTemplate( 'categories.add-category',
			[ 'categories' => buildSelectOptions( $arr ), 'group' => $request->group ]
		);

		$content = $this->getTemplate( 'categories.all-categories',
			[ 'form' => $form, 'categories' => $categories, 'group' => $request->group ] );
		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if ( !Gate::allows( 'VIEW_PRODUCT_CATEGORY' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to see this' ) ] );
			abort( 403 );
		}


		$this->title = __( 'eCommerce Product create' );


		$content = $this->getTemplate( 'products.add' );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( CategoryRequest $request ) {

		if ( !Gate::allows( 'ADD_PRODUCT_CATEGORY' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to add category' ) ] );
			abort( 403 );
		}



		$result = $this->c_rep->addCategory( $request );


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
	public function edit( Request $request, $id ) {
		/*if ( !Gate::allows( 'VIEW_PRODUCT_CATEGORY' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to see this' ) ] );
			abort( 403 );
		}*/

		$category = new Term();
		$this->title = 'Lararent';
		$type = $request->group ? 'group' : 'category';


		$categories = $category->with( 'translations' )->where('type',$type)->get()->groupBy( 'parent_id' );



		$arr = buildTree( $categories->toArray(), 0 );

		$category = $category->where( 'id', $id )->first();
		if ( !$this->user->can( "view", $category ) ) {
			return back();
			abort( 403 );
		}
		$parent_id = $category->parent_id ?? 0;

		$content = $this->getTemplate( 'categories.edit-category',
			[
				'group' => $request->group,
				'categories' => buildSelectOptions( $arr, $parent_id ),
				'category' => $category
			]

		);
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
	public function update( CategoryRequest $request, $id ) {
		//


		if ( !Gate::allows( 'UPDATE_PRODUCT_CATEGORY' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to update this' ) ] );
			abort( 403 );
		}



		$result = $this->c_rep->updateCategory( $request, $id );


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
	public function destroy( Request $request, $id ) {

		$category = Term::where( 'id', $id );
		abort_unless( $this->user->can( "delete", $category ), 403 );

		$result = $this->c_rep->deleteCategory( $category );

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			if ( $request->ajax() && $request->ajax_load_page ) {
				return json_encode( $request );
			}
			return back()->with( $result );
		}
		if ( $request->ajax() ) {
			return json_encode( $request );
		}


	}


}