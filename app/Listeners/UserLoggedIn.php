<?php

namespace App\Listeners;

use App\Events\RecordLoginTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserLoggedIn
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RecordLoginTime $event): void
    {
        $user = $event->user;
        DB::table('login_history')->insert([
            'user_id' => $user->id,
            'logged_at' => now()
            ]);
    }
}
