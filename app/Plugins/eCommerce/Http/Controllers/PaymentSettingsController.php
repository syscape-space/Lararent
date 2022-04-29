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
use Corp\Plugins\eCommerce\Gateways\PaymentGateways;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\TermsRepository;
use Corp\Plugins\eCommerce\Requests\CategoryRequest;
use Gate;
use Illuminate\Http\Request;


class PaymentSettingsController extends eCommercePlugin {


	/**
	 * @var product rep
	 */
	public $product_rep;


	/**
	 * CategoryController constructor.
	 * @param TermsRepository $terms
	 */
	public function __construct() {
		parent::__construct( app() );


		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

		$this->baseCms->setAdminCss( 'styleswitcher', asset( config( 'settings.admin' ) . '/plugins/components/switchery/dist/switchery.min.css' ), [], null, 10 );

		$this->baseCms->setAdminJs( 'styleswitcher', asset( config( 'settings.admin' ) . '/plugins/components/switchery/dist/switchery.min.js' ), array( 'jquery' ), '1', true, 10 );


	}

	/**
	 * @param Term $category
	 * @param Request $request
	 * @return CategoryController
	 * @throws \Throwable
	 */
	public function index( Request $request ) {

		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$PaymentGateways = PaymentGateways::instance();

		$gateways = $PaymentGateways->payment_gateways();

		$content = $this->getTemplate( 'settings.payment',
			compact( 'gateways' ) );
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
	public function store( CategoryRequest $request ) {

		abort_unless( $this->user->can( "create", Term::class ), 403 );


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

		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$PaymentGateways = PaymentGateways::instance();

		$gateways = $PaymentGateways->payment_gateways();
		$gateway = $gateways[$id] ?? '';


		///	dump($gateway->get_option_key());
		$form_fields = $gateway->get_form_fields();

		$content = $this->getTemplate( 'settings.update-payment',
			compact( 'gateway', 'id', 'form_fields' ) );
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
	public function update( Request $request, $id ) {
		//

		if ( !Gate::allows( 'EDIT_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

			$PaymentGateways = PaymentGateways::instance();
		$gateways = $PaymentGateways->payment_gateways();
		$gateway = $gateways[$id] ?? '';

		$result = [];

		$res = $request->except( '_method', '_token' );

		$option = Option::updateOrCreate( [
			'name' => $gateway->get_option_key(),
		],
			[
				'code' => app()->getLocale(),
				'value' => '',
				app()->getLocale() =>
					[ 'translation_value' => serialize( $res ) ],
			]
		);
		if ( $option ) {

			$result = [ 'status' => __( 'admin.saved' ) ];
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
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		abort_unless( $this->user->can( "delete", Option::class ), 403 );


	}


}