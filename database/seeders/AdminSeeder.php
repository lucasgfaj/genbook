<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Executa o seeder.
     */
    public function run(): void
    {
        // Cria o usuário base
        $user = User::firstOrCreate(
            ['email' => 'admin@genbook.com'],
            [
                'full_name' => 'Administrador GenBook',
                'is_active' => true,
            ]
        );

        // Cria o registro de staff vinculado
        Staff::firstOrCreate(
            ['user_id' => $user->id],
            [
                'password' => Hash::make('admin123'),
                'admin' => true,
                'employee_id' => 'GEN-ADM-001',
                'hire_date' => now(),
                'is_active' => true,
            ]
        );
    }
}
