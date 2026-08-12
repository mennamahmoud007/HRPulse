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
        return view('hr.index', compact('employees', 'departments', 'positions'));
    }

    /**
     * حذف الموظف وإعادة التوجيه لنفس الصفحة فوراً
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully');
    }

    /**
     * إضافة موظف جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Employee added successfully');
    }

    /**
     * تعديل بيانات الموظف
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
        ]);

        return redirect()->back()->with('success', 'Employee updated successfully');
    }
}