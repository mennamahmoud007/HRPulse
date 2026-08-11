<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $managers = [
            ['name' => 'Maya Ali', 'email' => 'ahmed@example.com'],
            ['name' => 'Menna Mohamed', 'email' => 'sara@example.com'],
            ['name' => 'Yasmine Hassan', 'email' => 'mona@example.com'],
            ['name' => 'Zeinab Khaled', 'email' => 'omar@example.com'],
            ['name' => 'Yostina Tarek', 'email' => 'nour@example.com'],
        ];

        foreach ($managers as $manager) {

            $user = User::firstOrCreate(
                ['email' => $manager['email']],
                [
                    'name' => $manager['name'],
                    'password' => bcrypt('123456'),
                ]
            );

            Employee::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'status' => 'active',
                ]
            );
        }

        // Create 10 additional employees
        Employee::factory()->count(10)->create();
    }
}