<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\HRDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\EmployeeDashboardController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;

use App\Http\Controllers\ManagerTeamEmployeeController;
use App\Http\Controllers\ManagerAttendanceController;
use App\Http\Controllers\ManagerLeaveRequestController;


// =========================
// Home
// =========================

Route::get('/', function () {
    return view('home');
})->name('home');


// =========================
// Authentication
// =========================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// =========================
// Profile
// =========================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');
});


// =========================
// Employee Dashboard
// =========================

Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])
    ->middleware(['auth', 'role:employee'])
    ->name('employee.dashboard');


// =========================
// Employee
// =========================

Route::middleware(['auth', 'role:employee'])->group(function () {

    Route::get('/salaries', [SalaryController::class, 'index'])
        ->name('salary.employee');

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance');

    Route::get('/leave-requests', [LeaveRequestController::class, 'index'])
        ->name('leave-requests');

    Route::post('/leave-requests', [LeaveRequestController::class, 'store'])
        ->name('leave-requests.store');
});


// =========================
// HR
// =========================

Route::middleware(['auth', 'role:hr'])->group(function () {

    Route::get('/hr/dashboard', [HRDashboardController::class, 'index'])
        ->name('hr.dashboard');

    Route::resource('employees', EmployeeController::class);

    Route::resource('departments', DepartmentController::class);

    Route::resource('positions', PositionController::class);

    Route::get('/hr/salaries', [SalaryController::class, 'index'])
        ->name('hr.salaries');
    Route::get('/hr/leave-requests', [LeaveRequestController::class, 'index'])
    ->name('hr.leave-requests');
        Route::get('/hr/attendance', [AttendanceController::class, 'index'])
        ->name('hr.attendance');
});


// =========================
// Manager
// =========================

Route::middleware(['auth', 'role:manager'])->group(function () {

    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])
        ->name('manager.dashboard');

    Route::get('/manager/team-employees', [ManagerTeamEmployeeController::class, 'index'])
        ->name('manager.team-employees');

    Route::get('/manager/attendance', [ManagerAttendanceController::class, 'index'])
        ->name('manager.attendance');

    Route::get('/manager/leave-requests', [ManagerLeaveRequestController::class, 'index'])
        ->name('manager.leave-requests');

    Route::patch('/manager/leave-requests/{id}', [ManagerLeaveRequestController::class, 'updateStatus'])
        ->name('manager.leave-requests.update');
});


// =========================
// Admin
// =========================

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('admin.dashboard');
});


// =========================
// Reports
// =========================

Route::get('/reports', function () {
    return 'Reports';
})->name('reports');