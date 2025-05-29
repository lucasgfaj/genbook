<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */

class Category extends Model
{
    protected static string $table = 'categories';
    protected static array $columns = ['name', 'description'];

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
        Validations::notEmpty('description', $this);
    }

    public function books(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'category_id');
    }
    public function authors(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
