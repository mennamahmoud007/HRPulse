<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class HREmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['department', 'position']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('position_id')) {
            $query->where('position_id', $request->position_id);
        }

        $employees = $query->latest()->get();
        $departments = Department::all();
        $positions = Position::all();

        // التوجيه إلى ملف hr/index.blade.php الموجود حالياً لديك
        return view('employees.index', compact('employees', 'departments', 'positions'));
    }
}