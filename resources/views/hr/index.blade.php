@extends('layouts.app')

@section('content')
<style>
    body { background-color: #0f172a !important; color: #f8fafc; }
    .custom-card { background-color: #1e293b; border: 1px solid #334155; border-radius: 12px; }
    .custom-input, .custom-select { background-color: #0f172a !important; border: 1px solid #334155 !important; color: #f8fafc !important; border-radius: 8px; }
    .custom-table { color: #cbd5e1; }
    .custom-table thead th { background-color: #1a2333; color: #64748b; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; border-bottom: 1px solid #334155; padding: 16px 20px; }
    .custom-table tbody tr { border-bottom: 1px solid #1e293b; }
    .custom-table tbody tr:hover { background-color: #26334d; }
    .custom-table td { padding: 16px 20px; vertical-align: middle; }
    .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background-color: #6366f1; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; }
    .badge-active { background-color: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; }
    .badge-inactive { background-color: rgba(239, 68, 68, 0.15); color: #ef4444; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; }
    .action-btn { background: transparent; border: none; color: #64748b; padding: 6px; border-radius: 6px; }
    .action-btn:hover { color: #f8fafc; background-color: #334155; }
</style>

<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-white fw-bold mb-1" style="font-size: 1.75rem;">Employees</h2>
            <span style="color: #64748b; font-size: 0.9rem;">{{ $employees->count() }} total employees</span>
        </div>
        <button class="btn text-white fw-medium d-flex align-items-center gap-2" style="background-color: #6366f1; border: none; padding: 10px 20px; border-radius: 8px;">
            <i class="fa-solid fa-plus"></i> Add Employee
        </button>
    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('employees.index') }}" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control custom-input py-2" placeholder="Search employees...">
        </div>
        <div class="col-md-3">
            <select name="department_id" class="form-select custom-select py-2" onchange="this.form.submit()">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="position_id" class="form-select custom-select py-2" onchange="this.form.submit()">
                <option value="">All Positions</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ request('position_id') == $pos->id ? 'selected' : '' }}>
                        {{ $pos->name ?? $pos->title }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Table Card -->
    <div class="card custom-card overflow-hidden">
        <div class="table-responsive">
            <table class="table custom-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>EMPLOYEE</th>
                        <th>EMAIL</th>
                        <th>DEPARTMENT</th>
                        <th>POSITION</th>
                        <th>SALARY</th>
                        <th>STATUS</th>
                        <th class="text-end">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        @php
                            $words = explode(' ', trim($employee->name));
                            $initials = strtoupper(($words[0][0] ?? '') . (isset($words[1]) ? $words[1][0] : ''));
                            $status = strtolower($employee->status ?? 'active');
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle">{{ $initials }}</div>
                                    <span class="text-white fw-semibold">{{ $employee->name }}</span>
                                </div>
                            </td>
                            <td style="color: #94a3b8;">{{ $employee->email }}</td>
                            <td style="color: #94a3b8;">{{ $employee->department->name ?? 'N/A' }}</td>
                            <td style="color: #818cf8; font-weight: 500;">
                                {{ $employee->position->name ?? $employee->position->title ?? 'N/A' }}
                            </td>
                            <td class="text-white fw-bold">${{ number_format($employee->salary ?? 0) }}</td>
                            <td>
                                <span class="{{ $status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="action-btn"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn text-danger"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4" style="color: #64748b;">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection