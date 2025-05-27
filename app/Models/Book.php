<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $title
 * @property string[] $author_id
 * @property string $category_id
 * @property string $publisher
 * @property string $isbn
 * @property string $edition
 * @property int $year
 * @property int $quantity
 * @property string $shelf_location
 * @property bool $is_active
 * @property string $cover_photo
 * @property string $created_at
 * @property string $updated_at
 */

class Book extends Model
{
    protected static string $table = 'books';
    protected static array $columns = [
        'title', 'author_id', 'category_id', 'publisher',
        'isbn', 'edition', 'year', 'quantity',
        'shelf_location', 'is_active', 'cover_photo'
    ];

    public function validates(): void
    {
        Validations::notEmpty('title', $this);
        Validations::notEmpty('author_id', $this);
        Validations::notEmpty('category_id', $this);
        Validations::notEmpty('isbn', $this);
        Validations::notEmpty('edition', $this);
        Validations::notEmpty('year', $this);
        Validations::notEmpty('quantity', $this);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function isAvailable(): bool
    {
        return $this->quantity > 0 && $this->is_active;
    }
    public function getCoverPhotoUrl(): string
    {
        return $this->cover_photo ? '/uploads/' . $this->cover_photo : '/images/default-cover.jpg';
    }
    public function getCreatedAtFormatted(): string
    {
        return date('Y-m-d H:i:s', strtotime($this->created_at));
    }
    public function getUpdatedAtFormatted(): string
    {
        return date('Y-m-d H:i:s', strtotime($this->updated_at));
    }
    public static function findByTitle(string $title): ?Book
    {
        return Book::findBy(['title' => $title]);
    }
    public static function findByAuthorId(int $authorId): ?Book
    {
        return Book::findBy(['author_id' => $authorId]);
    }
    public static function findByCategoryId(int $categoryId): ?Book
    {
        return Book::findBy(['category_id' => $categoryId]);
    }
    public static function findByIsbn(string $isbn): ?Book
    {
        return Book::findBy(['isbn' => $isbn]);
    }
}
