<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class LoanController extends Controller
{
    public function index(): void
    {
        $title = 'Loans';
        $user = Auth::userWithAdmin();
        $this->render('loans/index', compact('title', 'user'));
    }
}
