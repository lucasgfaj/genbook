<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use Core\Router\Route;

Route::get('/', [AuthController::class, 'index'])->name('users.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('users.authenticate');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'destroy'])->name('users.logout');
    Route::get('/home', [HomeController::class, 'index'])->name('users.home');
});
