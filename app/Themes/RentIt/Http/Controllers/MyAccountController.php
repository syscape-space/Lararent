<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use Cache;
use Corp\Plugins\eCommerce\Gateways\PaymentGateways;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Models\Product;
use Corp\Plugins\eCommerce\Repositories\OrderRepository;
use Corp\Repositories\UsersRepository;
use Corp\Themes\RentIt\RentItTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class MyAccountController extends RentItTheme {
	private $us_rep;
	private $order_rep;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct( UsersRepository $repository, OrderRepository $orderRepository ) {

		parent::__construct();
		$this->us_rep = $repository;
		$this->order_rep = $orderRepository;
	}


	/**
	 * @param Request $request
	 * @param bool $cat_alias
	 * @return MyAccountController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
	 * @throws \Throwable
	 */
	public function index( Request $request, $cat_alias = FALSE ) {

		if ( !isset( auth()->user()->id ) ) {
			return redirect( '/' );

		}


		$this->title = __( 'My account page' );


		$products = Product::GetRentedProduct()->get();
		$orders = Order::where( 'user_id', auth()->user()->id )->orderBy( 'created_at', 'desc' )->get();

		$content = $this->getTemplate( 'my-account.account', compact( 'products', 'orders' ) );


		$footer = $this->getTemplate( 'footer' );


		$breadcrumbs = $this->getTemplate( 'breadcrumbs', [ 'title' => __( 'My account' ) ] );

		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );


		$this->vars = array_add( $this->vars, 'breadcrumbs', $breadcrumbs );

		return $this->renderOutput();
	}


	/**
	 * @return MyAccountController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
	 * @throws \Throwable
	 */
	public function edit() {
		if ( !isset( auth()->user()->id ) ) {
			return redirect( '/' );
		}

		$this->title = __( 'My account page' );


		$user = auth()->user();

		$content = $this->getTemplate( 'my-account.edit-account', compact( 'user' ) );

		$footer = $this->getTemplate( 'footer' );


		$breadcrumbs = $this->getTemplate( 'breadcrumbs', [ 'title' => __( 'Edit account' ) ] );
		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );


		$this->vars = array_add( $this->vars, 'breadcrumbs', $breadcrumbs );

		return $this->renderOutput();
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateAccount( Request $request ) {
		$user = auth()->user();

		$result = $this->us_rep->updateUser( $request, $user );
		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			return back()->with( $result );
		}
		return back()->with( $result );
	}

	/**
	 * @param OrderRepository $order_rep
	 * @param Request $request
	 * @return mixed
	 */
	public function charge( OrderRepository $order_rep, Request $request ) {
		$ecommerce_cart = Session::get( 'ecommerce_cart' );
		$PaymentGateways = PaymentGateways::instance();
		//dump($PaymentGateways);
		$gateway = null;
		foreach ( $PaymentGateways->payment_gateways() as $item ) {
			if ( $item->id == $ecommerce_cart['payment'] ) {
				return $item->charge( $ecommerce_cart, $request );

				break;
			}

		}
	}


	public function cancelOrder( Request $request, $order_id ) {
		if ( get_theme_mod( 'rentit_booking_cancel', true ) ):

			$result = $this->order_rep->canceledOrder($order_id);
			if ( is_array( $result ) && !empty( $result['error'] ) ) {
				return back()->with( $result );
			}
			return back()->with( $result );
		endif;
		return back();

	}


}
