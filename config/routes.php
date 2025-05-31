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
use Core\Router\Router;

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
    Route::get('/books/show/{id}', [BookController::class, 'show'])->name('users.books.show');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/update/{id}', [BookController::class, 'update'])->name('books.update');
    Route::post('/books/create/', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/delete/{id}', [BookController::class, 'delete'])->name('books.delete');
    // Materials
    Route::get('/materials', [MaterialController::class, 'index'])->name('users.materials');


    // Create Author
    Route::get('/authors/new', [AuthorController::class, 'new'])->name('authors.new');
    Route::post('/authors', [AuthorController::class, 'create'])->name('authors.create');

    // List Authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/page/{page}', [AuthorController::class, 'index'])->name('authors.paginate');
    Route::get('authors/show/{id}', [AuthorController::class, 'show'])->name('authors.show');

    // Update Author
    Route::get('/authors/{id}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('authors.update');

    // Delete Author
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    // Deactivate Author
    Route::post('/authors/{id}/deactivate', [AuthorController::class, 'deactivate'])->name('authors.deactivate');


    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('users.categories');
    // Loans
    Route::get('/loans', [LoanController::class, 'index'])->name('users.loans');
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.users');
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('users.reports');
    // Config
    Route::get('/config', [ConfigController::class, 'index'])->name('users.config');
});
// Admin Routes
Route::middleware('admin')->group(function () {
    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('users.admin');
});
