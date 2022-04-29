<?php

namespace  Corp\Plugins\eCommerce\Policies;

use Corp\Plugins\eCommerce\Models\Location;
use Corp\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{

	use HandlesAuthorization;

	/**
	 * Determine whether the user can view  menu item in admin area.
	 * @param User $user
	 * @return bool
	 */
	public function viewAll(User $user){

		return $user->canDo('location.viewAll');
	}
	/**
	 * Determine whether the user can view the post.
	 *
	 * @param  \Corp\User  $user
	 * @param  \Corp\Post  $post
	 * @return mixed
	 */
	public function view(User $user, Location $location)
	{
		//

		return $user->id === $location->user_id || $user->canDo('location.view');
	}

	/**
	 * Determine whether the user can create posts.
	 *
	 * @param  \Corp\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		//
		return  $user->canDo('location.create');

	}

	/**
	 * Determine whether the user can update the post.
	 *
	 * @param  \Corp\User  $user
	 * @param  \Corp\Post  $post
	 * @return mixed
	 */
	public function update(User $user, Location $location)
	{
		//


		return    $user->id === $location->user_id || $user->canDo('location.update');
	}

	/**
	 * Determine whether the user can delete the post.
	 *
	 * @param  \Corp\User  $user
	 * @param  \Corp\Post  $post
	 * @return mixed
	 */
	public function delete(User $user, Location $location)
	{
		//
		return  $user->id === $location->user_id || $user->canDo('location.delete');
	}
}
