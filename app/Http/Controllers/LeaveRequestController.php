<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $employee = $user->employee;

        if (!$employee) {
            abort(404, 'Employee not found.');
        }

        $requests = DB::table('leave_requests')
            ->where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $pending = DB::table('leave_requests')
            ->where('employee_id', $employee->id)
            ->where('status', 'pending')
            ->count();

        $approved = DB::table('leave_requests')
            ->where('employee_id', $employee->id)
            ->where('status', 'approved')
            ->count();

        $rejected = DB::table('leave_requests')
            ->where('employee_id', $employee->id)
            ->where('status', 'rejected')
            ->count();

        return view('employees.leaves', compact(
            'user',
            'pending',
            'approved',
            'rejected',
            'requests'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ]);

        $user = auth()->user();
        $employee = $user->employee;

        if (!$employee) {
            abort(404, 'Employee not found.');
        }

        DB::table('leave_requests')->insert([
            'employee_id' => $employee->id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Leave request submitted successfully!');
    }
}