<?php

namespace Corp\Http\Controllers\Admin;

use App;
use Auth;
use Cache;
use Corp\Category;
use Corp\Country;
use Corp\Http\Requests\PostRequest;
use Corp\Post;
use Corp\Repositories\CategoriesRepository;
use Corp\Repositories\PostsRepository;
use Corp\Tag;
use Gate;
use Illuminate\Http\Request;


class PostsController extends AdminController {


	public function __construct( PostsRepository $p_rep, CategoriesRepository $c_rep, Category $category ) {
		$this->middleware( 'auth' );


		parent::__construct();


		$this->baseCms->setAdminCss( 'Magnific', asset( config( 'settings.admin' ) . '/plugins/components/Magnific-Popup-master/dist/magnific-popup.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/skins/square/_all.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-tagsinput', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css' ), [], null, 10 );
		$this->baseCms->setAdminCss( 'bootstrap-datetimepicker', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css' ), [], null, 10 );


		//	$this->baseCms->setAdminJs( 'PostsController', asset( config( 'settings.admin' ) . '/js/PostsController.min.js ' ), array( 'jquery' ), '1', false, 10 );

		$this->baseCms->setAdminJs( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'icheck-init', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.init.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'moment-with-locales', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/moment-with-locales.min.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'bootstrap-datetimepicker', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js' ),
			array( 'jquery', 'moment-with-locales' ), '2', true, 10 );
		$this->baseCms->setAdminJs( 'typeahead', asset( config( 'settings.admin' ) . '/js/typeahead.bundle.js' ), array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'tagsinput', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js' ), array( 'jquery' ), '1', true, 10 );

		$this->baseCms->setAdminJs( 'tinymce', asset( config( 'settings.admin' ) . '/plugins/components/tinymce/js/tinymce/tinymce.js' ), array( 'jquery' ), '1', false, 10 );


		$this->p_rep = $p_rep;
		$this->c_rep = $c_rep;
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request, Post $post ) {
		//


		if ( !Gate::allows( 'VIEW_ADMIN_POSTS' ) ) {
			return back();
			abort( 403 );
		}


		$this->title = __( 'admin.All Posts' );
		$posts = $post->with( 'translations', 'user' )->latest( 'created_at' );

		if ( $request->search ) {
			$posts = $posts->whereHas(
				'translations',
				function ( $query ) use ( $request ) {
					$query->where( 'title', 'like', '%' . $request->search . '%' );
					$query->where( 'locale', App::getLocale() );
				}
			);
		}


		$posts = $posts->paginate( config( 'lararent.item_per_page', 10 ) );
		$content = $this->getTemplate( '.posts.all-posts', [ 'posts' => $posts, 'request' => $request ] );


		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create( Category $category ) {
		//
		if ( !Gate::allows( 'ADD_POSTS' ) ) {
			//return back();
			//abort( 403 );
		}
		$this->title = __( 'admin.Add post' );
		$this->title = 'Lararent';

		$categories = $this->c_rep->transliterateAll( $category->with( 'translations' )->get()->groupBy( 'parent_id' ) );

		$category_list = buildUlCheckboxOptions( buildTree( $categories->toArray(), 0 ) );


		$tags = Tag::with( 'translations' )->get();


		$content = $this->getTemplate( '.posts.add-post',
			[

				'category_list' => $category_list,
				'tags' => $tags,

			] );


		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( PostRequest $request ) {
		//

		if ( !Gate::allows( 'ADD_POSTS' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to store this post' ) ] );
			abort( 403 );
		}

		$result = $this->p_rep->addPost( $request );

		//	dd($result);
		if ( is_array( $result ) && isset( $result['id'] ) ) {
			return redirect( route( 'admin.posts.edit', [ 'posts' => $result['id'] ] ) )->with( $result );
		}
		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );
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
	 * Show the form for editing Post.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Category $category, $id ) {
		//

		$post = Post::with( [ 'translations', 'categories' ] )->where( 'id', $id )->first();
		$this->title = __( 'admin.Edit post' ) . ' > ' . $post->title;
		if ( !Gate::allows( 'VIEW_ADMIN_POSTS', $post ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to edit this post' ) ] );

			abort( 403 );
		}


		$categories = $this->c_rep->transliterateAll( $category->with( 'translations' )->get() );

		// we get array of categories id that attach to post you also can use array_pluck
		$post_categories = [];

		foreach ( $post->categories as $k => $v ) {
			$post_categories[] = $categories->find( $v->id )->id;


		}


		$categories = $categories->groupBy( 'parent_id' );

		$category_list = buildUlCheckboxOptions( buildTree( $categories->toArray(), 0 ), $post_categories );


		$tags = Tag::with( 'translations' )->get();
		$post_tags = $post->tags()->with( 'translations' )->get();
		$attached_tag = [];
		foreach ( $post_tags as $item ) {
			$attached_tag[] = $item->title;

		}
		$attached_tag = implode( ',', $attached_tag );

		$content = $this->getTemplate( '.posts.add-post',
			[
				'post' => $post,
				'category_list' => $category_list,
				'tags' => $tags,
				'attached_tag' => $attached_tag
			] );


		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( PostRequest $request, Post $post ) {
		//


		if ( !Gate::allows( 'UPDATE_POSTS' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to change this portfolio' ) ] );
			abort( 403 );
		}

		$result = $this->p_rep->updatePost( $request, $post );
		//dd($request);

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			return back()->with( $result );
		}

		return back()->with( $result );

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Post $post, \Illuminate\Http\Request $request ) {
		//

		abort_unless( Gate::allows( 'DELETE_POSTS' ), 403 );

		$result = $this->p_rep->deletePost( $post );

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			if ( $request->ajax() && $request->ajax_load_page ) {
				return json_encode( $request );
			}
			return back()->with( $result );
		}
		if ( $request->ajax() ) {
			return json_encode( $request );
		}
		return redirect( '/admin' )->with( $result );

	}


	public function getPosts() {
		//

		//return $this->p_rep->get('*',false,true);
		return $this->p_rep->get();


	}

	public function clone( Request $request ) {

		if ( Gate::allows( 'ADD_POSTS' ) ) {


			$post = new Post();


			$old = $post->with( 'translations', 'user', 'categories' )->where( 'id', (int) $request->posts )->first();


			list( $alias, $i ) = $this->p_rep->generateAlias( $alias ?? $old->alias );


			$request->request->add( $old->getAttributes() );
			$request->request->add( $old->translations()->first()->getAttributes() );
			$request->request->add( [ 'alias' => $alias ] );
			$request->request->add( [ 'title' => $old->title . ' ' . $i ] );


			$request->request->add( [ 'category_id' => $old->categories->pluck( 'id' )->toArray() ] );

			$meta = $old->meta()->get();
			$post_meta = [];
			foreach ( $meta as $item ) {
				if ( $item->value == '' ) {
					$post_meta[$item->name] = $item->translation_value;
					$request->request->add( [ $item->name => json_decode( $item->translation_value, true ) ?? $item->translation_value ] );
				} else {
					$request->request->add( [ $item->name => json_decode( $item->value, true ) ?? $item->value ] );
					$post_meta[$item->name] = $item->value;
				}

			}


			$result = $this->p_rep->addPost( $request );


			$post = $post->where( 'id', $result['id'] )->first();

			return $this->getTemplate( '.posts.post_item', compact( 'post' ) );
		}
	}
}
