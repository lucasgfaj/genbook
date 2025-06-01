<?php

namespace Tests\Unit\Controllers;

use App\Models\Staff;
use App\Models\User;
use Core\Http\Request;

class AuthControllerTest extends ControllerTestCase
{
    private User $user;
    private Staff $staff;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User([
            'full_name' => 'Bibliotecário exemplo',
            'email' => 'genbook@gmail.com',
        ]);
        $this->user->save();

        $this->staff = new Staff([
            'user_id' => $this->user->id,
            'admin' => false,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'employee_id' => '789012',
            'hire_date' => date('Y-m-d'),
        ]);
        $this->staff->save();
    }

    public function test_index_renders_login_view(): void
    {
        $output = $this->get('index', 'App\Controllers\AuthController');

        $this->assertStringContainsString('<form', $output); // ou outro conteúdo da view de login
    }

    public function test_authenticate_successfully_logs_user_in(): void
    {
        $output = $this->post('authenticate', 'App\Controllers\AuthController', [
            'user' => [
                'email' => $this->user->email,
                'password' => '123456'
            ]
        ]);

        $this->assertStringContainsString(route('users.home'), $output);
        $this->assertEquals($this->user->id, $_SESSION['user']['id'] ?? null);
        $this->assertEquals('Login realizado com sucesso!', $_SESSION['flash']['success'] ?? null);
    }

    public function test_authenticate_fails_with_invalid_password(): void
    {
        $output = $this->post('authenticate', 'App\Controllers\AuthController', [
            'user' => [
                'email' => $this->user->email,
                'password' => 'senha_errada'
            ]
        ]);

        $this->assertStringContainsString(route('users.login'), $output);
        $this->assertEquals('Email e/ou senha inválidos!', $_SESSION['flash']['danger'] ?? null);
    }

    public function test_authenticate_fails_with_invalid_email(): void
    {
        $output = $this->post('authenticate', 'App\Controllers\AuthController', [
            'user' => [
                'email' => 'naoexiste@example.com',
                'password' => 'qualquer'
            ]
        ]);

        $this->assertStringContainsString(route('users.login'), $output);
        $this->assertEquals('Email e/ou senha inválidos!', $_SESSION['flash']['danger'] ?? null);
    }

    public function test_destroy_logs_out_user(): void
    {
        $_SESSION['user'] = ['id' => $this->user->id];

        $output = $this->get('destroy', 'App\Controllers\AuthController');

        $this->assertArrayNotHasKey('user', $_SESSION);
        $this->assertEquals('Logout realizado com sucesso!', $_SESSION['flash']['success'] ?? null);
        $this->assertStringContainsString(route('users.login'), $output);
    }
}
