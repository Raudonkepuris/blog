<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\TagController;
use App\Models\Tag;

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
    return view('index');
})->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard')->middleware('can:open_dashboard');

    Route::get('/dashboard/tags/index', [TagController::class, 'index'])->name('tags.index');
    Route::get('/dashboard/tag/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::post('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');

});

Route::resource('posts', PostController::class);
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/upload', [PostImageController::class, 'upload'])->name('upload');



Auth::routes(['register'=>false]);
