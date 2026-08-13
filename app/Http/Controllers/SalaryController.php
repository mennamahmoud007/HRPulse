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
    public function employeeSalaries()
    {
        $user = auth()->user();
        $employee = $user->employee;

        if (!$employee) {
            abort(404, 'Employee not found.');
        }

        $salaries = Salary::where('employee_id', $employee->id)
            ->with(['employee.user', 'employee.department', 'employee.position'])
            ->get();

        return view('employees.salary', compact('salaries'));
    }
}