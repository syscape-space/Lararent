<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Schema;

use Corp\Libraries\CustomUrlGenerator;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot( UrlGenerator $url ) {
		//
		Schema::defaultStringLength(191);


		/*if ( !config( 'lararent.is_installed' ) && ( $url->getRequest()->getMethod() == 'GET' || $url->getRequest()->getMethod() == 'POST' ) ) {
			$install = new \Corp\Http\Controllers\Admin\InstallController();

			var_dump($url->getRequest()->getMethod());
			die();

			if ( isset( $_POST['name']{0} ) ) {
				$r = $install->installCms();

				dump( $_POST );
				dump( $r );
			}

			echo $install->showInstall();
			die();

		}*/
		//   dd(config('lararent'));
//	    $hasRun = DB::table( 'migrations' )->where( 'migration', '2018_12_10_173307_create_pages_table' )->exists();
//	    dd( $hasRun );
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
		//Get route instance
		$routes = $this->app['router']->getRoutes();
		//Replace UrlGenerator with CustomUrlGenerator
		$customUrlGenerator = new CustomUrlGenerator( $routes, $this->app->make( 'request' ) );
		$this->app->instance( 'url', $customUrlGenerator );


	}
}
