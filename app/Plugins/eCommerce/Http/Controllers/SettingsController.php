<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.08.2018
 * Time: 19:05
 */

namespace Corp\Plugins\eCommerce\Http\Controllers;


use Corp\Option;
use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\TermsRepository;
use Corp\Plugins\eCommerce\Requests\CategoryRequest;
use Corp\Plugins\eCommerce\Requests\EcomerceSettingsRequest;
use Gate;
use Cache;
use Illuminate\Http\Request;


class SettingsController extends eCommercePlugin {

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
	public function index(Option $option,  Request $request ) {

		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$settings = $option->where('name','ecommerce_currency_options')->first();
		$settings =  isset($settings->translation_value{1}) ? unserialize($settings->translation_value) : [];



		$content = $this->getTemplate( 'settings.all-settings',
			compact('settings') );
		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( EcomerceSettingsRequest $request ) {

		if ( !Gate::allows( 'EDIT_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

   Cache::forget('ecommerce_currency_options');

		$res = $request->except( '_method', '_token' );

		$option = Option::updateOrCreate( [
			'name' => 'ecommerce_currency_options',
		],
			[
				'code' => app()->getLocale(),
				'value' => '',
				app()->getLocale() =>
					[ 'translation_value' => serialize( $res ) ],
			]
		);
		if ( $option ) {

			$result = [ 'status' => __( 'admin.option-updated' ) ];
		} else {
			$result = [ 'error' => __( 'admin.some error occurred.' ) ];
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

		if ( !Gate::allows( 'EDIT_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to this' ) ] );
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

		if ( !Gate::allows( 'EDIT_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to this' ) ] );
			abort( 403 );

		}

		$category = Term::where( 'id', $id );
		abort_unless( $this->user->can( "delete", $category ), 403 );



	}


}