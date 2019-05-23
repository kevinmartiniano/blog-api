<?php

namespace App\Policies;

use App\User;
use App\UserType;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user type.
     *
     * @param  \App\User  $user
     * @param  \App\UserType  $userType
     * @return mixed
     */
    public function view(User $user, UserType $userType)
    {
        return true;
    }

    /**
     * Determine whether the user can create user types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the user type.
     *
     * @param  \App\User  $user
     * @param  \App\UserType  $userType
     * @return mixed
     */
    public function update(User $user, UserType $userType)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the user type.
     *
     * @param  \App\User  $user
     * @param  \App\UserType  $userType
     * @return mixed
     */
    public function delete(User $user, UserType $userType)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the user type.
     *
     * @param  \App\User  $user
     * @param  \App\UserType  $userType
     * @return mixed
     */
    public function restore(User $user, UserType $userType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user type.
     *
     * @param  \App\User  $user
     * @param  \App\UserType  $userType
     * @return mixed
     */
    public function forceDelete(User $user, UserType $userType)
    {
        return false;
    }
}
