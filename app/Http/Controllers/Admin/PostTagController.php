<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\CategoryRequest;
use Corp\Repositories\TagsRepository;
use Corp\Tag;
use Gate;
use Illuminate\Http\Request;

class PostTagController extends AdminController {
	protected $tags_r;

	public function __construct( TagsRepository $tag ) {
		$this->tags_r = $tag;
		$this->middleware( 'auth' );
		parent::__construct();
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		abort_unless( Gate::allows( 'VIEW_ADMIN_POSTS' ), 403 );

		$this->title = __('admin.Post tags');

		$tags = Tag::with('translations')->get();


		$form = $this->getTemplate( 'tags.add-form' );
		$content = $this->getTemplate( '.tags.all', compact('form','tags'));
		$this->vars = array_add( $this->vars, 'content', $content );

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
	public function store( CategoryRequest $request ) {
		//

		if(Gate::allows( 'ADD_CATEGORY' )){
			//
			return back()->withErrors( [ __( 'You don\'t have permission to add tag' ) ] );

		}

		$result = $this->tags_r->addTag( $request );


		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Corp\Tag $tag
	 * @return \Illuminate\Http\Response
	 */
	public function show( Tag $tag ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Corp\Tag $tag
	 * @return \Illuminate\Http\Response
	 */
	public function edit(  $id ) {
		//



		$tag = Tag::where('id',$id)->first();

		$this->title = __('admin.Edit Tag'). ' > '. $tag->title;


		$form = $this->getTemplate( 'tags.add-form', compact('tag')  );
		$content = $this->getTemplate( '.tags.edit-tag', compact('form','tags'));


		$this->vars = array_add( $this->vars, 'content', $content );

		return $this->renderOutput();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Corp\Tag $tag
	 * @return \Illuminate\Http\Response
	 */
	public function update( CategoryRequest $request, $id) {
		//

		if(! Gate::allows( 'UPDATE_CATEGORY' )){
			//
			return back()->withErrors( [ __( 'You don\'t have permission to edit tags' ) ] );

		}
	$result = $this->tags_r->updateTag( $request, $id );


		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			return back()->with( $result );
		}

		return back()->with( $result );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Corp\Tag $tag
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(  $tag ,  Request $request ) {
		//

		if(!Gate::allows( 'DELETE_CATEGORY' )){
			//
			return back()->withErrors( [ __( 'You don\'t have permission to delete term' ) ] );
			abort(403);

		}

		$result = $this->tags_r->deleteTag( $tag );

		if ( is_array( $result ) && !empty( $result['error'] ) ) {
			if ( $request->ajax() && $request->ajax_load_page ) {
				return json_encode( $result );
			}
			return back()->with( $result );
		}
		if ( $request->ajax())  {
			return json_encode( $result );
		}
		return redirect( '/admin' )->with( $result );
	}
}
