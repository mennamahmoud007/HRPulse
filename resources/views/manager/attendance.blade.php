<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - HRPulse</title>
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
        .card-box { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 24px; }
        .custom-table { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .custom-table th { color: #475569; border-bottom: 1px solid #1e253e; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; padding: 14px 12px; background: transparent !important; }
        .custom-table td { border-bottom: 1px solid #1b2035; padding: 16px 12px; vertical-align: middle; font-size: 0.88rem; background: transparent !important; color: #cbd5e1 !important; }
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; flex-shrink: 0; }
        .badge-present { background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-halfday { background: rgba(245, 158, 11, 0.18); color: #fbbf24; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .search-input { background-color: #0f1422; border: 1px solid #1e253e; color: #fff; padding: 10px 16px 10px 40px; border-radius: 10px; font-size: 0.88rem; width: 100%; }
        .date-picker-input { background-color: #0f1422; border: 1px solid #1e253e; color: #cbd5e1; padding: 10px 16px; border-radius: 10px; font-size: 0.88rem; min-width: 160px; }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="col-md-10 p-4 px-5">
            <div class="mb-4">
                <h3 class="text-white fw-bold mb-1">Attendance Monitoring</h3>
                <p style="font-size: 0.85rem; color: #64748b;" class="mb-0">Track your team's daily attendance</p>
            </div>

            <div class="card-box">
                <div class="d-flex gap-3 mb-4">
                    <div class="position-relative flex-grow-1">
                        <i class="fa-solid fa-magnifying-glass position-absolute" style="left: 14px; top: 50%; transform: translateY(-50%); color: #475569;"></i>
                        <input type="text" class="search-input" placeholder="Search team members...">
                    </div>
                    <div>
                        <input type="text" class="date-picker-input" value="08/06/2026">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>EMPLOYEE</th>
                                <th>DATE</th>
                                <th>CHECK IN</th>
                                <th>CHECK OUT</th>
                                <th>HOURS</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                       <tbody>
    @forelse($attendances as $attendance)
        @php
            // 1. استخراج بيانات المستخدم/الموظف
            $person = $attendance->user ?? $attendance->employee ?? null;
            $userName = $person?->name 
                ?? $person?->full_name 
                ?? $attendance->user_name 
                ?? $attendance->employee_name 
                ?? $attendance->name 
                ?? 'Employee';

            $initials = strtoupper(substr($userName, 0, 2));

            // 2. معالجة وقت الحضور والانصراف
            $rawCheckIn = $attendance->check_in ?? null;
            $rawCheckOut = $attendance->check_out ?? null;

            $checkIn = $rawCheckIn ? \Carbon\Carbon::parse($rawCheckIn)->format('H:i') : '--';
            $checkOut = $rawCheckOut ? \Carbon\Carbon::parse($rawCheckOut)->format('H:i') : '--';

            // 3. حساب ساعات العمل
            $hours = $attendance->hours ?? null;
            if ((!$hours || $hours === 'N/A') && $rawCheckIn && $rawCheckOut) {
                $start = \Carbon\Carbon::parse($rawCheckIn);
                $end = \Carbon\Carbon::parse($rawCheckOut);
                $diff = $start->diff($end);
                $hours = $diff->h . 'h ' . $diff->i . 'm';
            }
            $hours = $hours ?: '--';

            // 4. تحديد لون وشكل شارة الحالة
            $status = strtolower($attendance->status ?? 'absent');
            $statusClass = match($status) {
                'present' => 'badge-present',
                'late', 'half day' => 'badge-halfday',
                default => 'badge-absent'
            };
        @endphp

        <tr>
            <td>
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar-circle" style="background: #6366f1;">
                        {{ $initials }}
                    </div>
                    <span class="text-white fw-semibold">{{ $userName }}</span>
                </div>
            </td>
            <td class="text-white-50">{{ $attendance->date ?? '--' }}</td>
            <td class="time-green">{{ $checkIn }}</td>
            <td class="text-white-50">{{ $checkOut }}</td>
            <td class="text-white-50">{{ $hours }}</td>
            <td>
                <span class="{{ $statusClass }}">{{ ucfirst($attendance->status ?? 'Absent') }}</span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-4">No attendance records found.</td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>