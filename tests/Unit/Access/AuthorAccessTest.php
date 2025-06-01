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

    /**
     */
    private function loginAsAdmin(): void
    {
        $email = 'admin@test.com';
        $password = '123456';

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

        $loginResponse = $this->client->post('/login', [
            'form_params' => [
                'user[email]' => $email,
                'user[password]' => $password,
            ],
            'cookies' => $this->cookieJar,
        ]);

        $this->assertTrue(in_array($loginResponse->getStatusCode(), [200, 302]), 'Login falhou.');
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

        // Normalmente redireciona após criação
        $this->assertEquals(302, $response->getStatusCode());

        $author = Author::findBy(['full_name' => 'New Author']);
        $this->assertNotEmpty($author, "Autor não foi criado no banco");
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

        $this->assertEquals(302, $response->getStatusCode());

        $authorUpdated = Author::findById($author->id);
        $this->assertEquals('Author Updated', $authorUpdated->full_name);
        $this->assertEquals('Updated bio', $authorUpdated->bio);
    }


public function test_should_deactivate_author(): void
{
    $this->loginAsAdmin();
    $author = new Author([
        'full_name' => 'Author to Deactivate',
        'is_active' => true,
    ]);

    // *** IMPORTANT: Check if save() is successful and ID is set ***
    $saveResult = $author->save();
    $this->assertTrue($saveResult, "Failed to save author for deactivation test.");
    $this->assertNotNull($author->id, "Author ID is null after saving for deactivation test.");
    $this->assertIsInt($author->id, "Author ID is not an integer after saving for deactivation test.");


    $response = $this->client->put("/authors/{$author->id}/deactivate", [
        'cookies' => $this->cookieJar,
    ]);

    // As discussed before, verify if this should be 200 or 302 based on your controller
    // If controller redirects after deactivation (which is common for web apps)
    // $this->assertEquals(302, $response->getStatusCode());
    // If it truly returns 200 (e.g., API no redirect)
    $this->assertEquals(200, $response->getStatusCode());

    // This line is where the error originates if $author->id was null
    $authorDeactivated = Author::findById($author->id);
    $this->assertFalse($authorDeactivated->is_active);
}

// In your test:
public function test_should_delete_author(): void
{
    $this->loginAsAdmin();
    $author = new Author([
        'full_name' => 'Author to Delete',
        'is_active' => true,
    ]);

    // *** IMPORTANT: Check if save() is successful and ID is set ***
    $saveResult = $author->save();
    $this->assertTrue($saveResult, "Failed to save author for deletion test.");
    $this->assertNotNull($author->id, "Author ID is null after saving for deletion test.");
    $this->assertIsInt($author->id, "Author ID is not an integer after saving for deletion test.");


    $response = $this->client->delete("/authors/{$author->id}", [
        'cookies' => $this->cookieJar,
    ]);

    // As discussed before, verify if this should be 200, 302 or 204
    // If controller redirects after deletion (common for web apps)
    // $this->assertEquals(302, $response->getStatusCode());
    // Or if it's an API returning no content
    // $this->assertEquals(204, $response->getStatusCode());
    $this->assertEquals(200, $response->getStatusCode());


    // This line is where the error originates if $author->id was null
    $deletedAuthor = Author::findById($author->id);
    $this->assertNull($deletedAuthor);
}

}
