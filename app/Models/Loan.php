<?php

namespace App\Models;

use App\Enums\LoanType;
use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $staff_id
 * @property int $type_id
 * @property LoanType $enum_type
 * @property string $loan_date
 * @property string $due_date
 * @property string $return_date
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */

class Loan extends Model
{
    protected static string $table = 'loans';
    protected static array $columns = [
        'user_id', 'staff_id', 'enum_type', 'type_id',
        'loan_date', 'due_date', 'return_date', 'status'
    ];

    public function validates(): void
    {
        Validations::notEmpty('user_id', $this);
        Validations::notEmpty('staff_id', $this);
        Validations::notEmpty('enum_type', $this);
        Validations::notEmpty('type_id', $this);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(LoanType::class, 'enum_type');
    }
}
