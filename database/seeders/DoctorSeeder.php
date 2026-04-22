<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all departments
        $departments = Department::all();

        if ($departments->count() === 0) {
            $this->command->info('No departments found. Please create departments first.');

            return;
        }

        foreach ($departments as $department) {
            // Create a doctor user for each department
            $user = User::firstOrCreate(
                ['email' => "doctor_{$department->department_name}@hospital.com"],
                [
                    'name' => 'Dr. '.$department->department_name,
                    'password' => Hash::make('password123'),
                    'role' => 'doctor',
                    'status' => true,
                ]
            );

            // Create or update doctor profile
            $doctor = Doctor::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'department_id' => $department->id,
                    'name' => $user->name,
                    'specialization' => $department->department_name.' Specialist',
                    'contact_number' => '09'.rand(100000000, 999999999),
                ]
            );

            $this->command->info("Created doctor: {$user->name} for department: {$department->department_name}");
        }
    }
}
