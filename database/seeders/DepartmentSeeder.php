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
        $desc = [
            'Engineering' => 'Responsible for designing, developing, and maintaining software applications and systems.',
            'IT' => 'Manages the organization\'s technology infrastructure, including hardware, software, and networks.',
            'Human Resources' => 'Handles employee relations, recruitment, training, and benefits administration.',
            'Marketing' => 'Promotes the organization\'s products or services through advertising, branding, and market research.',
            'Finance' => 'Manages the organization\'s financial resources, including budgeting, accounting, and financial reporting.',
        ];

        foreach ($departments as $dept) {
            $managerUser = User::where('name', $dept['manager_name'])->first();

            Department::create([
                'name' => $dept['name'],
                'description' => $desc[$dept['name']],
                'manager_id' => $managerUser?->id,
            ]);
        }
    }
}