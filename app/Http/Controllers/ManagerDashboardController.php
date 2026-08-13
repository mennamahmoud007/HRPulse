<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeaveRequest;
use App\Models\Attendance;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $teamMembersCount = User::count();
        $pendingLeaves = LeaveRequest::where('status', 'pending')->count();
        $presentToday = Attendance::whereDate('created_at', today())->count();

        return view('dashboard.manager', compact(
            'teamMembersCount',
            'pendingLeaves',
            'presentToday'
        ));
    }
}