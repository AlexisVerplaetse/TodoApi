<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('todos', TodoController::class);
Route::apiResource('events', EventController::class);
