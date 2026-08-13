@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #0f172a;
        color: #f8fafc;
    }

    .page-title {
        color: #f8fafc;
        font-weight: 700;
    }

    .page-subtitle {
        color: #94a3b8;
    }

    .card {
        background-color: #1e293b;
        border: none;
        border-radius: 15px;
    }

    .table {
        --bs-table-bg: #1e293b;
        --bs-table-color: #f8fafc;
        --bs-table-border-color: #334155;
        margin-bottom: 0;
    }

    .table th {
        color: #94a3b8;
        font-weight: 600;
        border-bottom: 1px solid #334155;
    }

    .table td {
        color: #f8fafc;
        vertical-align: middle;
        border-bottom: 1px solid #334155;
    }

    .table tbody tr:hover {
        background-color: #273449;
    }

    .btn-purple {
        background: linear-gradient(to right, #7c3aed, #9333ea);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 16px;
        text-decoration: none;
    }

    .btn-purple:hover {
        color: white;
        opacity: 0.9;
    }

    .btn-warning,
    .btn-danger {
        border-radius: 7px;
    }

    .employee-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #7c3aed;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .search-input,
    .filter-select {
        background-color: #0f172a;
        border: 1px solid #475569;
        color: #f8fafc;
        border-radius: 8px;
    }

    .search-input:focus,
    .filter-select:focus {
        background-color: #0f172a;
        color: #f8fafc;
        border-color: #7c3aed;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.2);
    }

    .search-input::placeholder {
        color: #64748b;
    }

    .badge-active {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
        padding: 6px 10px;
        border-radius: 20px;
    }

    .badge-inactive {
        background-color: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        padding: 6px 10px;
        border-radius: 20px;
    }

    .employee-id {
        color: #64748b;
        font-size: 12px;
    }

    .text-secondary-custom {
        color: #94a3b8;
    }
    .text{
        color: #7c3aed;
    }
    .pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    background-color: #1e293b;
    border-color: #334155;
    color: #cbd5e1;
}

.pagination .page-link:hover {
    background-color: #7c3aed;
    border-color: #7c3aed;
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: #7c3aed;
    border-color: #7c3aed;
    color: white;
}

.pagination .page-item.disabled .page-link {
    background-color: #1e293b;
    border-color: #334155;
    color: #7c3aed;
}
</style>


<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title mb-1">Employees</h2>

            <p class="page-subtitle mb-0">
                Manage all employees in the organization.
            </p>
        </div>

        <a href="{{ route('employees.create') }}" class="btn btn-purple">
            + Add Employee
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Search & Filters --}}
    <div class="card p-4 mb-4">

        <form method="GET" action="{{ route('employees.index') }}">

            <div class="row g-3">

                {{-- Search --}}
                <div class="col-md-5">

                    <input
                        type="text"
                        name="search"
                        class="form-control search-input"
                        placeholder="Search by name or email..."
                        value="{{ request('search') }}"
                    >

                </div>


                {{-- Department --}}
                <div class="col-md-3">

                    <select
                        name="department_id"
                        class="form-select filter-select"
                    >

                        <option value="">All Departments</option>

                        @foreach($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                {{ request('department_id') == $department->id ? 'selected' : '' }}
                            >
                                {{ $department->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Position --}}
                <div class="col-md-2">

                    <select
                        name="position_id"
                        class="form-select filter-select"
                    >

                        <option value="">All Positions</option>

                        @foreach($positions as $position)

                            <option
                                value="{{ $position->id }}"
                                {{ request('position_id') == $position->id ? 'selected' : '' }}
                            >
                                {{ $position->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Filter --}}
                <div class="col-md-1">

                    <button type="submit" class="btn btn-purple w-100">
                        Filter
                    </button>

                </div>


                {{-- Reset --}}
                <div class="col-md-1">

                    <a
                        href="{{ route('employees.index') }}"
                        class="btn btn-secondary w-100"
                    >
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Employees Table --}}
    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="mb-0 text">
                All Employees
            </h5>

            <span class="text-secondary-custom">
                {{ $employees->total() }} Employees
            </span>

        </div>


        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>
                        <th>Employee</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($employees as $employee)

                        <tr>

                            {{-- Employee --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($employee->photo)

                                        <img
                                            src="{{ filter_var($employee->photo, FILTER_VALIDATE_URL)
                                                ? $employee->photo
                                                : asset('storage/' . $employee->photo) }}"
                                            alt="{{ $employee->user->name }}"
                                            class="employee-avatar"
                                        >

                                    @else

                                        <div class="avatar-placeholder">
                                            {{ strtoupper(substr($employee->user->name, 0, 1)) }}
                                        </div>

                                    @endif


                                    <div>

                                        <div class="fw-semibold">
                                            {{ $employee->user->name }}
                                        </div>

                                        <div class="employee-id">
                                            #{{ $employee->id }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Email --}}
                            <td>
                                {{ $employee->user->email }}
                            </td>


                            {{-- Department --}}
                            <td>
                                {{ $employee->department?->name ?? 'N/A' }}
                            </td>


                            {{-- Position --}}
                            <td>
                                {{ $employee->position?->name ?? 'N/A' }}
                            </td>


                            {{-- Salary --}}
                            <td>

                                @php
                                    $salary = $employee->salaries
                                        ->sortByDesc('from_date')
                                        ->first();
                                @endphp

                                @if($salary)

                                    {{ number_format($salary->net_salary, 2) }}

                                @else

                                    <span class="text-secondary-custom">
                                        N/A
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($employee->status === 'active')

                                    <span class="badge-active">
                                        Active
                                    </span>

                                @else

                                    <span class="badge-inactive">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('employees.edit', $employee) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('employees.destroy', $employee) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5 text-secondary-custom"
                            >
                                No employees found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
        

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center mt-3">

        <div class="text-secondary-custom">
            Showing {{ $employees->firstItem() }}
            to {{ $employees->lastItem() }}
            of {{ $employees->total() }} results
        </div>

        <div>
            {{ $employees->links() }}
        </div>



    </div>

</div>

@endsection
