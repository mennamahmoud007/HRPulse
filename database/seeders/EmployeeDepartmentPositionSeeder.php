<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;

class EmployeeDepartmentPositionSeeder extends Seeder
{
    public function run(): void
    {
        $departments = Department::with('positions')->get();

        $employees = Employee::with('user')->get();

        foreach ($employees as $index => $employee) {

            // Keep the 5 managers with their assigned departments and positions
            if ($employee->user) {

                switch ($employee->user->name) {

                    case 'Maya Ali':
                        $departmentName = 'Engineering';
                        $positionName = 'Software Engineer';
                        break;

                    case 'Menna Mohamed':
                        $departmentName = 'IT';
                        $positionName = 'IT Specialist';
                        break;

                    case 'Yasmine Hassan':
                        $departmentName = 'Human Resources';
                        $positionName = 'HR Specialist';
                        break;

                    case 'Zeinab Khaled':
                        $departmentName = 'Marketing';
                        $positionName = 'Marketing Specialist';
                        break;

                    case 'Yostina Tarek':
                        $departmentName = 'Finance';
                        $positionName = 'Financial Analyst';
                        break;

                    default:
                        $departmentName = null;
                        $positionName = null;
                }

                if ($departmentName && $positionName) {

                    $department = Department::where('name', $departmentName)->first();

                    $position = Position::where('name', $positionName)
                        ->where('department_id', $department->id)
                        ->first();

                    $employee->update([
                        'department_id' => $department->id,
                        'position_id' => $position->id,
                    ]);

                    continue;
                }
            }

            // Assign other employees to departments and positions
            $department = $departments[$index % $departments->count()];

            $position = $department->positions->first();

            if ($position) {
                $employee->update([
                    'department_id' => $department->id,
                    'position_id' => $position->id,
                ]);
            } 
        }
    }
}