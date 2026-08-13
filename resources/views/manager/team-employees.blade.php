<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Employees - HRPulse</title>
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
        .badge-absent { background: rgba(239, 68, 68, 0.18); color: #f87171; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .search-input { background-color: #0f1422; border: 1px solid #1e253e; color: #fff; padding: 10px 16px 10px 40px; border-radius: 10px; font-size: 0.88rem; width: 100%; }
        .search-input:focus { outline: none; border-color: #6366f1; }
        .btn-action { background-color: rgba(255, 255, 255, 0.05); border: 1px solid #1e253e; color: #cbd5e1; font-size: 0.8rem; padding: 6px 14px; border-radius: 8px; text-decoration: none; transition: 0.2s; }
        .btn-action:hover { background-color: rgba(255, 255, 255, 0.1); color: #fff; }
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
                <h3 class="text-white fw-bold mb-1">Team Employees</h3>
                <p style="font-size: 0.85rem; color: #64748b;" class="mb-0">3 engineers on your team</p>
            </div>

            <div class="card-box">
                <div class="position-relative mb-4">
                    <i class="fa-solid fa-magnifying-glass position-absolute" style="left: 14px; top: 50%; transform: translateY(-50%); color: #475569;"></i>
                    <input type="text" class="search-input" placeholder="Search team members...">
                </div>

                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>EMPLOYEE</th>
                                <th>POSITION</th>
                                <th>EMAIL</th>
                                <th>TODAY'S STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                       <tbody>
    @forelse($employees as $employee)
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <div class="avatar me-2">
                        {{ strtoupper(substr($employee->name, 0, 2)) }}
                    </div>
                    <div>
                        <strong>{{ $employee->name }}</strong><br>
                        <small class="text-muted">Joined {{ $employee->created_at->format('Y-m-d') }}</small>
                    </div>
                </div>
            </td>
            <td>{{ $employee->position->title ?? 'N/A' }}</td>
            <td>{{ $employee->email }}</td>
            <td>
                <span class="badge bg-success">Active</span>
            </td>
            <td>
                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-outline-primary">View Profile</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No team members found.</td>
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