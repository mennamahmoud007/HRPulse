<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Salary - HRPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0d111d; color: #94a3b8; font-family: 'Inter', system-ui, sans-serif; }
        .sidebar { background-color: #121625; min-height: 100vh; padding: 24px 16px; border-right: 1px solid #1a1f33; }
        .brand-icon { background: #6366f1; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; }
        .brand-badge { color: #6366f1; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; }
        .menu-title { color: #475569; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-top: 20px; margin-bottom: 10px; padding-left: 12px; }
        .nav-link { color: #94a3b8; padding: 10px 14px; border-radius: 10px; font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 4px; }
        .nav-link:hover { color: #fff; background-color: rgba(255, 255, 255, 0.05); }
        .nav-link.active { background-color: #6366f1; color: #fff; font-weight: 600; }
        .card-box { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 24px; }
        .salary-row { background: #121625; border: 1px solid #1e253e; border-radius: 10px; padding: 18px 20px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center; }
        .net-salary-card { background: #1a1e36; border: 1px solid #6366f1; border-radius: 12px; padding: 22px 24px; display: flex; justify-content: space-between; align-items: center; }
        .stat-card { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 22px 24px; height: 100%; display: flex; align-items: center; gap: 16px; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; flex-shrink: 0; }
        .badge-paid { background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
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
                <a href="{{ route('employee.dashboard') }}" class="nav-link"><i class="fa-solid fa-border-all"></i> Dashboard</a>
                <a href="/profile" class="nav-link"><i class="fa-regular fa-user"></i> My Profile</a>
                <a href="{{ route('employee.salary') }}" class="nav-link active"><i class="fa-solid fa-dollar-sign"></i> My Salary</a>
                <a href="{{ route('employee.attendance') }}" class="nav-link"><i class="fa-regular fa-clock"></i> Attendance History</a>
                <a href="{{ route('employee.leaves') }}" class="nav-link"><i class="fa-regular fa-envelope"></i> Leave Requests</a>
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
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-secondary btn-sm border-0"><i class="fa-solid fa-bars text-white fs-5"></i></button>
                    <h4 class="text-white mb-0 fw-bold">My Salary</h4>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-regular fa-bell text-secondary fs-5"></i>
                    <div class="avatar-circle">{{ $userInitials }}</div>
                    <span class="text-white fw-medium" style="font-size: 0.9rem;">{{ $userName }} <i class="fa-solid fa-chevron-down ms-1 text-secondary" style="font-size: 0.75rem;"></i></span>
                </div>
            </div>

            <!-- Main Breakdown Card -->
            <div class="card-box mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-white fw-bold mb-0">Salary Breakdown — July 2026</h5>
                    <span class="badge-paid">Paid</span>
                </div>

                <div class="salary-row">
                    <span class="text-white fw-medium">Basic Salary</span>
                    <span class="text-white fw-bold fs-5">$95,000</span>
                </div>
                <div class="salary-row">
                    <span class="text-white fw-medium">Performance Bonus</span>
                    <span class="text-success fw-bold fs-5">+$5,000</span>
                </div>
                <div class="salary-row">
                    <span class="text-white fw-medium">Tax Deduction</span>
                    <span class="text-danger fw-bold fs-5">$2,800</span>
                </div>

                <div class="net-salary-card mt-3">
                    <span class="fw-bold" style="color: #818cf8; font-size: 1.1rem;">Net Salary</span>
                    <span class="text-white fw-bold fs-3">$97,200</span>
                </div>
            </div>

            <!-- 3 Sub Stat Cards -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(99, 102, 241, 0.15); color: #818cf8;"><i class="fa-solid fa-dollar-sign"></i></div>
                        <div>
                            <div class="text-secondary" style="font-size: 0.8rem;">Basic</div>
                            <div class="text-white fw-bold fs-4">$95,000</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.15); color: #34d399;"><i class="fa-solid fa-arrow-trend-up"></i></div>
                        <div>
                            <div class="text-secondary" style="font-size: 0.8rem;">Bonus</div>
                            <div class="text-success fw-bold fs-4">+$5,000</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.15); color: #f87171;"><i class="fa-solid fa-dollar-sign"></i></div>
                        <div>
                            <div class="text-secondary" style="font-size: 0.8rem;">Deduction</div>
                            <div class="text-danger fw-bold fs-4">-2,800</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>