<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index(){
        $artists = Artist::all();

        return view('artists',[
            'artists' => $artists
        ]);
    }

    public function store(Request $request){

        $request->file('artist_image')->store('artist-images');

        Artist::where('id', $request->get('artist_id'))->update(['image' => $request->file('artist_image')->store('artist-images')]);

        return redirect()->back();
    }
}
