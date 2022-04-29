<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.06.2018
 * Time: 22:12
 */

Route::group( [ 'prefix' => Corp\Http\Middleware\LocaleMiddleware::getLocale() ], function () {

	Route::group( [ 'prefix' => 'admin', 'middleware' => [ 'web', 'auth' ] ], function () {


		Route::group( [ 'prefix' => 'products' ], function () {


			Route::resource( 'categories', 'CategoryController', [
				'as' => 'admin.products'
			] );


		} );
		Route::group( [ 'prefix' => 'ecommerce' ], function () {

			Route::resource( 'orders', 'OrdersController', [
				'as' => 'admin.products'
			] );
			Route::resource( 'settings', 'SettingsController', [
				'as' => 'admin.ecommerce'
			] );
			Route::resource( 'payment', 'PaymentSettingsController', [
				'as' => 'admin.ecommerce'
			] );
			Route::resource( 'email', 'EmailSettingsController', [
				'as' => 'admin.ecommerce'
			] );

			Route::resource( 'coupons', 'CouponsController', [
				'as' => 'admin.ecommerce'
			] );


		} );
		Route::resource( 'products', 'ProductController', [
			'as' => 'admin'
		] );
		Route::resource( 'locations', 'LocationController', [
			'as' => 'admin'
		] );


		Route::post( 'product/clone', 'ProductController@clone' )->name( 'admin.product.clone' );

		Route::get( 'reports', [
				'uses' => 'ReportsController@index',
				'as' => 'adminReports',
			]
		);



	} );
	Route::post( 'gateway/paynotify', [
		'uses' => 'PayNotifyController@index',
		'as' => 'PayNotifyController',
	] );


	Route::group( [ 'prefix' => 'gateway', 'middleware' => [ 'web'] ], function () {

		Route::match( [ 'get', 'post' ], '/paynotify', [
				'uses' => 'PayNotifyController@index',
				'as' => 'PayNotifyController',
			]
		);
		Route::match( [ 'get', 'post' ], '/paynotify/cancel', [
			'uses' => 'PayNotifyController@cancel',
			'as' => 'PayCancel',
		] );

		Route::match( [ 'get', 'post' ], '/paynotify/ok', [
			'uses' => 'PayNotifyController@ok',
			'as' => 'PayOk',
		] );


	});

} );
Route::get('mailable', function () {

	$object = new \stdClass();
	$object->subject = 'subject';
	$object->email = 'email';
	$object->name = 'name';
	$object->payment  = 'payment ';
	return new \Corp\Plugins\eCommerce\Emails\OrdersEmail($object, 1);
});



