<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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
    ->middlewareFor(['update', 'destroy'], 'auth');

Route::get('/profile', [UserController::class, 'show'])
    ->name('profile.index')
    ->middleware('auth');

Route::get('/profile/edit', [UserController::class, 'edit'])
    ->name('profile.edit')
    ->middleware('auth');

Route::get('/register', [UserController::class, 'create'])
    ->name('register');
