<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongsController extends Controller
{
    public function index()
    {
        return view('songs.index', ['songs' => Song::paginate(20)]);
    }
}
