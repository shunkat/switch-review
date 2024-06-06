<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SwitchController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SwitchController::class, 'index']);

Route::get('/switches', [SwitchController::class, 'index']);
Route::get('/switches/{id}', [SwitchController::class, 'detail']);

Route::get('/reviews/create/{id}', [ReviewController::class, 'create']);
Route::post('/reviews/store/{id}', [ReviewController::class, 'store']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisrerController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
