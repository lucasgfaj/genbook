<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
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
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'integer',
        'quantity' => 'integer',
    ];

    /**
     * Relationships
     */

    // N:1 → Categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // N:N → Autores
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'book_id', 'author_id');
    }

    /**
     * Custom helpers
     */

    public function hasRelatedAuthors(): bool
    {
        return $this->authors()->exists();
    }

    public function isAvailable(): int
    {
        // aqui você pode substituir por lógica real de empréstimos
        return max($this->quantity - 1, 0);
    }

    /**
     * Custom static methods
     */

    public static function findByIsbn(string $isbn): ?self
    {
        return static::where('isbn', $isbn)->first();
    }

    public static function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return static::with(['authors', 'category'])->get();
    }

    /**
     * Validation (opcional — pode mover para FormRequest)
     */
    public function validate(): void
    {
        $validator = validator($this->attributes, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'isbn' => 'required|string|max:50|unique:books,isbn,' . ($this->id ?? 'null') . ',id',
            'edition' => 'required|string|max:100',
            'year' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
