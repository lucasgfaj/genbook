<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

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

        Category::insert($categories);
    }
}
