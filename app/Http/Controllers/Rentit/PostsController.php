<?php

namespace Corp\Http\Controllers\Rentit;

use Corp\Http\Controllers\Frontend\FrontendController;
use Corp\Post;
use Corp\Repositories\PostsRepository;
use Illuminate\Http\Request;

use Corp\Category;

class PostsController extends FrontendController {
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
	public function getPosts( $alias = FALSE ) {
		$where = FALSE;

		if ( $alias ) {
			// WHERE `alias` = $alias
		//	$id = Category::select( 'id' )->where( 'alias', $alias )->first()->id;
			//WHERE `category_id` = $id
		//	$where = [ 'category_id', $id ];
		}

		$posts = $this->post_rep->get( [
			'id',
			'title',
			'alias',
			'created_at',
			'img',
			'desc',
			'user_id',
			'category_id',
			'keywords',
			'meta_desc'
		], FALSE, TRUE, $where );

		if ( $posts ) {
			$posts->load( 'user', 'category', 'comments' );
		}

		return $posts;
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
	public function show( $cat_alias  ) {
		//

		$this->title = 'Lararent';

		$post = $this->post_rep->one($cat_alias,['comments' => TRUE]);

		$sidebar = $this->getTemplate('sidebar');
		$content = $this->getTemplate('partials.single-content',['post' => $post]);


		$footer =  $this->getTemplate('footer');



		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );
		$this->vars = array_add( $this->vars, 'sidebar', $sidebar );

		return $this->renderOutput();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */


}
