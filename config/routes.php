<?php

use App\Controllers\AdminController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ErrorController;
use App\Controllers\UserController;
use App\Controllers\LoanController;
use App\Controllers\ReportController;
use App\Controllers\MaterialController;
use App\Controllers\AuthorController;
use App\Controllers\CategoryController;
use App\Controllers\BookController;
use App\Controllers\ConfigController;
use Core\Router\Route;

// Error Routes
Route::get('/*', [ErrorController::class, 'notfound'])->name('error.notfound');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login and Authentication
    Route::get('/', [AuthController::class, 'index'])->name('users.login');
    Route::get('/login', [AuthController::class, 'index'])->name('users.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('users.authenticate');
});
// User Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::get('/logout', [AuthController::class, 'destroy'])->name('users.logout');
    // Home or Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('users.home');
    //Books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    // Materials
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');

    // Create Author
    Route::get('/authors/new', [AuthorController::class, 'new'])->name('authors.new');
    Route::post('/authors', [AuthorController::class, 'create'])->name('authors.create');

    // List Authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/page/{page}', [AuthorController::class, 'index'])->name('authors.paginate');
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

    // Deactivate Author
    Route::put('/authors/{id}/deactivate', [AuthorController::class, 'deactivate'])->name('authors.deactivate');

    // Update Author
    Route::get('/authors/{id}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('authors.update');

    // Delete Author
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');




    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    // Loans
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    // Config
    Route::get('/config', [ConfigController::class, 'index'])->name('config.index');
});
// Admin Routes
Route::middleware('admin')->group(function () {
    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('users.admin');
});
