<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Carbon\Carbon;

class AuthorSeeder extends Seeder
{

    public function run(): void
    {
        $now = Carbon::now();

        $authors = [
            [
                'full_name' => 'Machado de Assis',
                'birth_date' => '1839-06-21',
                'bio' => 'Machado de Assis foi um escritor, poeta e dramaturgo brasileiro, considerado um dos maiores escritores da literatura brasileira.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Monteiro Lobato',
                'birth_date' => '1882-04-18',
                'bio' => 'Monteiro Lobato foi um escritor, editor e ativista brasileiro, conhecido por suas obras infantis e por sua contribuição à literatura brasileira.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Rachel de Queiroz',
                'birth_date' => '1910-11-17',
                'bio' => 'Escritora e jornalista, primeira mulher a ingressar na Academia Brasileira de Letras.',
                'nationality' => 'Brasileira',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Author::insert($authors); 
    }
}
