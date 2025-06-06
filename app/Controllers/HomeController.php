<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class HomeController extends Controller
{
    public function index(): void
    {
        $title = 'Home';
        $user = Auth::userWithAdmin();
        $this->render('home/index', compact('title', 'user'));
    }
}
