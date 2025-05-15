<?php

namespace Lib\Authentication;

use App\Models\Staff;
use App\Models\User;

class Auth
{
    public static function login($user): void
    {
        $_SESSION['user']['id'] = $user->id ?? " ";
    }

    public static function user(): ?User
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            return User::findById($id);
        }

        return null;
    }

    public static function staff(): ?Staff
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            return Staff::findByUserId($id);
        }
        return null;
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']['id']) && self::user() !== null;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']['id']);
    }

    public static function isAdmin(): bool
    {
        return self::staff()->isAdmin($_SESSION['user']['id']);
    }
}
