<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $description
 * @property bool $readed
 */
class Alert extends Model
{
    protected static string $table = 'alerts';
    protected static array $columns = [
        'user_id',
        'description',
        'readed'
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
