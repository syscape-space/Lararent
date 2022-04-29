<?php

namespace Corp\Themes\RentIt\Http\Controllers;


use Cache;
use Corp\Category;
use Corp\Post;
use Corp\Repositories\PostsRepository;
use Corp\Themes\RentIt\RentItTheme;
use Illuminate\Http\Request;

class PostsController extends RentItTheme {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public $post_id;
	public $cat_id;


	public function __construct( PostsRepository $post_rep ) {
		parent:: __construct();


		setFrontendJs( 'comment-reply', asset( config( 'settings.theme' ) . '/assets/js/comment-reply.js' ) )
			->setFrontendJs( 'myscripts', asset( config( 'settings.theme' ) . '/assets/js/myscripts.js' ) );

		$this->js_path[] = '/assets/js/comment-reply.js';
		$this->js_path[] = '/assets/js/myscripts.js';
		$this->post_rep = $post_rep;


		$this->template = 'theme:rentit::index';

	}


	/**
	 * For  post  list
	 * @param bool $cat_alias
	 * @return PostsController|string
	 * @throws \Throwable
	 */
	public function index(Request $request, $cat_alias = FALSE ) {
		//
		$this->title = getControllerTitle(__('Blog'));
		$page_title = __('BLOG POST PAGE');
		if ( $cat_alias != false ) {

			$this->title = getControllerTitle(__('Blog'));
			list( $posts, $cat_id , $page_title) = Cache::remember( App()->getLocale() . 'PostsController.' . $cat_alias, 10000, function () use ( $cat_alias ) {


				$category = Category::with( array(
					'posts' => function ( $query ) {
						$query->with( 'translations' )->where( 'published_at', '<', new \DateTime() )->latest( 'published_at' );
					},


				) )->where( 'alias', $cat_alias )->first();


				$page_title = $category->title;
				$posts = $category->posts->load( 'categories.translations', 'comments' );
				return [ $posts, $category->id, $page_title ];
			} );
			$this->title = getControllerTitle($page_title);
			$this->cat_id = $cat_id;
		}
		else {

			//	dd($request->s);


			if($request->s){
				$posts = Post::whereRaw( "id in(
	SELECT post_id FROM post_translations WHERE locale = 'en' AND `title` LIKE ? OR `text` LIKE ?
)",['%'.$request->s.'%','%'.$request->s .'%'])
				             ->with( 'translations', 'comments', 'categories', 'categories.translations', 'user' )
				             ->whereNotNull( 'published_at' )
				             ->where( 'published_at', '<', new \DateTime() )
				             ->latest( 'published_at' )
				             ->get();
				$page_title = __('Search result for'). ' "'. e($request->s).'"';
			} else {

				$posts = Cache::remember( App()->getLocale() . 'PostsController.post', 1000000, function () {
					$posts = Post::with( 'translations', 'comments', 'categories', 'categories.translations', 'user' )->whereNotNull( 'published_at' )
					             ->where( 'published_at', '<', new \DateTime() )
					             ->latest( 'published_at' )
					             ->get();
					return $posts;
				} );



			}




		}




		$sidebar = $this->getTemplate( 'sidebar' );

		$content = $this->getTemplate( 'posts.posts-content', [ 'posts' => $posts ] );





		$footer = $this->getTemplate( 'footer' );

		$breadcrumbs = $this->getTemplate( 'breadcrumbs', [ 'title' => $page_title  ] );

		$this->vars = array_add( $this->vars, 'breadcrumbs', $breadcrumbs );


		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );


		// get sidebar position
		if(get_theme_mod('rentit_sidebar_position') !== 'hide'){
			if ( $request->sidebar_right || get_theme_mod( 'rentit_sidebar_position' ) == 'right' ) {
				$this->vars = array_add( $this->vars, 'sidebar_right', $sidebar );
			} else {
				$this->vars = array_add( $this->vars, 'sidebar', $sidebar );
			}
		}

		return $this->renderOutput();
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
	public function show( Request $request,$post_alias ) {
		//



		$post = Post::with( 'translations', 'comments' )->where( 'alias', $post_alias )->first();
		$this->title = getControllerTitle($post->title);
		$this->keywords = ($post->keywords);
		$this->description = ($post->meta_desc);

		if ( !isset( $post->id ) ) {
			abort( 404 );

		}
		$this->post_id = $post->id;


		$rentIt_visitors = $post->meta->where( 'name', 'rentIt_visitors' )->first()->value ?? 0;


		$item = $post->meta()->updateOrCreate( [
			'name' => 'rentIt_visitors',
		], [ 'value' => ++ $rentIt_visitors ] );
		$item->save();


		$relatedPosts = Cache::remember( 'releted_post' . $post_alias, 1000, function () use ( $post ) {

			$categories = $post->categories->modelKeys();


			$relatedPosts = $post->whereHas( 'categories', function ( $q ) use ( $categories ) {
				$q->whereIn( 'categories.id', $categories );
			} )->where( 'id', '<>', $post->id )->limit(2)->get();
			$relatedPosts->load( 'translations' );
			return $this->getTemplate( 'posts.relatedPosts', compact( 'relatedPosts' ) );

		} );

		$sidebar = $this->getTemplate( 'sidebar' );

		$content = $this->getTemplate( 'posts.single-content', compact( 'post', 'relatedPosts' ) );
		$footer = $this->getTemplate( 'footer' );


		$breadcrumbs = $this->getTemplate( 'breadcrumbs', [ 'title' => 'BLOG POST PAGE' ,'list_links' =>
			" <li><a href=\"".route('posts.index')."\">".__('Blog')."</a></li>
                    <li class=\"active\">".$post->title."</li>" ] );

		$this->vars = array_add( $this->vars, 'breadcrumbs', $breadcrumbs );
		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );
		/*
		 * Get sidebar position
		 */
		if(get_theme_mod('rentit_sidebar_position') !== 'hide'){
			if ( $request->sidebar_right || get_theme_mod( 'rentit_sidebar_position' ) == 'right' ) {
				$this->vars = array_add( $this->vars, 'sidebar_right', $sidebar );
			} else {
				$this->vars = array_add( $this->vars, 'sidebar', $sidebar );
			}
		}

		return $this->renderOutput();

	}


}
