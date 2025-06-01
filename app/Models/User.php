<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model
{
    protected static string $table = 'users';
    protected static array $columns = ['full_name', 'email', 'is_active', 'created_at', 'updated_at'];


    public function validates(): void
    {
        Validations::notEmpty('full_name', $this);
        Validations::notEmpty('email', $this);
        Validations::uniqueness('email', $this);
    }


    public static function findByEmail(string $email): User | null
    {
        return User::findBy(['email' => $email]);
    }
}
