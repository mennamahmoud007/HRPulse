<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::with([
            'user',
            'department',
            'position',
            'salaries',
        ])
        ->when($request->search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->when($request->department_id, function ($query, $departmentId) {
            $query->where('department_id', $departmentId);
        })
        ->when($request->position_id, function ($query, $positionId) {
            $query->where('position_id', $positionId);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();

        return view('employees.index', compact(
            'employees',
            'departments',
            'positions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();

        return view('employees.create', compact(
            'departments',
            'positions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $request) {
            $employeeRole = Role::where('name', 'employee')->firstOrFail();
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
                'role_id'  => $employeeRole->id,
            ]);

            $employee = Employee::create([
                'user_id'       => $user->id,
                'department_id' => $data['department_id'] ?? null,
                'position_id'   => $data['position_id'] ?? null,
                'phone'         => $data['phone'] ?? null,
                'address'       => $data['address'] ?? null,
                'hire_date'     => $data['hire_date'] ?? null,
                'status'        => $data['status'] ?? 'active',
            ]);

           
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('employees', 'public');
                $employee->update(['photo' => $photoPath]);
            }

            if (isset($data['basic'])) {
                $basic     = $data['basic'];
                $bonus     = $data['bonus'] ?? 0;
                $deduction = $data['deduction'] ?? 0;

                $employee->salaries()->create([
                    'basic'      => $basic,
                    'bonus'      => $bonus,
                    'deduction'  => $deduction,
                    'net_salary' => $basic + $bonus - $deduction,
                    'from_date'  => now()->toDateString(),
                    'to_date'    => null,
                ]);
            }
        });

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->load([
            'user',
            'department',
            'position',
            'salaries',
        ]);

        $departments = Department::orderBy('name')->get();
        $positions   = Position::orderBy('name')->get();

        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $request, $employee) {

            // Update user data
            $employee->user->update([
                'name'  => $data['name'],
                'email' => $data['email'],
            ]);

            // Update password only if provided
            if (!empty($data['password'])) {
                $employee->user->update([
                    'password' => bcrypt($data['password']),
                ]);
            }

            // Update employee data
            $employee->update([
                'department_id' => $data['department_id'] ?? null,
                'position_id'   => $data['position_id'] ?? null,
                'phone'         => $data['phone'] ?? null,
                'address'       => $data['address'] ?? null,
                'hire_date'     => $data['hire_date'] ?? null,
                'status'        => $data['status'] ?? $employee->status,
            ]);

            // Update photo if a new one was uploaded
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('employees', 'public');
                $employee->update(['photo' => $photoPath]);
            }

            // Update current salary
            $salary = $employee->salaries()->latest()->first();

            if ($salary && isset($data['basic'])) {
                $basic     = $data['basic'];
                $bonus     = $data['bonus'] ?? 0;
                $deduction = $data['deduction'] ?? 0;

                $salary->update([
                    'basic'      => $basic,
                    'bonus'      => $bonus,
                    'deduction'  => $deduction,
                    'net_salary' => $basic + $bonus - $deduction,
                ]);
            }
        });

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}