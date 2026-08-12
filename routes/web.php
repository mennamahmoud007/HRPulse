<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HRDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;

// Authentication

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Profile

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

});

// Employee Dashboard



// Employee

Route::middleware(['auth', 'role:employee'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard.employee');
    })->name('employee.dashboard');
    Route::get('/salaries', [SalaryController::class, 'index'])->name('salary.employee');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');

    Route::get('/leave-requests', function () {
        return 'Leave Requests';
    })->name('leave-requests');

});

// HR

Route::middleware(['auth', 'role:hr'])->group(function () {

    Route::get('/hr/dashboard', [HRDashboardController::class, 'index'])
        ->name('hr.dashboard');

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
    Route::get('/salaries',function(){
        return view('salaries.index');
    })->name('salaries');

    Route::resource('positions', PositionController::class);
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