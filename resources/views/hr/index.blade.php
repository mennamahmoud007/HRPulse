@extends('layouts.app')

@section('content')
<style>
    .custom-card { background-color: #1e293b !important; border: 1px solid #334155 !important; border-radius: 12px; }
    .custom-input, .custom-select { background-color: #0f172a !important; border: 1px solid #334155 !important; color: #f8fafc !important; border-radius: 8px; }
    .custom-input::placeholder { color: #475569 !important; }
    
    .table-dark-custom { background-color: #1e293b !important; color: #f8fafc !important; margin-bottom: 0; }
    .table-dark-custom thead th { background-color: #1a2333 !important; color: #64748b !important; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em; border-bottom: 1px solid #334155 !important; padding: 16px 20px; }
    .table-dark-custom tbody tr { background-color: #1e293b !important; border-bottom: 1px solid #334155 !important; }
    .table-dark-custom tbody tr:hover { background-color: #26334d !important; }
    .table-dark-custom td { padding: 16px 20px; vertical-align: middle; background-color: transparent !important; color: #e2e8f0 !important; }

    .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background-color: #6366f1; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; flex-shrink: 0; }
    .badge-active { background-color: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; }
    .badge-inactive { background-color: rgba(239, 68, 68, 0.15); color: #ef4444; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; }
    .action-btn { background: transparent; border: none; padding: 6px; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
    .action-btn:hover { background-color: #334155; }
    
    .modal-content-dark { background-color: #1e293b; border: 1px solid #334155; color: #fff; }
</style>

<div class="container-fluid py-2">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0 mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-white fw-bold mb-1" style="font-size: 1.75rem;">Employees</h2>
            <span style="color: #64748b; font-size: 0.9rem;">{{ method_exists($employees, 'total') ? $employees->total() : $employees->count() }} total employees</span>
        </div>
        <button class="btn text-white fw-medium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addEmployeeModal" style="background-color: #6366f1; border: none; padding: 10px 20px; border-radius: 8px;">
            + Add Employee
        </button>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('employees.index') }}" class="row g-3 mb-4">
        <div class="col-12">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control custom-input py-2" placeholder="Search employees...">
        </div>
    </form>

    <!-- Table Card -->
    <div class="card custom-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark-custom align-middle">
                <thead>
                    <tr>
                        <th>EMPLOYEE</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                        <th class="text-end">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        @php
                            $empName = optional($employee->user)->name ?? $employee->name ?? 'N/A';
                            $empEmail = optional($employee->user)->email ?? $employee->email ?? 'N/A';
                            
                            $words = explode(' ', trim($empName));
                            $initials = strtoupper(($words[0][0] ?? 'E') . (isset($words[1]) ? $words[1][0] : ''));
                            
                            $status = strtolower($employee->status ?? 'active');
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle">{{ $initials }}</div>
                                    <span class="text-white fw-semibold">{{ $empName }}</span>
                                </div>
                            </td>
                            <td style="color: #94a3b8;">{{ $empEmail }}</td>
                            <td>
                                <span class="{{ $status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button type="button" class="action-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $employee->id }}">✏️</button>
                                
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn text-danger">🗑️</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal التعديل -->
                        <div class="modal fade" id="editModal{{ $employee->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content modal-content-dark">
                                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header border-secondary">
                                            <h5 class="modal-title">Edit Employee</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" value="{{ $empName }}" class="form-control custom-input" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ $empEmail }}" class="form-control custom-input" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-secondary">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4" style="color: #64748b;">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(method_exists($employees, 'links'))
        <div class="d-flex justify-content-center mt-3">
            {{ $employees->links() }}
        </div>
    @endif
</div>

<!-- Modal إضافة موظف جديد -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modal-content-dark">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control custom-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control custom-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control custom-input" required>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #6366f1; border:none;">Create Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection