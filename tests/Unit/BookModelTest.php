<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_can_be_created()
    {
        $category = Category::factory()->create();
        $book = Book::factory()->create([
            'category_id' => $category->id,
            'quantity' => 5,
        ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $book->title,
        ]);
    }

    public function test_book_is_available_method_returns_quantity_minus_one()
    {
        $book = Book::factory()->create(['quantity' => 3]);
        $this->assertEquals(2, $book->isAvailable());
    }

    public function test_book_has_authors_relationship()
    {
        $book = Book::factory()->create();
        $author = Author::factory()->create();
        $book->authors()->attach($author);

        $this->assertTrue($book->hasRelatedAuthors());
        $this->assertEquals(1, $book->authors()->count());
    }
}
