<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteSongsController extends Controller
{
    public function index(User $user)
    {
        return view('songs.index', ['songs' => $user->favorites]);
    }

    public function store(Song $song)
    {
        // @TODO will add auth user when the login functionality will be created
        // $user = User::first();
        // auth()->login($user);
        $user = auth()->user();

        $user->favorites()->attach($song->id);

        return redirect()->back();
    }

    public function destroy(Song $song)
    {
//     $user = User::first();
//
//     auth()->login($user);

        $user = auth()->user();


        $user->favorites()->detach($song->id);

     return redirect()->back();
    }

}
