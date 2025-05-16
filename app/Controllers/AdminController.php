<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class AdminController extends Controller
{
    public function index(): void
    {
        $title = 'Admin Dashboard';
        $user = Auth::userWithAdmin();
        $this->render('admin/index', compact('title', 'user'));
    }
}
