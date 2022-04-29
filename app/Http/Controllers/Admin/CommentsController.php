<?php

namespace Corp\Http\Controllers\Admin;

use App;
use Auth;
use Cache;
use Corp\Category;
use Corp\Comment;
use Corp\Country;
use Corp\Http\Requests\PostRequest;
use Corp\Post;
use Corp\Repositories\CommentsRepository;
use Gate;
use Illuminate\Http\Request;


class CommentsController extends AdminController {


	public function __construct( CommentsRepository $c_rep ) {
		$this->middleware( 'auth' );


		parent::__construct();



		$this->c_rep = $c_rep;
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, Comment $comment ) {
		//


		if ( !Gate::allows( 'VIEW_COMMENTS' ) ) {
			return back();
			abort( 403 );
		}
		$comment = $comment->with('user','post','post.translations')->latest( 'created_at' );
		if ( $request->search ) {
			$comment = $comment->where( 'text', 'like', '%' . $request->search . '%' );
		}
		$comment = $comment->paginate(config('lararent.item_per_page',10));




		$this->title = __( 'admin.All comments' );

		$content = $this->getTemplate( '.comments.all-comments', [ 'comments' => $comment ,'request' =>$request] );


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
			return back();
			abort( 403 );
		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( PostRequest $request ) {
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
	 * Show the form for editing Post.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//


		$comment = new Comment();
		$comment = $comment->where( 'id', $id )->first();

		if ( !Gate::allows( 'VIEW_ADMIN_POSTS', $comment ) ) {
			return back();
			abort( 403 );
		}


		$content = $this->getTemplate( '.comments.edit-comment',
			compact( 'comment' )
		);


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
	public function update( Request $request, Comment $comment ) {
		//


		if ( !Gate::allows( 'EDIT_COMMENTS' ) ) {
			return back()->withErrors([__('You don\'t have permission to change comment')]);

			abort( 403 );
		}

		$result = $this->c_rep->updateComment( $request, $comment );
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
	public function destroy( \Illuminate\Http\Request $request, Comment $comment) {
		//

		abort_unless( Gate::allows( 'DELETE_POSTS' ), 403 );

		$result = $this->c_rep->delete( $comment );

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



}
