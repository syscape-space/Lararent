<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use App;
use Cache;
use Corp\Plugins\PageBuilder\Classes\RegisterModule;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\RentItTheme;

class PageController extends RentItTheme {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	/**
	 * @var
	 */
	public $page_id;
	public $error;


	/**
	 * PageController constructor.
	 * @param PostsRepository $page_rep
	 */
	public function __construct( PostsRepository $page_rep ) {
		parent:: __construct();


		setFrontendJs( 'comment-reply', asset( config( 'settings.theme' ) . '/assets/js/comment-reply.js' ) )
			->setFrontendJs( 'myscripts', asset( config( 'settings.theme' ) . '/assets/js/myscripts.js' ) );

		$this->js_path[] = '/assets/js/comment-reply.js';
		$this->js_path[] = '/assets/js/myscripts.js';
		$this->post_rep = $page_rep;


		$this->template = 'theme:rentit::layouts.full-page';

	}


	/**
	 * Show page
	 * @param $slug
	 * @return PageController|string
	 * @throws \Throwable
	 */
	public function show( $slug ) {


		$page = \Corp\Page::where( 'alias', $slug )->first();

		if ( is_null( $page ) ) {
			$this->error = true;
			App::abort( 404 );
		}


		$this->keywords = ( $page->keywords );
		$this->description = ( $page->meta_desc );

		$RegisterModule = RegisterModule::getInstance();
		$modules = $RegisterModule->getModules();

		//	dump( $modules );


		$this->page_id = $page->id;

		preg_match_all( '#\[module(.*?)/]#', $page->text, $math );
		if ( isset( $math[1][0]{0} ) ) {
			foreach ( $math[1] as $k => $item ) {
				//	echo $item;
				preg_match( '#name=[\',"](.*?)[\',"]#', $item, $math_att );
				//dump($math_att[1]);
				if ( isset( $modules[$math_att[1]] ) ) {
					$module = new $modules[$math_att[1]]['path'];
					preg_match( '#id=[\',"](.*?)[\',"]#', $item, $math_id );


					//	$page->text = str_replace( $math[0][$k],$module->show($math_id[1] ?? 0),$page->text);
				}
			}
		}

		//	dump( $math );

		$modules_db = $page->module()->orderBy( 'sorting', 'asc' )->get();
		//dump( $modules );
//
		foreach ( $modules_db as $module ) {
			//	dump($module->value);
			preg_match( '#(\w+)__\d+$#', $module->name, $math );
			if(isset($math[1])) {
				$module_ob = new $modules[$math[1]]['path']( $page, $module->value );
				//	dump($module->variables);

				$page->text .= $module_ob->show( $module );
			}
		}

		$content = $this->getTemplate( 'pages.single-page',
			compact( 'page' ) );
		//	$footer = $this->getTemplate( 'footer' );



		$this->vars = array_add( $this->vars, 'content', $content );


		$meta = getMetas( $page );

		if ( isset( $meta['rentit_disable_footer'] ) && $meta['rentit_disable_footer'] == 'on' ) {
			$this->vars = array_add( $this->vars, 'hide_widgets', true );
		}


		return $this->renderOutput();


	}


}
