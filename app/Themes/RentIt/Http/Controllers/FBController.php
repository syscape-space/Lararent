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
class FBController extends RentItTheme {


	/**
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function index() {
		$client_id = trim( get_theme_mod( 'rentit_fb_app_id' ) );  //
		$client_secret = trim( get_theme_mod( 'rentit_fb_app_secret' ) ); //

// $client_secret
		if ( isset( $_GET['code'] ) && strlen( $client_id ) > 5 && strlen( $client_secret ) > 5 ) {


			$redirect_uri = url( '/fb-callback' ); // Redirect URIs

			$params = array(
				'client_id' => $client_id,
				'redirect_uri' => $redirect_uri,
				'client_secret' => $client_secret,
				'code' => $_GET['code']
			);

			$url = 'https://graph.facebook.com/oauth/access_token';

			$tokenInfo = null;

			$tokem_ansver = file_get_contents( $url . '?' . http_build_query( $params ) );


			if ( json_decode( $tokem_ansver )->access_token ?? false ) {

				$params = array( 'access_token' => json_decode( $tokem_ansver )->access_token ?? '' );
				$token = json_decode( $tokem_ansver )->access_token ?? '';

				$get =
					file_get_contents( "https://graph.facebook.com/me?fields=id,name,email,birthday,gender,verified,link&access_token=${token}" );


				$userInfo = json_decode( json_encode( json_decode( $get, true ) ) );

				$user = $this->findOrCreateUser($userInfo, 'twitter' );
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

		$authUser = User::where( 'provider_id', $user->id )->first();
		if ( $authUser ) {
			return $authUser;
		}
		$authUser = User::where( 'email', $user->email )->first();
		if ( $authUser ) {
			return $authUser;
		}

		return User::create( [
			'name' => $user->name,
			'email' => $user->email,
			'provider' => $provider,
			'provider_id' => $user->id
		] );
	}

}
