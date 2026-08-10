<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Salary>
 */
class SalaryFactory extends Factory
{
    public function definition(): array
    {
        $basic = fake()->randomFloat(2, 5000, 30000);
        $bonus = fake()->randomFloat(2, 0, 5000);
        $deduction = fake()->randomFloat(2, 0, 3000);

        return [
            'employee_id' => Employee::inRandomOrder()->first()->user_id,
            'basic' => $basic,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'net_salary' => $basic + $bonus - $deduction,
            'from_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'to_date' => null,
        ];
    }
}