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

    .form-label {
        color: #cbd5e1;
        font-weight: 500;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        background-color: #0f172a;
        border: 1px solid #475569;
        color: #f8fafc;
        border-radius: 8px;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #0f172a;
        color: #f8fafc;
        border-color: #7c3aed;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.2);
    }

    .form-control::placeholder {
        color: #64748b;
    }

    .form-select option {
        background-color: #1e293b;
        color: #f8fafc;
    }

    .btn-purple {
        background: linear-gradient(to right, #7c3aed, #9333ea);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        text-decoration: none;
    }

    .btn-purple:hover {
        color: white;
        opacity: 0.9;
    }

    .btn-secondary-custom {
        background-color: #334155;
        color: #cbd5e1;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        text-decoration: none;
    }

    .btn-secondary-custom:hover {
        background-color: #475569;
        color: white;
    }

    .section-title {
        color: #a78bfa;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .form-text {
        color: #64748b;
    }

    .required {
        color: #ef4444;
    }
</style>


<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="mb-4">

        <h2 class="page-title mb-1">
            Add Employee
        </h2>

        <p class="page-subtitle mb-0">
            Create a new employee record.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>

    @endif


    {{-- Employee Form --}}
    <div class="card p-4">

        <form
            method="POST"
            action="{{ route('employees.store') }}"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- Personal Information --}}
            <div class="section-title">
                Personal Information
            </div>

            <div class="row g-4">

                {{-- Photo --}}
                <div class="col-md-12">

                    <label class="form-label">
                        Profile Photo
                    </label>

                    <input
                        type="file"
                        name="photo"
                        class="form-control"
                        accept="image/*"
                    >

                    <div class="form-text">
                        JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
                    </div>

                </div>


                {{-- Name --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Full Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Enter employee name"
                        required
                    >

                </div>


                {{-- Email --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Email <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="employee@example.com"
                        required
                    >

                </div>


                {{-- Password --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter password"
                        required
                    >

                </div>


                {{-- Confirm Password --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Confirm Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm password"
                        required
                    >

                </div>


                {{-- Phone --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="Enter phone number"
                    >

                </div>


                {{-- Address --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Address
                    </label>

                    <input
                        type="text"
                        name="address"
                        class="form-control"
                        value="{{ old('address') }}"
                        placeholder="Enter address"
                    >

                </div>

            </div>


            <hr class="border-secondary my-4">


            {{-- Employment Information --}}
            <div class="section-title">
                Employment Information
            </div>

            <div class="row g-4">

                {{-- Department --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Department <span class="required">*</span>
                    </label>

                    <select
                        name="department_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select Department
                        </option>

                        @foreach($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}
                            >
                                {{ $department->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Position --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Position <span class="required">*</span>
                    </label>

                    <select
                        name="position_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select Position
                        </option>

                        @foreach($positions as $position)

                            <option
                                value="{{ $position->id }}"
                                {{ old('position_id') == $position->id ? 'selected' : '' }}
                            >
                                {{ $position->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Hire Date --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Hire Date
                    </label>

                    <input
                        type="date"
                        name="hire_date"
                        class="form-control"
                        value="{{ old('hire_date') }}"
                    >

                </div>


                {{-- Status --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Status <span class="required">*</span>
                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select Status
                        </option>

                        <option
                            value="active"
                            {{ old('status') === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ old('status') === 'inactive' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            <hr class="border-secondary my-4">


            {{-- Salary Information --}}
            <div class="section-title">
                Salary Information
            </div>

            <div class="row g-4">

                {{-- Basic --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Basic Salary <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        name="basic"
                        class="form-control"
                        value="{{ old('basic') }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        required
                    >

                </div>


                {{-- Bonus --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Bonus
                    </label>

                    <input
                        type="number"
                        name="bonus"
                        class="form-control"
                        value="{{ old('bonus', 0) }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                    >

                </div>


                {{-- Deduction --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Deduction
                    </label>

                    <input
                        type="number"
                        name="deduction"
                        class="form-control"
                        value="{{ old('deduction', 0) }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                    >

                </div>

            </div>


            {{-- Buttons --}}
            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top border-secondary">

                <a
                    href="{{ route('employees.index') }}"
                    class="btn-secondary-custom"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-purple"
                >
                    Create Employee
                </button>

            </div>

        </form>

    </div>

</div>

@endsection