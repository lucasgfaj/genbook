<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\HasMany;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */

class Category extends Model
{
    protected static string $table = 'categories';
    protected static array $columns = ['name', 'description', 'is_active', 'created_at', 'updated_at'];

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
        Validations::notEmpty('description', $this);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_id');
    }
    public function authors(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
