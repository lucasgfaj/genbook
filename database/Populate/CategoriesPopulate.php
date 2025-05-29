<?php

namespace Database\Populate;

use App\Models\Category;

class CategoriesPopulate
{
    public static function populate(): void
    {
        $categories = [
            [
                'name' => 'Ficção Científica',
                'description' => 'Obras com temáticas científicas, futuristas e tecnológicas.',
            ],
            [
                'name' => 'Distopia',
                'description' => 'Narrativas ambientadas em sociedades opressivas ou autoritárias.',
            ],
            [
                'name' => 'Romance',
                'description' => 'Histórias centradas em relacionamentos amorosos.',
            ],
            [
                'name' => 'Biografia',
                'description' => 'Relatos da vida de pessoas reais.',
            ],
            [
                'name' => 'Tecnologia',
                'description' => 'Livros sobre informática, ciência de dados e engenharia.',
            ],
        ];

        foreach ($categories as $data) {
            $category = new Category($data);
            $category->save();
        }
    }
}
