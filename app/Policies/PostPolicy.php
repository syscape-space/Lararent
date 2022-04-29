<?php

namespace Corp\Policies;

use Corp\User;
use Corp\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function __construct() {

    }

	/**
     * Determine whether the user can view the post.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //

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
	    return $user->canDo('ADD_POSTS');
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        //
	    return $user->canDo('UPDATE_POSTS');
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \Corp\User  $user
     * @param  \Corp\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        //
	    return ($user->canDo('DELETE_POSTS')  && $user->id == $post->user_id);
    }
}
