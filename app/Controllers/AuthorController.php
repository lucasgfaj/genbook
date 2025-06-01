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

        $paginator = Author::paginate(
            page: $request->getParam('page', 1),
            per_page: 10,
            conditions: ['is_active' => true]
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
        $params = $request->getParams();
        $user = Auth::userWithAdmin();
        $title = "Visualização do Author #{$params['id']}";
        $author = Author::findById($params['id']);
        if (!$author) {
            $this->redirectTo(route('authors.index'));
            return;
        }

        $this->render('authors/show', compact('title', 'user', 'author'));
    }

    public function new(): void
    {
        $user = Auth::userWithAdmin();
        $title = 'Novo Autor';
        $author = new Author(); // cria uma nova instância vazia
        $this->render('authors/new', compact('author', 'user', 'title'));
    }

    public function create(Request $request): void
    {
        $author = new Author($request->getParam('author'));
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
        $id = $request->getParam('id');
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
        $id = $request->getParam('id');
        $params = $request->getParam('author');

        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }

        // Atualiza os dados do autor
        $author->full_name = $params['full_name'] ?? $author->full_name;
        $author->bio = $params['bio'] ?? $author->bio;
        $author->nationality = $params['nationality'] ?? $author->nationality;
        $author->birth_date = $params['birth_date'] ?? $author->birth_date;

        // Atualiza o campo updated_at para o horário atual
        $author->updated_at = date('Y-m-d H:i:s');

        $author->validates();

        if ($author->save()) {
            FlashMessage::success('Author atualizado com sucesso!');
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
        $id = $request->getParam('id');
        $author = Author::findById($id);

        if (!$author) {
            FlashMessage::danger("Autor não encontrado.");
            $this->redirectTo(route('authors.index'));
            return;
        }


        if (!empty($user['admin'])) {
            if ($author->hasRelatedBooks()) {
                FlashMessage::danger("Não é possível inativar o autor pois existem livros relacionados.");
                $this->redirectTo(route('authors.index'));
                return;
            }
        } else {
            if ($author->hasRelatedBooks()) {
                FlashMessage::danger("Não é possível deletar o autor pois existem livros relacionados.");
                $this->redirectTo(route('authors.index'));
                return;
            }
        }


        $author->is_active = false;
        $author->updated_at = date('Y-m-d H:i:s');

        if ($author->save()) {
            if (!empty($user['admin'])) {
                FlashMessage::success('Autor inativado com sucesso!');
            } else {
                FlashMessage::success('Autor deletado com sucesso!');
            }
        } else {
            if (!empty($user['admin'])) {
                FlashMessage::success('Erro ao inativar o autor!');
            } else {
                FlashMessage::success('Erro ao deletar o autor!');
            }
        }

        $this->redirectTo(route('authors.index'));
    }


    public function destroy(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = $request->getParam('id');
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
}
