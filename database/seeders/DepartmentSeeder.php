<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;
use App\Models\Employee;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Engineering', 'manager_name' => 'Maya Ali'],
            ['name' => 'IT', 'manager_name' => 'Menna Mohamed'],
            ['name' => 'Human Resources', 'manager_name' => 'Yasmine Hassan'],
            ['name' => 'Marketing', 'manager_name' => 'Zeinab Khaled'],
            ['name' => 'Finance', 'manager_name' => 'Yostina Tarek'],
        ];

        foreach ($departments as $dept) {
            $managerUser = User::where('name', $dept['manager_name'])->first();
            $manager = Employee::where('user_id', $managerUser?->id)->first();

            Department::create([
                'name' => $dept['name'],
                'manager_id' => $manager?->id,
            ]);
        }
    }
}