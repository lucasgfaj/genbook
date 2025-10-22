<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Página de login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('public.auth');
})->name('login');

// Processa login
Route::post('/', [AuthController::class, 'login'])->name('auth');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas públicas
Route::view('/policies', 'public.policies')->name('policies');
Route::view('/terms', 'public.terms')->name('terms');
Route::view('/about', 'public.about')->name('about');
Route::view('/contact', 'public.contact')->name('contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.index'))->name('dashboard');

    Route::controller(BookController::class)->prefix('books')->name('books.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'create')->name('new');
        Route::post('/', 'store')->name('store');
        Route::get('/{book}', 'show')->name('show');
        Route::get('/{book}/edit', 'edit')->name('edit');
        Route::put('/{book}', 'update')->name('update');
        Route::put('/{book}/deactivate', 'deactivate')->name('deactivate');
        Route::put('/{book}/activate', 'activate')->name('activate');
        Route::delete('/{book}', 'destroy')->name('destroy');
    });

    Route::controller(AuthorController::class)->prefix('authors')->name('authors.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'create')->name('new');
        Route::post('/', 'store')->name('store');
        Route::get('/{author}', 'show')->name('show');
        Route::get('/{author}/edit', 'edit')->name('edit');
        Route::put('/{author}', 'update')->name('update');
        Route::put('/{author}/deactivate', 'deactivate')->name('deactivate');
        Route::put('/{author}/activate', 'activate')->name('activate');
        Route::delete('/{author}', 'destroy')->name('destroy');
    });

    Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'create')->name('new');
        Route::post('/', 'store')->name('store');
        Route::get('/{category}', 'show')->name('show');
        Route::get('/{category}/edit', 'edit')->name('edit');
        Route::put('/{category}', 'update')->name('update');
        Route::put('/{category}/deactivate', 'deactivate')->name('deactivate');
        Route::put('/{category}/activate', 'activate')->name('activate');
        Route::delete('/{category}', 'destroy')->name('destroy');
    });
});


// Fallback dinâmico
Route::fallback(function () {
    if (Auth::check()) {
        // Usuário logado: exibe 404 interna ou redireciona pro dashboard
        return response()->view('errors.authenticated', [
            'code' => 404,
            'message' => 'Página não encontrada dentro do sistema.'
        ], 404);
        // ou: return redirect()->route('dashboard');
    }

    // Usuário não autenticado: exibe 404 pública
    return response()->view('errors.generic', [
        'code' => 404,
        'message' => 'A página que você procura não existe.'
    ], 404);
});
