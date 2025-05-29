<?php

namespace Database\Populate;

use App\Models\Author;

class AuthorsPopulate
{
    public static function populate(): void
    {
        $authors = [
            [
                'full_name' => 'Machado de Assis',
                'birth_date' => '1839-06-21',
                'bio' => 'Machado de Assis foi um escritor, poeta e dramaturgo brasileiro, considerado um dos maiores escritores da literatura brasileira.',
                'nationality' => 'Brasileiro',
            ],
            [
                'full_name' => 'Monteiro Lobato',
                'birth_date' => '1882-04-18',
                'bio' => 'Monteiro Lobato foi um escritor, editor e ativista brasileiro, conhecido por suas obras infantis e por sua contribuição à literatura brasileira.',
                'nationality' => 'Brasileiro',
            ],
            [
                'full_name' => 'Clarice Lispector',
                'birth_date' => '1920-12-10',
                'bio' => 'Clarice Lispector foi uma escritora e jornalista brasileira, considerada uma das mais importantes autoras do século XX.',
                'nationality' => 'Brasileira',
            ],
            [
                'full_name' => 'Jorge Amado',
                'birth_date' => '1912-08-10',
                'bio' => 'Jorge Amado foi um romancista brasileiro, conhecido por suas obras que retratam a vida e a cultura da Bahia.',
                'nationality' => 'Brasileiro',
            ],
        ];
        foreach ($authors as $data) {
            $author = new Author($data);
            $author->save();
        }
    }
}
