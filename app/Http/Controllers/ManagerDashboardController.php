<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeaveRequest; // هذا السطر لحل مشكلة السطر 18
use App\Models\Attendance;   // هذا السطر لتجنب خطأ مشابه في السطر 19

class ManagerDashboardController extends Controller
{
    public function index()
    {
        // الكروت العلوية من الداتابيز
        $teamMembersCount = User::count();
        $pendingLeaves = LeaveRequest::where('status', 'pending')->count();
        $presentToday = Attendance::whereDate('created_at', today())->count();

        return view('dashboard.manager', compact('teamMembersCount', 'pendingLeaves', 'presentToday'));
    }
}