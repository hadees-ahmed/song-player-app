<?php

namespace App\Policies;

use App\Models\User;

class UsersPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user)
    {
        return auth()->user()->is_admin || $user->id === auth()->user()->id;
    }

    public function ban(User $user)
    {
        return auth()->user()->is_admin;
    }

    public function unban(User $user)
    {
        return auth()->user()->is_admin;
    }
}
