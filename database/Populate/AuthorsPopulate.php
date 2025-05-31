<?php
namespace Database\Populate;

use App\Models\Author;

class AuthorsPopulate
{
    public static function populate(): void
    {
        $now = date('Y-m-d H:i:s');
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
                'full_name' => 'Clarice Lispector',
                'birth_date' => '1920-12-10',
                'bio' => 'Clarice Lispector foi uma escritora e jornalista brasileira, considerada uma das mais importantes autoras do século XX.',
                'nationality' => 'Brasileira',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Jorge Amado',
                'birth_date' => '1912-08-10',
                'bio' => 'Jorge Amado foi um romancista brasileiro, conhecido por suas obras que retratam a vida e a cultura da Bahia.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Carlos Drummond de Andrade',
                'birth_date' => '1902-10-31',
                'bio' => 'Poeta brasileiro, uma das figuras mais influentes da literatura brasileira moderna.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Graciliano Ramos',
                'birth_date' => '1892-10-27',
                'bio' => 'Romancista e cronista brasileiro, autor de clássicos como "Vidas Secas".',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Raquel de Queiroz',
                'birth_date' => '1910-11-17',
                'bio' => 'Escritora e jornalista, primeira mulher a entrar na Academia Brasileira de Letras.',
                'nationality' => 'Brasileira',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Érico Veríssimo',
                'birth_date' => '1905-12-17',
                'bio' => 'Escritor gaúcho, autor de importantes romances e sagas históricas.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Cecília Meireles',
                'birth_date' => '1901-11-07',
                'bio' => 'Poetisa, professora e jornalista, uma das maiores vozes da poesia brasileira.',
                'nationality' => 'Brasileira',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'João Guimarães Rosa',
                'birth_date' => '1908-06-27',
                'bio' => 'Escritor modernista, conhecido por seu estilo inovador e por retratar o sertão brasileiro.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Lygia Fagundes Telles',
                'birth_date' => '1923-04-19',
                'bio' => 'Escritora e contista brasileira, reconhecida por sua prosa elegante e profunda.',
                'nationality' => 'Brasileira',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Manuel Bandeira',
                'birth_date' => '1886-04-19',
                'bio' => 'Poeta modernista brasileiro, autor de obras marcantes na literatura nacional.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'José de Alencar',
                'birth_date' => '1829-05-01',
                'bio' => 'Romancista, dramaturgo e político brasileiro, importante para a literatura romântica nacional.',
                'nationality' => 'Brasileiro',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'full_name' => 'Mário de Andrade',
                'birth_date' => '1893-10-09',
                'bio' => 'Poeta, romancista e musicólogo, um dos líderes do Modernismo brasileiro.',
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

        foreach ($authors as $data) {
            $author = new Author($data);
            $author->save();
        }
    }
}
