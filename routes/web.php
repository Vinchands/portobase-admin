<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'loginView'])->name('login');
  Route::get('/register', [AuthController::class, 'registerView'])->name('register');
  Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
  Route::post('/register', [AuthController::class, 'register'])->name('registerStore');
});

Route::middleware('auth')->group(function() {
  Route::view('/dashboard', 'auth.dashboard')->name('dashboard');
});

Route::fallback(function () {
  return to_route('dashboard');
});
