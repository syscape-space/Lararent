<?php
namespace Corp\Plugins\eCommerce\Http\Controllers;


use Corp\Option;
use Corp\Plugins\eCommerce\eCommercePlugin;
use Corp\Plugins\eCommerce\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Session;

/**
 * For PayPal gateway
 * Class PayNotifyController
 * @package Corp\Plugins\eCommerce\Http\Controllers
 */

class PayNotifyController extends eCommercePlugin {


	/**
	 * Update order status
	 * @param Request $request
	 * @param Order $order
	 */
	public function index( Request $request, Order $order ) {
		if ( $request->item_number ) {
			if ( $this->verifyTransaction( $_POST ) ) {
				$order = $order->where( 'id', $request->item_number )->update( [ 'status' => 'paid' ] );
				Log::info( 'PayPal order', $order );
				Log::info( 'PayPal info', $_POST );
			} else {
				Log::info( 'PayPal not verify' );
			}


		}

	}


	/**
	 * if user cancel order
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function cancel(Order $order) {
		if ( isset( $_SESSION['paypal_gt_res'] ) ) {

			$order->where( 'id', $_SESSION['paypal_gt_res']['result']['id'] )->update( [ 'status' => 'canceled' ] );

			return redirect( $_SESSION['paypal_gt_res']['url'] )->with( [ 'error' => __( 'admin.some error occurred.' ) ]);
		}

		return redirect( url('/'));
	}

	/**
	 * Payment done return to product
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function ok() {

		if ( isset( $_SESSION['paypal_gt_res'] ) ) {

			return redirect( $_SESSION['paypal_gt_res']['url'] )->with( $_SESSION['paypal_gt_res']['result'] );
		}
	}

	/**
	 * @param $data
	 * @return bool
	 */
	public function verifyTransaction( Option $option, $data ) {

		$enableSandbox = true;
		// check if this sand box mode or live
		$res = $option->where( 'name', 'ecommerce_PayPal_settings' )->first();
		if ( $res ) {
			$res = unserialize($res->translation_value);
			if(isset($res['enable_test_mode']) && $res['enable_test_mode'] == 'on' ){
				$enableSandbox = false;
			}

		}

		$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

		$req = 'cmd=_notify-validate';
		foreach ( $data as $key => $value ) {
			$value = urlencode( stripslashes( $value ) );
			$value = preg_replace( '/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value ); // IPN fix
			$req .= "&$key=$value";
		}

		$ch = curl_init( $paypalUrl );
		curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $req );
		curl_setopt( $ch, CURLOPT_SSLVERSION, 6 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 1 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
		curl_setopt( $ch, CURLOPT_FORBID_REUSE, 1 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Connection: Close' ) );
		$res = curl_exec( $ch );

		if ( !$res ) {
			$errno = curl_errno( $ch );
			$errstr = curl_error( $ch );
			curl_close( $ch );
			throw new Exception( "cURL error: [$errno] $errstr" );
		}

		$info = curl_getinfo( $ch );
		Log::info( 'PayPal info', $info );
		Log::info( 'PayPal res', is_array($res) ? $res : [$res] );
		// Check the http response
		$httpCode = $info['http_code'];
		if ( $httpCode != 200 ) {
			throw new Exception( "PayPal responded with http code $httpCode" );
		}

		curl_close( $ch );

		return $res === 'VERIFIED';
	}

}