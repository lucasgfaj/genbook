<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class AuthorController extends Controller
{
    public function index(): void
    {
        $title = 'Authors';
        $user = Auth::userWithAdmin();
        $this->render('authors/index', compact('title', 'user'));
    }
}
