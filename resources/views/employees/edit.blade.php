@extends('layouts.app')

@section('content')

<style>

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #F8FAFC;
    }

    .page-header p {
        margin: 0;
        color: #94A3B8;
    }

    .form-card {
        background-color: #1F2937;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: span 2;
    }

    .form-group label {
        margin-bottom: 8px;
        color: #CBD5E1;
        font-size: 14px;
        font-weight: 600;
    }

    .form-group input,
    .form-group select {
        padding: 11px 13px;
        border-radius: 8px;
        border: 1px solid #475569;
        background-color: #111827;
        color: #F8FAFC;
        outline: none;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #7C3AED;
    }

    .current-photo {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
    }

    .current-photo img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
    }

    .no-photo {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: #7C3AED;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        font-weight: 600;
    }

    .photo-note {
        color: #94A3B8;
        font-size: 13px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #374151;
    }

    .btn-primary {
        padding: 11px 18px;
        border: none;
        border-radius: 8px;
        background-color: #7C3AED;
        color: #F8FAFC;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #8B5CF6;
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 18px;
        border-radius: 8px;
        background-color: #374151;
        color: #CBD5E1;
        text-decoration: none;
        font-size: 14px;
        border: 1px solid #475569;
    }

    .error-message {
        margin-top: 5px;
        color: #EF4444;
        font-size: 13px;
    }

</style>


<div class="page-header">

    <div>
        <h1>Edit Employee</h1>
        <p>Update employee information.</p>
    </div>

    <a href="{{ route('employees.index') }}" class="btn-secondary">
        Back to Employees
    </a>

</div>


<div class="form-card">

    <form
        method="POST"
        action="{{ route('employees.update', $employee) }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="form-grid">


            {{-- Photo --}}
            <div class="form-group full">

                <label>Profile Photo</label>

                <div class="current-photo">

                    @if($employee->photo)

                        <img
                            src="{{ str_starts_with($employee->photo, 'http')
                                ? $employee->photo
                                : asset('storage/' . $employee->photo) }}"
                            alt="{{ $employee->user->name }}"
                        >

                    @else

                        <div class="no-photo">
                            {{ strtoupper(substr($employee->user->name, 0, 1)) }}
                        </div>

                    @endif

                    <div class="photo-note">
                        Upload a new photo only if you want to replace the current one.
                    </div>

                </div>

                <input
                    type="file"
                    name="photo"
                    accept="image/*"
                >

                @error('photo')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Name --}}
            <div class="form-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $employee->user->name) }}"
                >

                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Email --}}
            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $employee->user->email) }}"
                >

                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Password --}}
            <div class="form-group">

                <label>New Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Leave empty to keep current password"
                >

                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Confirm Password --}}
            <div class="form-group">

                <label>Confirm New Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Repeat new password"
                >

            </div>


            {{-- Phone --}}
            <div class="form-group">

                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $employee->phone) }}"
                >

                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Address --}}
            <div class="form-group">

                <label>Address</label>

                <input
                    type="text"
                    name="address"
                    value="{{ old('address', $employee->address) }}"
                >

                @error('address')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Department --}}
            <div class="form-group">

                <label>Department</label>

                <select name="department_id">

                    @foreach($departments as $department)

                        <option
                            value="{{ $department->id }}"
                            {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}
                        >
                            {{ $department->name }}
                        </option>

                    @endforeach

                </select>

                @error('department_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Position --}}
            <div class="form-group">

                <label>Position</label>

                <select name="position_id">

                    @foreach($positions as $position)

                        <option
                            value="{{ $position->id }}"
                            {{ old('position_id', $employee->position_id) == $position->id ? 'selected' : '' }}
                        >
                            {{ $position->name }}
                        </option>

                    @endforeach

                </select>

                @error('position_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Hire Date --}}
            <div class="form-group">

                <label>Hire Date</label>

                <input
                    type="date"
                    name="hire_date"
                    value="{{ old('hire_date', optional($employee->hire_date)->format('Y-m-d')) }}"
                >

                @error('hire_date')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Status --}}
            <div class="form-group">

                <label>Status</label>

                <select name="status">

                    <option
                        value="active"
                        {{ old('status', $employee->status) === 'active' ? 'selected' : '' }}
                    >
                        Active
                    </option>

                    <option
                        value="inactive"
                        {{ old('status', $employee->status) === 'inactive' ? 'selected' : '' }}
                    >
                        Inactive
                    </option>

                </select>

                @error('status')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Basic Salary --}}
            <div class="form-group">

                <label>Basic Salary</label>

                <input
                    type="number"
                    name="basic"
                    step="0.01"
                    value="{{ old('basic', optional($employee->salaries->sortByDesc('from_date')->first())->basic) }}"
                >

                @error('basic')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Bonus --}}
            <div class="form-group">

                <label>Bonus</label>

                <input
                    type="number"
                    name="bonus"
                    step="0.01"
                    value="{{ old('bonus', optional($employee->salaries->sortByDesc('from_date')->first())->bonus ?? 0) }}"
                >

                @error('bonus')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>


            {{-- Deduction --}}
            <div class="form-group">

                <label>Deduction</label>

                <input
                    type="number"
                    name="deduction"
                    step="0.01"
                    value="{{ old('deduction', optional($employee->salaries->sortByDesc('from_date')->first())->deduction ?? 0) }}"
                >

                @error('deduction')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

        </div>


        <div class="form-actions">

            <a
                href="{{ route('employees.index') }}"
                class="btn-secondary"
            >
                Cancel
            </a>

            <button type="submit" class="btn-primary">
                Update Employee
            </button>

        </div>

    </form>

</div>

@endsection