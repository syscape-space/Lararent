<?php

namespace Corp\Policies;

use Corp\User;
use Corp\Menu;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;
	public function before($user)
	{
		if ($user->isSuperAdmin()) {
			return true;
		}
	}
    /**
     * Determine whether the user can view the menu.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Menu  $menu
     * @return mixed
     */
    public function view(User $user, Menu $menu)
    {
        //
    }

    /**
     * Determine whether the user can create menus.
     *
     * @param  \Corp\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
	    return $user->canDo('ADD_POSTS');
    }

    /**
     * Determine whether the user can update the menu.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Menu  $menu
     * @return mixed
     */
    public function update(User $user, Menu $menu)
    {
        //
	    return $user->canDo('EDIT_MENU');
    }

    /**
     * Determine whether the user can delete the menu.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Menu  $menu
     * @return mixed
     */
    public function delete(User $user, Menu $menu)
    {
        //
	    return false;
    }
}
