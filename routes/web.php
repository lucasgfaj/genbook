<?php

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

// Dashboard protegido
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.index'))->name('dashboard');
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
