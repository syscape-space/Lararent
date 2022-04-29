<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2018
 * Time: 12:04
 */

namespace Corp\Themes\RentIt\Classes;



use URL;

/**
 * Menu walker it's build theme header menu
 * Class MenuWalker
 * @package Corp\Themes\RentIt\Classes
 */
class FacaBookLogin {
	public function __construct() {


	}

	public function getRegisterLink() {

		$client_id = trim( get_theme_mod( 'rentit_fb_app_id' ) );  //
		$client_secret =trim( get_theme_mod( 'rentit_fb_app_secret' ) ); //

		//in not exits id app facebook
		if ( strlen( $client_id ) < 5 && strlen( $client_secret ) < 5 ) {
			return false;
		}
		$redirect_uri = url('/fb-callback'); //url( '/' ).'/'; // Redirect URIs
		$url_f = 'https://www.facebook.com/dialog/oauth';
		//	$url_f = 'https://lararent.alfafox.site/dialog/oauth';

		$params = array(
			'client_id' => $client_id,
			'redirect_uri' => $redirect_uri,
			'response_type' => 'code',
			'scope' => 'email'
		);

		return $url_f . '?&fields=email,gender,name&' . urldecode( http_build_query( $params ) );



	}

}