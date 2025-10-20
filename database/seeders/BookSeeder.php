<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $romance = Category::where('name', 'Romance')->first();
        $ficcao = Category::where('name', 'Ficção Científica')->first();
        $tecnologia = Category::where('name', 'Tecnologia')->first();

        $machado = Author::where('full_name', 'Machado de Assis')->first();
        $monteiro = Author::where('full_name', 'Monteiro Lobato')->first();
        $clarice = Author::where('full_name', 'Clarice Lispector')->first();
        $jorge = Author::where('full_name', 'Jorge Amado')->first();

        $book1 = Book::create([
            'title' => 'Dom Casmurro',
            'category_id' => $romance?->id,
            'publisher' => 'Editora Globo',
            'isbn' => '978-8508151312',
            'edition' => '2ª',
            'year' => 1899,
            'quantity' => 3,
            'shelf_location' => 'A1',
            'is_active' => true,
            'cover_name' => '/assets/images/defaults/genbook.png',
            'validity_date' => '2025-12-31',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $book1->authors()->attach($machado?->id);

        $book2 = Book::create([
            'title' => 'O Sítio do Picapau Amarelo',
            'category_id' => $tecnologia?->id,
            'publisher' => 'Editora Brasil',
            'isbn' => '978-8579022753',
            'edition' => '5ª',
            'year' => 1939,
            'quantity' => 5,
            'shelf_location' => 'B3',
            'is_active' => true,
            'cover_name' => '/assets/images/defaults/genbook.png',
            'validity_date' => '2025-12-31',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $book2->authors()->attach($monteiro?->id);
    }
}
