<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'loginView'])->name('login');
  Route::post('/login', [AuthController::class, 'login'])->name('loginStore');
  Route::get('/register', [AuthController::class, 'registerView'])->name('register');
  Route::post('/register', [AuthController::class, 'register'])->name('registerStore');
});

Route::middleware('auth')->group(function() {
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  
  Route::view('/dashboard', 'auth.dashboard')->name('dashboard');
});

Route::fallback(function () {
  return to_route('dashboard');
});
