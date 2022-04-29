<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/.well-known/acme-challenge/{key}', [
    'uses' => 'WellKnowController@show',
    'as' => 'WellKnowController'
] );


Route::group( [
	'prefix' => Corp\Http\Middleware\LocaleMiddleware::getLocale(),
	'middleware' => [ 'web' ]
], function () {


	/**
	 * Home pages
	 */
	Route::resource( '/', 'HomeController', [] );
	Route::get( '/index-2', [ 'uses' => 'HomeController@index2', 'as' => 'Index2' ] );
	Route::get( '/index-3', [ 'uses' => 'HomeController@index3', 'as' => 'Index3' ] );
	Route::get( '/index-4', [ 'uses' => 'HomeController@index4', 'as' => 'Index4' ] );
	Route::get( '/index-5', [ 'uses' => 'HomeController@index5', 'as' => 'Index5' ] );
	Route::get( '/index-6', [ 'uses' => 'HomeController@index6', 'as' => 'Index6' ] );

	Route::get( '/fb-callback', [
		'uses' => 'FBController@index',
		'as' => 'FBController'
	] );

	Route::get( '/tw-callback', [
		'uses' => 'TWController@index',
		'as' => 'TWController'
	] );


	//Route::get( '/contact', [ 'uses' => 'ContactController@index6', 'as' => 'Index6' ] );
	Route::get( '/coming-soon', [ 'uses' => 'MaintenanceMode@show', 'as' => 'coming-soon' ] );
	Route::get( '/index-10', [ 'uses' => 'HomeController2@index', 'as' => 'Index10' ] );
	/**
	 * Portfolio
	 */

	Route::resource( 'portfolio', 'PortfolioController', [

		'parameters' => [

			'portfolio' => 'alias'

		]
	] )->only( [
		'index',
		'show'
	] );

	Route::get( '/portfolio/cat/{cat_alias?}', [

		'uses' => 'PortfolioController@index',
		'as' => 'porCat'

	] )->where( 'cat_alias', '[\w-]+' );
	/**
	 * Posts
	 */
	Route::resource( 'posts', 'PostsController', [

		'parameters' => [

			'posts' => 'alias'

		]

	] )->only( [
		'index',
		'show'
	] );
	Route::get( '/posts/cat/{cat_alias?}', [
		'uses' => 'PostsController@index',
		'as' => 'postsCat'
	] )->where( 'cat_alias', '[\w-]+' );
	Route::get( '/posts_tag/{tag_alias?}', [
		'uses' => 'PostTagController@index',
		'as' => 'postsTag'
	] )->where( 'tag_alias', '[\w-]+' );

	/**
	 * Search
	 */
	Route::get( '/s', [ 'uses' => 'PostsController@index', 'as' => 'search' ] );

	/**
	 * Ajax
	 */

	Route::post( '/ajax/news_letter_widget', [ 'uses' => 'Ajax\MailchimpAjax@index', 'as' => 'NewsLetterWidget' ] );
	Route::post( '/ajax/send_email', [ 'uses' => 'Ajax\MailController@send', 'as' => 'SendEmail' ] );
	Route::post( '/ajax/PreviewReservation', [
		'uses' => 'Ajax\PreviewReservation@show',
		'as' => 'PreviewReservation'
	] );
	Route::get( '/demo', function () {
		return new Corp\Themes\RentIt\Mail\DemoEmail();
	} );

	/*
	 * Checkout router
	 */

	Route::get( '/checkout', [ 'uses' => 'CheckoutController@index', 'as' => 'FrontendCheckout' ] );
	Route::get( '/checkout/charge', [ 'uses' => 'CheckoutController@charge', 'as' => 'FrontendCheckoutCharge' ] );
	Route::post( '/checkout/charge', [ 'uses' => 'CheckoutController@charge', 'as' => 'FrontendCheckoutCharge' ] );
	Route::post( '/checkout/coupon', [ 'uses' => 'CheckoutController@coupon', 'as' => 'FrontendCheckoutCoupon' ] );

	/**
	 * My account
	 */

	Route::get( '/my-account/', [ 'uses' => 'MyAccountController@index', 'as' => 'MyAccount' ] );
	Route::get( '/my-account/edit', [ 'uses' => 'MyAccountController@edit', 'as' => 'MyAccountEdit' ] );
	Route::post( '/my-account/edit', [
		'uses' => 'MyAccountController@updateAccount',
		'as' => 'MyAccountUpdateAccount'
	] );
	Route::get( '/my-account/cancel-order/{id}', [
		'uses' => 'MyAccountController@cancelOrder',
		'as' => 'MyAccountCancelOrder'
	] )
	     ->where( 'id', '[0-9]+' );;


	/**
	 * Produscts
	 */


	Route::resource( '/products', 'ProductsController', [

		'parameters' => [
			'products' => 'alias'
		]
	] );
	Route::get( '/products/term/{term_alias?}', [
		'uses' => 'ProductsController@index',
		'as' => 'productTerm'
	] )->where( 'term_alias', '[\w-]+' );



// for controllers and views
	Route::get( '{page}', array( 'as' => 'pages.show', 'uses' => 'PageController@show' ) );






	Route::group( [ 'prefix' => 'admin', 'middleware' => [ 'web', 'auth' ] ], function () {


		Route::group( [ 'themes' => 'products' ], function () {


			Route::get( '/run-demo-import', [
				'uses' => 'Backend\DemoImport@index',
				'as' => 'RentItRunDemoImport'
			] );
			Route::post( '/run-demo-import', [
				'uses' => 'Backend\DemoImport@import',
				'as' => 'RentItRunDemoImport_post'
			] );

		} );


	} );


} );

