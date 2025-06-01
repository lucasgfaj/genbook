<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class CategoryController extends Controller
{
    public function index(): void
    {
        $title = 'Categories';
        $user = Auth::userWithAdmin();
        $this->render('categories/index', compact('title', 'user'));
    }
}
