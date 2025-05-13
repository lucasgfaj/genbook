<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use Core\Router\Route;

// Authentication
Route::get('/', [LoginController::class, 'login'])->name('root');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
