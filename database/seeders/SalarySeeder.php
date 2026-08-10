<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salary;

class SalarySeeder extends Seeder
{
    public function run(): void
    {
        Salary::factory()->count(10)->create();
    }
}