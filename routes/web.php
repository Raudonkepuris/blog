<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\TagController;
use App\Models\Tag;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingsController;
use Illuminate\Http\Request;
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
    Route::get('/dashboard/tag/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/dashboard/tag/store', [TagController::class, 'store'])->name('tags.store');
    Route::post('/dashboard/tag/destroy/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    Route::get('/dashboard/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/dashboard/name/user/{user}/', [UserController::class, 'edit_name'])->name('user.edit_name');
    Route::post('/users/name/{user}', [UserController::class, 'update_name'])->name('users.update_name');
    Route::get('/dashboard/password/user/{user}/', [UserController::class, 'edit_psw'])->name('user.edit_psw');
    Route::post('/users/password/{user}', [UserController::class, 'update_psw'])->name('users.update_psw');
    Route::get('/dashboard/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/dashboard/user_settings/index', [UserSettingsController::class, 'index'])->name('user_settings.index');
    Route::get('/dashboard/{user}/change_username', [UserSettingsController::class, 'edit_name'])->name('user_settings.change_name');
    Route::post('/user_settings/name/{user}', [UserSettingsController::class, 'update_name'])->name('user_settings.update_name');
    Route::get('/dashboard/{user}/change_email', [UserSettingsController::class, 'edit_email'])->name('user_settings.change_email');
    Route::post('/user_settings/email/{user}', [UserSettingsController::class, 'update_email'])->name('user_settings.update_email');
    Route::get('/dashboard/{user}/change_password', [UserSettingsController::class, 'edit_psw'])->name('user_settings.change_psw');
    Route::post('/user_settings/password/{user}', [UserSettingsController::class, 'update_psw'])->name('user_settings.update_psw');

    Route::get('/logout', function (Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    });
});

Route::resource('posts', PostController::class);
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/upload', [PostImageController::class, 'upload'])->name('upload');



Auth::routes(['register'=>false]);
