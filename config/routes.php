<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use Core\Router\Route;

// Authentication
Route::get('/', [AuthController::class, 'auth'])->name('users.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('users.authenticate');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');