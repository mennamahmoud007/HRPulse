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
                    'email_verified_at' => now(),
                ]
            );

            Employee::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => fake()->address(),
                    'phone' => fake()->phoneNumber(),
                    'photo' => 'https://picsum.photos/200/200?random=' . fake()->unique()->numberBetween(1, 1000),
                    'hire_date' => fake()->dateTimeBetween('-5 years', 'now'),
                    'status' => 'active',
                ]
            );
        }

        // Create 10 additional employees
        Employee::factory()->count(10)->create();
    }
}