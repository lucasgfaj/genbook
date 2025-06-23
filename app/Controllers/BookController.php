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
    public function index(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $books = Book::getAll();

        $page = (int) $request->getParam('page', 1);
        if (!$user['admin']) {
            $aux = ['is_active' => true];
        } else {
            $aux = [];
        }
        $paginator = Book::paginate(
            page: $page,
            per_page: 10,
            conditions: $aux,
        );
        $books = $paginator->registers();
        $title = 'GenBook';
        if ($request->acceptJson()) {
            $this->renderJson('books/index', compact('paginator', 'books', 'user', 'title'));
        } else {
            $this->render('books/index', compact('paginator', 'books', 'user', 'title'));
        }
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

          if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/assets/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = basename($_FILES['image']['name']);

            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('book_cover_', true) . '.' . $ext;

            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Aqui você salva o caminho relativo para a capa no banco
                $bookData['cover_name'] = '/assets/uploads/' . $newFileName;
            } else {
                FlashMessage::danger('Erro ao salvar a imagem da capa.');
                $this->redirectBack();
                return;
            }
        }

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
        $this->render('books/edit', compact('title', 'book', 'authors', 'categories', 'user'));
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
    public function deactivate(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $book = Book::findById($id);

        if (!$book) {
            FlashMessage::danger("Livro não encontrado.");
            $this->redirectTo(route('books.index'));
            return;
        }

        $book->is_active = false;
        $book->updated_at = date('Y-m-d H:i:s');

        if ($book->save()) {
            $message = !empty($user['admin']) ? 'Livro inativado com sucesso!' : 'Livro deletado com sucesso!';
            FlashMessage::success($message);
        } else {
            $message = !empty($user['admin']) ? 'Erro ao inativar o livro!' : 'Erro ao deletar o livro!';
            FlashMessage::danger($message);
        }

        $this->redirectTo(route('books.index'));
    }
    public function activate(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $book = Book::findById($id);

        if (!$book) {
            FlashMessage::danger("Livro não encontrado.");
            $this->redirectTo(route('books.index'));
            return;
        }
        if (!$book->hasRelatedAuthors()) {
            FlashMessage::danger("Livro não pode ser ativado sem autores relacionados.");
            $this->redirectTo(route('books.index'));
            return;
        }

        $book->is_active = true;
        $book->updated_at = date('Y-m-d H:i:s');

        if ($book->save()) {
            FlashMessage::success("Livro #{$book->id} ativado com sucesso.");
        } else {
            FlashMessage::danger("Erro ao ativar o livro.");
        }

        $this->redirectTo(route('books.index'));
    }

    public function destroy(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $book = Book::findById($id);

        if (!$book) {
            FlashMessage::danger("Livro não encontrado.");
            $this->redirectTo(route('books.index'));
            return;
        }

        if ($book->destroy()) {
            FlashMessage::success("Livro #{$book->id} excluído com sucesso.");
        } else {
            FlashMessage::danger("Erro ao excluir o livro.");
        }

        $this->redirectTo(route('books.index'));
    }
}