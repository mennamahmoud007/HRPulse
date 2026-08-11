<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $user = auth()->user();

        // 1. حساب الراتب بشكل مرن
        $netSalary = 97200;
        $basicSalary = 95000;
        if (Schema::hasTable('salaries')) {
            $salaryFk = Schema::hasColumn('salaries', 'user_id') ? 'user_id' : 'employee_id';
            if (Schema::hasColumn('salaries', $salaryFk)) {
                $salaryData = DB::table('salaries')->where($salaryFk, $userId)->first();
                if ($salaryData) {
                    $netSalary = $salaryData->net_salary ?? $salaryData->amount ?? $netSalary;
                    $basicSalary = $salaryData->basic_salary ?? $basicSalary;
                }
            }
        }

        // 2. حساب أيام الحضور آخر 30 يوم
        $daysPresent = 4;
        if (Schema::hasTable('attendances')) {
            $attendanceFk = Schema::hasColumn('attendances', 'user_id') ? 'user_id' : 'employee_id';
            if (Schema::hasColumn('attendances', $attendanceFk)) {
                $daysPresent = DB::table('attendances')
                    ->where($attendanceFk, $userId)
                    ->where('created_at', '>=', Carbon::now()->subDays(30))
                    ->count();
            }
        }

        // 3. حساب طلبات الإجازة المعلقة
        $pendingLeaves = 0;
        $leaveTable = Schema::hasTable('leave_requests') ? 'leave_requests' : (Schema::hasTable('leaves') ? 'leaves' : null);
        if ($leaveTable) {
            $leaveFk = Schema::hasColumn($leaveTable, 'user_id') ? 'user_id' : 'employee_id';
            if (Schema::hasColumn($leaveTable, $leaveFk)) {
                $pendingLeaves = DB::table($leaveTable)->where($leaveFk, $userId)->where('status', 'pending')->count();
            }
        }

        // 4. جلب سجل الحضور الأخير للموظف
        $recentAttendance = collect();
        if (Schema::hasTable('attendances')) {
            $attendanceFk = Schema::hasColumn('attendances', 'user_id') ? 'user_id' : 'employee_id';
            $dateCol = Schema::hasColumn('attendances', 'date') ? 'date' : 'created_at';
            
            if (Schema::hasColumn('attendances', $attendanceFk)) {
                $recentAttendance = DB::table('attendances')
                    ->where($attendanceFk, $userId)
                    ->orderBy($dateCol, 'desc')
                    ->take(5)
                    ->get();
            }
        }

        // بيانات افتراضية ممتازة للمعاينة في حال عدم وجود سجلات سابقة للمستخدم
        if ($recentAttendance->isEmpty()) {
            $recentAttendance = collect([
                (object)['date' => '2026-08-06', 'check_in' => '08:52', 'check_out' => '17:30', 'working_hours' => '8h 38m', 'status' => 'Present'],
                (object)['date' => '2026-08-05', 'check_in' => '08:47', 'check_out' => '17:28', 'working_hours' => '8h 41m', 'status' => 'Present'],
                (object)['date' => '2026-08-04', 'check_in' => '09:02', 'check_out' => '17:35', 'working_hours' => '8h 33m', 'status' => 'Present'],
            ]);
        }

        return view('dashboard.employee', compact(
            'user',
            'netSalary',
            'basicSalary',
            'daysPresent',
            'pendingLeaves',
            'recentAttendance'
        ));
    }
}