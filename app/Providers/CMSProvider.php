<?php

namespace Corp\Providers;

use Blade;
use Corp\CMS;
use Eventy;
use Illuminate\Support\ServiceProvider;

class CMSProvider extends ServiceProvider {
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot() {
		Blade::directive( 'dynamic_sidebar', function ( $expression ) {
			return "<?php echo app('BaseCms')->dynamicSidebar($expression); ?>";
		} );


	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {

		$this->app->singleton( 'BaseCms', function ( $app ) {
			return new CMS\BaseCms();
		} );
		$this->app->singleton( 'CustomizeManager', function ( $app ) {
			return new CMS\CustomizeManager();
		} );

		require_once __DIR__ . '/../Http/helpers.php';
	}
}
