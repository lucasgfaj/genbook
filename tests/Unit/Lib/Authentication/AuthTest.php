<?php

namespace Tests\Unit\Lib\Authentication;

use App\Models\Staff;
use Lib\Authentication\Auth;
use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $_SESSION = [];
        $this->user = new User([
            'full_name' => 'Bibliotecário exemplo',
            'email' => 'genbook@gmail.com',
        ]);
        $this->user->save();
        $staff1 = new Staff([
            'user_id' => $this->user->id,
            'admin' => false,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'employee_id' => '789012',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff1->save();
    }

    public function tearDown(): void
    {
        parent::setUp();
        $_SESSION = [];
    }

    public function test_login(): void
    {
        Auth::login($this->user);

        $this->assertEquals(1, $_SESSION['user']['id']);
    }

    public function test_user(): void
    {
        Auth::login($this->user);

        $userFromSession = Auth::user();

        $this->assertEquals($this->user->id, $userFromSession->id);
    }

    public function test_check(): void
    {
        Auth::login($this->user);

        $this->assertTrue(Auth::check());
    }

    public function test_logout(): void
    {
        Auth::login($this->user);
        Auth::logout();

        $this->assertFalse(Auth::check());
    }
}
