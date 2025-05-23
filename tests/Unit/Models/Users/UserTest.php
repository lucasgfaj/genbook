<?php

namespace Tests\Unit\Models\Users;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    private User $user;
    private User $user2;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User([
            'full_name' => 'User 1',
            'email' => 'fulano@example.com',
        ]);
        $this->user->save();

        $this->user2 = new User([
            'full_name' => 'User 2',
            'email' => 'fulano1@example.com',
        ]);
        $this->user2->save();
    }

    public function test_should_create_new_user(): void
    {
        $this->assertCount(2, User::all());
    }

    public function test_all_should_return_all_users(): void
    {
        $this->user2->save();

        $users[] = $this->user->id;
        $users[] = $this->user2->id;

        $all = array_map(fn($user) => $user->id, User::all());

        $this->assertCount(2, $all);
        $this->assertEquals($users, $all);
    }

    public function test_destroy_should_remove_the_user(): void
    {
        $this->user->destroy();
        $this->assertCount(1, User::all());
    }

    public function test_set_id(): void
    {
        $this->user->id = 10;
        $this->assertEquals(10, $this->user->id);
    }

    public function test_set_name(): void
    {
        $this->user->full_name = 'User full_name';
        $this->assertEquals('User full_name', $this->user->full_name);
    }

    public function test_set_email(): void
    {
        $this->user->email = 'outro@example.com';
        $this->assertEquals('outro@example.com', $this->user->email);
    }

    public function test_errors_should_return_errors(): void
    {
        $user = new User();

        $this->assertFalse($user->isValid());
        $this->assertFalse($user->save());
        $this->assertTrue($user->hasErrors());

        $this->assertEquals('não pode ser vazio!', $user->errors('full_name'));
        $this->assertEquals('não pode ser vazio!', $user->errors('email'));
    }


    public function test_find_by_id_should_return_the_user(): void
    {
        $this->assertEquals($this->user->id, User::findById($this->user->id)->id);
    }

    public function test_find_by_id_should_return_null(): void
    {
        $this->assertNull(User::findById(3));
    }

    public function test_find_by_email_should_return_the_user(): void
    {
        $this->assertEquals($this->user->id, User::findByEmail($this->user->email)->id);
    }

    public function test_find_by_email_should_return_null(): void
    {
        $this->assertNull(User::findByEmail('not.exits@example.com'));
    }
}
