<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;

class ReportController extends Controller
{
    public function index(): void
    {
        $title = 'Reports';
        $user = Auth::userWithAdmin();
        $this->render('reports/index', compact('title', 'user'));
    }
}
