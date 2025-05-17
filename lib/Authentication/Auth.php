<?php

namespace Lib\Authentication;

use App\Models\Staff;
use App\Models\User;

class Auth
{
    public static function login($user): void
    {
        $_SESSION['user']['id'] = $user->id ?? " ";
        if ($user instanceof Staff) {
            $_SESSION['user']['admin'] = $user->admin;
        } else {
            $_SESSION['user']['admin'] = false;
        }
    }

    public static function user(): ?User
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            return User::findById($id);
        }

        return null;
    }

    public static function userWithAdmin(): mixed
    {

        $user = $_SESSION['user']['id'];
        $admin = Auth::isAdmin();
        return [
            'user' => $user,
            'admin' => $admin
        ];
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']['id']) && self::user() !== null;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
    }

    public static function isAdmin(): bool
    {
        if (!isset($_SESSION['user']['id'])) {
            return false;
        }

        return Staff::isAdmin($_SESSION['user']['id']);
    }
}
