<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employee;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'basic',
        'bonus',
        'deduction',
        'net_salary',
        'from_date',
        'to_date',
    ];

    // Salary belongs to Employee through employee's user_id
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'user_id');
    }
}