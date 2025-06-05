<?php

namespace Database\Populate;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BooksPopulate
{
    public static function populate(): void
    {
        // Busca categorias por nome
        $romance = Category::findBy(['name' => 'Romance']);
        $ficcaoCientifica = Category::findBy(['name' => 'Ficção Científica']);
        $tecnologia = Category::findBy(['name' => 'Tecnologia']);

        // Busca autores por nome
        $machado = Author::findBy(['full_name' => 'Machado de Assis']);
        $monteiro = Author::findBy(['full_name' => 'Monteiro Lobato']);
        $clarice = Author::findBy(['full_name' => 'Clarice Lispector']);
        $jorge = Author::findBy(['full_name' => 'Jorge Amado']);

        // Livro 1
        $book1 = new Book([
            'title' => 'Dom Casmurro',
            'category_id' => $romance->id,
            'publisher' => 'Editora Globo',
            'isbn' => '978-8508151312',
            'edition' => '2ª',
            'year' => 1899,
            'quantity' => 3,
            'shelf_location' => 'A1',
            'is_active' => true,
            'cover_name' => 'dom-casmurro.jpg',
            'validity_date' => '2025-12-31',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $book1->save();
        $book1->bookAuthors()->attach($machado->id);

        // Livro 2
        $book2 = new Book([
            'title' => 'O Sítio do Picapau Amarelo',
            'category_id' => $tecnologia->id,
            'publisher' => 'Editora Brasil',
            'isbn' => '978-8579022753',
            'edition' => '5ª',
            'year' => 1939,
            'quantity' => 5,
            'shelf_location' => 'B3',
            'is_active' => true,
            'cover_name' => 'sitio.jpg',
            'validity_date' => '2025-12-31',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $book2->save();
        $book2->bookAuthors()->attach($monteiro->id);

        // Livro 3 - dois autores
        $book3 = new Book([
            'title' => 'Encontros Literários',
            'category_id' => $ficcaoCientifica->id,
            'publisher' => 'Companhia das Letras',
            'isbn' => '978-8535911234',
            'edition' => '1ª',
            'year' => 2020,
            'quantity' => 2,
            'shelf_location' => 'C2',
            'is_active' => true,
            'cover_name' => 'encontros.jpg',
            'validity_date' => '2025-12-31',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $book3->save();
        $book3->bookAuthors()->attach($clarice->id);
        $book3->bookAuthors()->attach($jorge->id);
    }
}
