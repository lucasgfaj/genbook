<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;

/**
 * @property int $book_id
 * @property int $author_id
 */
class BookAuthor extends Model
{
    protected static string $table = 'book_authors';
    protected static array $columns = [
        'book_id',
        'author_id'
    ];

    public function validates(): void
    {
        // Add validations as needed
    }

    // public function book()
    // {
    //     return $this->belongsTo(Book::class, 'book_id');
    // }

    // public function author()
    // {
    //     return $this->belongsTo(Author::class, 'author_id');
    // }
}
