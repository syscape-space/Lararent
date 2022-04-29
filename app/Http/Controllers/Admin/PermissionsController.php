<?php

namespace Corp\Http\Controllers\Admin;

use Auth;
use DB;
use Gate;
use Corp\Permission;
use Corp\Role;
use Illuminate\Http\Request;

class PermissionsController extends AdminController {

	public function __construct() {

		parent::__construct();


		$this->css_path[] = '/plugins/components/datatables/jquery.dataTables.min.css';

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';


	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Permission $permission, Role $role ) {
		//
		if ( !Gate::allows( 'VIEW_USERS_PERMISSION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}


		$this->title = __('admin.permissions');
		$roles = $role->with('perms')->get();


		$cof_perm = config('settings.permission');

		$permissions = $permission->all();
		$permissions_a =$permissions->pluck('name')->toArray();


		foreach ($cof_perm as $item){
			if(!in_array($item, $permissions_a)){
				Permission::Create( [ 'name' => $item ] );
			}

		}

	//	dump(in_array('VIEW_ADMIN',$cof_perm));

		//foreach ($permissions as $per){
//			if($per->id > 77){
//				$per->delete();
//			}
			/*dump($per->name);
			dump($per->id);*/
		/*	if(!inArray($per->name,$cof_perm)){
		 dump($per->name);
				Permission::Create( [ 'name' => $per ] );
			}

		}**/




		$content = $this->getTemplate( '.users.permissions',
			[
				'permissions' => $permissions,
				'roles' => $roles
			]
		);

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
		if ( !Gate::allows( 'VIEW_USERS_PERMISSION' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$this->title = __('admin.add-permissions');

		$content = $this->getTemplate( '.users.add-role' );

		$this->vars = array_add( $this->vars, 'content', $content );
		return $this->renderOutput();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request, Role $role ) {
		//

		if ( !Gate::allows( 'EDIT_USERS_PERMISSION' ) ) {
		//	return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );
			die();

		}

		$role->name = $request->name;

		$role->save();
		$role->perms()->sync(
			$request->perms

		);
		return response()->json( $role );

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

		if ( !Gate::allows( 'EDIT_USERS_PERMISSION' ) ) {
			//	return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );
			die();

		}

		$role = Role::where( 'id', $id )->first();


		$role->perms()->sync(
			$request->perms
		);
		return response()->json( $request->perms );

		//	return json_encode($request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//

		if ( !Gate::allows( 'EDIT_USERS_PERMISSION' ) ) {
			//	return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );
			die();

		}

		if($id == 1) {
			return  response()->json( ['error' => 'you can\'t deleted super admin'] );
		}
		$role = Role::where('id', $id)->first();
		$role->perms()->sync(
			[]
		);
		if(	$role->delete()){
			return  response()->json( ['status' => 'deleted'] );
		}
		return  response()->json( ['status' => 'error'] );

	}
}
