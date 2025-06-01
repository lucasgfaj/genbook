<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\Model;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;

/**
 * @property int $id
 * @property string $full_name
 * @property string $bio
 * @property string $nationality
 * @property string $birth_date
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Author extends Model
{
    protected static string $table = 'authors';
    protected static array $columns = [
        'full_name',
        'bio',
        'nationality',
        'birth_date',
        'is_active',
        'created_at',
        'updated_at'
    ];

    public function validates(): void
    {
        Validations::notEmpty('full_name', $this);
        Validations::notEmpty('bio', $this);
        Validations::notEmpty('nationality', $this);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_authors', 'author_id', 'book_id');
    }

    public function hasRelatedBooks(): bool
    {
        return count($this->books()->get()) > 0;
    }
}
