<?php

namespace Tests\Unit\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Controllers\UserController;

class UserControllerTest extends ControllerTestCase
{
    private User $user;
    private Staff $staff;
    public function setUp(): void
    {
        parent::setUp();

          $this->user = new User([
            'email' => 'auth@example.com',
            'full_name' => 'User Auth',
          ]);
        $this->user->save();

        $this->staff = new Staff([
            'user_id' => $this->user->id,
            'password' => password_hash('senha123', PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => 'EMP001',
            'hire_date' => date('Y-m-d'),
        ]);
        $this->staff->save();


        $_SESSION['user']['id'] = $this->user->id;
    }

    public function test_index(): void
    {
        $response = $this->get(
            action: 'index',
            controllerName: UserController::class
        );

        // Verifica se a view renderizada contém o título correto
        $this->assertStringContainsString('<h2 class="mb-4">Usuários</h2>', $response);
    }
}
