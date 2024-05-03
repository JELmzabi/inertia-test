<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SetLocaleMiddleware;
use App\Models\User;
use App\Notifications\UnFollowNotification;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ### Feed routes
    Route::resource('photos', PhotoController::class);
    Route::get('myphotos', [PhotoController::class, 'myPhotos'])->name('photos.myphotos');
    
});

require __DIR__.'/auth.php';


// Test
Route::get('/getuser/{user}', [UserController::class, 'getUser'])->name('getUser');

Route::post('/follow', [FollowerController::class, 'follow'])->name('follow');
Route::post('/unfollow', [FollowerController::class, 'unfollow'])->name('unfollow');

## Notifications
Route::get('/notifications', [NotificationController::class, 'index'])->name('getNotifications');


Route::get('test', function(Request $request){

    $request->user()->notify(new UnFollowNotification(User::find(2), 'index.show', ["id" => "jawada"]));
});