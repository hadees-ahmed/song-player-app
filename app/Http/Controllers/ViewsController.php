<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewsController extends Controller
{
    public function increment(Song $song)
    {
        $song->increment('views');

        return new JsonResponse(['message' => 'View count incremented successfully'], 200);
    }
}
