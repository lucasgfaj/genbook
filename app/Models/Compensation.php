<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $penalty_id
 * @property string $type
 * @property string $equivalent_item
 * @property string $delivery_date
 * @property bool $resolved
 * @property string $created_at
 */
class Compensation extends Model
{
    protected static string $table = 'compensations';
    protected static array $columns = [
        'penalty_id',
        'type',
        'equivalent_item',
        'delivery_date',
        'resolved',
        'created_at'
    ];

    public function validates(): void
    {
        Validations::notEmpty('penalty_id', $this);
        Validations::notEmpty('type', $this);
        Validations::notEmpty('equivalent_item', $this);
        Validations::notEmpty('delivery_date', $this);
    }

    // public function penalty()
    // {
    //     return $this->belongsTo(Penalty::class, 'penalty_id');
    // }
}
