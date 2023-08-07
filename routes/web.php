<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/',[\App\Http\Controllers\DashboardController::class, 'index'])
//    ->name('dashboard.index');
Route::get('artists',[\App\Http\Controllers\ArtistsController::class, 'index'])
    ->name('artists.index')
    ->middleware('auth');

Route::get('artists/{artist}/songs', [\App\Http\Controllers\SongsController::class, 'index'])
    ->name('songs.index')
    ->middleware('auth');

Route::get('songs/create',[\App\Http\Controllers\SongsController::class, 'create'])
    ->name('songs.create')
    ->middleware('auth');

Route::post('songs/store', [\App\Http\Controllers\SongsController::class, 'store'])
    ->name('songs.store')
    ->middleware('auth');

Route::post('artists/store',[\App\Http\Controllers\ArtistsController::class,'store'])
    ->name('artists.store')
    ->middleware('auth');

Route::post('songs/{song}/views-increment', [\App\Http\Controllers\ViewsController::class,'increment'])
    ->name('songs.views.increment')
    ->middleware('auth');

Route::get('add/{song}/favorites',[\App\Http\Controllers\FavoriteSongsController::class,'store'])
    ->name('add.favorites')
    ->middleware('auth');

Route::get('remove/{song}/favorites',[\App\Http\Controllers\FavoriteSongsController::class, 'destroy'])
    ->name('remove.favorites')
    ->middleware('auth');

require __DIR__.'/auth.php';
