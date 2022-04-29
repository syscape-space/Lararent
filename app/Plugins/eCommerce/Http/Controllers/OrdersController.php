<?php

namespace Corp\Plugins\eCommerce\Http\Controllers;

use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Repositories\OrderRepository;
use Gate;
use Illuminate\Http\Request;

class OrdersController extends eCommercePlugin {

	private $order_rep;

	public function __construct( OrderRepository $orderRepository ) {
		parent::__construct( app() );

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';
		$this->order_rep = $orderRepository;

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request, Order $order ) {
		//

		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to this' ) ] );
			abort( 403 );

		}

		$orders = $order->with( 'items', 'items.product' )
		                ->orderBy( 'created_at', 'DESC' );

		if ( $request->search ) {
			$orders = $orders->where( 'name', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'email', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'phone', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'street_address', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'payment', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'status', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'message', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'ip', 'like', '%' . $request->search . '%' )
			                 ->orWhere( 'id', 'like', '%' . $request->search . '%' )
			;
		}

		$orders = $orders->paginate( config( 'lararent.item_per_page', 10 ) );;

		$content = $this->getTemplate( 'orders.all-orders', compact( 'orders','request' ) );

		$this->vars = array_add( $this->vars, 'content', $content );

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
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		if ( !Gate::allows( 'VIEW_ECOMMERCE' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to this' ) ] );
			abort( 403 );

		}

		$order = new Order;
		//
		$order = $order->with( 'items' )->where( 'id', (int) $id )->first();

		//	dump($order_s->items);
		//dump($order_s->items());
		$content = $this->getTemplate( 'orders.change', compact( 'order' ) );

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
		$order = Order::where( 'id', $id )->first();

		$result = $this->order_rep->updateOrder( $request, $order );
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
	public function destroy( Request $request, Order $order ) {
		//
		abort_unless( Gate::allows( 'EDIT_ECOMMERCE' ), 403 );
		$result = $this->order_rep->deleteOrder( $order );

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			if ( $request->ajax() && $request->ajax_load_page ) {
				return json_encode( [ 'deleted' => true ] );
			}
			return back()->with( $result );
		}
		if ( $request->ajax() ) {
			return json_encode( [ 'deleted' => true ] );
		}
		return redirect( '/admin' )->with( $result );
	}
}
