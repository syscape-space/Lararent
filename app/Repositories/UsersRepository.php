<?php

namespace Corp\Repositories;

use Config;
use Corp\User;
use Gate;


class UsersRepository extends Repository {


	public function __construct( User $user ) {
		$this->model = $user;

	}

	public function addUser( $request ) {


		if ( \Gate::denies( 'create', $this->model ) ) {
			abort( 403 );
		}

		$data = $request->all();

		$user = $this->model->create( [
			'name' => $data['name'],
			'login' => $data['login'],
			'email' => $data['email'],
			'password' => bcrypt( $data['password'] ),
		] );

		if ( $user ) {
			$user->roles()->attach( $data['role_id'] );
		}

		return [ 'status' => __( 'User added' ) ];

	}


	public function updateUser( $request, $user ) {






		$data = $request->all();

		if ( isset( $data['password'] ) ) {
			$data['password'] = bcrypt( $data['password'] );
		} else {
			$data['password'] = $user->password;
		}

		$user->fill( $data )->update();
		if ( isset( $data['role_id'] ) ) {
			$user->roles()->sync( [ $data['role_id'] ] );
		}

		return [ 'status' => __( 'User changed' ),'id' => $user->id ];

	}

	public function deleteUser( $user ) {

		if ( Gate::denies( 'edit', $this->model ) && !\Auth::user()->isSuperAdmin() ) {
			abort( 403 );
		}

		$user->roles()->detach();

		if ( $user->delete() ) {
			return [ 'status' => __( 'User deleted' ) ];
		}

	}


}