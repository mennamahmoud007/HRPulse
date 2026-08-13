<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class ManagerAttendanceController extends Controller
{
    public function index()
    {
        // جلب سجلات الحضور مع بيانات الموظف المرتبط بها
        // قم باستدعاء العلاقة المحددة في الـ Model لديك (user أو employee)
$attendances = Attendance::with('user')->latest()->get(); // أو حسب الفلترة الخاصة بك

        return view('manager.attendance', compact('attendances'));
    }
}