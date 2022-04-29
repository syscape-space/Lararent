<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use Cache;
use Corp\Post;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\RentItTheme;
use Request;


class BaseController extends RentItTheme {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct( PostsRepository $post_rep ) {

		parent::__construct();

		$this->post_rep = $post_rep;


	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index( $cat_alias = FALSE ) {
		//


		//$res = Cache::remember( 'index', 10, function
		// () {

		$this->title = 'Lararent';

		$posts = Post::with( 'translations')->whereNotNull( 'published_at' )
		             ->where( 'published_at', '<', new \DateTime() )
		             ->latest( 'published_at' )
		             ->get();



		$sidebar = $this->getTemplate( 'sidebar' );
		$content = $this->getTemplate( 'posts.posts-content', [ 'posts' => $posts ] );


		$footer = $this->getTemplate( 'footer' );


		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );
		$this->vars = array_add( $this->vars, 'sidebar', $sidebar );

		return $this->renderOutput();
		//return $res;
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
