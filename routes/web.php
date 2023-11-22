<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\FavoriteSongsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\SubscriptionController;
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

Route::get('/dashboard', function () {
    if (! auth()->user()->banned_at) {
        return view('dashboard');
    }
    return view('users.ban');
})->middleware( 'verified', 'setLocale')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//Route::get('/',[\App\Http\Controllers\DashboardController::class, 'index'])
//    ->name('dashboard.index');

Route::prefix('songs')->name('songs.')->group(function () {

    Route::get('create', [SongsController::class, 'create'])
        ->name('create');

    Route::post('{song}/views-increment', [ViewsController::class, 'increment'])
        ->name('view.increment');

    Route::get('/', [SongsController::class, 'index'])
        ->name('index');
});

Route::post('songs/{song}/ratings', [RatingsController::class, 'store'])
    ->name('ratings.store');


Route::prefix('user')->group(function () {

    Route::post('me/favorites/{song}', [FavoriteSongsController::class, 'store'])
        ->name('add.favorites');


    Route::delete('me/favorites/{song}', [FavoriteSongsController::class, 'destroy'])
        ->name('remove.favorites');

    Route::get('{user}/favorites', [FavoriteSongsController::class, 'index'])
        ->name('user.favorite.songs');
});


Route::prefix('artists')->group(function () {

// search artists
    Route::get('search', [SongsController::class, 'index']);

    Route::get('/', [ArtistsController::class, 'index'])
        ->name('artists.index');

    Route::post('store', [ArtistsController::class, 'store'])
        ->name('artists.store');
});

Route::get('/subscriptions', [SubscriptionController::class, 'create']);

Route::post('subscriptions/{method}/store', [SubscriptionController::class, 'store'])
    ->name('subscribe.store');

Route::get('subscriptions/confirm', [SubscriptionController::class, 'confirm'])
    ->name('subscriptions.confirm');

Route::get('products',[ProductsController::class, 'index']);

Route::post('orders/{product}/store',[OrdersController::class, 'store'])
    ->name('orders.store');

Route::POST('orders/{product}',[OrdersController::class, 'destroy'])
    ->name('orders.destroy');

Route::get('basket/index', [OrdersController::class , 'index'])->name('orders.basket');

require __DIR__.'/auth.php';
//require __DIR__.'/admin.php';
