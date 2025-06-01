<?php

namespace Database\Populate;

use App\Models\User;
use App\Models\Staff;
use App\Models\Client;

class UsersPopulate
{
    public static function populate(): void
    {
        $now = date('Y-m-d H:i:s');

        // Usuário Aluno (Client)
        $user1 = new User([
            'full_name' => 'Aluno exemplo',
            'email' => 'alunoexample@example.com',
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $user1->save();

        $client1 = new Client([
            'user_id' => $user1->id,
            'role' => 'aluno',
            'registration_number' => '123456',
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $client1->save();

        // Usuário Admin (Staff)
        $user2 = new User([
            'full_name' => 'Admin exemplo',
            'email' => 'admin@example.com',
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $user2->save();

        $staff2 = new Staff([
            'user_id' => $user2->id,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => '654321',
            'hire_date' => date('Y-m-d'),
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $staff2->save();

        // Usuário Bibliotecário (Staff)
        $user3 = new User([
            'full_name' => 'Bibliotecário exemplo',
            'email' => 'genbook@gmail.com',
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $user3->save();

        $staff3 = new Staff([
            'user_id' => $user3->id,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'admin' => false,
            'employee_id' => '789012',
            'hire_date' => date('Y-m-d'),
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $staff3->save();
    }
}
