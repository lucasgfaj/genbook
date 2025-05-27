<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $full_name
 * @property string $bio
 * @property string $nationality
 * @property string $birth_date
 * @property string $created_at
 * @property string $updated_at
 */

class Author extends Model
{
    protected static string $table = 'authors';
    protected static array $columns = ['full_name', 'bio', 'nationality', 'birth_date'];

    public function validates(): void
    {
        Validations::notEmpty('full_name', $this);
        Validations::notEmpty('bio', $this);
        Validations::notEmpty('nationality', $this);
    }
    public function books(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'author_id');
    }
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
