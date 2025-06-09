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
        $user = Auth::userWithAdmin();
        $bookData = $request->getParam('book');
        $book = new Book($bookData);
        $authors = $request->getParam('authors',[]);
        if ($book->hasErrors()) {
            FlashMessage::danger('Erro ao criar o livro: ' . $book->errors());
            $this->redirectTo(route('books.index'));
            return;
        }
        if ($book->save()) {
            FlashMessage::success('livro registrado com sucesso!');
            $this->redirectTo(route('books.index'));
        } else {
            FlashMessage::danger('Erro ao registrar o livro: ' . $book->errors());
            $title = 'Novo Autor';
            $this->redirectBack();
        }
        // foreach ($authors as $key => $author) {
        //             if (is_numeric($author)) {
        //                 $authors[$key] = (int) $author;
        //             } elseif (is_string($author)) {
        //                 $authors[$key] = Author::findBy(['full_name' => $author])->id ?? null;
        //             }
        //             $book->bookAuthors()->attach($authors[$key]);
        //         }
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
            $this->redirectTo(route('books.index'));
            return;
        }
        $book->getAll();
        $authors = Author::all();
        $categories = Category::all();
        $book->bookAuthors()->get();
        $title = "Editar Livro";

        $user = Auth::userWithAdmin();
        $this->render('books/update', compact('title', 'book', 'authors', 'categories', 'user'));
    }
    public function update(Request $request): void
    {
        $newBook = $request->getParam('book');
        $authors = $request->getParam('authors');
        $authors = is_array($authors) ? $authors : [$authors];
        $book = Book::findById($newBook['id']);
        if (!$book) {
            FlashMessage::danger('Livro não encontrado.');
            $this->redirectTo(route('books.index'));
            return;
        }

        $book->update($newBook);

        $book->validates();
        if ($book->hasErrors()) {
            FlashMessage::danger('Erro ao atualizar o livro: ' . $book->errors());
            $this->redirectTo(route('books.edit', ['id' => $book->id]));
            return;
        }
        // Remove autores antigos
        $book->bookAuthors()->detach($book->id);
        // Adiciona novos autores
        foreach ($authors as $key => $author) {
            if (is_numeric($author)) {
                $authors[$key] = (int) $author;
            } elseif (is_string($author)) {
                $authors[$key] = Author::findBy(['full_name' => $author])->id ?? null;
            }
            $book->bookAuthors()->attach($authors[$key]);
        }
        FlashMessage::success('Livro atualizado com sucesso!');
        $this->redirectTo(route('books.index'));
    }
}
