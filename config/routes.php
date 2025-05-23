<?php

use App\Controllers\AdminController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ErrorController;
use App\Controllers\UserController;
use App\Controllers\LoanController;
use App\Controllers\ReportController;
use App\Controllers\MaterialController;
use App\Controllers\BookController;
use App\Controllers\ConfigController;
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
    Route::get('/books', [BookController::class, 'index'])->name('users.books');
    Route::get('/books/show/{id}', [BookController::class, 'show'])->name('users.books.show');
    Route::get('/materials', [MaterialController::class, 'index'])->name('users.materials');
    Route::get('/loans', [LoanController::class, 'index'])->name('users.loans');
    Route::get('/users', [UserController::class, 'index'])->name('users.users');
    Route::get('/reports', [ReportController::class, 'index'])->name('users.reports');
    Route::get('/config', [ConfigController::class, 'index'])->name('users.config');
});
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('users.admin');
});
