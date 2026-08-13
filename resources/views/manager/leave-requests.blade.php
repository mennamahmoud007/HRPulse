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
        .nav-link { color: #94a3b8; padding: 10px 14px; border-radius: 10px; font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 4px; transition: all 0.2s; }
        .nav-link:hover { color: #fff; background-color: rgba(255, 255, 255, 0.05); }
        .nav-link.active { background-color: #6366f1; color: #fff; font-weight: 600; }
        .card-box { background-color: #151a2e; border: 1px solid #1e253e; border-radius: 14px; padding: 24px; }
        .custom-table { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .custom-table th { color: #475569; border-bottom: 1px solid #1e253e; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; padding: 14px 12px; background: transparent !important; }
        .custom-table td { border-bottom: 1px solid #1b2035; padding: 16px 12px; vertical-align: middle; font-size: 0.88rem; background: transparent !important; color: #cbd5e1 !important; }
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; flex-shrink: 0; }
        
        .type-sick { background: rgba(245, 158, 11, 0.2); color: #fbbf24; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }
        .type-annual { background: rgba(99, 102, 241, 0.2); color: #818cf8; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }
        .badge-pending { background: rgba(245, 158, 11, 0.18); color: #fbbf24; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-approved { background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-rejected { background: rgba(239, 68, 68, 0.15); color: #f87171; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        
        .btn-approve { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; padding: 6px 12px; border-radius: 8px; font-size: 0.78rem; font-weight: 600; text-decoration: none; transition: 0.2s; cursor: pointer; }
        .btn-approve:hover { background: rgba(16, 185, 129, 0.2); color: #34d399; }
        .btn-reject { background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; padding: 6px 12px; border-radius: 8px; font-size: 0.78rem; font-weight: 600; text-decoration: none; transition: 0.2s; cursor: pointer; }
        .btn-reject:hover { background: rgba(239, 68, 68, 0.2); color: #f87171; }
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
                <h3 class="text-white fw-bold mb-1">Leave Requests</h3>
                <p style="font-size: 0.85rem; color: #64748b;" class="mb-0">{{ $pendingCount ?? 0 }} pending approval</p>
            </div>

            <div class="card-box">
                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>EMPLOYEE</th>
                                <th>LEAVE TYPE</th>
                                <th>DURATION</th>
                                <th>REASON</th>
                                <th>REQUESTED</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leaveRequests as $request)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle" style="background: #818cf8;">
                                                 {{ strtoupper(substr($request->employee->user->name ?? 'U', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="text-white fw-semibold">{{ $request->employee->user->name ?? 'N/A' }}</div>
                                                <div style="font-size: 0.75rem; color: #475569;">
                                                    {{ $request->employee->user->name ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="{{ strtolower($request->leave_type) == 'sick' ? 'type-sick' : 'type-annual' }}">
                                            {{ ucfirst($request->leave_type ?? 'Leave') }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $request->days ?? (\Carbon\Carbon::parse($request->start_date)->diffInDays($request->end_date) + 1) }} days
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($request->reason, 25) }}</td>
                                    <td>{{ $request->created_at ? $request->created_at->format('Y-m-d') : 'N/A' }}</td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <span class="badge-pending">Pending</span>
                                        @elseif($request->status == 'approved')
                                            <span class="badge-approved">Approved</span>
                                        @else
                                            <span class="badge-rejected">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('manager.leave-requests.update', $request->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn-approve border-0">
                                                        <i class="fa-solid fa-check me-1"></i> Approve
                                                    </button>
                                                </form>

                                                <form action="{{ route('manager.leave-requests.update', $request->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn-reject border-0">
                                                        <i class="fa-solid fa-xmark me-1"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span style="font-size: 0.8rem; color: #64748b;">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No leave requests found.</td>
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