<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('home');
});

Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('login', [AuthController::class, 'doLogin']);
Route::post('register', [AuthController::class, 'doRegister']);

Route::middleware(['auth'])->group(function () {
    Route::resource('home', HomeController::class);
    Route::resource('posts', PostController::class);
    Route::resource('group', GroupController::class);
    Route::get('/group/join/{groupId}', [GroupController::class, 'joinGroup'])->name('group.join');
    Route::post('group/{group}/confirm/{member}', [GroupController::class, 'confirmMember'])->name('group.confirm');
    Route::get('/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::post('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::get('posts/status/{status}', [PostController::class, 'filter'])->name('posts.filter');
    Route::get('posts/filter/{status}', [PostController::class, 'filterTrash'])->name('posts.filtrasi');
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'show')->name('profile.show');
        Route::get('profile/edit', 'edit')->name('profile.edit');
        Route::put('profile/update', 'update')->name('profile.update');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
