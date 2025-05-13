<?php

namespace App\Models;

use Lib\Validations;
use App\Models\User;

/**
 * @property int $id
 * @property int $user_id
 * @property string $role
 * @property string $registration_number
 */

class Client extends User
{
    protected static string $table = 'clients';
    protected static array $columns = ['user_id', 'role', 'registration_number'];

    public function validates(): void
    {
        Validations::notEmpty('role', $this);
        Validations::notEmpty('registration_number', $this);
    }
}
