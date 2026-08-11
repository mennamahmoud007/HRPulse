@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Employees</h1>
        <p>Manage all employees in the organization.</p>
    </div>

    <a href="{{ route('employees.create') }}" class="btn-primary">
        + Add Employee
    </a>
</div>


{{-- Success Message --}}
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif


{{-- Search & Filters --}}
<div class="filter-card">

    <form method="GET" action="{{ route('employees.index') }}">

        <div class="filter-row">

            {{-- Search --}}
            <div class="search-box">
                <input
                    type="text"
                    name="search"
                    placeholder="Search by name or email..."
                    value="{{ request('search') }}"
                >
            </div>


            {{-- Department --}}
            <select name="department_id">
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


            {{-- Position --}}
            <select name="position_id">
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


            <button type="submit" class="btn-primary">
                Filter
            </button>

            <a href="{{ route('employees.index') }}" class="btn-secondary">
                Reset
            </a>

        </div>

    </form>

</div>


{{-- Employees Table --}}
<div class="table-card">

    <div class="table-header">
        <h2>All Employees</h2>

        <span class="employee-count">
            {{ $employees->total() }} Employees
        </span>
    </div>


    <div class="table-wrapper">

        <table>

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

                            <div class="employee-info">

                                @if($employee->photo)

                                    <img
                                        src="{{ asset('storage/' . $employee->photo) }}"
                                        alt="{{ $employee->user->name }}"
                                        class="employee-avatar"
                                    >

                                @else

                                    <div class="employee-avatar placeholder">
                                        {{ strtoupper(substr($employee->user->name, 0, 1)) }}
                                    </div>

                                @endif


                                <div>
                                    <strong>
                                        {{ $employee->user->name }}
                                    </strong>

                                    <small>
                                        #{{ $employee->id }}
                                    </small>
                                </div>

                            </div>

                        </td>


                        {{-- Email --}}
                        <td>
                            {{ $employee->user->email }}
                        </td>


                        {{-- Department --}}
                        <td>
                            {{ $employee->department->name ?? 'N/A' }}
                        </td>


                        {{-- Position --}}
                        <td>
                            {{ $employee->position->name ?? 'N/A' }}
                        </td>


                        {{-- Salary --}}
                        <td>

                            @php
                                $salary = $employee->salaries->sortByDesc('from_date')->first();
                            @endphp

                            {{ $salary ? number_format($salary->net_salary, 2) : 'N/A' }}

                        </td>


                        {{-- Status --}}
                        <td>

                            @if($employee->status === 'active')

                                <span class="badge badge-success">
                                    Active
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td>

                            <div class="actions">

                                <a
                                    href="{{ route('employees.edit', $employee) }}"
                                    class="action-edit"
                                >
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('employees.destroy', $employee) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="action-delete">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty-state">
                            No employees found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="pagination-wrapper">

        {{ $employees->links() }}

    </div>

</div>

@endsection