<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        // 1. أرقام الكروت الحقيقية
        $teamMembersCount = Schema::hasTable('users') ? DB::table('users')->count() : 0;
        
        $pendingLeaves = 0;
        if (Schema::hasTable('leave_requests')) {
            $pendingLeaves = DB::table('leave_requests')->where('status', 'pending')->count();
        } elseif (Schema::hasTable('leaves')) {
            $pendingLeaves = DB::table('leaves')->where('status', 'pending')->count();
        }

        // 2. تحديد اسم المفتاح الأجنبي الصحيح لجدول الحضور
        $attendanceFk = 'employee_id';
        if (Schema::hasTable('attendances')) {
            if (Schema::hasColumn('attendances', 'user_id')) {
                $attendanceFk = 'user_id';
            } elseif (Schema::hasColumn('attendances', 'employee_id')) {
                $attendanceFk = 'employee_id';
            }
        }

        // 3. حساب الحاضرين اليوم
        $presentToday = 0;
        if (Schema::hasTable('attendances')) {
            $dateColumn = Schema::hasColumn('attendances', 'date') ? 'date' : 'created_at';
            $presentToday = DB::table('attendances')->whereDate($dateColumn, $today)->count();
        }

        // 4. جلب قائمة الموظفين والحضور الحقيقية
        $teamAttendance = collect();
        if (Schema::hasTable('users')) {
            $query = DB::table('users');

            if (Schema::hasTable('attendances')) {
                $dateColumn = Schema::hasColumn('attendances', 'date') ? 'attendances.date' : 'attendances.created_at';
                
                $query->leftJoin('attendances', function($join) use ($today, $attendanceFk, $dateColumn) {
                    $join->on('users.id', '=', "attendances.{$attendanceFk}")
                         ->whereDate($dateColumn, '=', $today);
                })->select(
                    'users.name',
                    DB::raw("'Engineer' as position_name"),
                    'attendances.check_in',
                    'attendances.check_out',
                    'attendances.status'
                );
            } else {
                $query->select(
                    'users.name',
                    DB::raw("'Engineer' as position_name"),
                    DB::raw("NULL as check_in"),
                    DB::raw("NULL as check_out"),
                    DB::raw("NULL as status")
                );
            }

            $teamAttendance = $query->get();
        }

        return view('dashboard.dashboard', compact(
            'teamMembersCount',
            'pendingLeaves',
            'presentToday',
            'teamAttendance'
        ));
    }
}