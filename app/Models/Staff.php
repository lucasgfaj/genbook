<?php

namespace App\Models;

use Lib\Validations;
use App\Models\User;

/**
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property bool $is_active
 * @property string $password
 * @property string $employee_id
 * @property string $hire_date
 * @property bool $admin
 * @property int $user_id
 */
class Staff extends User
{
    protected static string $table = 'staff';
    protected static array $columns = ['user_id', 'password', 'admin', 'employee_id', 'hire_date'];

    public function validates(): void
    {
        Validations::notEmpty('password', $this);
        Validations::notEmpty('employee_id', $this);
    }

    public function user(): User
    {
        return User::findById($this->user_id);
    }

    public function authenticate(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public static function findByUserId(int $userId): ?Staff
    {
        return Staff::findBy(['user_id' => $userId]);
    }
    
    public static function isAdmin(int $user_id): bool
    {
        return Staff::findBy(['user_id' => $user_id])->admin;
    }
}
