<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Song;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function store(Song $song)
    {
        Rating::create([
            'stars' => \request('stars'),
            'user_id' => auth()->id(),
            'song_id' => $song->id
        ]);

        return redirect()->back();
    }
}
