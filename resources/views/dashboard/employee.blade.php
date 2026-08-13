<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - HRPulse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0d111d; color: #94a3b8; font-family: 'Inter', system-ui, sans-serif; }
        .sidebar { background-color: #121625; min-height: 100vh; padding: 24px 16px; border-right: 1px solid #1a1f33; }
        .brand-icon { background: #6366f1; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; }
        .brand-badge { color: #6366f1; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; }
        .menu-title { color: #475569; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-top: 20px; margin-bottom: 10px; padding-left: 12px; }
        .nav-link { color: #94a3b8; padding: 10px 14px; border-radius: 10px; font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 4px; transition: all 0.2s; }
        .nav-link:hover { color: #fff; background-color: rgba(255, 255, 255, 0.05); }
        .nav-link.active { background-color: #6366f1; color: #fff; font-weight: 600; }
        
        .stat-card { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 22px 24px; height: 100%; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .icon-purple { background: rgba(99, 102, 241, 0.15); color: #818cf8; }
        .icon-green { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .icon-yellow { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
        
        .stat-label { color: #64748b; font-size: 0.85rem; font-weight: 500; }
        .stat-value { color: #ffffff; font-size: 1.8rem; font-weight: 700; line-height: 1.2; margin-top: 2px; }
        .stat-sub { font-size: 0.78rem; font-weight: 600; margin-top: 4px; }
        
        .card-box { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 24px; }
        .custom-table { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .custom-table th { color: #475569; border-bottom: 1px solid #1e253e; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; padding: 14px 12px; background: transparent !important; }
        .custom-table td { border-bottom: 1px solid #1b2035; padding: 16px 12px; vertical-align: middle; font-size: 0.88rem; background: transparent !important; color: #cbd5e1 !important; }
        
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; flex-shrink: 0; }
        .badge-present { background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .time-green { color: #34d399; font-weight: 500; }
    </style>
</head>

<body>

@php
    $userName = $user->name ?? 'Sarah Mitchell';
    $userEmail = $user->email ?? 'sarah.mitchell@corp.io';
    $userInitials = strtoupper(substr($userName, 0, 2));
@endphp

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-flex flex-column">
            <div class="brand mb-3 px-2 d-flex align-items-center gap-2">
                <div class="brand-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div>
                    <div class="text-white fw-bold" style="font-size: 1.1rem;">HRPulse</div>
                    <span class="brand-badge">EMPLOYEE</span>

                </div>
            </div>

            <div class="menu-title">MENU</div>

            <div class="nav flex-column">
                <a href="{{ route('employee.dashboard') }}" class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-border-all"></i> Dashboard
                </a>
                <a href="/profile" class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                    <i class="fa-regular fa-user"></i> My Profile
                </a>
                <a href="{{ route('employee.salary') }}" class="nav-link {{ request()->routeIs('employee.salary') ? 'active' : '' }}">
                    <i class="fa-solid fa-dollar-sign"></i> My Salary
                </a>
                <a href="{{ route('employee.attendance') }}" class="nav-link {{ request()->routeIs('employee.attendance') ? 'active' : '' }}">
                    <i class="fa-regular fa-clock"></i> Attendance History
                </a>
                <a href="{{ route('employee.leaves') }}" class="nav-link {{ request()->routeIs('employee.leaves') ? 'active' : '' }}">
                    <i class="fa-regular fa-envelope"></i> Leave Requests
                </a>
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
        <div class="col-md-10 p-4 px-5">
            <!-- Header Bar -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-secondary btn-sm border-0"><i class="fa-solid fa-bars text-white fs-5"></i></button>
                    <h4 class="text-white mb-0 fw-bold">Dashboard</h4>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-regular fa-bell text-secondary fs-5" style="cursor: pointer;"></i>
                    <div class="avatar-circle">{{ $userInitials }}</div>
                    <span class="text-white fw-medium" style="font-size: 0.9rem;">{{ $userName }} <i class="fa-solid fa-chevron-down ms-1 text-secondary" style="font-size: 0.75rem;"></i></span>
                </div>
            </div>

            <!-- Page Title -->
            <div class="mb-4">
                <h3 class="text-white fw-bold mb-1">My Dashboard</h3>
                <p style="font-size: 0.85rem; color: #64748b;" class="mb-0">
                    {{ \Carbon\Carbon::now()->format('l, F j, Y') }} • Welcome back, {{ $userName }}!
                </p>
            </div>

            <!-- 3 Stat Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-purple"><i class="fa-solid fa-dollar-sign"></i></div>
                        <div>
                            <div class="stat-label">Net Salary (July)</div>
                            <div class="stat-value">${{ number_format($netSalary) }}</div>
                            <div class="stat-sub text-success">Basic: ${{ number_format($basicSalary) }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-green"><i class="fa-regular fa-clock"></i></div>
                        <div>
                            <div class="stat-label">Days Present</div>
                            <div class="stat-value">{{ $daysPresent }}</div>
                            <div class="stat-sub text-success">Last 30 days</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-yellow"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                        <div>
                            <div class="stat-label">Leave Requests</div>
                            <div class="stat-value">{{ $pendingLeaves }}</div>
                            <div class="stat-sub text-success">0 pending</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-white fw-bold mb-0" style="font-size: 1.05rem;">Recent Attendance</h5>
                    <a href="{{ route('employee.attendance') }}" class="btn btn-dark btn-sm text-secondary border-0" style="background: #1b2035; font-size: 0.8rem;">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>CHECK IN</th>
                                <th>CHECK OUT</th>
                                <th>WORKING HOURS</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAttendance as $item)
                            @php
                                $date = isset($item->date) ? $item->date : (isset($item->created_at) ? date('Y-m-d', strtotime($item->created_at)) : '--');
                                $checkIn = $item->check_in ?? '--';
                                $checkOut = $item->check_out ?? '--';
                                $hours = $item->working_hours ?? '8h 30m';
                                $status = $item->status ?? 'Present';
                            @endphp
                            <tr>
                                <td class="text-white fw-medium">{{ $date }}</td>
                                <td class="time-green">{{ $checkIn }}</td>
                                <td class="text-white-50">{{ $checkOut }}</td>
                                <td class="text-white-50">{{ $hours }}</td>
                                <td><span class="badge-present">{{ ucfirst($status) }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>