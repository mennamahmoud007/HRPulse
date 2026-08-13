<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    // تعريف العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}