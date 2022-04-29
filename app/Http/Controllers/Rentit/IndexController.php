<?php

namespace Corp\Http\Controllers\Rentit;

use Corp\Http\Controllers\Frontend\FrontendController;
use Corp\Post;
use Corp\Repositories\PostsRepository;
use Illuminate\Http\Request;

class IndexController extends FrontendController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct( PostsRepository $post_rep ) {

		parent::__construct();

		parent::__construct();
		$this->post_rep = $post_rep;

		$this->template = 'themes.' . config( 'settings.theme' ) . '.index';

	}


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function index( $cat_alias = FALSE ) {
		//

		$this->title = 'Lararent';
		$posts = Post::whereNotNull('published_at')
		             ->where('published_at', '<', new \DateTime())
		             ->latest('published_at')
		             ->get();


		$sidebar = $this->getTemplate('sidebar');
		$content = $this->getTemplate('partials.posts-content',['posts' => $posts]);


		$footer =  $this->getTemplate('footer');



		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );
		$this->vars = array_add( $this->vars, 'sidebar', $sidebar );


		return $this->renderOutput();
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
