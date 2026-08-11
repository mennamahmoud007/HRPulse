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
            'department_id' => Department::factory(),
            'position_id' => Position::factory(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'photo' => null,
            'hire_date' => fake()->dateTimeBetween('-3 years', 'now'),
            'status' => 'active',
        ];
    }
}