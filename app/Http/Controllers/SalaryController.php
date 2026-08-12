<?php

namespace App\Http\Controllers;

use App\Models\Salary;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with([
            'employee.user',
            'employee.department',
            'employee.position',
        ])->get();

        return view('salaries.index', compact('salaries'));
    }
}