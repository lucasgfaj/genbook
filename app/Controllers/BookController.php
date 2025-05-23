<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;

class BookController extends Controller
{
    public function index(): void
    {
        $title = 'GenBook';
        $user = Auth::userWithAdmin();
        $this->render('books/index', compact('title', 'user'));
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();
        $user = Auth::userWithAdmin();
        $title = "Visualização do Livro #{$params['id']}";
        $book = [
            'id' => $params['id'],
            'title' => 'O Senhor dos Anéis',
            'author' => 'J.R.R. Tolkien',
            'publisher' => 'Allen & Unwin',
            'isbn' => '978-0261102385',
            'edition' => '1ª edição',
            'year' => 1954,
            'quantity' => 4,
            'shelf_location' => 'Estante F - Prateleira 3',
            'is_active' => true,
            'cover_photo' => 'https://example.com/cover.jpg',
            'created_at' => '2023-05-10 14:35:00'
        ];

        $this->render('books/show', compact('title', 'user', 'book'));
    }
}
