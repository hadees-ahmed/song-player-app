<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function create()
    {
        return view('songs.form',['artists' => Artist::withCount('songs')->get()]);
    }

    public function store(StoreSongRequest $request)
    {
        $attributes = $request->validated();
        // Remove the 'audio' key from the array
        Arr::forget($attributes, 'audio');

        $attributes['path'] = $request->file('audio')->store('songs');

        $attributes['duration'] = 10;


        Song::create($attributes);

        return view('dashboard');

    }
}
