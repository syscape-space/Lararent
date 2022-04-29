<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.08.2018
 * Time: 11:31
 */

namespace Corp\Plugins\PageBuilder;


use Auth;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Foundation\Application;
use V\Plugins\Plugin;

class PageBuilderPlugin extends Plugin {
	public $name = 'CustomizePlugin';
	public $registerModule;


	public function boot() {
		// TODO: Implement boot() method.
		$this->enableRoutes();
		$this->enableViews();

/// we wait for user auth
		app()['events']->listen( Authenticated::class, function ( $e ) {

			if ( $e->user->isSuperAdmin() ) {
				$this->
				baseCms->setFrontendJs( 'page-builder-live-edit', asset( 'plugins\PageBuilder\js\LiveEdit.js' ) )
				       ->localizedFrontendJs( 'page-builder-live-edit', 'page_builder_obj',
					       [
						       'get_html' => route( 'page-builder-get-sidebar' ),
						       'get_module' => route( 'page-builder-get-module' ),
						       'save' => route( 'page-builder-save' ),
						       'get_module_options' => route( 'page-builder-get_module_options' ),
						       'delete_module' => route( 'page-builder-delete-module' ),
						       'save_module' => route( 'page-builder-save-module' ),

					       ]
				       );
				$this->
				baseCms
					->setFrontendCss( 'page-builder-live-edit', asset( 'plugins\PageBuilder\css\LiveEdit.css' ) );


				$this->
				baseCms->setFrontendJs( 'page-builder-codemirror', asset( 'plugins/PageBuilder/ace/ace.js'))

				;


			}

		} );


	}




	public function permission() {
		// TODO: Implement permission() method.
	}
}