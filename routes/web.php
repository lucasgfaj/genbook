<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Initial Page
Route::get('/', function () {
    return view('public.auth');
})->name('auth');

// Authentication Routes
Route::post('/auth', [LoginController::class, 'auth']);

// Public Routes
Route::view('/policies', 'public.policies')->name('policies');
Route::view('/terms', 'public.terms')->name('terms');
Route::view('/about', 'public.about')->name('about');
Route::view('/contact', 'public.contact')->name('contact');

Route::middleware(['auth'])->group(function () {
    // Protected Routes
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});

Route::fallback(function () {
    return response()->view('errors.generic', [
        'code' => 404,
        'message' => 'A página que você procura não existe.'
    ], 404);
});
