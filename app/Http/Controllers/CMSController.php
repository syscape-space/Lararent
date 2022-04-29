<?php

namespace Corp\Http\Controllers;


use App;
use Auth;
use Corp\Http\Middleware\LocaleMiddleware;
use Eventy;
use Gate;

class CMSController extends Controller
{
    //


	protected $p_rep;
	public $baseCms;
	protected $a_rep;
	protected $menu_rep;
	protected $user;
	protected $template;
	protected $content = FALSE;
	protected $title;

	protected $vars;

	protected $frontend_css;
	protected $frontend_js;

	public function __construct() {
        $locale = LocaleMiddleware::getLocale();
        if($locale) {
            App::setLocale($locale);
        } else {
            App::setLocale(getOption('LANG', 'en'));
        }
		$this->baseCms =  App::make( 'BaseCms' );
		$this->setWidgets();



	}


	/**
	 *  register all widgets
	 */
	public function setWidgets() {


	}




}
