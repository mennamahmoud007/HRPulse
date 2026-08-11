<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
{
    $user = auth()->user();
    return view('employees.salary', compact('user'));
}
}