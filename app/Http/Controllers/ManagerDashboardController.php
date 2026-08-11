<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        // 1. بيانات الكروت العلويّة
        $teamMembersCount = 3;
        $pendingLeaves = 1;
        $presentToday = 1;

        // 2. بيانات جدول الحضور
        $teamAttendance = collect([
            (object)[
                'name' => 'Sarah Mitchell',
                'position_name' => 'Senior Developer',
                'check_in' => '08:52',
                'check_out' => '17:30',
                'status' => 'Present'
            ],
            (object)[
                'name' => 'Lucas Weber',
                'position_name' => 'Frontend Developer',
                'check_in' => '09:00',
                'check_out' => '13:30',
                'status' => 'Half Day'
            ],
            (object)[
                'name' => 'Ryan Nakamura',
                'position_name' => 'Backend Developer',
                'check_in' => null,
                'check_out' => null,
                'status' => 'Absent'
            ]
        ]);

        return view('dashboard.dashboard', compact(
            'teamMembersCount',
            'pendingLeaves',
            'presentToday',
            'teamAttendance'
        ));
    }
}