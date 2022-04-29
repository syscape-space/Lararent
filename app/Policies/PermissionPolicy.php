<?php

namespace Corp\Policies;

use Corp\User;
use Corp\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Permission  $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \Corp\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Permission  $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Permission  $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        //
    }

	public function change(User $user) {

		//EDIT_PERMISSIONS
		return $user->canDo('EDIT_USERS');
	}
}
