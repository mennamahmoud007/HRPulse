<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;

// Home
Route::get('/', function () {
    return redirect('/login');
});

// Authentication
Route::get('/login', function () {
    return 'Login Page';
})->name('login');

Route::get('/register', function () {
    return 'Register Page';
})->name('register');

// Dashboard
Route::get('/dashboard', function () {
    return 'Dashboard';
})->name('dashboard');

// Employees
Route::resource('employees', EmployeeController::class);

// Departments
Route::resource('departments', DepartmentController::class);

// Positions
Route::get('/positions', function () {
    return 'Positions';
})->name('positions');

// Salaries
Route::get('/salaries', function () {
    return 'Salaries';
})->name('salaries');

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