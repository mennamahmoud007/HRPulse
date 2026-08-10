<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

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

    // Salary belongs to Employee (User)
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}