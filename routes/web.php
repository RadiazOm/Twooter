<?php

use App\Http\Controllers\ConctactController;
use App\Http\Controllers\HomeController;
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

Route::resource('posts', PostController::class);

Route::resource('profile', ProfileController::class);

//Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
//Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/posts', [ProfileController::class, 'posts'])->name('profile.posts');
//Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


