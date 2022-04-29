<?php

namespace Corp\Plugins\eCommerce\Http\Controllers;

use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Booking;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Repositories\OrderRepository;
use Corp\User;
use Gate;

class ReportsController extends eCommercePlugin {

	private $order_rep;

	public function __construct( OrderRepository $orderRepository ) {
		parent::__construct( app() );
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';
		$this->order_rep = $orderRepository;

		$this->baseCms->setAdminCss( 'morris', asset( config( 'settings.admin' ) . '/plugins/components/morrisjs/morris.css' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminCss( 'fullcalendar',
			asset( config( 'settings.admin' ) . '/plugins/components/fullcalendar/fullcalendar.css' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminJs( 'raphael', asset( config( 'settings.admin' ) . '/plugins/components/raphael/raphael-min.js' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminJs( 'morris', asset( config( 'settings.admin' ) . '/plugins/components/morrisjs/morris.js' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminJs( 'moment',
			asset( config( 'settings.admin' ) .
			       '/plugins/components/moment/moment.js' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminJs( 'fullcalendar',
			asset( config( 'settings.admin' ) .
			       '/plugins/components/fullcalendar/fullcalendar.js' ), array( 'jquery' ), '1', false, 10 );

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Order $order, User $user ) {
		//
		if ( !Gate::allows( 'VIEW_REPORTS' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$orders_all = $this->getMothsArray( $order->select( 'created_at', 'status' )->get() );
		$TotalSalesPerMoth = $order->getTotalSalesPerMoth();
		$totalSales = collect($order->getTotalSalesSum())->first()->TotalSales ?? 0;
		$users = $user->getTotalUsersPerMoth();

		$bookings = Booking::with('product')->get();


		$content = $this->getTemplate( 'reports.all-reports',
			compact( 'orders_all', 'TotalSalesPerMoth','totalSales' , 'users' , 'bookings') );

		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * @param $all_orders
	 * @return array
	 */
	public function getMothsArray( $all_orders ) {
		$orders_by_moth = [];
		foreach ( $all_orders as $item ) {
			$orders_by_moth[$item->created_at->format( 'Y' )][$item->created_at->format( 'm' )][] = $item->toArray();
		}
		foreach ( $orders_by_moth as $k => $v ) {
			foreach ( $v as $key => $val ) {
				$orders_by_moth[$k][$key]['count'] = count( $val );

				$completed = 0;
				$pending = 0;
				$paid = 0;
				$canceled = 0;


				foreach ( $val as $o_k => $o_v ) {
					if ( $o_v['status'] == 'completed' ) {
						$completed ++;
					}
					if ( $o_v['status'] == 'pending' ) {
						$pending ++;
					}
					if ( $o_v['status'] == 'paid' ) {
						$paid ++;
					}
					if ( $o_v['status'] == 'canceled' ) {
						$canceled ++;
					}

				}
				$orders_by_moth[$k][$key]['completed'] = $completed;
				$orders_by_moth[$k][$key]['pending'] = $pending;
				$orders_by_moth[$k][$key]['paid'] = $paid;
				$orders_by_moth[$k][$key]['canceled'] = $canceled;


			}
		}
		return $orders_by_moth;

	}

	public function getSalesByMonth() {

	}
}


