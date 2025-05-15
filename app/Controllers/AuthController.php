<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Staff;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class AuthController extends Controller
{
    protected string $layout = 'login';

    public function index(): void
    {
        $this->render('auth/auth');
    }
    public function authenticate(Request $request): void
    {
        $params = $request->getParam('user');
        $user = User::findByEmail($params['email']);
        if ($user) {
            $staff = Staff::findByUserId($user->id);
            if ($staff && $staff->authenticate($params['password'])) {
                Auth::login($staff);
                FlashMessage::success('Login realizado com sucesso!');
                $this->redirectTo(route('users.home'));
            } else {
                FlashMessage::danger('Email e/ou senha inválidos!');
                $this->redirectTo(route('users.login'));
            }
        } else {
            FlashMessage::danger('Email e/ou senha inválidos!');
            $this->redirectTo(route('users.login'));
        }
    }
    public function destroy(): void
    {
        Auth::logout();
        FlashMessage::success('Logout realizado com sucesso!');
        $this->redirectTo(route('users.login'));
    }
}
