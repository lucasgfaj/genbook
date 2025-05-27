<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $role
 * @property string $registration_number
 */

class Client extends Model
{
    protected static string $table = 'clients';
    protected static array $columns = ['user_id', 'role', 'registration_number'];

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
