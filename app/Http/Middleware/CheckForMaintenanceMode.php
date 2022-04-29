<?php

namespace Corp\Http\Middleware;

use Auth;
use Closure;
use Gate;
use Illuminate\Contracts\Foundation\Application;


class CheckForMaintenanceMode {
	protected $app;

	public function __construct( Application $app ) {
		$this->app = $app;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {



		if ( get_theme_mod( 'rentit_rent_it_coming_soon', false ) == true
		     && !isset( $request->user()->id ) && $request->getPathInfo() != '/login' && $request->getPathInfo() != '/admin' ) {
			$error_ob = "\Corp\Themes\\" . session( 'lr_active_theme_slug' ) . '\Http\Controllers\MaintenanceMode';
			if ( class_exists( $error_ob ) && method_exists($error_ob,'show')  ) {
				$error_ob = new $error_ob;
				return response( $error_ob->show(), 200 );

			}

			//return response( 'Be right back!', 503 );
		}

		return $next( $request );
	}
}
