<?php

namespace App\Models;

use App\Services\BookCover;
use Lib\Validations;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $publisher
 * @property string $isbn
 * @property string $edition
 * @property int $year
 * @property int $quantity
 * @property string $shelf_location
 * @property bool $is_active
 * @property string $cover_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $validity_date
 * @property Author[] $authors
 * @property Category $category
 */

class Book extends Model
{
    protected static string $table = 'books';

    protected static array $columns = [
        'title',
        'category_id',
        'publisher',
        'isbn',
        'edition',
        'year',
        'quantity',
        'shelf_location',
        'is_active',
        'cover_name',
        'validity_date',
        'created_at',
        'updated_at',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'book_id', 'author_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function hasRelatedAuthors(): bool
    {
        return count($this->authors()->get()) > 0;
    }
    public function getCoverPhotoUrl(): string
    {
        return (new BookCover($this))->path();
    }
    public static function findByTitle(string $title): ?Book
    {
        return Book::findBy(['title' => $title]);
    }
    public static function findByIsbn(string $isbn): ?Book
    {
        return Book::findBy(['isbn' => $isbn]);
    }
    public function validates(): void
    {
        Validations::notEmpty('title', $this);
        Validations::notEmpty('category_id', $this);
        Validations::notEmpty('isbn', $this);
        Validations::notEmpty('edition', $this);
        Validations::notEmpty('year', $this);
        Validations::notEmpty('quantity', $this);
    }
    public function isAvailable(): int
    {
        return $this->quantity - 1;
    }

    /** @return array<mixed, mixed>*/
    public static function getAll(): array
    {
        $books = Book::all();
        foreach ($books as $book) {
            $book->authors()->get();
            $book->category()->get();
        }
        return $books;
    }
}
