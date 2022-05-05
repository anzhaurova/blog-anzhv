<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'index']);
Route::resource('admin/posts', PostController::class);

//Route::get('/', [PostController::class, 'index']);
//Route::resource('posts', PostController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

//Route::get('/', [PostController::class, 'index'])->name('home');
//Route::get('/posts/feed', [PostFeedController::class, 'index'])->name('posts.feed');
//Route::resource('posts', PostController::class)->only('show');
//Route::resource('users', UserController::class)->only('show');
//
//Route::get('newsletter-subscriptions/unsubscribe', [NewsletterSubscriptionController::class, 'unsubscribe'])->name('newsletter-subscriptions.unsubscribe');
