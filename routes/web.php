<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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
    $post = Post::all()->random();
    return view('index', compact('post'));
})->name('home');

Route::resource('posts', PostController::class);
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::resource('comments', CommentController::class);

Auth::routes(['register'=>false]);
