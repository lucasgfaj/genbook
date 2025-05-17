<?php

use App\Controllers\AdminController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ErrorController;
use Core\Router\Route;

Route::get('/*', [ErrorController::class, 'notfound'])->name('error.notfound');

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('users.login');
    Route::get('/login', [AuthController::class, 'index'])->name('users.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('users.authenticate');
});
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'destroy'])->name('users.logout');
    Route::get('/home', [HomeController::class, 'index'])->name('users.home');
});
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('users.admin');
});
