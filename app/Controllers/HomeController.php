<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class HomeController extends Controller
{
    public function index(): void
    {
        $title = 'GenBook';
        $this->render('home/index', compact('title'));
    }
    public function auth(): void
    {
        if (!Auth::check()) {
            $this->redirectTo(route('users.login'));
        }
        $this->index();
    }
}
