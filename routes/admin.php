<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\FavoriteSongsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;


//Route::resource('songs', SongsController::class)
//    ->only(['destroy', 'update', 'edit', 'store']);

Route::prefix('songs')->name('songs.')->group(function () {

Route::get('{song}/delete',[SongsController::class, 'destroy'])
    ->name('delete');

Route::post('{song}/update', [SongsController::class, 'update'])
    ->name('update');

Route::get('{song}/edit', [SongsController::class, 'edit'])
    ->name('edit');

Route::post('store', [SongsController::class, 'store'])
    ->name('store');
});


Route::prefix('users')->name('users.')->group(function () {

Route::get('index',[UsersController::class, 'index'])
    ->name('index');

Route::get('{user}/delete', [UsersController::class, 'destroy'])
    ->name('delete');

Route::get('{user}/edit',[UsersController::class, 'edit'])
    ->name('edit');

Route::get('{user}/update',[UsersController::class, 'update'])
    ->name('update');

Route::get('{user}/ban',[UsersController::class, 'ban'])
    ->name('ban');

Route::get('{user}/unban',[UsersController::class, 'unban'])
    ->name('unban');
});


Route::get('/panel', [AdminController::class, 'create'])
    ->name('admin.panel');
