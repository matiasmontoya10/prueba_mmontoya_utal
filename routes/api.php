<?php

use Illuminate\Support\Facades\Route;


Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    route::get('list', [\App\Http\Controllers\AuthController::class, 'list']);
    route::post('new', [\App\Http\Controllers\AuthController::class, 'new']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

//quedó pendiente el me y el delete. ingresar en la ver. 1.1.0.
