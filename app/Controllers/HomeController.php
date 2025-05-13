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
}
// Compare this snippet from app/Views/home/index.php:
