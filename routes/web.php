<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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
