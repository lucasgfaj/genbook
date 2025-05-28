<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $description
 * @property bool $active
 * @property string $created_at
 */
class Penalty extends Model
{
    protected static string $table = 'penalties';
    protected static array $columns = [
        'user_id',
        'description',
        'active',
        'created_at'
    ];

    public function validates(): void
    {
        Validations::notEmpty('user_id', $this);
        Validations::notEmpty('description', $this);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
