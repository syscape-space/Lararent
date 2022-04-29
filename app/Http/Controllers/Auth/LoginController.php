<?php

namespace Corp\Http\Controllers\Auth;

use Corp\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';
	protected $username = 'login';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->redirectTo = route( 'adminIndex' );
		$this->middleware( 'guest' )->except( 'logout' );
	}


	public function showLoginForm() {
		if ( view()->exists( 'admins.' . config( 'settings.admin' ) . '.auth.login' ) ) {
			return view( 'admins.' . config( 'settings.admin' ) . '.auth.login' );
		}
		abort( 404 );
	}

	public function username() {
		return 'login';
	}



}
