<?php

namespace App\Http\Controllers;

use App\Models\Salary;

class SalaryController extends Controller
{
    // Display the latest salary for each employee
    public function index()
    {
        $salaries = Salary::with([
            'employee.user',
            'employee.department',
            'employee.position'
        ])
        ->latest('id')
        ->get()
        ->unique('employee_id')
        ->values();

        return view('salaries.index', compact('salaries'));
    }
}