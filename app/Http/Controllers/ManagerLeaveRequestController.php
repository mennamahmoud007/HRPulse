<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class ManagerLeaveRequestController extends Controller
{
    public function index()
    {
        // جلب جميع الطلبات مع بيانات المستخدم مرتبة من الأحدث للأقدم
        $leaveRequests = LeaveRequest::with('user')->latest()->get();
        $pendingCount = LeaveRequest::where('status', 'pending')->count();

        return view('manager.leave-requests', compact('leaveRequests', 'pendingCount'));
    }

    public function updateStatus(Request $request, $id)
    {
        // التحقق من أن حالة الطلب إما مقبولة أو مرفوضة فقط
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