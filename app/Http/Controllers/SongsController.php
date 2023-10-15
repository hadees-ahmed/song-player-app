<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use App\Services\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SongsController extends Controller
{
    public function index()
    {
        $query = Song::query();


        //load artist song
        if (!\request()->isNotFilled('artist_id')) {
            $query->where('artist_id', request()->get('artist_id'));
        }

        if (\request()->has('search')){
            $query->where('name', 'like', '%' . \request('search') .'%');
            // @info to search artist as well
//            ->orWhereHas('artist',function ($q){
//                    $q->where('name', 'like', '%' . \request('search') . '%');
//            });
        }

        //load trending
        if (\request()->has('trending')) {
            $query->latest('views');
        }

        if (\request()->filled('min_duration')){
            $seconds = minutesToSeconds(\request('min_duration'));
            $query->where('duration' ,'>=' , $seconds);
        }

        if (\request()->filled('max_duration')){
            $seconds = minutesToSeconds(\request('max_duration'));
            $query->where('duration' ,'<=' , $seconds);
        }
        $songs = $query->paginate(20);

        return view('songs.index', [
            'songs' => $songs,
            'artists' => Artist::all(),
            'filters' => [
                'artist_id' => \request()->get('artist_id'),
            ]
        ]  );
    }

    public function create()
    {
        return view('songs.form',['artists' => Artist::withCount('songs')->get()]);
    }

    public function edit(Song $song)
    {
        return view('songs.form',[
            'artists' => Artist::withCount('songs')->get(),
            'song' => $song
            ]);
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

    public function destroy(Song $song)
    {
        $this->authorize('delete', $song);
        $song->delete();
    }

    public function update(Song $song, StoreSongRequest $request)
    {
        $this->authorize('update', $song);

        $attributes['path'] = $request->file('audio')->store('songs');

        $attributes = $request->validated();

        $song->update($attributes);

        return redirect()->back();
    }
}
