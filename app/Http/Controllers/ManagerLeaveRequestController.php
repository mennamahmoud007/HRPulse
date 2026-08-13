<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class ManagerLeaveRequestController extends Controller
{
    public function index()
    {
    
        $leaveRequests = LeaveRequest::with('employee.user')
    ->latest()
    ->get();
        $pendingCount = LeaveRequest::where('status', 'pending')->count();

        return view('manager.leave-requests', compact('leaveRequests', 'pendingCount'));
    }

    public function updateStatus(Request $request, $id)
    {
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Leave request updated successfully.');
    }
}