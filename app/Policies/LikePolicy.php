<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Like;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the like.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Like  $like
     * @return mixed
     */
    public function view(User $user, Like $like)
    {
        return true;
    }

    /**
     * Determine whether the user can create likes.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the like.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Like  $like
     * @return mixed
     */
    public function update(User $user, Like $like)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the like.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Like  $like
     * @return mixed
     */
    public function delete(User $user, Like $like)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the like.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Like  $like
     * @return mixed
     */
    public function restore(User $user, Like $like)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the like.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Like  $like
     * @return mixed
     */
    public function forceDelete(User $user, Like $like)
    {
        return false;
    }
}
