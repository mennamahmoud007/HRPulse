<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use App\Models\Department;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            'Engineering' => [
                'Software Engineer',
                'Backend Developer',
                'Frontend Developer',
            ],

            'IT' => [
                'IT Specialist',
                'System Administrator',
            ],

            'Human Resources' => [
                'HR Specialist',
                'HR Manager',
            ],

            'Marketing' => [
                'Marketing Specialist',
                'Digital Marketing Specialist',
            ],

            'Finance' => [
                'Accountant',
                'Financial Analyst',
            ],
        ];

        foreach ($positions as $departmentName => $positionNames) {

            $department = Department::where('name', $departmentName)->first();

            foreach ($positionNames as $positionName) {
                Position::create([
                    'name' => $positionName,
                    'department_id' => $department->id,
                ]);
            }
        }
    }
}