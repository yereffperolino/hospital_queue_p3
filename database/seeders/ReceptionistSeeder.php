<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'receptionist@hospital.com'],
            [
                'name' => 'Reception Staff',
                'password' => Hash::make('password123'),
                'role' => 'receptionist',
                'status' => true,
            ]
        );

        $this->command->info('Receptionist created: receptionist@hospital.com / password123');
    }
}
