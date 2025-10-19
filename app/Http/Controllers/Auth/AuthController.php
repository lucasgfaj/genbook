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

        $user = User::where('email', $request->auth)->first();

        if (!$user) {
            return back()->with('error', 'Usuário não encontrado.');
        }

        $staff = Staff::findByUserId($user->id);

        if (!$staff) {
            return back()->with('error', 'Conta inexistente.');
        }

        if (!$staff->is_active) {
            return back()->with('error', 'Conta inativa.');
        }

        if (!Hash::check($request->password, $staff->password)) {
            return back()->with('error', 'Senha incorreta.');
        }

        Auth::login($user);
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
