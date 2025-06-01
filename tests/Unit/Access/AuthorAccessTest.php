<?php

namespace Tests\Unit\Access;

use App\Models\Staff;
use App\Models\User;
use App\Models\Author;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Tests\TestCase;

class AuthorAccessTest extends TestCase
{
    private Client $client;
    private CookieJar $cookieJar;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client([
            'allow_redirects' => false,
            'base_uri' => 'http://web:8080'
        ]);

        $this->cookieJar = new CookieJar();
    }

    private function loginAsAdmin(): void
    {
        $email = 'admin@test.com';
        $password = '123456';

        // Criar usuário admin
        $user = new User([
            'full_name' => 'Admin User',
            'email' => $email,
        ]);
        $user->save();

        $staff = new Staff([
            'user_id' => $user->id,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => '123456',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff->save();

        // Fazer login via HTTP client
        $loginResponse = $this->client->post('/login', [
            'form_params' => [
                'user[email]' => $email,
                'user[password]' => $password,
            ],
            'cookies' => $this->cookieJar,
        ]);

        $this->assertTrue(
            in_array($loginResponse->getStatusCode(), [200, 302]),
            'Login falhou.'
        );
    }

    public function test_should_access_the_route_admin_if_authenticated_as_admin(): void
    {
        $this->loginAsAdmin();

        $response = $this->client->get('/admin', [
            'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_should_show_author(): void
    {
        $author = new Author([
            'full_name' => 'Test Author',
            'bio' => 'Test bio',
            'nationality' => 'BR',
            'birth_date' => '1970-01-01',
            'is_active' => true,
        ]);
        $author->save();

        $response = $this->client->get("/authors/{$author->id}");
        // Supondo que mostrar autor redirecione (exemplo: login ou página)
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_should_create_author(): void
    {
        $this->loginAsAdmin();

        $response = $this->client->post('/authors', [
            'form_params' => [
                'author' => [
                    'full_name' => 'New Author',
                    'bio' => 'New bio',
                    'nationality' => 'BR',
                    'birth_date' => '1980-05-10',
                ]
            ],
            'cookies' => $this->cookieJar,
        ]);

        // A criação normalmente redireciona (status 302)
        $this->assertEquals(302, $response->getStatusCode());

        // Buscar autor criado
        $author = Author::findBy(['full_name' => 'New Author']);
        $this->assertNotNull($author, "Autor não foi criado no banco");
    }

    public function test_should_update_author(): void
    {
        $this->loginAsAdmin();

        $author = new Author([
            'full_name' => 'Author to Update',
            'bio' => 'Old bio',
            'nationality' => 'BR',
            'birth_date' => '1960-01-01',
            'is_active' => true,
        ]);
        $author->save();

        $response = $this->client->post("/authors/{$author->id}", [
            'form_params' => [
                '_method' => 'PUT',
                'author' => [
                    'full_name' => 'Author Updated',
                    'bio' => 'Updated bio',
                ]
            ],
            'cookies' => $this->cookieJar,
        ]);

        // Alteração normalmente redireciona (302)
        $this->assertEquals(302, $response->getStatusCode());

        // Buscar autor atualizado
        $authorUpdated = Author::findById($author->id);
        $this->assertEquals('Author Updated', $authorUpdated->full_name);
        $this->assertEquals('Updated bio', $authorUpdated->bio);
    }

    public function test_should_deactivate_author(): void
    {
        $this->loginAsAdmin();

        $author = new Author([
            'full_name' => 'Author to Deactivate',
            'bio' => 'Bio para desativação',
            'nationality' => 'BR',
            'birth_date' => '1970-01-01',
            'is_active' => true,
        ]);
        $saveResult = $author->save();
        $this->assertTrue($saveResult, "Falha ao salvar autor para desativação.");

        $response = $this->client->put("/authors/{$author->id}/deactivate", [
            'cookies' => $this->cookieJar,
        ]);

        // Normalmente desativar redireciona (302)
        $this->assertEquals(302, $response->getStatusCode());

        // Buscar autor desativado
        $authorDeactivated = Author::findById($author->id);
        $this->assertFalse($authorDeactivated->is_active, "Autor não foi desativado.");
    }

    public function test_should_delete_author(): void
    {
        $this->loginAsAdmin();

        $author = new Author([
            'full_name' => 'Author to Delete',
            'bio' => 'Bio para deleção',
            'nationality' => 'BR',
            'birth_date' => '1970-01-01',
            'is_active' => true,
        ]);
        $saveResult = $author->save();
         $this->assertTrue($saveResult, "Falha ao salvar autor para deleção.");

        $response = $this->client->delete("/authors/{$author->id}", [
            'cookies' => $this->cookieJar,
        ]);

        // Deleção normalmente redireciona (302)
        $this->assertEquals(302, $response->getStatusCode());

        // Verificar se autor foi deletado
        $deletedAuthor = Author::findById($author->id);
        $this->assertNull($deletedAuthor, "Autor não foi deletado.");
    }
}
