<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class MaterialController extends Controller
{
    public function index(): void
    {
        $title = 'GenBook';
        $user = Auth::userWithAdmin();
        $this->render('materials/index', compact('title', 'user'));
    }
}
