<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $book_id
 * @property int $category_id
 */
class BookCategory extends Model
{
    protected static string $table = 'book_categories';
    protected static array $columns = [
        'book_id',
        'category_id'
    ];

    public function validates(): void
    {
        // Add validations as needed
    }

    // public function book()
    // {
    //     return $this->belongsTo(Book::class, 'book_id');
    // }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }
}
