<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;

// Authentication

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.employee');
     })->name('dashboard');


// Employees
Route::resource('employees', EmployeeController::class);


// Departments
Route::resource('departments', DepartmentController::class);


// Positions
Route::resource('positions', PositionController::class);


// Salaries
Route::get('/salaries', [SalaryController::class, 'index'])
    ->name('salaries');


// Attendance
Route::get('/attendance', function () {
    return 'Attendance';
})->name('attendance');


// Leave Requests
Route::get('/leave-requests', function () {
    return 'Leave Requests';
})->name('leave-requests');


// Performance
Route::get('/performance', function () {
    return 'Performance';
})->name('performance');


// Reports
Route::get('/reports', function () {
    return 'Reports';
})->name('reports');


// Profile
Route::get('/profile', function () {
    return 'Profile';
})->name('profile');
