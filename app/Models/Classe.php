<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $year
 * @property string $period
 *
 */

class Classe extends Model
{
    protected static string $table = 'classe';
    protected static array $columns = [
        'name',
        'year',
        'period'
    ];

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
        Validations::notEmpty('year', $this);
        Validations::notEmpty('period', $this);
    }
}
