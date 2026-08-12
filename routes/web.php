<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HrDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\ManagerTeamEmployeeController;
use App\Http\Controllers\ManagerAttendanceController;
use App\Http\Controllers\ManagerLeaveRequestController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HREmployeeController;

Route::get('/employees', [HREmployeeController::class, 'index'])->name('employees.index');
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee/salary', [SalaryController::class, 'index'])->name('employee.salary');
    Route::get('/employee/attendance', [AttendanceController::class, 'index'])->name('employee.attendance');
    Route::get('/employee/leave-requests', [LeaveRequestController::class, 'index'])->name('employee.leaves');
    Route::post('/employee/leave-requests', [LeaveRequestController::class, 'store'])->name('employee.leaves.store');
});

// Dashboard
Route::get('/hr/dashboard', [HrDashboardController::class, 'index'])->middleware('auth')->name('hr.dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Employee Dashboard Route
Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])
    ->middleware(['auth', 'role:employee'])
    ->name('employee.dashboard');

// Employee
Route::middleware(['auth', 'role:employee'])->group(function () {
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

// HR Resources
Route::resource('employees', EmployeeController::class);

Route::middleware(['auth', 'role:hr'])->group(function () {
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

// Positions
Route::resource('positions', PositionController::class);

// Salaries
Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries');

// Manager Routes (مجمعة ومنظمة بدون تكرار)
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::patch('/manager/leave-requests/{id}', [ManagerLeaveRequestController::class, 'updateStatus'])->name('manager.leave-requests.update');
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
    Route::get('/manager/team-employees', [ManagerTeamEmployeeController::class, 'index'])->name('manager.team-employees');
    Route::get('/manager/attendance', [ManagerAttendanceController::class, 'index'])->name('manager.attendance');
    Route::get('/manager/leave-requests', [ManagerLeaveRequestController::class, 'index'])->name('manager.leave-requests');
    Route::get('/manager/performance', [PerformanceController::class, 'index'])->name('manager.performance');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('admin.dashboard');
});

// Reports
Route::get('/reports', function () {
    return 'Reports';
})->name('reports');

Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');