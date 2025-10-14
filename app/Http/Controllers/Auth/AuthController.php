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

        \Log::info('Iniciando login', ['auth' => $request->auth]);

        $user = User::where('email', $request->auth)->first();

        if (!$user) {
            \Log::warning('Usuário não encontrado', ['auth' => $request->auth]);
            return back()->with('error', 'Usuário não encontrado.');
        }

        $staff = Staff::findByUserId($user->id);

        if (!$staff) {
            \Log::warning('Staff não encontrado', ['user_id' => $user->id]);
            return back()->with('error', 'Conta inexistente.');
        }

        if (!$staff->is_active) {
            \Log::warning('Staff inativo', ['user_id' => $user->id]);
            return back()->with('error', 'Conta inativa.');
        }

        if (!Hash::check($request->password, $staff->password)) {
            \Log::warning('Senha incorreta', ['user_id' => $user->id]);
            return back()->with('error', 'Senha incorreta.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        \Log::info('Usuário logado', [
        'id' => $user->id,
        'auth_check' => Auth::check(),
        'session_id' => session()->getId(),
        ]);

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
