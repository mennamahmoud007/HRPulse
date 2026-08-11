<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
   public function index()
{
    $user = auth()->user();
    return view('employees.attendance', compact('user'));
}
}