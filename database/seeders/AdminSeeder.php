<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@genbook.com'],
            [
                'full_name' => 'GenBook',
                'is_active' => true,
            ]
        );

        Staff::firstOrCreate(
            ['user_id' => $user->id],
            [
                'password' => '12345678',
                'admin' => true,
                'employee_id' => 'GEN-ADM-001',
                'hire_date' => now(),
                'is_active' => true,
            ]
        );
    }
}
