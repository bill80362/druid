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
Route::resource('goods', \App\Http\Controllers\GoodsController::class)->parameters([
    "goods" => "goods:id",
]);
Route::resource('specs', \App\Http\Controllers\SpecController::class);
Route::resource('spec_options', \App\Http\Controllers\SpecOptionController::class);
Route::resource('goods_details', \App\Http\Controllers\GoodsDetailController::class);
Route::resource('legal_attest_letters', \App\Http\Controllers\LegalAttestLetterController::class);
