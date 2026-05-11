<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.key')->group(function () {
    Route::apiResource('todos', TodoController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('user', UserController::class);
});
