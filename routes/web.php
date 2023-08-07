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

Route::post('artists/store',[\App\Http\Controllers\ArtistsController::class,'store'])
    ->name('artists.store');

Route::post('songs/{song}/views-increment', [\App\Http\Controllers\ViewsController::class,'increment'])
    ->name('songs.views.increment');

Route::get('add/{song}/favorites',[\App\Http\Controllers\FavoriteSongsController::class,'store'])
    ->name('add.favorites');

Route::get('remove/{song}/favorites',[\App\Http\Controllers\FavoriteSongsController::class, 'destroy'])
    ->name('remove.favorites');
