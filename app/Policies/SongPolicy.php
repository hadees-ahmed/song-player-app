<?php

namespace App\Policies;

use App\Models\Song;
use App\Models\User;

class SongPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete()
    {
        return auth()->user()->admin_at;
    }

    public function update()
    {
        return auth()->user()->admin_at;
    }
}
