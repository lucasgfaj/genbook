<?php

namespace Tests\Unit\Models\Books;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Tests\TestCase;

class BookTest extends TestCase
{
    private Book $book;

    public function setUp(): void
    {
        parent::setUp();

        $now = date('Y-m-d H:i:s');

        // Cria categoria com os campos completos
        $category = new Category([
            'name' => 'Test Category',
            'description' => 'Descrição teste para categoria',
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        if (!$category->save()) {
            var_dump('Erro ao salvar categoria:', $category->errors());
            $this->fail('Falha ao salvar categoria no setup');
        }

        // Cria o livro com dados completos e coerentes
        $this->book = new Book([
            'title' => 'Test Book',
            'category_id' => $category->id,
            'publisher' => 'Test Publisher',
            'isbn' => '1234567890123',
            'edition' => '1st',
            'year' => 2020,
            'quantity' => 5,
            'shelf_location' => 'A1',
            'is_active' => true,
            'cover_name' => 'cover.jpg',
            'validity_date' => '2030-12-31',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        if (!$this->book->save()) {
            var_dump('Erro ao salvar livro:', $this->book->errors());
            $this->fail('Falha ao salvar livro no setup');
        }
    }

    public function test_should_create_new_book(): void
    {
        $this->assertCount(1, Book::all());
    }

    public function test_destroy_should_remove_book(): void
    {
        $this->book->destroy();
        $this->assertCount(0, Book::all());
    }

    public function test_set_title(): void
    {
        $this->book->title = 'Updated Title';
        $this->assertEquals('Updated Title', $this->book->title);
    }

    public function test_set_isbn(): void
    {
        $this->book->isbn = '1111111111111';
        $this->assertEquals('1111111111111', $this->book->isbn);
    }

    public function test_find_by_id_should_return_null(): void
    {
        $this->assertNull(Book::findById(999));
    }

    public function test_errors_should_return_validation_errors(): void
    {
        $book = new Book();

        $this->assertFalse($book->isValid());
        $this->assertFalse($book->save());
        $this->assertTrue($book->hasErrors());

        $this->assertEquals('não pode ser vazio!', $book->errors('title'));
        $this->assertEquals('não pode ser vazio!', $book->errors('category_id'));
        $this->assertEquals('não pode ser vazio!', $book->errors('isbn'));
        $this->assertEquals('não pode ser vazio!', $book->errors('edition'));
        $this->assertEquals('não pode ser vazio!', $book->errors('year'));
        $this->assertEquals('não pode ser vazio!', $book->errors('quantity'));
    }

    public function test_should_return_true_when_book_has_related_authors(): void
    {
        $this->assertNotNull($this->book->id, 'Book ID está nulo');

        $author = new Author([
            'full_name' => 'Related Author',
            'bio' => 'Test bio',
            'nationality' => 'PT',
            'birth_date' => '1985-01-01',
            'is_active' => true,
        ]);
        $this->assertTrue($author->save(), 'Falha ao salvar autor');

        $this->book->authors()->sync([$author->id]);

        $this->assertTrue($this->book->hasRelatedAuthors());
    }
    public function test_should_return_false_when_book_has_no_authors(): void
    {
        $this->assertFalse($this->book->hasRelatedAuthors());
    }

    // public function test_get_cover_url_should_return_path(): void
    // {
    //     $coverUrl = $this->book->getCoverPhotoUrl();
    //     $this->assertStringContainsString($this->book->cover_name, $coverUrl);
    // }

    public function test_is_available_should_return_quantity_minus_one(): void
    {
        $available = $this->book->isAvailable();
        $this->assertEquals($this->book->quantity - 1, $available);
    }
}
