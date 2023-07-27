<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;

class SongsController extends Controller
{
    public function index(Artist $artist)
    {
        $songs = $artist->songs;

        return view('songs',[
            'songs' => $songs,
            'artist' => $artist
        ]);
    }
}
