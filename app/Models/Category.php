<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationships
     */

    // 1:N → Uma categoria pode ter vários livros
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }

    // (OBS: esta relação não fazia muito sentido no original,
    // mas mantive a estrutura caso precise de referência reversa)
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    /**
     * Validation (equivalente ao Validations::notEmpty)
     */
    public function validate(): void
    {
        $validator = validator($this->attributes, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
