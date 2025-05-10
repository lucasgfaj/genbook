<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property bool $is_active
 */
class User extends Model
{
    protected static string $table = 'users';
    protected static array $columns = ['full_name', 'email', 'is_active'];

    protected ?string $password = null;
    protected ?string $password_confirmation = null;

    public function validates(): void
    {
        Validations::notEmpty('full_name', $this);
        Validations::notEmpty('email', $this);

        Validations::uniqueness('email', $this);
    }

    // public function authenticate(string $password): bool
    // {
    //     if ($this->encrypted_password == null) {
    //         return false;
    //     }

    //     return password_verify($password, $this->encrypted_password);
    // }

    public static function findByEmail(string $email): User | null
    {
        return User::findBy(['email' => $email]);
    }

    // public function __set(string $property, mixed $value): void
    // {
    //     parent::__set($property, $value);

    //     if (
    //         $property === 'password' &&
    //         $this->newRecord() &&
    //         $value !== null && $value !== ''
    //     ) {
    //         $this->encrypted_password = password_hash($value, PASSWORD_DEFAULT);
    //     }
    // }
}
