<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property string $brand
 * @property string $model
 * @property string $serial_number
 * @property int $quantity
 * @property string $unit
 * @property string $location
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Material extends Model
{
    protected static string $table = 'materials';
    protected static array $columns = [
        'name', 'type', 'description', 'brand', 'model',
        'serial_number', 'quantity', 'unit', 'location', 'is_active'
    ];

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
        Validations::notEmpty('type', $this);
        Validations::notEmpty('brand', $this);
        Validations::notEmpty('quantity', $this);
        Validations::notEmpty('unit', $this);
        Validations::notEmpty('location', $this);
    }
    public function isActive(): bool
    {
        return $this->is_active;
    }
    public function getLocation(): string
    {
        return $this->location;
    }
}
