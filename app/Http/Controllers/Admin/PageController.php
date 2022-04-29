<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\PageRequest;
use Corp\Http\Requests\PostRequest;
use Corp\Page;
use Corp\Repositories\PageRepository;
use Gate;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;

class PageController extends AdminController
{
	public function __construct( PageRepository $p_rep) {
		parent::__construct(  );


	    $this->baseCms->setAdminCss('icheck',asset(config('settings.admin') .'/plugins/components/icheck/skins/square/_all.css'),[],null,10);
		$this->baseCms->setAdminCss('bootstrap-tagsinput',asset(config('settings.admin') .'/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'),[],null,10);
		$this->baseCms->setAdminCss('bootstrap-datetimepicker',asset(config('settings.admin') .'/plugins/components/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css'),[],null,10);


     	$this->baseCms->setAdminJs( 'icheck', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.js' ),array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'icheck-init', asset( config( 'settings.admin' ) . '/plugins/components/icheck/icheck.init.js' ),array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'moment-with-locales', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/moment-with-locales.min.js' ),array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'bootstrap-datetimepicker', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js' ),
			array( 'jquery','moment-with-locales' ), '2', true, 10 );
		$this->baseCms->setAdminJs( 'typeahead', asset( config( 'settings.admin' ) . '/js/typeahead.bundle.js' ),array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'tagsinput', asset( config( 'settings.admin' ) . '/plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js' ),array( 'jquery' ), '1', true, 10 );
		$this->baseCms->setAdminJs( 'tinymce', asset( config( 'settings.admin' ) . '/plugins/components/tinymce/js/tinymce/tinymce.js' ),array( 'jquery' ), '1', false, 10 );


		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

		$this->p_rep = $p_rep;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

	    if(! Gate::allows( 'VIEW_ADMIN_PAGES' )){
		    return back()->withErrors([__('You don\'t have access to change this post')]);

		    abort(403);
	    }




	    $pages = Page::with( [ 'translations','user' ] )->latest( 'created_at' );
	    if ( $request->search ) {
		    $pages = $pages->whereHas(
			    'translations',
			    function ( $query ) use ( $request ) {
				    $query->where( 'title', 'like', '%' . $request->search . '%' );
				    $query->where( 'locale', app()->getLocale() );
			    }
		    );
	    }
	    $pages = $pages->paginate(config('lararent.item_per_page',10));



	    $this->title = __('admin.Pages');

	    $content = $this->getTemplate( '.pages.all-pages' ,compact('pages','request'));


	    $this->vars = array_add( $this->vars, 'content', $content );

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
	    if(! Gate::allows( 'VIEW_ADMIN_PAGES' )){
		    return back()->withErrors([__('You don\'t have access to change this post')]);

		    abort(403);
	    }
	    $this->title = __('admin.Add Page');



	    $content = $this->getTemplate( '.pages.add-page');
	    $this->vars = array_add( $this->vars, 'content', $content );

	    return $this->renderOutput();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        //

	    if(! Gate::allows( 'ADD_PAGES' )){
		    return back()->withErrors([__('You don\'t have permission to add page')]);

		    abort(403);
	    }

	    $result = $this->p_rep->addPage( $request );



	    if ( is_array( $result ) && isset( $result['id'] ) ) {
		    return redirect( route( 'admin.pages.edit', [ 'pages' => $result['id'] ] ) )->with( $result );
	    }
	    if ( is_array( $result ) && !empty( $result['error'] ) ) {

		    return back()->with( $result );
	    }

	    return back()->with( $result );

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

	   $page= Page::with('translations')->where('id',$id)->first();


	    if(! Gate::allows( 'VIEW_ADMIN_PAGES' )){
		    return back()->withErrors([__('You don\'t have access to change this post')]);

		    abort(403);
	    }
	    $this->title = __('admin.Edit Page'). ' > '. $page->title;



	    $meta = $page->meta()->get();
	    $page_meta = [];
	    foreach ( $meta as $item ) {
		    if ( $item->value == '' ) {
			   $page_meta[$item->name] = $item->translation_value;

		    } else {
			    $page_meta[$item->name] = $item->value;
		    }

	    }



	    $content = $this->getTemplate( '.pages.add-page',compact('page','page_meta'));
	    $this->vars = array_add( $this->vars, 'content', $content );



	    return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        //
	    if(! Gate::allows( 'UPDATE_PAGES' )){
		    return back()->withErrors([__('You don\'t have permission to edit this page')]);

		    abort(403);
	    }


	    $page = Page::where('id',$id)->first();
	    $result = $this->p_rep->updatePage( $request, $page );


	    if ( is_array( $result ) && isset( $result['id'] ) ) {
		    return redirect( route( 'admin.pages.edit', [ 'pages' => $result['id'] ] ) )->with( $result );
	    }
	    if ( is_array( $result ) && !empty( $result['error'] ) ) {

		    return back()->with( $result );
	    }

	    return back()->with( $result );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page, \Illuminate\Http\Request $request)
    {
        //

	    abort_unless( Gate::allows( 'DELETE_PAGES' ), 403 );
	    $result = $this->p_rep->deletePage( $page );

	    if ( is_array( $result ) && !empty( $result['error'] ) ) {
		    if ( $request->ajax() && $request->ajax_load_page ) {
			    return json_encode( ['deleted' => true] );
		    }
		    return back()->with( $result );
	    }
	    if ( $request->ajax() ) {
		    return json_encode(   ['deleted' => true]  );
	    }
	    return redirect( '/admin' )->with( $result );

    }
}
