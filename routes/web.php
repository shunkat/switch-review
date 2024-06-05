<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SwitchController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RegisterController;

Route::get('/', [SwitchController::class, 'index']);

Route::get('/switches', [SwitchController::class, 'index']);
Route::get('/switches/{id}', [SwitchController::class, 'detail']);

Route::get('/reviews/create/{id}', [ReviewController::class, 'create']);
Route::post('/reviews/store/{id}', [ReviewController::class, 'store']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisrerController::class, 'store']);