<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.06.2018
 * Time: 22:12
 */

Route::group(
	[ 'prefix' => Corp\Http\Middleware\LocaleMiddleware::getLocale(),  'middleware' => ['web','auth'] ], function () {


	Route::get( 'asfsfsdf',function (){

	})->name('page-builder');

	Route::get( '/page-builder/get-sidebar', [
		'uses' => 'PageBuilder@getSidebar',
		'as' => 'page-builder-get-sidebar'
	] );
	Route::get( '/page-builder/get-module', [
		'uses' => 'PageBuilder@getModule',
		'as' => 'page-builder-get-module'
	] );
	Route::get( '/page-builder/save', [
		'uses' => 'PageBuilder@save',
		'as' => 'page-builder-save'
	] );
	Route::post( '/page-builder/save', [
		'uses' => 'PageBuilder@save',
		'as' => 'page-builder-save'
	] );
	Route::post( '/page-builder/get_module_options', [
		'uses' => 'PageBuilder@getModuleOptions',
		'as' => 'page-builder-get_module_options'
	] );
	Route::post( '/page-builder/delete_module', [
		'uses' => 'PageBuilder@DeleteModule',
		'as' => 'page-builder-delete-module'
	] );
	Route::post( '/page-builder/save-module', [
		'uses' => 'PageBuilder@saveModule',
		'as' => 'page-builder-save-module'
	]);


} );