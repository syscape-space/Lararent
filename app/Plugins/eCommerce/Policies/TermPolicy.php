<?php

namespace  Corp\Plugins\eCommerce\Policies;

use Corp\Plugins\eCommerce\Models\Term;
use Corp\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class TermPolicy
{
    use HandlesAuthorization;

	public function viewAll(User $user){

		return $user->canDo('product.category.viewAll');
	}
    /**
     * Determine whether the user can view the Term.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Term  $Term
     * @return mixed
     */
    public function view(User $user, Term $Term)
    {
        //
	    return $user->id === $Term->user_id || $user->canDo('product.view');

    }

    /**
     * Determine whether the user can create Term.
     *
     * @param  \Corp\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the Term.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Term  $Term
     * @return mixed
     */
    public function update(User $user, Term $Term)
    {
        //
    }

    /**
     * Determine whether the user can delete the Term.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Term  $Term
     * @return mixed
     */
    public function delete(User $user, Term $Term)
    {
        //
    }
}
