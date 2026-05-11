<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userController;

Route::middleware('api.key')->group(function () {
    Route::apiResource('todos', TodoController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('user',userController::class);
});
