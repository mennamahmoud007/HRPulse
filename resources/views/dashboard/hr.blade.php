<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - HRPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0b0e19; color: #94a3b8; font-family: 'Inter', system-ui, sans-serif; }
        
        .sidebar { background-color: #111425; min-height: 100vh; padding: 24px 16px; border-right: 1px solid #1a1d33; }
        .brand-icon { background: #6366f1; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; }
        .brand-badge { background-color: rgba(99, 102, 241, 0.2); color: #818cf8; font-size: 0.65rem; padding: 2px 8px; border-radius: 4px; font-weight: 700; }
        .nav-link { color: #8f95b2; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 4px; }
        .nav-link:hover, .nav-link.active { background-color: #6366f1; color: #fff; }
        
        .stat-card { background-color: #13172b; border: 1px solid #1e233d; border-radius: 14px; padding: 20px; }
        .stat-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
        .icon-purple { background: rgba(99, 102, 241, 0.15); color: #818cf8; }
        .icon-green { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .icon-red { background: rgba(239, 68, 68, 0.15); color: #f87171; }
        .icon-orange { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
        
        .card-box { background-color: #13172b; border: 1px solid #1e233d; border-radius: 14px; padding: 20px; }
        
        /* Table Figma Exact Match */
        .custom-table { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .custom-table th { color: #d5e2f5; border-bottom: 1px solid #1e233d; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; padding: 12px 10px; background: transparent !important; }
        .custom-table td { border-bottom: 1px solid #1a1e36; padding: 16px 10px; vertical-align: middle; font-size: 0.88rem; background: transparent !important; color: #cbd5e1 !important; }
        .custom-table tr:last-child td { border-bottom: none; }
        
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; flex-shrink: 0; }
        
        /* Status Badges */
        .badge-active { background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-pending { background: rgba(245, 158, 11, 0.18); color: #fbbf24; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-approved { background: rgba(16, 185, 129, 0.18); color: #34d399; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-rejected { background: rgba(239, 68, 68, 0.18); color: #f87171; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-type { background: rgba(99, 102, 241, 0.2); color: #818cf8; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        
        .btn-view-all { background: transparent; border: 1px solid #2a2f4c; color: #94a3b8; font-size: 0.75rem; padding: 5px 12px; border-radius: 6px; text-decoration: none; }
        .btn-view-all:hover { background: #1e233d; color: #fff; }
    </style>
</head>
<body>

@php
    $currentUser = auth()->user();
    $userName = $currentUser->name ?? 'HR Admin';
    $userEmail = $currentUser->email ?? 'hr@company.com';
    $userInitials = strtoupper(substr($userName, 0, 2));
@endphp

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-flex flex-column">
            <div class="brand mb-4 px-2 d-flex align-items-center gap-2">
                <div class="brand-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div>
                    <div class="text-white fw-bold" style="font-size: 1.1rem;">HRPulse</div>
                    <span class="brand-badge">HR</span>
                </div>
            </div>

            <div class="nav flex-column gap-1">
                <a href="{{ route('hr.dashboard') }}" class="nav-link active"><i class="fa-solid fa-border-all"></i> Dashboard</a>
                <a href="{{ route('employees.index') }}" class="nav-link"><i class="fa-regular fa-user"></i> Employees</a>
                <a href="{{ route('departments.index') }}" class="nav-link"><i class="fa-regular fa-building"></i> Departments</a>
                <a href="{{ route('positions.index') }}" class="nav-link"><i class="fa-solid fa-briefcase"></i> Positions</a>
                <a href="{{ route('hr.salaries') }}" class="nav-link"><i class="fa-solid fa-dollar-sign"></i> Salaries</a>
                <a href="{{ route('hr.attendance') }}" class="nav-link"><i class="fa-regular fa-clock"></i> Attendance</a>
                <a href="{{ route('hr.leave-requests') }}" class="nav-link"><i class="fa-regular fa-envelope"></i> Leave Requests</a>
                <a href="#" class="nav-link"><i class="fa-solid fa-chart-simple"></i> Reports</a>
                <a href="{{ route('profile') }}" class="nav-link"><i class="fa-regular fa-circle-user"></i> Profile</a>
            </div>

            <div class="mt-auto pt-3 border-top border-secondary-subtle">
                <div class="d-flex align-items-center gap-2 mb-3 px-1">
                    <div class="avatar-circle">{{ $userInitials }}</div>
                    <div class="overflow-hidden">
                        <div class="text-white fw-medium text-truncate" style="font-size: 0.85rem;">{{ $userName }}</div>
                        <div class="text-muted text-truncate" style="font-size: 0.75rem;">{{ $userEmail }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger text-decoration-none nav-link w-100 p-0 border-0"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">

            <h3 class="text-white fw-bold mb-1">HR Dashboard</h3>
            <p style="font-size: 0.85rem; color: #64748b;" class="mb-4">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>

            <!-- Stat Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-purple"><i class="fa-solid fa-users"></i></div>
                        <div>
                            <div class="text-muted small fw-medium">Total Employees</div>
                            <div class="text-white fs-3 fw-bold">{{ $totalEmployees ?? 0 }}</div>
                            <div class="text-success" style="font-size: 0.72rem; font-weight: 600;">+2 this month</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-green"><i class="fa-solid fa-user-check"></i></div>
                        <div>
                            <div class="text-muted small fw-medium">Present Today</div>
                            <div class="text-white fs-3 fw-bold">{{ $presentToday ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-red"><i class="fa-solid fa-user-xmark"></i></div>
                        <div>
                            <div class="text-muted small fw-medium">Absent Today</div>
                            <div class="text-white fs-3 fw-bold">{{ $absentToday ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-orange"><i class="fa-solid fa-circle-exclamation"></i></div>
                        <div>
                            <div class="text-muted small fw-medium">Pending Leaves</div>
                            <div class="text-white fs-3 fw-bold">{{ $pendingLeaves ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Double Tables Section -->
            <div class="row g-3">
                <!-- Table 1: Recent Employees -->
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-white fw-semibold mb-0">Recent Employees</h6>
                            <a href="{{ route('employees.index') }}" class="btn-view-all">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom-table align-middle">
                                <thead>
                                    <tr>
                                        <th>EMPLOYEE</th>
                                        <th>DEPARTMENT</th>
                                        <th>POSITION</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentEmployees as $emp)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-circle">{{ strtoupper(substr($emp->name ?? 'E', 0, 2)) }}</div>
                                                <div style="line-height: 1.2;">
                                                    <div class="text-white fw-medium">{{ $emp->name ?? 'N/A' }}</div>
                                                    <div style="color: #64748b; font-size: 0.75rem;">{{ $emp->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-white-50">{{ $emp->department_name ?? 'Engineering' }}</td>
                                        <td class="text-white-50">{{ $emp->position_name ?? 'Developer' }}</td>
                                        <td><span class="badge-active">Active</span></td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center text-muted py-4">No recent employees found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Table 2: Recent Leave Requests -->
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-white fw-semibold mb-0">Recent Leave Requests</h6>
                            <a href="{{ route('hr.leave-requests') }}" class="btn-view-all">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom-table align-middle">
                                <thead>
                                    <tr>
                                        <th>EMPLOYEE</th>
                                        <th>TYPE</th>
                                        <th>DURATION</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentLeaves as $leave)
                                    @php
                                        //  (Duration)
                                        $start = \Carbon\Carbon::parse($leave->start_date);
                                        $end = \Carbon\Carbon::parse($leave->end_date);
                                        $days = $start->diffInDays($end) + 1;
                                        
                                        $statusClass = match(strtolower($leave->status)) {
                                            'approved' => 'badge-approved',
                                            'rejected' => 'badge-rejected',
                                            default => 'badge-pending'
                                        };
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-circle">{{ strtoupper(substr($leave->employee_name ?? 'E', 0, 2)) }}</div>
                                                <div class="text-white fw-medium">{{ $leave->employee_name ?? 'Employee' }}</div>
                                            </div>
                                        </td>
                                        <td><span class="badge-type">{{ $leave->leave_type ?? 'Annual' }}</span></td>
                                        <td class="text-white-50 fw-medium">{{ $days }}d</td>
                                        <td><span class="{{ $statusClass }}">{{ ucfirst($leave->status ?? 'Pending') }}</span></td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center text-muted py-4">No leave requests found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>