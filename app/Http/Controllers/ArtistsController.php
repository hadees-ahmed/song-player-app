<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index()
    {
        $query = Artist::withCount('songs');

        if (\request('search')){
            $query->where('name', 'like', '%' . \request('search') .'%');
        }

        $artists = $query->get();

        return view('artists',[
            'artists' => $artists
        ]);

    }

    public function store(StoreArtistRequest $request){

        Artist::where('id', $request->get('artist_id'))
            ->update(['image' => $request->file('artist_image')->store('artist-images')]);
        return redirect()->back();
    }

}
