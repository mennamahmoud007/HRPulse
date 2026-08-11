@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - HRPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: sans-serif; }
        .card-custom { background-color: #1e293b; border: 1px solid #334155; border-radius: 12px; }
        .badge-active { background-color: rgba(16, 185, 129, 0.2); color: #10b981; }
        .badge-pending { background-color: rgba(245, 158, 11, 0.2); color: #f59e0b; }
        .badge-type { background-color: #312e81; color: #818cf8; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; background: #6366f1; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .table-custom { --bs-table-bg: transparent; --bs-table-color: #cbd5e1; }
        </style>
</head>
<body class="p-4">
    
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="fw-bold">HR Dashboard</h2>
            <p class="text-secondary">Wednesday, August 6, 2026</p>
        </div>
        
        <!-- 4 KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card-custom p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary d-block">Total Employees</span>
                        <h3 class="fw-bold my-1">12</h3>
                        <small class="text-success">+2 this month</small>
                    </div>
                    <i class="bi bi-people fs-2 text-primary"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary d-block">Present Today</span>
                        <h3 class="fw-bold my-1">5</h3>
                    </div>
                    <i class="bi bi-person-check fs-2 text-success"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary d-block">Absent Today</span>
                        <h3 class="fw-bold my-1">1</h3>
                    </div>
                    <i class="bi bi-person-x fs-2 text-danger"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-secondary d-block">Pending Leaves</span>
                        <h3 class="fw-bold my-1">2</h3>
                    </div>
                    <i class="bi bi-exclamation-circle fs-2 text-warning"></i>
                </div>
            </div>
        </div>
        
        <!-- Tables Row -->
        <div class="row g-4">
            <!-- Recent Employees -->
            <div class="col-md-6">
                <div class="card-custom p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Recent Employees</h5>
                        <button class="btn btn-sm btn-outline-secondary">View All</button>
                    </div>
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr class="text-secondary">
                                <th>EMPLOYEE</th>
                                <th>DEPARTMENT</th>
                                <th>POSITION</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar">SM</div>
                                        <div>
                                            <div class="fw-bold text-light">Sarah Mitchell</div>
                                            <small class="text-secondary">sarah@corp.io</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Engineering</td>
                                <td>Senior Developer</td>
                                <td><span class="badge badge-active">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Recent Leave Requests -->
            <div class="col-md-6">
                <div class="card-custom p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Recent Leave Requests</h5>
                        <button class="btn btn-sm btn-outline-secondary">View All</button>
                    </div>
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr class="text-secondary">
                                <th>EMPLOYEE</th>
                                <th>TYPE</th>
                                <th>DURATION</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar">MC</div>
                                        <div>
                                            <div class="fw-bold text-light">Marcus Chen</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-type">Annual</span></td>
                                <td>5d</td>
                                <td><span class="badge badge-pending">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
@endsection