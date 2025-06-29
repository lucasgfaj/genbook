<?php

namespace Tests\Unit\Access;

use App\Models\Book;
use App\Models\User;
use App\Models\Staff;
use App\Models\Author;
use App\Models\Category;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Tests\TestCase;

class BookAccessTest extends TestCase
{
    private Client $client;
    private CookieJar $cookieJar;

    /** @var Author */
    private $testAuthor;

    /** @var Category */
    private $testCategory;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client([
            'allow_redirects' => false,
            'base_uri' => 'http://web:8080'
        ]);

        $this->cookieJar = new CookieJar();

        $this->testAuthor = new Author([
            'full_name' => 'Test Author for Books',
            'bio' => 'Biography of a test author for book-related tests.',
            'nationality' => 'Brazilian',
            'birth_date' => '1900-01-01',
            'is_active' => true,
        ]);
        $this->testAuthor->save();

        $this->testCategory = new Category([
            'name' => 'Test Category for Books',
            'description' => 'Description of a test category for book-related tests.',
            'is_active' => true,
        ]);
        $this->testCategory->save();
    }

    private function loginAsAdmin(): void
    {
        $email = 'admin_book@test.com';
        $password = '123456';

        $user = new User([
            'full_name' => 'Admin Book User',
            'email' => $email,
        ]);
        $user->save();

        $staff = new Staff([
            'user_id' => $user->id,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => '987654',
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

        $this->assertTrue(
            in_array($loginResponse->getStatusCode(), [200, 302]),
            'Falha no login como admin.'
        );
    }

    public function test_should_access_books_index_as_admin(): void
    {
        $this->loginAsAdmin();

        $response = $this->client->get('/books', [
            'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_should_create_book(): void
    {
        $this->loginAsAdmin();

        $response = $this->client->post('/books', [
            'form_params' => [
                'title' => 'Book to Edit',
                'category_id' => $this->testCategory->id,
                'publisher' => 'Old Publisher',
                'isbn' => '999-888-777-6',
                'edition' => '1ª',
                'quantity' => 1,
                'shelf_location' => 'E1',
                'is_active' => true,
                'authors' => [$this->testAuthor->id]
            ],
            'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_should_update_book(): void
    {
        $this->loginAsAdmin();

        $book = new Book([
            'title' => 'Book to Edit',
            'publisher' => 'Old Publisher',
            'isbn' => '999-888-777-6',
            'edition' => '1ª',
            'quantity' => 1,
            'shelf_location' => 'E1',
            'is_active' => true,
        ]);
        $book->save();

        $response = $this->client->post("/books/{$book->id}", [
            'form_params' => [
                '_method' => 'PUT',
                'book' => [
                    'title' => 'Updated Book Title',
                ],
            ],
            'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_should_deactivate_book(): void
    {
        $this->loginAsAdmin();

        $book = new Book([
            'title' => 'Book to Deactivate',
            'category_id' => $this->testCategory->id,
            'publisher' => 'Publisher',
            'isbn' => '999-888-777-6',
            'edition' => '1ª',
            'year' => 2005,
            'quantity' => 1,
            'shelf_location' => 'E1',
            'is_active' => true,
        ]);
        $book->save();

        $response = $this->client->put("/books/{$book->id}/deactivate", [
            'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_should_delete_book(): void
    {
        $this->loginAsAdmin();

        $book = new Book([
            'title' => 'Book to Delete',
            'category_id' => $this->testCategory->id,
            'publisher' => 'Publisher',
            'isbn' => '999-888-777-6',
            'edition' => '1ª',
            'year' => 2010,
            'quantity' => 1,
            'shelf_location' => 'E1',
            'is_active' => true,
        ]);
        $book->save();

        $response = $this->client->delete("/books/{$book->id}", [
            'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(302, $response->getStatusCode());

        $deletedBook = Book::findById($book->id);
        $this->assertNull($deletedBook, "Livro não foi deletado.");
    }

    public function test_should_create_book_with_cover(): void
    {
        $this->loginAsAdmin();

        $multipart = [
            [
                'name' => 'book[title]',
                'contents' => 'Book with Cover'
            ],
            [
                'name' => 'book[category_id]',
                'contents' => $this->testCategory->id
            ],
            [
                'name' => 'book[publisher]',
                'contents' => 'Publisher Test'
            ],
            [
                'name' => 'book[isbn]',
                'contents' => '123-456-789-0'
            ],
            [
                'name' => 'book[edition]',
                'contents' => '1a'
            ],
            [
                'name' => 'book[quantity]',
                'contents' => 2
            ],
            [
                'name' => 'book[shelf_location]',
                'contents' => 'Z9'
            ],
            [
                'name' => 'book[is_active]',
                'contents' => true
            ],
            [
                'name' => 'authors[]',
                'contents' => $this->testAuthor->id
            ],
            [
                'name' => 'cover_name',
                'contents' => fopen(__DIR__ . '/../../files/genbook.png', 'r'),

                'filename' => 'genbook.png'
            ]
        ];

        $response = $this->client->request('POST', '/books', [
            'multipart' => $multipart,
            'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }
    public function test_should_update_book_with_new_cover(): void
    {
        $this->loginAsAdmin();

        $book = new Book([
        'title' => 'Old Title',
        'category_id' => $this->testCategory->id,
        'publisher' => 'Old Pub',
        'isbn' => '000-111-222-3',
        'edition' => '1a',
        'quantity' => 1,
        'shelf_location' => 'X1',
        'is_active' => true,
        ]);
        $book->save();


        $multipart = [
        [
            'name' => '_method',
            'contents' => 'PUT'
        ],
        [
            'name' => 'book[title]',
            'contents' => 'Updated Title'
        ],
        [
            'name' => 'authors[]',
            'contents' => $this->testAuthor->id
        ],
        [
            'name' => 'cover_name',
            'contents' => fopen(__DIR__ . '/../../files/genbook.png', 'r'),
            'filename' => 'genbook.png'
        ]
        ];

        $response = $this->client->request('POST', "/books/{$book->id}", [
        'multipart' => $multipart,
        'cookies' => $this->cookieJar,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
