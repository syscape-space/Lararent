<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use App;
use Cache;
use Corp\Plugins\PageBuilder\Classes\RegisterModule;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\RentItTheme;

class MaintenanceMode extends RentItTheme {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	/**
	 * @var
	 */


	/**
	 * Error404 constructor.
	 */
	public function __construct(  ) {
		parent:: __construct();


		setFrontendJs( 'comment-reply', asset( config( 'settings.theme' ) . '/assets/js/comment-reply.js' ) )
			->setFrontendJs( 'myscripts', asset( config( 'settings.theme' ) . '/assets/js/myscripts.js' ) )
			->setFrontendJs( 'jquery-plugin', asset( config( 'settings.theme' ) . '/assets/plugins/countdown/jquery.plugin.min.js' ) )
			->setFrontendJs( 'jquery-countdown', asset( config( 'settings.theme' ) . '/assets/plugins/countdown/jquery.countdown.min.js' ) );




		$this->js_path[] = '/assets/js/comment-reply.js';
		$this->js_path[] = '/assets/js/myscripts.js';


		$this->template = 'theme:rentit::layouts.MaintenanceMode';

	}


	/**
	 * @return Error404|string
	 * @throws \Throwable
	 */
	 public function show(  ) {


		 $this->title = get_theme_mod('rentit_coming_soon_mode_title',__('Coming soon'));
		$content = $this->getTemplate( 'MaintenanceMode',
			[] );
		$footer = $this->getTemplate( 'footer' );


		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );


		return $this->renderOutput();


	}


}
