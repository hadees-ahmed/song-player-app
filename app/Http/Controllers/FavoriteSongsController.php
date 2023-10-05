<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteSongsController extends Controller
{
    public function index(User $user)
    {
        return view('favorites', ['songs' => $user->favorites()->paginate(20)]);
    }

    public function store(Song $song)
    {
        $user = auth()->user();

        $user->favorites()->attach($song->id);

        return redirect()->back();
    }

    public function destroy(Song $song)
    {
        $user = auth()->user();

        $user->favorites()->detach($song->id);

     return redirect()->back();
    }
}
