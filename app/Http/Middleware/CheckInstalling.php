<?php

namespace Corp\Http\Middleware;

use Closure;
use DB;

class CheckInstalling {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		if(!lr_is_installed() && $request->getRequestUri() != '/lr-install'){

			return redirect('/lr-install');
		}

//		if($request->getRequestUri() == '/lr-install')
//		dd( $request->getRequestUri() == '/lr-install' );
//		$hasRun = DB::table( 'migrations' )->where( 'migration', '2018_12_10_173307_create_pages_table' )->exists();
//		dd( $hasRun );
		return $next( $request );
	}
}
