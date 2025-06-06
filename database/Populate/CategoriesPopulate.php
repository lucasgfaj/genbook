<?php

namespace Database\Populate;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

namespace Database\Populate;

use App\Models\Category;

class CategoriesPopulate
{
    public static function populate(): void
    {
        $now = date('Y-m-d H:i:s');
        $categories = [
            [
                'name' => 'Ficção Científica',
                'description' => 'Obras com temáticas científicas, futuristas e tecnológicas.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Distopia',
                'description' => 'Narrativas ambientadas em sociedades opressivas ou autoritárias.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Romance',
                'description' => 'Histórias centradas em relacionamentos amorosos.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Biografia',
                'description' => 'Relatos da vida de pessoas reais.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Tecnologia',
                'description' => 'Livros sobre informática, ciência de dados e engenharia.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($categories as $data) {
            $category = new Category($data);
            $category->save();
        }
    }
}
