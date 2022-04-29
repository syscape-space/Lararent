<?php

namespace Corp;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'login',
		'provider',
		'provider_id',
		'img',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function posts() {
		return $this->hasMany( 'Corp\Post' );
	}

	public function page() {
		return $this->hasMany( 'Corp\Page' );
	}

	public function portfolios() {
		return $this->hasMany( 'Corp\Portfolio' );
	}


	public function roles() {
		return $this->belongsToMany( 'Corp\Role', 'role_user' );
	}

	//  'string'  array('View_Admin','ADD_ARTICLES')
	//
	public function canDo( $permission, $require = FALSE ) {
		if ( is_array( $permission ) ) {
			foreach ( $permission as $permName ) {

				$permName = $this->canDo( $permName );
				if ( $permName && !$require ) {
					return TRUE;
				} else if ( !$permName && $require ) {
					return FALSE;
				}
			}

			return $require;
		} else {
			foreach ( $this->roles as $role ) {
				foreach ( $role->perms as $perm ) {
					//foo*    foobar
					if ( str_is( $permission, $perm->name ) ) {
						return TRUE;
					}
				}
			}
		}
	}

	// string  ['role1', 'role2']
	public function hasRole( $name, $require = false ) {
		if ( is_array( $name ) ) {
			foreach ( $name as $roleName ) {
				$hasRole = $this->hasRole( $roleName );

				if ( $hasRole && !$require ) {
					return true;
				} elseif ( !$hasRole && $require ) {
					return false;
				}
			}
			return $require;
		} else {
			foreach ( $this->roles as $role ) {
				if ( $role->name == $name ) {
					return true;
				}
			}
		}

		return false;
	}

	public function isSuperAdmin() {
		return $this->hasRole( 'Admin' );
	}

	/**
	 * @return mixed
	 */
	public function getTotalUsersPerMoth() {


		$sql = DB::select( "SELECT YEAR(created_at) as Year,
         MONTH(created_at) as Month,
         count(id) AS TotalUsers
    FROM users
GROUP BY YEAR(created_at), MONTH(created_at)
ORDER BY YEAR(created_at), MONTH(created_at);" );

		return $sql;

	}
}
