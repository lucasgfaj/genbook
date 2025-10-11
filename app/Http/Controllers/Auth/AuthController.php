<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'auth' => 'required|string',
            'password' => 'required|string',
        ]);

        // Identifica se o campo é um e-mail
        $isEmail = filter_var($request->auth, FILTER_VALIDATE_EMAIL);

        // Busca o usuário pelo email
        $user = $isEmail
            ? User::where('email', $request->auth)->first()
            : null; // se quiser login por username, adiciona depois

        if (!$user) {
            return back()->with('error', 'Usuário não encontrado.');
        }

        // Busca o staff correspondente
        $staff = Staff::where('user_id', $user->id)->first();

        if (!$staff || !Hash::check($request->password, $staff->password)) {
            return back()->with('error', 'Senha incorreta.');
        }

        // Loga o usuário manualmente
        Auth::login($user);

        // Regenera sessão
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sessão encerrada com sucesso.');
    }
}
