<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use App;
use Auth;
use Cache;
use Corp\Themes\RentIt\RentItTheme;
use Corp\User;

/**
 * Class FBController
 * @package Corp\Themes\RentIt\Http\Controllers
 */
class TWController extends RentItTheme {


	/**
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function index() {

		$rentit_twiter_CONSUMER_KEY = trim(get_theme_mod("rentit_tw_app_id"));
		$rentit_twiter_CONSUMER_SECRET = trim(get_theme_mod("rentit_tw_app_secret"));


		if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier']) && strlen($rentit_twiter_CONSUMER_KEY) > 5 && strlen($rentit_twiter_CONSUMER_SECRET) > 5) {


		
			$rentit_twiter_ACCESS_TOKEN_URL = 'https://api.twitter.com/oauth/access_token';
			$rentit_twiter_ACCOUNT_DATA_URL = 'https://api.twitter.com/1.1/users/show.json';

			$rentit_twiter_URL_SEPARATOR = '&';


			//We are preparing a signature for token access
			$oauth_token_secret = $_SESSION['twiter_token_secret'];
			$oauth_nonce = md5(uniqid(rand(), true));
			$oauth_timestamp = time();
			$oauth_token = ($_GET['oauth_token']);
			$oauth_verifier = ($_GET['oauth_verifier']);


			$oauth_base_text = "GET&";
			$oauth_base_text .= urlencode($rentit_twiter_ACCESS_TOKEN_URL) . "&";

			$params = array(
				'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY . $rentit_twiter_URL_SEPARATOR,
				'oauth_nonce=' . $oauth_nonce . $rentit_twiter_URL_SEPARATOR,
				'oauth_signature_method=HMAC-SHA1' . $rentit_twiter_URL_SEPARATOR,
				'oauth_token=' . $oauth_token . $rentit_twiter_URL_SEPARATOR,
				'oauth_timestamp=' . $oauth_timestamp . $rentit_twiter_URL_SEPARATOR,
				'oauth_verifier=' . $oauth_verifier . $rentit_twiter_URL_SEPARATOR,
				'oauth_version=1.0'
			);

			$key = $rentit_twiter_CONSUMER_SECRET . $rentit_twiter_URL_SEPARATOR . $oauth_token_secret;
			$oauth_base_text = 'GET' . $rentit_twiter_URL_SEPARATOR . urlencode($rentit_twiter_ACCESS_TOKEN_URL) . $rentit_twiter_URL_SEPARATOR . implode('', array_map('urlencode', $params));
			$oauth_signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

			// получаем токен доступа
			$params = array(
				'oauth_nonce=' . $oauth_nonce,
				'oauth_signature_method=HMAC-SHA1',
				'oauth_timestamp=' . $oauth_timestamp,
				'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY,
				'oauth_token=' . urlencode($oauth_token),
				'oauth_verifier=' . urlencode($oauth_verifier),
				'oauth_signature=' . urlencode($oauth_signature),
				'oauth_version=1.0'
			);
			$url = $rentit_twiter_ACCESS_TOKEN_URL . '?' . implode('&', $params);



			$response = file_get_contents($url);
			if ($response) {
				
				parse_str($response, $response);


				// формируем подпись для следующего запроса
				$oauth_nonce = md5(uniqid(rand(), true));
				$oauth_timestamp = time();

				$oauth_token = $response['oauth_token'];
				$oauth_token_secret = $response['oauth_token_secret'];
				$screen_name = $response['screen_name'];

				$params = array(
					'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY . $rentit_twiter_URL_SEPARATOR,
					'oauth_nonce=' . $oauth_nonce . $rentit_twiter_URL_SEPARATOR,
					'oauth_signature_method=HMAC-SHA1' . $rentit_twiter_URL_SEPARATOR,
					'oauth_timestamp=' . $oauth_timestamp . $rentit_twiter_URL_SEPARATOR,
					'oauth_token=' . $oauth_token . $rentit_twiter_URL_SEPARATOR,
					'oauth_version=1.0' . $rentit_twiter_URL_SEPARATOR,
					'screen_name=' . $screen_name
				);
				$oauth_base_text = 'GET' . $rentit_twiter_URL_SEPARATOR . urlencode($rentit_twiter_ACCOUNT_DATA_URL) . $rentit_twiter_URL_SEPARATOR . implode('', array_map('urlencode', $params));

				$key = $rentit_twiter_CONSUMER_SECRET . '&' . $oauth_token_secret;
				$signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

				// get user data
				$params = array(
					'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY,
					'oauth_nonce=' . $oauth_nonce,
					'oauth_signature=' . urlencode($signature),
					'oauth_signature_method=HMAC-SHA1',
					'oauth_timestamp=' . $oauth_timestamp,
					'oauth_token=' . urlencode($oauth_token),
					'oauth_version=1.0',
					'screen_name=' . $screen_name,

				);

				$url = $rentit_twiter_ACCOUNT_DATA_URL . '?' . implode($rentit_twiter_URL_SEPARATOR, $params);


				$response = file_get_contents($url);
				if(!isset($response{1})) return;

				$user_data = json_decode($response, true);


				$user = $this->findOrCreateUser( $user_data, 'faccebock' );
				Auth::login( $user );
				return redirect( '/' );









			}
		}


	}

	/**
	 * @param $user
	 * @param $provider
	 * @return mixed
	 */
	public function findOrCreateUser( $user, $provider ) {



		$authUser = User::where( 'provider_id', $user['id'] )->first();
		if ( $authUser ) {
			return $authUser;
		}
		$authUser = User::where( 'email', $user['email'] ?? '' )->first();
		if ( $authUser ) {
			return $authUser;
		}
		return User::create( [
			'name' => $user['name'],
			'email' => $user['email'] ?? $user['screen_name'].'@twitter.com' ,
			'login' => $user['screen_name'] ?? '',
			'provider' => $provider,
			'provider_id' => $user['id']
		] );
	}

}
