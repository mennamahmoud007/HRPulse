<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;

class DepartmentController extends Controller
{
    // Display all departments
    public function index()
    {
        $departments = Department::latest()->paginate(10);

        return view('departments.index', compact('departments'));
    }

    // Show create form
    public function create()
    {
        return view('departments.create');
    }

    // Store new department
    public function store(DepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department added successfully.');
    }

    // Show edit form
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update department
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    // Delete department
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}