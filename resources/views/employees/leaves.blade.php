<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests - HRPulse</title>
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
        
        .stat-card { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 22px 24px; height: 100%; display: flex; align-items: center; gap: 16px; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .card-box { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 24px; }
        
        .custom-table { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .custom-table th { color: #475569; border-bottom: 1px solid #1e253e; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; padding: 14px 12px; background: transparent !important; }
        .custom-table td { border-bottom: 1px solid #1b2035; padding: 16px 12px; vertical-align: middle; font-size: 0.88rem; background: transparent !important; color: #cbd5e1 !important; }
        
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; flex-shrink: 0; }
        .badge-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-approved { background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-rejected { background: rgba(239, 68, 68, 0.15); color: #f87171; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        
        .modal-content { background-color: #151a2e; border: 1px solid #1e253e; color: #fff; }
        .form-control, .form-select { background-color: #0d111d; border: 1px solid #1e253e; color: #fff; }
        .form-control:focus, .form-select:focus { background-color: #0d111d; border-color: #6366f1; color: #fff; box-shadow: none; }
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
                <a href="{{ route('employee.salary') }}" class="nav-link"><i class="fa-solid fa-dollar-sign"></i> My Salary</a>
                <a href="{{ route('employee.attendance') }}" class="nav-link"><i class="fa-regular fa-clock"></i> Attendance History</a>
                <a href="{{ route('employee.leaves') }}" class="nav-link active"><i class="fa-regular fa-envelope"></i> Leave Requests</a>
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

            <!-- Title & Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="text-white fw-bold mb-1">My Leave Requests</h3>
                    <p style="font-size: 0.85rem; color: #64748b;" class="mb-0">Track the status of your time-off requests</p>
                </div>
                <button class="btn text-white fw-semibold px-3 py-2" style="background-color: #6366f1; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#newLeaveModal">
                    + New Request
                </button>
            </div>

            @if(session('success'))
            <div class="alert alert-success bg-success text-white border-0 mb-4">
                {{ session('success') }}
            </div>
            @endif

            <!-- 3 Stat Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24;"><i class="fa-solid fa-clock"></i></div>
                        <div>
                            <div class="text-secondary" style="font-size: 0.8rem;">Pending</div>
                            <div class="text-white fw-bold fs-3">{{ $pending }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.15); color: #34d399;"><i class="fa-solid fa-check"></i></div>
                        <div>
                            <div class="text-secondary" style="font-size: 0.8rem;">Approved</div>
                            <div class="text-white fw-bold fs-3">{{ $approved }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.15); color: #f87171;"><i class="fa-solid fa-xmark"></i></div>
                        <div>
                            <div class="text-secondary" style="font-size: 0.8rem;">Rejected</div>
                            <div class="text-white fw-bold fs-3">{{ $rejected }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requests Table or Empty State -->
            <div class="card-box">
                @if($requests->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-3" style="font-size: 3rem;">📫</div>
                    <p class="text-secondary mb-3">No leave requests yet.</p>
                    <button class="btn text-white fw-semibold px-4 py-2" style="background-color: #6366f1; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#newLeaveModal">
                        Submit First Request
                    </button>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>REQUEST DATE</th>
                                <th>LEAVE TYPE</th>
                                <th>START DATE</th>
                                <th>END DATE</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $req)
                            @php
                                $type = $req->leave_type ?? $req->type ?? 'Annual Leave';
                                $status = $req->status ?? 'pending';
                                $startDate = $req->start_date ?? '--';
                                $endDate = $req->end_date ?? '--';
                                $created = isset($req->created_at) ? date('Y-m-d', strtotime($req->created_at)) : date('Y-m-d');
                            @endphp
                            <tr>
                                <td class="text-white fw-medium">{{ $created }}</td>
                                <td class="text-white-50">{{ $type }}</td>
                                <td class="text-white-50">{{ $startDate }}</td>
                                <td class="text-white-50">{{ $endDate }}</td>
                                <td>
                                    @if(strtolower($status) == 'approved')
                                        <span class="badge-approved">Approved</span>
                                    @elseif(strtolower($status) == 'rejected')
                                        <span class="badge-rejected">Rejected</span>
                                    @else
                                        <span class="badge-pending">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

<!-- Modal for New Leave Request -->
<div class="modal fade" id="newLeaveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom border-secondary-subtle">
                <h5 class="modal-title fw-bold text-white">New Leave Request</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('employee.leaves.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-secondary">Leave Type</label>
                        <select name="leave_type" class="form-select" required>
                            <option value="Annual Leave">Annual Leave</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary">Start Date</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary">End Date</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary">Reason</label>
                        <textarea name="reason" class="form-control" rows="3" placeholder="Write your reason here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary-subtle">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white" style="background-color: #6366f1;">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>