<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.auth');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
