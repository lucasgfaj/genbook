<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class ConfigController extends Controller
{
    public function index(): void
    {
        $title = 'Configurations';
        $user = Auth::userWithAdmin();
        $this->render('config/index', compact('title', 'user'));
    }
}
