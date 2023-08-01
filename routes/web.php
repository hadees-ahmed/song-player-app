<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[\App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard.index');

Route::get('artists',[\App\Http\Controllers\ArtistsController::class, 'index'])
    ->name('artists.index');

Route::get('artists/{artist}/songs', [\App\Http\Controllers\SongsController::class, 'index'])
    ->name('songs.index');

Route::get('songs/create',[\App\Http\Controllers\SongsController::class, 'create'])
    ->name('songs.create');

Route::post('songs/store', [\App\Http\Controllers\SongsController::class, 'store'])
    ->name('songs.store');
