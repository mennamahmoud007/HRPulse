<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salary;
use App\Models\Employee;

class SalarySeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {

            $basic = fake()->randomFloat(2, 5000, 30000);
            $bonus = fake()->randomFloat(2, 0, 5000);
            $deduction = fake()->randomFloat(2, 0, 3000);

            Salary::create([
                // salaries.employee_id currently stores the employee's user_id
                'employee_id' => $employee->user_id,

                'basic' => $basic,
                'bonus' => $bonus,
                'deduction' => $deduction,

                'net_salary' => $basic + $bonus - $deduction,

                'from_date' => fake()
                    ->dateTimeBetween('-1 year', 'now')
                    ->format('Y-m-d'),

                'to_date' => null,
            ]);
        }
    }
}