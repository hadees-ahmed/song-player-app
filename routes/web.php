<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\FavoriteSongsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ViewsController;
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
    if (! auth()->user()->is_banned) {
        return view('dashboard');
    }
    return view('users.ban');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/',[\App\Http\Controllers\DashboardController::class, 'index'])
//    ->name('dashboard.index');
Route::get('artists',[ArtistsController::class, 'index'])
    ->name('artists.index')->middleware('auth', 'subscribed');

Route::get('songs/create',[SongsController::class, 'create'])
    ->name('songs.create')
    ->middleware('auth');

Route::post('songs/store', [SongsController::class, 'store'])
    ->name('songs.store')
    ->middleware('auth','subscribed', 'unbanned');

Route::post('artists/store',[ArtistsController::class,'store'])
    ->name('artists.store')
    ->middleware('auth','subscribed', 'unbanned');

Route::post('songs/{song}/views-increment', [ViewsController::class,'increment'])
    ->name('song.view.increment');

Route::post('user/me/favorites/{song}',[FavoriteSongsController::class,'store'])
    ->name('add.favorites')
    ->middleware('auth','subscribed', 'unbanned');

Route::delete('user/me/favorites/{song}',[FavoriteSongsController::class, 'destroy'])
    ->name('remove.favorites')
    ->middleware('auth','subscribed', 'unbanned');

Route::get('user/{user}/favorites', [FavoriteSongsController::class, 'index'])
    ->name('user.favorite.songs')
    ->middleware('auth','subscribed', 'unbanned');

Route::get('songs', [SongsController::class, 'index'])
    ->name('songs.index')
    ->middleware('auth','subscribed', 'unbanned');
// search artists
Route::get('artists/search',[SongsController::class,'index'])
    ->middleware('auth','subscribed', 'unbanned');

Route::get('admin/panel', [AdminController::class, 'create'])
    ->name('admin.panel')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('songs/{song}/delete',[SongsController::class, 'destroy'])
    ->name('songs.delete')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::post('songs/{song}/update', [SongsController::class, 'update'])
    ->name('songs.update')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('songs/{song}/edit', [SongsController::class, 'edit'])
    ->name('songs.edit')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('users/index',[UsersController::class, 'index'])
    ->name('users.index')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('users/{user}/delete', [UsersController::class, 'destroy'])
    ->name('users.delete')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('users/{user}/edit',[UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('users/{user}/update',[UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('users/{user}/ban',[UsersController::class, 'ban'])
    ->name('users.ban')
    ->middleware('auth','subscribed', 'unbanned', 'admin');

Route::get('users/{user}/unban',[UsersController::class, 'unban'])
    ->name('users.unban')
    ->middleware('auth','subscribed', 'unbanned', 'admin');
require __DIR__.'/auth.php';
