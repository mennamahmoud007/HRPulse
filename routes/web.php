<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


// Authentication

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// Employee Dashboard

Route::get('/dashboard', function () {
    return view('dashboard.employee');
})->middleware(['auth', 'role:employee'])->name('employee.dashboard');


// Employee

Route::middleware(['auth', 'role:employee'])->group(function () {

    Route::get('/profile', function () {
        return 'Profile';
    })->name('profile');

    Route::get('/salaries', function () {
        return 'Salaries';
    })->name('salaries');

    Route::get('/attendance', function () {
        return 'Attendance';
    })->name('attendance');

    Route::get('/leave-requests', function () {
        return 'Leave Requests';
    })->name('leave-requests');

});


// HR

Route::middleware(['auth', 'role:hr'])->group(function () {

    Route::get('/hr/dashboard', function () {
        return 'HR Dashboard';
    })->name('hr.dashboard');

    Route::resource('employees', EmployeeController::class);

    Route::resource('departments', DepartmentController::class);

    Route::get('/positions', function () {
        return 'Positions';
    })->name('positions');

    Route::get('/hr/salaries', function () {
        return 'Salaries';
    })->name('hr.salaries');

    Route::get('/hr/attendance', function () {
        return 'Attendance';
    })->name('hr.attendance');

    Route::get('/hr/leave-requests', function () {
        return 'Leave Requests';
    })->name('hr.leave-requests');

    Route::get('/reports', function () {
        return 'Reports';
    })->name('reports');

});


// Manager

Route::middleware(['auth', 'role:manager'])->group(function () {

    Route::get('/manager/dashboard', function () {
        return 'Manager Dashboard';
    })->name('manager.dashboard');

    Route::get('/manager/attendance', function () {
        return 'Attendance';
    })->name('manager.attendance');

    Route::get('/manager/leave-requests', function () {
        return 'Leave Requests';
    })->name('manager.leave-requests');

    Route::get('/performance', function () {
        return 'Performance';
    })->name('performance');

});


// Admin

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');

});