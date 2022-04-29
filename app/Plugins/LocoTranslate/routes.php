<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.06.2018
 * Time: 22:12
 */


Route::group( [ 'prefix' => Corp\Http\Middleware\LocaleMiddleware::getLocale() ], function () {

	Route::group( [ 'prefix' => 'admin', 'middleware' => [ 'web', 'auth' ] ], function () {


		Route::group( [ 'prefix' => 'translates' ], function () {
			Route::get( '/',
				[ 'uses' => 'TranslatesController@index', 'as' => 'admin.translates' ]
			);

			Route::get( '/theme/{slug}',
				[ 'uses' => 'TranslatesController@theme', 'as' => 'admin.translates.theme' ]
			);
			Route::post( '/theme/{slug}',
				[ 'uses' => 'TranslatesController@storeTheme', 'as' => 'admin.translates.theme.store' ]
			);

			Route::get( '/plugin/{slug}',
				[ 'uses' => 'TranslatesController@editPlugin', 'as' => 'admin.translates.plugin' ]
			);
			Route::post( '/plugin/{slug}',
				[ 'uses' => 'TranslatesController@storePlugin', 'as' => 'admin.translates.plugin.store' ]
			);

			Route::get( '/admin',
				[ 'uses' => 'TranslatesController@editAdmin', 'as' => 'admin.translates.admin' ]
			);
			Route::post( '/admin/store',
				[ 'uses' => 'TranslatesController@storeAdmin', 'as' => 'admin.translates.plugin.store' ]
			);
		} );

	} );

} );





