<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $title = 'GenBook';
        $this->render('home/index', compact('title'));
    }
    public function login(): void
    {
        $title = 'Login';
        $this->render('login/login', compact('title'));
    }
}
