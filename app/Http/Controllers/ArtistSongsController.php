<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Models\Artist;
use App\Models\Song;
use App\Services\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ArtistSongsController extends Controller
{
    public function index(Artist $artist)
    {
        $songs = $artist->songs()->paginate(20);

        return view('songs.index',[
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


        $attributes['path'] = $request->file('audio')->store('songs');
        $attributes['duration'] = (new Audio())->getDuration($request->file('audio')
            ->path()) ?? 0;

        // Remove the 'audio' key from the array
        Arr::forget($attributes, 'audio');

        Song::create($attributes);

        return view('dashboard');
    }
}
