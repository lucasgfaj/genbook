<?php

namespace Tests\Unit\Controllers;

use App\Models\Author;
use App\Models\User;
use App\Models\Staff;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class AuthorControllerTest extends ControllerTestCase
{
    private User $user;
    private Staff $staff;
    private Author $author;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User([
            'email' => 'auth@example.com',
            'full_name' => 'User Auth',
        ]);
        $this->user->save();

        $this->staff = new Staff([
            'user_id' => $this->user->id,
            'password' => password_hash('senha123', PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => 'EMP001',
            'hire_date' => date('Y-m-d'),
        ]);
        $this->staff->save();

        $_SESSION['user'] = [
            'id' => $this->user->id,
            'email' => $this->user->email,
            'admin' => true
        ];

        $this->author = new Author([
            'full_name' => 'J. R. R. Tolkien',
            'bio' => 'Autor de O Senhor dos Anéis',
            'is_active' => true
        ]);
        $this->author->save();
    }

    public function test_index_displays_authors(): void
    {
        $response = $this->get(action: 'index', controllerName: 'App\Controllers\AuthorController');

        $this->assertStringContainsString('Autores', $response);
        $this->assertStringContainsString($this->author->full_name, $response);
    }

    public function test_show_displays_author(): void
    {
        $response = $this->get(
            action: 'show',
            controllerName: 'App\Controllers\AuthorController',
            params: ['id' => $this->author->id]
        );

        $this->assertStringContainsString($this->author->full_name, $response);
        $this->assertStringContainsString("Visualização do Author #{$this->author->id}", $response);
    }

    public function test_new_author_page(): void
    {
        $response = $this->get(action: 'new', controllerName: 'App\Controllers\AuthorController');

        $this->assertStringContainsString('Novo Autor', $response);
        $this->assertStringContainsString('<form', $response);
    }

    public function test_successfully_create_author(): void
    {
        $params = [
            'author' => [
                'full_name' => 'George Orwell',
                'bio' => 'Autor de 1984',
                'is_active' => true
            ]
        ];

        $response = $this->post(
            action: 'create',
            controllerName: 'App\Controllers\AuthorController',
            params: $params
        );

        $this->assertMatchesRegularExpression('/Location: \/authors/', $response);
    }

    public function test_unsuccessfully_create_author(): void
    {
        $params = [
            'author' => [
                'full_name' => '',
                'bio' => '',
                'is_active' => true
            ]
        ];

        $response = $this->post(
            action: 'create',
            controllerName: 'App\Controllers\AuthorController',
            params: $params
        );

        $this->assertStringContainsString('Existem dados incorretos', $response);
        $this->assertStringContainsString('Novo Autor', $response);
    }

    public function test_edit_author(): void
    {
        $response = $this->get(
            action: 'edit',
            controllerName: 'App\Controllers\AuthorController',
            params: ['id' => $this->author->id]
        );

        $this->assertStringContainsString('Editar Autor', $response);
        $this->assertStringContainsString($this->author->full_name, $response);
    }

    public function test_update_author_success(): void
    {
        $params = [
            'id' => $this->author->id,
            'author' => [
                'full_name' => 'John Tolkien',
                'bio' => 'Autor atualizado'
            ]
        ];

        $response = $this->post(
            action: 'update',
            controllerName: 'App\Controllers\AuthorController',
            params: $params
        );

        $this->assertMatchesRegularExpression('/Location: \/authors/', $response);

        $updatedAuthor = Author::findById($this->author->id);
        $this->assertEquals('John Tolkien', $updatedAuthor->full_name);
        $this->assertEquals('Autor atualizado', $updatedAuthor->bio);
    }

    public function test_deactivate_author_success(): void
    {
        $response = $this->post(
            action: 'deactivate',
            controllerName: 'App\Controllers\AuthorController',
            params: ['id' => $this->author->id]
        );

        $this->assertMatchesRegularExpression('/Location: \/authors/', $response);

        $deactivatedAuthor = Author::findById($this->author->id);
        $this->assertFalse($deactivatedAuthor->is_active);
    }

    public function test_destroy_author_success(): void
    {
        $authorToDelete = new Author([
            'full_name' => 'Autor a deletar',
            'bio' => 'Bio',
            'is_active' => true
        ]);
        $authorToDelete->save();

        $response = $this->post(
            action: 'destroy',
            controllerName: 'App\Controllers\AuthorController',
            params: ['id' => $authorToDelete->id]
        );

        $this->assertMatchesRegularExpression('/Location: \/authors/', $response);

        $deletedAuthor = Author::findById($authorToDelete->id);
        $this->assertNull($deletedAuthor);
    }
}
