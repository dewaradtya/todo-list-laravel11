<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('posts');
});

Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('login', [AuthController::class, 'doLogin']);
Route::post('register', [AuthController::class, 'doRegister']);

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::post('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::get('posts/status/{status}', [PostController::class, 'filter'])->name('posts.filter');
    Route::get('posts/filter/{status}', [PostController::class, 'filterTrash'])->name('posts.filtrasi');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
