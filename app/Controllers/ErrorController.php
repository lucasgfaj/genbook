<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class ErrorController extends Controller
{
    public function notFound(): void
    {
        FlashMessage::danger('Página não encontrada.');

        $referer = $_SERVER['HTTP_REFERER'] ?? route('users.home');

        header('Location: ' . $referer);
        exit;
    }
}
