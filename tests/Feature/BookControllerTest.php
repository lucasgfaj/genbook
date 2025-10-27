<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Staff;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_books_index_can_be_rendered()
    {
        $response = $this->get(route('books.index'));
        $response->assertStatus(200);
        $response->assertSee('Livros');
    }

    public function test_book_can_be_created()
    {
        $category = Category::factory()->create();
        $author = Author::factory()->create();

        $data = [
            'book' => [
                'title' => 'Livro Teste',
                'category_id' => $category->id,
                'publisher' => 'Editora Teste',
                'isbn' => '1234567890',
                'edition' => '1ª',
                'year' => 2025,
                'quantity' => 10,
            ],
            'authors' => [$author->id],
        ];

        $response = $this->post(route('books.store'), $data);
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['title' => 'Livro Teste']);
        $this->assertEquals(1, Book::first()->authors()->count());
    }

    public function test_book_can_be_updated()
    {
        $book = Book::factory()->create(['title' => 'Antigo']);
        $category = Category::factory()->create();

        $data = [
            'book' => [
                'title' => 'Novo Título',
                'category_id' => $category->id,
                'publisher' => 'Editora',
                'isbn' => $book->isbn,
                'edition' => '2ª',
                'year' => 2025,
                'quantity' => 5,
            ],
            'authors' => [],
        ];

        $response = $this->put(route('books.update', $book), $data);
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['title' => 'Novo Título']);
    }

    public function test_book_can_be_deleted()
    {
        $book = Book::factory()->create();
        $response = $this->delete(route('books.destroy', $book));
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
