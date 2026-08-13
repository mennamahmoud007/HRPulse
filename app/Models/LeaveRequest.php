<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    // ربط العلاقة مع جدول المستخدمين عبر عمود employee_id
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // أو إن كان لديكِ موديل باسم Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}