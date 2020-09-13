<?php

namespace App\Policies;

use App\Model\User;
use App\Model\UserType;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user type.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\UserType  $userType
     * @return mixed
     */
    public function view(User $user, UserType $userType)
    {
        return true;
    }

    /**
     * Determine whether the user can create user types.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the user type.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\UserType  $userType
     * @return mixed
     */
    public function update(User $user, UserType $userType)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the user type.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\UserType  $userType
     * @return mixed
     */
    public function delete(User $user, UserType $userType)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the user type.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\UserType  $userType
     * @return mixed
     */
    public function restore(User $user, UserType $userType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user type.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\UserType  $userType
     * @return mixed
     */
    public function forceDelete(User $user, UserType $userType)
    {
        return false;
    }
}
