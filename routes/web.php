<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

/**開發期間 */
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('pages', \App\Http\Controllers\PageController::class);
Route::resource('page_tags', \App\Http\Controllers\PageTagController::class);
