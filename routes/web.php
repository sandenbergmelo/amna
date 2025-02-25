<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
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

Route::get('/profile/delete/{user}', [UserController::class, 'delete'])
    ->name('profile.delete')
    ->middleware('auth');

Route::get('/register', [UserController::class, 'create'])
    ->name('register');

Route::get('/dashboard', [DashBoardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::resource('news', NewsController::class)
    ->except(['show', 'edit', 'update', 'delete'])
    ->middleware('auth')
    ->withoutMiddlewareFor('index', 'auth');


Route::get('/news/edit/{news}', [NewsController::class, 'edit'])
    ->name('news.edit')
    ->middleware('auth');

Route::patch('/news/update/{news}', [NewsController::class, 'update'])
    ->name('news.update')
    ->middleware('auth');

Route::get('/news/delete/{news}', [NewsController::class, 'delete'])
    ->name('news.delete')
    ->middleware('auth');

Route::resource('events', EventController::class)
    ->except(['show', 'edit', 'update', 'delete'])
    ->middleware('auth')
    ->withoutMiddlewareFor('index', 'auth');

Route::get('/events/edit/{event}', [EventController::class, 'edit'])
    ->name('events.edit')
    ->middleware('auth');

Route::patch('/events/update/{event}', [EventController::class, 'update'])
    ->name('events.update')
    ->middleware('auth');

Route::get('/events/delete/{event}', [EventController::class, 'delete'])
    ->name('events.delete')
    ->middleware('auth');

Route::resource('event-registration', EventRegistrationController::class)
    ->only(['store', 'destroy'])
    ->middleware('auth');

Route::get('/event-registration/create/{event}', [EventRegistrationController::class, 'create'])
    ->name('event-registration.create')
    ->middleware('auth');

Route::put('/event-registration/update/{id}', [EventRegistrationController::class, 'update'])
    ->name('event-registration.update')
    ->middleware('auth');

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

Route::get('/sobre', [HomeController::class, 'about'])
    ->name('about');
