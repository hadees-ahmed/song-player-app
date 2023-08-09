<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use App\Services\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SongsController extends Controller
{
    public function index()
    {
        $query = Song::query();

        //load artist song
        if (\request()->has('artist_id')) {
            $query->where('artist_id', request()->get('artist_id'));
        }

        //load trending
        if (\request()->has('trending')) {
            $query->latest('views');
        }

        $songs = $query->paginate(20);

        return view('songs.index', ['songs' => $songs]);
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
