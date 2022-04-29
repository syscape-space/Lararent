<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use App;
use Cache;
use Corp\Plugins\PageBuilder\Classes\RegisterModule;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\RentItTheme;

class Error404 extends RentItTheme {
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
			->setFrontendJs( 'myscripts', asset( config( 'settings.theme' ) . '/assets/js/myscripts.js' ) );

		$this->js_path[] = '/assets/js/comment-reply.js';
		$this->js_path[] = '/assets/js/myscripts.js';


		$this->template = 'theme:rentit::layouts.full-page';

	}


	/**
	 * @return Error404|string
	 * @throws \Throwable
	 */
	 public function show(  ) {

	 //	return '33';*/
		$content = $this->getTemplate( '404',
			[] );
		$footer = $this->getTemplate( 'footer' );


		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );


		return $this->renderOutput();


	}


}
