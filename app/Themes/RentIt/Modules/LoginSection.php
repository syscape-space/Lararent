<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.11.2018
 * Time: 21:13
 */

namespace Corp\Themes\RentIt\Modules;


use Corp\Plugins\PageBuilder\Classes\BaseModule;
use Corp\Themes\RentIt\Classes\FacaBookLogin;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;

/**
 * Class Breadcrumbs
 * @package Corp\Themes\RentIt\Modules
 */
class LoginSection extends BaseModule {


	/**
	 * @param bool $module
	 * @param bool $options
	 * @return bool|string
	 * @throws \Throwable
	 */
	/*	public function show( $module = false, $options = false ) {

			$id = isset( $module->name ) ? $module->name : 'login_section__0';

			if ( isset( $module->value ) ) {
				return $module->value;
			}



			return view( 'theme:rentit::modules.LoginSection' )->with( compact( 'id' ) )->render();



		}*/


	public function show( $module = false, $options = false ) {
		$content = $this->content;
		$page = $this->page;


		$id = isset( $module->name ) ? $module->name : 'breadcrumbs__0';


		$facebook = new FacaBookLogin();
		$f_link = $facebook->getRegisterLink();

		$t_link = $this->getTwitterLink();



		if ( isset( $content{6} ) ) {
			ob_start();
			eval( '?> ' . $content . ' <?php ' );
			return ob_get_clean();
		} else {

			if ( isset( $options['type'] ) && $options['type'] == 'php' ) {
				return file_get_contents( app( 'view' )->getFinder()->find( ViewName::normalize( 'theme:rentit::modules.LoginSection' ) ) );
			}

			return view( 'theme:rentit::modules.LoginSection' )->with(
				compact( 'id', 'page', 'content' ,'f_link','t_link') )->render();

		}


	}

	/**
	 * @return array of options
	 */
	public function options() {
		return [
			'params' => array(
				[
					'type' => 'select',
					'param_name' => 'alignment',
					'title' => __( 'Select Alignment' ),
					'value' => [
						'alignment-center' => __( 'Alignment center' ),
						'alignment-left' => __( 'Alignment left' ),
						'alignment-right' => __( 'Alignment right' )
					],
				],
				[
					'title' => __( 'Page title' ),
					'type' => 'text',
					'param_name' => 'page_title',
					'value' => ''
				]
			)

		];
	}

	public function postLogin( Request $request ) {
		$auth = false;
		$credentials = $request->only( 'email', 'password' );

		if ( Auth::attempt( $credentials, $request->has( 'remember' ) ) ) {
			$auth = true; // Success
		}

		if ( $request->ajax() ) {
			return response()->json( [
				'auth' => $auth,
				'intended' => URL::previous()
			] );
		} else {
			return redirect()->intended( URL::route( 'dashboard' ) );
		}
		return redirect( URL::route( 'login_page' ) );
	}


	/**
	 * @return bool|string
	 */
	public function getTwitterLink(){
		$rentit_twiter_CONSUMER_KEY = @trim(get_theme_mod("rentit_tw_app_id"));
		$rentit_twiter_CONSUMER_SECRET = @trim(get_theme_mod("rentit_tw_app_secret"));

		if (strlen($rentit_twiter_CONSUMER_KEY) < 5 && strlen($rentit_twiter_CONSUMER_SECRET) < 5) {
			return false;
		}
		$rentit_twiter_REQUEST_TOKEN_URL = 'https://api.twitter.com/oauth/request_token';
		$rentit_twiter_AUTHORIZE_URL = 'https://api.twitter.com/oauth/authorize';
		$rentit_twiter_CALLBACK_URL = url('/').'/tw-callback';

		$rentit_twiter_URL_SEPARATOR = '&';


		$oauth_nonce = md5(uniqid(rand(), true));
		$oauth_timestamp = time();

		$params = array(
			'oauth_callback=' . urlencode($rentit_twiter_CALLBACK_URL) . $rentit_twiter_URL_SEPARATOR,
			'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY . $rentit_twiter_URL_SEPARATOR,
			'oauth_nonce=' . $oauth_nonce . $rentit_twiter_URL_SEPARATOR,
			'oauth_signature_method=HMAC-SHA1' . $rentit_twiter_URL_SEPARATOR,
			'oauth_timestamp=' . $oauth_timestamp . $rentit_twiter_URL_SEPARATOR,
			'oauth_version=1.0'
		);

		$oauth_base_text = implode('', array_map('urlencode', $params));
		$key = $rentit_twiter_CONSUMER_SECRET . $rentit_twiter_URL_SEPARATOR;
		$oauth_base_text = 'GET' . $rentit_twiter_URL_SEPARATOR . urlencode($rentit_twiter_REQUEST_TOKEN_URL) . $rentit_twiter_URL_SEPARATOR . $oauth_base_text;
		$oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));


// get token
		$params = array(
			$rentit_twiter_URL_SEPARATOR . 'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY,
			'oauth_nonce=' . $oauth_nonce,
			'oauth_signature=' . urlencode($oauth_signature),
			'oauth_signature_method=HMAC-SHA1',
			'oauth_timestamp=' . $oauth_timestamp,
			'oauth_version=1.0'
		);
		$url = $rentit_twiter_REQUEST_TOKEN_URL . '?oauth_callback=' . urlencode($rentit_twiter_CALLBACK_URL) . implode('&', $params);


		$response = file_get_contents($url);

		if ($response) {

			parse_str($response, $response);


			$oauth_token =  isset($response['oauth_token']) ?  $response['oauth_token'] : '';
			$oauth_token_secret = isset($response['oauth_token_secret']) ? $response['oauth_token'] : '';


			$_SESSION['twiter_token_secret'] = $oauth_token_secret;

			return $rentit_twiter_AUTHORIZE_URL . '?oauth_token=' . $oauth_token;
		}
	}
}