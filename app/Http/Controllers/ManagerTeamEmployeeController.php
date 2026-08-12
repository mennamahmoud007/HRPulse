<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;

class ManagerTeamEmployeeController extends Controller
{
    public function index()
    {
        // جلب الموظفين عبر علاقة الـ Role مع جدول المستخدمين
        $employees = User::whereHas('role', function ($query) {
            $query->where('name', 'employee');
        })->get();

        // ملاحطة: إذا كانت بيانات الموظفين تخزن في موديل Employee مباشرة استخدمي السطر التالي بدلاً من الأعلي:
        // $employees = Employee::with(['department', 'position'])->get();

        return view('manager.team-employees', compact('employees'));
    }
}