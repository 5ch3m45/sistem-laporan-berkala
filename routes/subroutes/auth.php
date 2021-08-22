<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function () {
  Route::get( '/', [AuthController::class, 'index'])->name('login');
  Route::post('/login', [AuthController::class, 'login']);
  Route::get( '/logout', [AuthController::class, 'logout'])->name('logout');
  Route::post('/register', [AuthController::class, 'register']);
});