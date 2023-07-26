<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index(){
        $artists = Artist::all();

        return view('dashboard',[
            'artists' => $artists
        ]);
    }
}
