<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'full_name',
        'bio',
        'nationality',
        'birth_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'birth_date' => 'date',
    ];

    /**
     * Relationships
     */

    // N:N → Um autor pode ter vários livros
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_authors', 'author_id', 'book_id');
    }

    /**
     * Helpers
     */

    public function hasRelatedBooks(): bool
    {
        return $this->books()->exists();
    }

    /**
     * Validation (substituindo Validations::notEmpty)
     */
    public function validate(): void
    {
        $validator = validator($this->attributes, [
            'full_name' => 'required|string|max:255',
            'bio' => 'required|string',
            'nationality' => 'required|string|max:100',
            'birth_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
