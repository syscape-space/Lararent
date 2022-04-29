<?php

namespace Corp\Http\Controllers;

class SiteController extends Controller {
	//

	protected $post_rep;
	protected $s_rep;
	protected $a_rep;
	protected $m_rep;
	protected $c_rep;

	protected $keywords;
	protected $meta_desc;
	protected $title;

	protected $template;

	protected $vars = array();

	protected $contentRightBar = FALSE;
	protected $contentLeftBar = FALSE;

	protected $bar = 'no';

	public function __construct(  ) { }

	protected function renderOutput() {



		$this->vars = array_add( $this->vars, 'bar', $this->bar );


		$this->vars = array_add( $this->vars, 'keywords', $this->keywords );
		$this->vars = array_add( $this->vars, 'meta_desc', $this->meta_desc );
		$this->vars = array_add( $this->vars, 'title', $this->title );


		//$footer = view( config( 'settings.theme' ) . '.footer' )->render();
		//$this->vars = array_add( $this->vars, 'footer', $footer );

		return view( $this->template )->with( $this->vars );
	}
}

