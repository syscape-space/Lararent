<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.08.2018
 * Time: 11:26
 */

namespace Corp\Themes\RentIt\Http\Controllers\Ajax;


use Corp\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MailchimpAjax extends Controller {

	public function index( Request $request ) {

		$key = $request->key  ?? get_theme_mod('rent_it_MailChimp_key');
		$id = $request->id  ?? get_theme_mod('rent_it_MailChimp_id');
		//get api kode
		preg_match( "/(.*?)-(us..)/", ($key ), $math );
		@$api_key = ( isset( $math[1] ) ) ? $math[1] : "";
		if ( @strlen( $math[1] ) < 10 ) {
			echo( ( 'You have incorrect API key ' ) );
			exit;
			die();

		}
		if ( isset( $math[2] ) && strlen( $math[2] ) < 1 ) {
			echo( ( 'You have incorrect dc ' ) );
			exit;
			die();
		}
		$list_id = ( $id );
		if ( strlen( $list_id ) < 5 ) {
			echo( 'You have incorrect id list ' );
			exit;
			die();
		}


		$api_key =$key;

		$data = array(
			'apikey' =>$key,
			'email_address' => $request->email,
			'status' => 'pending',
			'merge_fields' => ''
		);


		$mch_api = curl_init(); // initialize cURL connection

		curl_setopt( $mch_api, CURLOPT_URL, 'https://' . substr( $api_key, strpos( $api_key, '-' ) + 1 ) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5( strtolower( $data['email_address'] ) ) );
		curl_setopt( $mch_api, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Basic ' . base64_encode( 'user:' . $api_key )
		) );
		curl_setopt( $mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0' );
		curl_setopt( $mch_api, CURLOPT_RETURNTRANSFER, true ); // return the API response
		curl_setopt( $mch_api, CURLOPT_CUSTOMREQUEST, 'PUT' ); // method PUT
		curl_setopt( $mch_api, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $mch_api, CURLOPT_POST, true );
		curl_setopt( $mch_api, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $mch_api, CURLOPT_POSTFIELDS, json_encode( $data ) ); // send data in json

		$result = json_decode( curl_exec( $mch_api ) );

//  email_address
		if ( isset( $result->error ) ) {
			return ( $result->error );
		} elseif ( isset( $result->email_address ) ) {
			return ( 'Email Submitted! You subscribe as  ' ) . ( $result->email_address );
		}

		return false;

	}
}