<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'department_id' => null, // Will be assigned in the seeder
            'position_id' => null, // Will be assigned in the seeder
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'photo' => 'https://picsum.photos/200/200?random=' . fake()->unique()->numberBetween(1, 1000),
            'hire_date' => fake()->dateTimeBetween('-3 years', 'now'),
            'status' => 'active',
        ];
    }
}