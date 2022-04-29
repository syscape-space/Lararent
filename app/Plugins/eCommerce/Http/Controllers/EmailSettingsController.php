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
use Corp\Plugins\eCommerce\Emails\EmailsGateways;
use Corp\Plugins\eCommerce\Gateways\PaymentGateways;
use Corp\Plugins\eCommerce\Models\Term;
use Corp\Plugins\eCommerce\Repositories\TermsRepository;
use Corp\Plugins\eCommerce\Requests\CategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\ViewName;


class EmailSettingsController extends eCommercePlugin {


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



		$this->
		baseCms->setAdminJs( 'ace', asset( 'plugins/PageBuilder/ace/ace.js'));
		$this->
		baseCms->setAdminJs( 'ext-language_tools', asset( 'plugins/PageBuilder/ace/ext-language_tools.js'));
		$this->baseCms->setAdminJs( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'icheck-init', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.init.js' ), array( 'jquery' ), '1', true, 10 );



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

		$EmailsGateways = EmailsGateways::instance();

		$gateways = $EmailsGateways->email_gateways();



		$content_row = $this->getTemplate( 'settings.emails', compact('gateways'));



		$content = $this->getTemplate( 'settings.all-settings-layout',
			compact( 'content_row' ) );


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

	/*	$pdf = app('dompdf.wrapper')->loadView('plugin:eCommerce::PDF.order-pdf', ['order' => $this]);

		return $pdf->download('invoice.pdf');*/
		$EmailsGateways = EmailsGateways::instance();

		$gateways = $EmailsGateways->email_gateways();


		$gateway = $gateways[$id] ?? '';
		$form_fields = $gateway->get_form_fields();



		$object = new \stdClass();
		$object->subject = 'subject';
		$object->email = 'email';
		$object->name = 'name';
		$object->payment  = 'payment ';
		$emailTemplate = new \Corp\Plugins\eCommerce\Emails\OrdersEmail($object, 1);


		$blade =  file_get_contents( app( 'view' )->getFinder()->find( ViewName::normalize( $gateway->blade ) ) );



		$content_row =
			$this->getTemplate( 'settings.emails.edit-email',
				compact('emailTemplate','blade','gateway','form_fields','id'));






		$content = $this->getTemplate( 'settings.all-settings-layout',
			compact( 'content_row' ) );


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


		$EmailsGateways = EmailsGateways::instance();

		$gateways = $EmailsGateways->email_gateways();

		$gateway = $gateways[$id] ?? '';

		$result = [];


		File::put(app( 'view' )->getFinder()->find( ViewName::normalize( $gateway->blade ) ), $request->blade);

		$res = $request->except( '_method', '_token','blade' );

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

			$result = [ 'status' => __( 'Email updated' ) ];
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