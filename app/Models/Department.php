<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'manager_id',
    ];

    // Department has many Positions
    public function positions()
    {
        return $this->hasMany(Position::class);
    }



    // Department belongs to Manager (Employee)
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}