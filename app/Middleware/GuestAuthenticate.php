<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;

class GuestAuthenticate implements Middleware
{
    public function handle(Request $request): void
    {
        if (Auth::check()) {
            header('Location: ' . route('users.home'));
            exit;
        }
    }
}
