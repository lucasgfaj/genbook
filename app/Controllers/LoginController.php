<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(): void
    {
        $title = 'GenBook';
        $this->render('login/login', compact('title'));
    }
}
