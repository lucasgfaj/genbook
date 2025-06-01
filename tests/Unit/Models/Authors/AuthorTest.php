<?php

namespace Tests\Unit\Models\Authors;

use App\Models\Author;
use App\Models\Book;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    private Author $author;

    public function setUp(): void
    {
        parent::setUp();

        $this->author = new Author([
            'full_name' => 'Author 1',
            'bio' => 'Author biography',
            'nationality' => 'Brazilian',
            'birth_date' => '1980-01-01',
            'is_active' => true,
        ]);

        $this->author->save();
    }

    public function test_should_create_new_author(): void
    {
        $this->assertCount(1, Author::all());
    }

    public function test_all_should_return_all_authors(): void
    {
        $author2 = new Author([
            'full_name' => 'Author 2',
            'bio' => 'Another bio',
            'nationality' => 'Argentinian',
            'birth_date' => '1970-05-10',
            'is_active' => true,
        ]);
        $author2->save();

        $ids = [$this->author->id, $author2->id];
        $all = array_map(fn($a) => $a->id, Author::all());

        $this->assertCount(2, $all);
        $this->assertEquals($ids, $all);
    }

    public function test_destroy_should_remove_author(): void
    {
        $this->author->destroy();
        $this->assertCount(0, Author::all());
    }

    public function test_set_id(): void
    {
        $this->author->id = 99;
        $this->assertEquals(99, $this->author->id);
    }

    public function test_set_name(): void
    {
        $this->author->full_name = 'New Name';
        $this->assertEquals('New Name', $this->author->full_name);
    }

    public function test_set_bio(): void
    {
        $this->author->bio = 'New bio';
        $this->assertEquals('New bio', $this->author->bio);
    }

    public function test_set_nationality(): void
    {
        $this->author->nationality = 'Chilean';
        $this->assertEquals('Chilean', $this->author->nationality);
    }

    public function test_set_birth_date(): void
    {
        $this->author->birth_date = '1990-10-15';
        $this->assertEquals('1990-10-15', $this->author->birth_date);
    }

    public function test_errors_should_return_validation_errors(): void
    {
        $author = new Author();

        $this->assertFalse($author->isValid());
        $this->assertFalse($author->save());
        $this->assertTrue($author->hasErrors());

        $this->assertEquals('não pode ser vazio!', $author->errors('full_name'));
        $this->assertEquals('não pode ser vazio!', $author->errors('bio'));
        $this->assertEquals('não pode ser vazio!', $author->errors('nationality'));
    }

    public function test_find_by_id_should_return_author(): void
    {
        $found = Author::findById($this->author->id);
        $this->assertEquals($this->author->id, $found->id);
    }

    public function test_find_by_id_should_return_null(): void
    {
        $this->assertNull(Author::findById(999));
    }

    public function test_has_related_books_should_return_false_when_no_books(): void
    {
        $this->assertFalse($this->author->hasRelatedBooks());
    }
}
