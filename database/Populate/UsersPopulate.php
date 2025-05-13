<?php

namespace Database\Populate;

use App\Models\User;
use App\Models\Staff;
use App\Models\Client;

class UsersPopulate
{
    public static function populate(): void
    {
        $user1 = new User([
            'full_name' => 'Aluno exemplo',
            'email' => 'alunoexample@example.com',          
        ]);
        $user1->save();
        $client1 = new Client([
            'user_id' => $user1->id,
            'role' => 'aluno',
            'registration_number' => '123456',
        ]);
        $client1->save();
        $user2 = new User([
            'full_name' => 'Professor exemplo',
            'email' => 'professorexemplo@example.com',
        ]);
        $user2->save();
        $staff2 = new Staff([
            'user_id' => $user2->id,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => '654321',
            'hire_date' => date('Y-m-d'),
        ]);
        $staff2->save();
    }
}