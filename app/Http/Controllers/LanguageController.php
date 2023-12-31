<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function french(){
        session()->put('locale', 'fr');
        return redirect()->back();
    }

    public function english(){
        session()->put('locale', 'en');

        return redirect()->back();
    }
}
