<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $role
 * @property string $registration_number
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 */

class Client extends User
{
    protected static string $table = 'clients';
    protected static array $columns = ['user_id', 'role', 'registration_number', 'is_active', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function validates(): void
    {
        Validations::notEmpty('role', $this);
        Validations::notEmpty('registration_number', $this);
    }
}
