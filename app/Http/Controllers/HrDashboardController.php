<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HrDashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');

        // 1. الكروت الأربعة
        $totalEmployees = Schema::hasTable('users') ? DB::table('users')->count() : 0;
        
        $presentToday = Schema::hasTable('attendances') 
            ? DB::table('attendances')->where('date', $today)->whereIn('status', ['Present', 'present', 'Present '])->count() 
            : 0;
            
        $absentToday = Schema::hasTable('attendances') 
            ? DB::table('attendances')->where('date', $today)->whereIn('status', ['Absent', 'absent'])->count() 
            : 0;

        $pendingLeaves = Schema::hasTable('leave_requests') 
            ? DB::table('leave_requests')->whereIn('status', ['Pending', 'pending'])->count() 
            : 0;

        // 2. جلب أحدث الموظفين بأسلوب آمن جداً بدون افترض أسماء أعمدة غير موجودة
        $recentEmployees = collect();
        if (Schema::hasTable('users')) {
            $query = DB::table('users');

            // فحص هل يحتوي جدول users على department_id
            if (Schema::hasColumn('users', 'department_id') && Schema::hasTable('departments')) {
                $query->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                      ->addSelect('departments.name as department_name');
            } else {
                $query->selectRaw("'General' as department_name");
            }

            // فحص هل يحتوي جدول users على position_id
            if (Schema::hasColumn('users', 'position_id') && Schema::hasTable('positions')) {
                $posCol = Schema::hasColumn('positions', 'name') ? 'positions.name' : (Schema::hasColumn('positions', 'title') ? 'positions.title' : 'positions.id');
                $query->leftJoin('positions', 'users.position_id', '=', 'positions.id')
                      ->addSelect(DB::raw("$posCol as position_name"));
            } else {
                $query->addSelect(DB::raw("'Staff' as position_name"));
            }

            $recentEmployees = $query->addSelect('users.name', 'users.email')
                ->orderBy('users.id', 'desc')
                ->take(5)
                ->get();
        }

        // 3. جلب أحدث طلبات الإجازة
        $recentLeaves = collect();
        if (Schema::hasTable('leave_requests')) {
            $leaveQuery = DB::table('leave_requests');

            if (Schema::hasColumn('leave_requests', 'employee_id') && Schema::hasTable('users')) {
                $leaveQuery->leftJoin('users', 'leave_requests.employee_id', '=', 'users.id')
                           ->addSelect('users.name as employee_name');
            } else {
                $leaveQuery->selectRaw("'Employee' as employee_name");
            }

            $recentLeaves = $leaveQuery->addSelect(
                'leave_requests.leave_type',
                'leave_requests.start_date',
                'leave_requests.end_date',
                'leave_requests.status'
            )
            ->orderBy('leave_requests.id', 'desc')
            ->take(5)
            ->get();
        }

        return view('dashboard.hr', compact(
            'totalEmployees',
            'presentToday',
            'absentToday',
            'pendingLeaves',
            'recentEmployees',
            'recentLeaves'
        ));
    }
}