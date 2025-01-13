<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('webhook/line/{id}', [\App\Http\Controllers\Api\WebhookLineController::class, "line"]);
Route::get('line/image/{id}/{image}', [\App\Http\Controllers\Api\WebhookLineController::class, "image"]);

Route::get('webhook/fb/{id}', [\App\Http\Controllers\Api\WebhookFbController::class, "verify"]);
Route::post('webhook/fb/{id}', [\App\Http\Controllers\Api\WebhookFbController::class, "webhook"]);
