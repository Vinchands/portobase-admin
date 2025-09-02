<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'loginView'])->name('login');
  Route::post('/login', [AuthController::class, 'login'])->name('login.store');
  Route::get('/register', [AuthController::class, 'registerView'])->name('register');
  Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function() {
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('/projects', ProjectController::class);
  Route::resource('/categories', CategoryController::class);
  Route::resource('/tags', TagController::class);
});

Route::fallback(function () {
  return to_route('dashboard');
});
