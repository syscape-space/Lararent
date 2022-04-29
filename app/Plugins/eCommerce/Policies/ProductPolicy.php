<?php

namespace  Corp\Plugins\eCommerce\Policies;

use Corp\Plugins\eCommerce\Models\Product;
use Corp\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{

	use HandlesAuthorization;

	/**
	 * Determine whether the user can view  menu item in admin area.
	 * @param User $user
	 * @return bool
	 */
	public function viewAll(User $user){

		return $user->canDo('product.viewAll');
	}
	/**
	 * Determine whether the user can view the post.
	 *
	 * @param  \Corp\User  $user
	 * @param  \Corp\Post  $post
	 * @return mixed
	 */
	public function view(User $user, Product $product)
	{
		//

		return 1;
		//return $user->id === $product->user_id || $user->canDo('product.view') || $user->canDo('product.viewAll') ;
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
		return  $user->canDo('product.create');

	}

	/**
	 * Determine whether the user can update the post.
	 *
	 * @param  \Corp\User  $user
	 * @param  \Corp\Post  $post
	 * @return mixed
	 */
	public function update(User $user, Product $product)
	{
		//


		return    $user->id === $product->user_id || $user->canDo('product.update');
	}

	/**
	 * Determine whether the user can delete the post.
	 *
	 * @param  \Corp\User  $user
	 * @param  \Corp\Post  $post
	 * @return mixed
	 */
	public function delete(User $user, Product $product)
	{
		//
		return  $user->id === $product->user_id || $user->canDo('product.delete');
	}
}
