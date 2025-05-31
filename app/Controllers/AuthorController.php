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
        $paginator = Author::findBy(['is_active' => true])->paginate(page: $request->getParam('page', 1));
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
        $title = "Editar Autor #{$author->id}";

        $this->render('authors/edit', compact('author', 'user', 'title'));
    }

    public function update(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = $request->getParam('id');
        $author = Author::findById($id);

        $this->persist($author, 'edit', 'Autor atualizado com sucesso!', 'Erro ao atualizar o autor.');
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

        $author->is_active = false;

        $this->persist(
            $author,
            'show',  // view para reexibir em caso de erro
            "Autor #{$author->id} desativado com sucesso.",
            "Erro ao desativar o autor."
        );
    }

    public function destroy(Request $request): void
    {
        $user = Auth::userWithAdmin();
        $id = $request->getParam('id');
        $author = Author::findById($id);

        if ($author && $author->destroy()) {
            FlashMessage::success("Autor #{$author->id} excluído com sucesso.");
        } else {
            FlashMessage::danger("Erro ao excluir o autor.");
        }

        $this->redirectTo(route('authors.index'));
    }


    private function persist(Author $author, string $view, string $successMsg, string $errorMsg): void
    {
        if ($author->save()) {
            FlashMessage::success($successMsg);
            $this->redirectTo(route('authors.index'));
        } else {
            FlashMessage::danger($errorMsg);
            $title = $view === 'new' ? 'Novo Autor' : "Editar Autor #{$author->id}";
            $this->render("authors/{$view}", compact('author', 'title'));
        }
    }
}
