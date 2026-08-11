<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LeaveRequestController extends Controller
{
    // عرض شاشة طلبات الإجازة
    public function index()
    {
        $user = auth()->user();
        $userId = auth()->id();

        // تحديد اسم جدول الإجازات
        $leaveTable = Schema::hasTable('leave_requests') ? 'leave_requests' : (Schema::hasTable('leaves') ? 'leaves' : null);

        $pending = 0;
        $approved = 0;
        $rejected = 0;
        $requests = collect();

        if ($leaveTable) {
            $leaveFk = Schema::hasColumn($leaveTable, 'user_id') ? 'user_id' : 'employee_id';

            $pending = DB::table($leaveTable)->where($leaveFk, $userId)->where('status', 'pending')->count();
            $approved = DB::table($leaveTable)->where($leaveFk, $userId)->where('status', 'approved')->count();
            $rejected = DB::table($leaveTable)->where($leaveFk, $userId)->where('status', 'rejected')->count();

            $requests = DB::table($leaveTable)
                ->where($leaveFk, $userId)
                ->orderBy('created_at', 'desc')
                ->get();
        }

       // غيري المفرد بالجمع:
return view('employees.leaves', compact('user', 'pending', 'approved', 'rejected', 'requests'));
    }

    // حفظ طلب الإجازة الجديد
    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'nullable|string',
        ]);

        $userId = auth()->id();
        $leaveTable = Schema::hasTable('leave_requests') ? 'leave_requests' : (Schema::hasTable('leaves') ? 'leaves' : 'leave_requests');

        $data = [
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (Schema::hasColumn($leaveTable, 'user_id')) {
            $data['user_id'] = $userId;
        } elseif (Schema::hasColumn($leaveTable, 'employee_id')) {
            $data['employee_id'] = $userId;
        }

        if (Schema::hasColumn($leaveTable, 'leave_type')) {
            $data['leave_type'] = $request->leave_type;
        } elseif (Schema::hasColumn($leaveTable, 'type')) {
            $data['type'] = $request->leave_type;
        }

        if (Schema::hasColumn($leaveTable, 'start_date')) {
            $data['start_date'] = $request->start_date;
        }
        if (Schema::hasColumn($leaveTable, 'end_date')) {
            $data['end_date'] = $request->end_date;
        }
        if (Schema::hasColumn($leaveTable, 'reason')) {
            $data['reason'] = $request->reason;
        }
        if (Schema::hasColumn($leaveTable, 'status')) {
            $data['status'] = 'pending';
        }

        DB::table($leaveTable)->insert($data);

        return redirect()->back()->with('success', 'Leave request submitted successfully!');
    }
}