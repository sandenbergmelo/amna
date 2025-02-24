<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('logout');
});

Route::resource('users', UserController::class)
    ->except(['show', 'create'])
    ->middlewareFor(['update', 'destroy', 'delete'], 'auth');

Route::get('/profile', [UserController::class, 'show'])
    ->name('profile.index')
    ->middleware('auth');

Route::get('/profile/edit', [UserController::class, 'edit'])
    ->name('profile.edit')
    ->middleware('auth');

Route::patch('/profile/update-photo/{user}', [UserController::class, 'updatePhoto'])
    ->name('profile.update-photo')
    ->middleware('auth');

Route::get('/profile/delete/{user}', [UserController::class, 'destroy'])
    ->name('profile.delete')
    ->middleware('auth');

Route::get('/register', [UserController::class, 'create'])
    ->name('register');


Route::resource('news', NewsController::class)
    ->except(['show', 'edit', 'update'])
    ->middleware('auth');

Route::get('/news/{news}/edit', [NewsController::class, 'edit'])
    ->name('news.edit')
    ->middleware('auth');

Route::patch('/news/{news}', [NewsController::class, 'update'])
    ->name('news.update')
    ->middleware('auth');


Route::get('/dashboard', [DashBoardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');
