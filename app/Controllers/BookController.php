<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Services\BookCover;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class BookController extends Controller
{
    public function index(): void
    {
        $title = 'GenBook';
        $user = Auth::userWithAdmin();
        $books = Book::getAll();
        $this->render('books/index', compact('title', 'user', 'books'));
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();
        $user = Auth::userWithAdmin();
        $title = "Visualização do Livro #{$params['id']}";
        $book = Book::findById($params['id']);
        if (!$book) {
            $this->redirectTo(route('users.books'));
            return;
        }
        $book->bookAuthors()->get();

        $this->render('books/show', compact('title', 'user', 'book'));
    }
    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $book = Book::findById($params['id']);

        if (!$book) {
            $this->redirectTo(route('users.books'));
            return;
        }

        $book->bookAuthors()->get();
        $book->category()->get();
        $authors = Author::all();
        $title = "Editar Livro";

        $user = Auth::userWithAdmin();
        $this->render('books/update', compact('title', 'book', 'authors', 'user'));
    }
    public function update(Request $request): void
    {
        $params = $request->getParams();
        $book = Book::findById($params['id']);

        if (!$book) {
            $this->redirectTo(route('users.books'));
            return;
        }

        // Atualiza dados do livro
        $book->title = $request->getParam('title');
        $book->publisher = $request->getParam('publisher');
        $book->isbn = $request->getParam('isbn');
        $book->edition = $request->getParam('edition');
        $book->year = (int) $request->getParam('year');
        $book->quantity = (int) $request->getParam('quantity');
        $book->shelf_location = $request->getParam('shelf_location');
        $book->is_active = (bool) $request->getParam('is_active');
        $book->category_id = (int) $request->getParam('category_id', $book->category_id);

        $book->save();
        // Atualiza autores
        $book->bookAuthors()->$request->getParams('authors');

        $book->validates();
        if ($book->hasErrors()) {
            FlashMessage::danger('Erro ao atualizar o livro: ' . $book->errors());
            $this->redirectTo(route('books.edit', ['id' => $book->id]));
            return;
        }

        // Atualiza capa (caso enviada)
        if ($request->getParam('cover_name')) {
            $bookCover = new BookCover($book, [
                'extension' => ['jpg', 'jpeg', 'png', 'webp'],
                'size' => 2 * 1024 * 1024, // 2MB
            ]);
            $success = $bookCover->update($request->getParam('cover_name'));

            if (!$success) {
                FlashMessage::danger('Erro ao atualizar a imagem de capa.');
            }
        }

        $this->redirectTo(route('users.books'));
    }
}
