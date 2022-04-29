<?php

namespace Corp\Policies;

use Corp\User;
use Corp\Medias;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the medias.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Medias  $medias
     * @return mixed
     */
    public function view(User $user, Medias $medias)
    {
        //
	    return $user->canDo('MEDIAS.VIEW');
    }

    /**
     * Determine whether the user can create medias.
     *
     * @param  \Corp\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
	    return $user->canDo('MEDIAS.CREATE');
    }

    /**
     * Determine whether the user can update the medias.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Medias  $medias
     * @return mixed
     */
    public function update(User $user, Medias $medias)
    {
        //
	    return $user->canDo('MEDIAS.UPDATE');
    }

    /**
     * Determine whether the user can delete the medias.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Medias  $medias
     * @return mixed
     */
    public function delete(User $user, Medias $medias)
    {
        //
	    return $user->canDo('MEDIAS.DELETE');
    }
}
