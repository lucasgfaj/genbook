<?php

namespace App\Controllers;

use App\Models\Author;
use Core\Http\Controllers\Controller;
use Lib\Authentication\Auth;
use Core\Http\Request;
use Lib\FlashMessage;

class AuthorController extends Controller
{
    public function index(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $page = (int) $request->getParam('page', 1);
        if (!$user['admin']) {
            $aux = ['is_active' => true];
        } else {
            $aux = [];
        }
        $paginator = Author::paginate(
            page: $page,
            per_page: 10,
            conditions: $aux,
        );
        $authors = $paginator->registers();
        $title = 'Autores';

        if ($request->acceptJson()) {
            $this->renderJson('authors/index', compact('paginator', 'authors', 'user', 'title'));
        } else {
            $this->render('authors/index', compact('paginator', 'authors', 'user', 'title'));
        }
    }

    public function show(Request $request): void
    {
        $id = (int) $request->getParam('id');
        $user = Auth::userWithAdmin();
        $title = "Visualização do Author #{$id}";
        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        $this->render('authors/show', compact('title', 'user', 'author'));
    }

    public function new(): void
    {
        $user = Auth::userWithAdmin();
        $title = 'Novo Autor';
        $author = new Author();
        $this->render('authors/new', compact('author', 'user', 'title'));
    }

    public function create(Request $request): void
    {
        $authorData = $request->getParam('author');
        $author = new Author($authorData);
        $user = Auth::userWithAdmin();

        if ($author->save()) {
            FlashMessage::success('Autor registrado com sucesso!');
            $this->redirectTo(route('authors.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por favor, verifique!');
            $title = 'Novo Autor';
            $this->render('authors/new', compact('author', 'user', 'title'));
        }
    }

    public function edit(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }
        $title = "Editar Autor #{$author->id}";

        $this->render('authors/edit', compact('author', 'user', 'title'));
    }

    public function update(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $params = $request->getParam('author');
        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        $author->full_name = $params['full_name'] ?? $author->full_name;
        $author->bio = $params['bio'] ?? $author->bio;
        $author->nationality = $params['nationality'] ?? $author->nationality;
        $author->birth_date = $params['birth_date'] ?? $author->birth_date;
        $author->updated_at = date('Y-m-d H:i:s');

        if ($author->save()) {
            FlashMessage::success('Autor atualizado com sucesso!');
            $this->redirectTo(route('authors.index'));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por favor, verifique!');
            $title = "Editar Author #{$author->id}";
            $this->render('authors/edit', compact('author', 'user', 'title'));
        }
    }

    public function deactivate(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        if ($author->hasRelatedBooks()) {
            FlashMessage::danger("Não é possível inativar/deletar o autor pois existem livros relacionados.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        $author->is_active = false;
        $author->updated_at = date('Y-m-d H:i:s');

        if ($author->save()) {
            $message = !empty($user['admin']) ? 'Autor inativado com sucesso!' : 'Autor deletado com sucesso!';
            FlashMessage::success($message);
        } else {
            $message = !empty($user['admin']) ? 'Erro ao inativar o autor!' : 'Erro ao deletar o autor!';
            FlashMessage::danger($message);
        }

        $this->redirectTo(route('authors.index'));
    }
    public function activate(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        if ($author->is_active) {
            FlashMessage::danger("Autor já está ativo.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        $author->is_active = true;
        $author->updated_at = date('Y-m-d H:i:s');

        if ($author->save()) {
            FlashMessage::success("Autor #{$author->id} ativado com sucesso.");
        } else {
            FlashMessage::danger("Erro ao ativar o autor.");
        }

        $this->redirectTo(route('authors.index'));
    }

    public function destroy(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = (int) $request->getParam('id');
        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        if ($author->hasRelatedBooks()) {
            FlashMessage::danger("Não é possível excluir o autor pois existem livros relacionados.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        if ($author->destroy()) {
            FlashMessage::success("Autor #{$author->id} excluído com sucesso.");
        } else {
            FlashMessage::danger("Erro ao excluir o autor.");
        }

        $this->redirectTo(route('authors.index'));
    }
    public function fetchFromOpenLibrary(Request $request): void
    {
        $q = $request->getParam('q');

        if (!$q) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "q" é obrigatório.']);
            return;
        }

        $url = "https://openlibrary.org/search/authors.json?q=" . urlencode($q);
        $response = file_get_contents($url);

        header('Content-Type: application/json');
        echo $response;
    }
}
