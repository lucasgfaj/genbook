<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
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
    public function new(): void
    {
        $user = Auth::userWithAdmin();
        $title = 'Novo Livro';
        $book = new Book();
        $authors = Author::all();
        $categories = Category::all();
        $this->render('books/new', compact('title', 'book', 'authors', 'user', 'categories'));
    }
    public function create(Request $request): void
    {
        $bookData = $request->getParam('book');
        $authors = $request->getParam('authors', []);
        $bookData['category_id'] = $bookData['category_id'] ?? null;

        $book = new Book($bookData);

        if ($book->hasErrors()) {
            FlashMessage::danger('Erro ao criar o livro: ' .  $book->errors());
            $this->redirectBack();
            return;
        }

        if ($book->save()) {
            if (!empty($authors)) {
                $book->authors()->sync(array_map('intval', $authors));
            }
            FlashMessage::success('Livro registrado com sucesso!');
            $this->redirectTo(route('books.index'));
        } else {
            FlashMessage::danger('Erro ao registrar o livro: ' . $book->errors());
            $this->redirectBack();
        }
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();
        $user = Auth::userWithAdmin();
        $title = "Visualização do Livro #{$params['id']}";
        $book = Book::findById($params['id']);
        if (!$book) {
            $this->redirectTo(route('books.index'));
            FlashMessage::danger("Livro não encontrado.");
            return;
        }
        $book->authors()->get();

        $this->render('books/show', compact('title', 'user', 'book'));
    }
    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $book = Book::findById($params['id']);

        if (!$book) {
            $this->redirectTo(route('books.index'));
            return;
        }
        $book->getAll();
        $authors = Author::all();
        $categories = Category::all();
        $title = "Editar Livro";

        $user = Auth::userWithAdmin();
        $this->render('books/update', compact('title', 'book', 'authors', 'categories', 'user'));
    }
    public function update(Request $request): void
    {
        $bookData = $request->getParam('book');
        $authors = $request->getParam('authors', []);
        $bookData['category_id'] = $bookData['category_id'] ?? null;

        $book = new Book($bookData);
        $book->id = $request->getParam('id');


        if ($book->hasErrors()) {
            FlashMessage::danger('Erro ao atualizar o livro: ' . $book->errors());
            $this->redirectBack();
            return;
        }
         if ($book->update($bookData)) {
            if (!empty($authors)) {
                $book->authors()->sync(array_map('intval', $authors));
            }
            FlashMessage::success('Livro registrado com sucesso!');
            $this->redirectTo(route('books.index'));
        } else {
            FlashMessage::danger('Erro ao atualizar o livro: ' . $book->errors());
            $this->redirectBack();
        }
    }
}
