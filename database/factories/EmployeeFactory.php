<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'hire_date' => fake()->dateTimeBetween('-3 years', 'now'),
            'status' => 'active',
        ];
    }
}