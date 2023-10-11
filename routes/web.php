<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConctactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('contact', [ConctactController::class, 'index'])->name('contact');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/posts/search', [PostController::class, 'find'])->name('posts.search');

Route::resource('posts', PostController::class);

Route::get('/user/posts', [ProfileController::class, 'posts'])->name('user.posts');

Route::post('/comments/store{post}', [CommentController::class, 'store'])->name('comments.store');

Route::resource('user', ProfileController::class);

Route::get('like/toggle/{post}', [LikeController::class, 'toggle'])->name('like.toggle');




