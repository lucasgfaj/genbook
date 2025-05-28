<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $loan_id
 * @property float $amount
 * @property string $reason
 * @property bool $resolved
 * @property string $created_at
 */
class Fine extends Model
{
    protected static string $table = 'fines';
    protected static array $columns = [
        'loan_id',
        'amount',
        'reason',
        'resolved',
        'created_at'
    ];

    public function validates(): void
    {
        Validations::notEmpty('loan_id', $this);
        Validations::notEmpty('amount', $this);
        Validations::notEmpty('reason', $this);
    }

    // public function loan()
    // {
    //     return $this->belongsTo(Loan::class, 'loan_id');
    // }
}
