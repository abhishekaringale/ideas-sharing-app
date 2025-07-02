<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\IdeasController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\UserController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => 'auth', 'prefix' => 'ideas/'], function () {

    Route::post('/', [IdeasController::class, 'store'])->name('ideas.store');
    Route::get('/{idea}', [IdeasController::class, 'show'])->name('ideas.show');
    Route::get('/{idea}/edit', [IdeasController::class, 'edit'])->name('ideas.edit');
    Route::put('/{idea}', [IdeasController::class, 'update'])->name('ideas.update');

    Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('idea.comments.store');

    Route::delete('/{id}', [IdeasController::class, 'destroy'])->name('ideas.destroy');
});

Route::get('/terms', function () {
    return view('terms');
})->name('terms');


Route::resource('users', UserController::class)->only(['show', 'edit', 'update'])->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::post('users/{user}/follow', [UserController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('users/{user}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::group(['middleware' => 'auth', 'prefix' => 'users/'], function () {
    // Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
});

Route::post('ideas/{idea}/like', [IdeasController::class, 'like'])->name('ideas.like')->middleware('auth');
Route::post('ideas/{idea}/unlike', [IdeasController::class, 'unlike'])->name('ideas.unlike')->middleware('auth');


//feed
Route::get('feed', FeedController::class)->name('feed')->middleware('auth');

//admin
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
});
