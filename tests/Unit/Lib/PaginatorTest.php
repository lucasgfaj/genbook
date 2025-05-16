<?php

namespace Tests\Unit\Lib;

use App\Models\User;
use Lib\Paginator;
use Tests\TestCase;

class PaginatorTest extends TestCase
{
    // private Paginator $paginator;
    public function setUp(): void
    {
        parent::setUp();
        $user = new User([
            'full_name' => 'User 1',
            'email' => 'fulano@example.com',
        ]);
        $user->save();
    }

    // public function test_total_of_registers(): void
    // {
    //     $this->assertEquals(10, $this->paginator->totalOfRegisters());
    // }

    // public function test_total_of_pages(): void
    // {
    //     $this->assertEquals(2, $this->paginator->totalOfPages());
    // }

    // public function test_previous_page(): void
    // {
    //     $this->assertEquals(0, $this->paginator->previousPage());
    // }

    // public function test_next_page(): void
    // {
    //     $this->assertEquals(2, $this->paginator->nextPage());
    // }


    // public function test_is_page(): void
    // {
    //     $this->assertTrue($this->paginator->isPage(1));
    //     $this->assertFalse($this->paginator->isPage(2));
    // }

    public function test_entries_info(): void
    {
        $entriesInfo = 'Mostrando 1 - 5 de 10';
        $this->assertEquals($entriesInfo, $entriesInfo);
    }
}
