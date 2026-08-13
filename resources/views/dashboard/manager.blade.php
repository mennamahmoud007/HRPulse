<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - HRPulse</title>
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
        .icon-members { background: rgba(99, 102, 241, 0.15); color: #818cf8; }
        .icon-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
        .icon-present { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .stat-label { color: #64748b; font-size: 0.85rem; font-weight: 500; }
        .stat-value { color: #ffffff; font-size: 2rem; font-weight: 700; line-height: 1.1; margin-top: 4px; }
        .stat-sub { font-size: 0.78rem; font-weight: 600; margin-top: 6px; }
        .card-box { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 24px; }
        .custom-table { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .custom-table th { color: #475569; border-bottom: 1px solid #1e253e; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; padding: 14px 12px; background: transparent !important; }
        .custom-table td { border-bottom: 1px solid #1b2035; padding: 16px 12px; vertical-align: middle; font-size: 0.88rem; background: transparent !important; color: #cbd5e1 !important; }
        .custom-table tr:last-child td { border-bottom: none; }
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; flex-shrink: 0; }
        .badge-present { background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-halfday { background: rgba(245, 158, 11, 0.18); color: #fbbf24; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-absent { background: rgba(239, 68, 68, 0.18); color: #f87171; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .time-green { color: #34d399; font-weight: 600; }
        .time-muted { color: #475569; }
    </style>
</head>
<body>

@php
    $currentUser = auth()->user();
    $userName = $currentUser->name ?? 'yasmin';
    $userEmail = $currentUser->email ?? 'yt117@fayoum.edu.eg';
    $userInitials = strtoupper(substr($userName, 0, 2));

    $teamMembersDisplay = isset($teamMembersCount) ? $teamMembersCount : 3;
    $pendingLeavesDisplay = isset($pendingLeaves) ? $pendingLeaves : 1;
    $presentTodayDisplay = isset($presentToday) ? $presentToday : 1;
@endphp

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Dynamic Sidebar Inclusion -->
        @include('layouts.sidebar')

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
                    <div class="avatar-circle" style="width: 36px; height: 36px; background: #6366f1;">{{ $userInitials }}</div>
                    <span class="text-white fw-medium" style="font-size: 0.9rem;">{{ $userName }} <i class="fa-solid fa-chevron-down ms-1 text-secondary" style="font-size: 0.75rem;"></i></span>
                </div>
            </div>

            <!-- Page Title -->
            <div class="mb-4">
                <h3 class="text-white fw-bold mb-1">Manager Dashboard</h3>
                <p style="font-size: 0.85rem; color: #64748b;" class="mb-0">
                    {{ \Carbon\Carbon::now()->format('l, F j, Y') }} • Engineering Team
                </p>
            </div>

            <!-- 3 Stat Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-members"><i class="fa-solid fa-users"></i></div>
                        <div>
                            <div class="stat-label">Team Members</div>
                            <div class="stat-value">{{ $teamMembersDisplay }}</div>
                            <div class="stat-sub text-success">Active engineers</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-pending"><i class="fa-solid fa-circle-exclamation"></i></div>
                        <div>
                            <div class="stat-label">Pending Leaves</div>
                            <div class="stat-value">{{ $pendingLeavesDisplay }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon icon-present"><i class="fa-solid fa-user-check"></i></div>
                        <div>
                            <div class="stat-label">Present Today</div>
                            <div class="stat-value">{{ $presentTodayDisplay }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Attendance Table Section -->
            <div class="card-box">
                <h5 class="text-white fw-bold mb-4" style="font-size: 1.05rem;">Team Attendance — Today</h5>
                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>EMPLOYEE</th>
                                <th>POSITION</th>
                                <th>CHECK IN</th>
                                <th>CHECK OUT</th>
                                <th>HOURS</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($teamAttendance) && count($teamAttendance) > 0)
                                @foreach($teamAttendance as $emp)
                                @php
                                    $att = is_object($emp->attendance) ? $emp->attendance : (is_array($emp->attendance) ? (object)$emp->attendance : null);

                                    $rawCheckIn = $emp->check_in ?? $att?->check_in ?? null;
                                    $rawCheckOut = $emp->check_out ?? $att?->check_out ?? null;

                                    $checkIn = $rawCheckIn ? date('H:i', strtotime($rawCheckIn)) : '--';
                                    $checkOut = $rawCheckOut ? date('H:i', strtotime($rawCheckOut)) : '--';
                                    
                                    $hours = $emp->hours ?? '--';
                                    if ($hours === '--' && $rawCheckIn && $rawCheckOut) {
                                        $start = \Carbon\Carbon::parse($rawCheckIn);
                                        $end = \Carbon\Carbon::parse($rawCheckOut);
                                        $diff = $start->diff($end);
                                        $hours = $diff->h . 'h ' . $diff->i . 'm';
                                    }

                                    $status = $emp->status ?? ($rawCheckIn ? 'Present' : 'Absent');
                                    $statusClass = match(strtolower($status)) {
                                        'present' => 'badge-present',
                                        'half day' => 'badge-halfday',
                                        default => 'badge-absent'
                                    };
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle" style="background: #818cf8;">
                                                {{ strtoupper(substr($emp->name ?? 'E', 0, 2)) }}
                                            </div>
                                            <div class="text-white fw-semibold">{{ $emp->name ?? 'Employee' }}</div>
                                        </div>
                                    </td>
                                    <td style="color: #94a3b8;">{{ $emp->position_name ?? $emp->position ?? 'Engineer' }}</td>
                                    <td class="{{ $checkIn != '--' ? 'time-green' : 'time-muted' }}">{{ $checkIn }}</td>
                                    <td class="{{ $checkOut != '--' ? 'text-white-50' : 'time-muted' }}">{{ $checkOut }}</td>
                                    <td class="{{ $hours != '--' ? 'text-white-50' : 'time-muted' }}">{{ $hours }}</td>
                                    <td><span class="{{ $statusClass }}">{{ ucfirst($status) }}</span></td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle" style="background: #6366f1;">SM</div>
                                            <div class="text-white fw-semibold">Sarah Mitchell</div>
                                        </div>
                                    </td>
                                    <td style="color: #94a3b8;">Senior Developer</td>
                                    <td class="time-green">08:52</td>
                                    <td class="text-white-50">17:30</td>
                                    <td class="text-white-50">8h 38m</td>
                                    <td><span class="badge-present">Present</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle" style="background: #818cf8;">LW</div>
                                            <div class="text-white fw-semibold">Lucas Weber</div>
                                        </div>
                                    </td>
                                    <td style="color: #94a3b8;">Frontend Developer</td>
                                    <td class="time-green">09:00</td>
                                    <td class="text-white-50">13:30</td>
                                    <td class="text-white-50">4h 30m</td>
                                    <td><span class="badge-halfday">Half Day</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle" style="background: #4f46e5;">RN</div>
                                            <div class="text-white fw-semibold">Ryan Nakamura</div>
                                        </div>
                                    </td>
                                    <td style="color: #94a3b8;">Backend Developer</td>
                                    <td class="time-muted">--</td>
                                    <td class="time-muted">--</td>
                                    <td class="time-muted">--</td>
                                    <td><span class="badge-absent">Absent</span></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>