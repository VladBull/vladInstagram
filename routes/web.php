<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/post/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/post/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::delete('/delete/{post}', [App\Http\Controllers\PostsController::class, 'delete'])->name('posts.delete');
Route::post('/post', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
