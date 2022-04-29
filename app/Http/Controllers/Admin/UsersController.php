<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Corp\Repositories\RolesRepository;
use Corp\Repositories\UsersRepository;
use Corp\User;

class UsersController extends   AdminController {

	public function __construct(RolesRepository $rol_rep, UsersRepository $us_rep) {

		parent::__construct();

		$this->baseCms->setAdminCss('jquery.dataTables',asset(config('settings.admin') .'/plugins/components/datatables/jquery.dataTables.min.css'),[],null,10);

		$this->baseCms->setAdminJs( 'jquery.dataTables', asset( config( 'settings.admin' ) . '/plugins/components/datatables/jquery.dataTables.min.js"' ),array( 'jquery' ), '1', true, 10 );


		$this->us_rep = $us_rep;
		$this->rol_rep = $rol_rep;

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

	}
		/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User  $user)
    {
        //
	    if ( !Gate::allows( 'VIEW_USERS' ) ) {
		    return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
		    abort( 403 );

	    }


	    $this->title = __('admin.users');


	    $content = $this->getTemplate( '.users.all-users' ,['users' => $user->with('roles')->get()]);

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
	    //
	    if ( !Gate::allows( 'VIEW_USERS' ) ) {
		    return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
		    abort( 403 );

	    }
	    $this->title = __('admin.add new user');
	    $roles = $this->getRoles()->reduce(function ($returnRoles, $role) {
		    $returnRoles[$role->id] = $role->name;
		    return $returnRoles;
	    }, []);;

	    $content = $this->getTemplate( '.users.add-user' ,['roles' => $roles]);

	    $this->vars = array_add( $this->vars, 'content', $content );
	    return $this->renderOutput();


    }
	public function getRoles() {
		return \Corp\Role::all();
	}


	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
	    if ( !Gate::allows( 'EDIT_USERS' ) ) {
		    return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
		    abort( 403 );

	    }



	    //
	    $result = $this->us_rep->addUser($request);
	    if(is_array($result) && !empty($result['error'])) {
		    return back()->with($result);
	    }
	    return back()->with($result);

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
    public function edit(User $user)
    {
	    if ( !Gate::allows( 'VIEW_USERS' ) ) {
		    return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
		    abort( 403 );

	    }



	    $roles = $this->getRoles()->reduce(function ($returnRoles, $role) {
		    $returnRoles[$role->id] = $role->name;
		    return $returnRoles;
	    }, []);
	    $this->title = __('admin.Edit user'). ' > '. $user->name;


	    $content = $this->getTemplate( '.users.add-user', ['user' => $user, 'roles' => $roles] );

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
    public function update(UserRequest $request, User $user)
    {

	    if ( !Gate::allows( 'EDIT_USERS' ) ) {
		    return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
		   // abort( 403 );

	    }
        //
	    $result = $this->us_rep->updateUser($request,$user);

	    if(is_array($result) && !empty($result['error'])) {
		    return back()->with($result);
	    }
	    return back()->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        //
	    if ( !Gate::allows( 'EDIT_USERS' ) ) {
		    return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
		    abort( 403 );

	    }
	    $result = $this->us_rep->deleteUser($user);
	    if($request->ajax()) {
		    return json_encode($result);
	    }

	    if(is_array($result) && !empty($result['error'])) {

		    return back()->with($result);
	    }
	    return redirect(route('admin.users.index'))->with($result);
    }
}
