@extends('layouts.app')
@section('content')
<style>
    .edit-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: calc(100vh - 60px);
        padding: 24px 0;
    }

    .edit-card {
        background-color: #1e293b;
        border-radius: 15px;
        padding: 30px;
        width: 100%;
        max-width: 650px;
        border: 1px solid #334155;
    }

    .edit-card label {
        color: white;
        margin-bottom: 8px;
    }

    .edit-card .form-control,
    .edit-card .form-select {
        background-color: #334155;
        color: white;
        border: 1px solid #475569;
    }

    .edit-card .form-control::placeholder {
        color: #cbd5e1;
    }

    .btn-purple {
        background: linear-gradient(to right, #7c3aed, #9333ea);
        color: white;
        border: none;
    }

    .btn-purple:hover {
        opacity: 0.9;
    }

</style>

<div class="edit-container">
    <div class="edit-card">
        <h3 class="mb-4 text-white">Edit Department</h3>

<form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Department Name -->
    <div class="mb-3">
        <label>Department Name</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $department->name) }}"
            placeholder="e.g. Product"
        >

        @error('name')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Manager -->
    <div class="mb-3">
        <label>Manager</label>

        <select name="manager_id" class="form-select">
            <option value="">Select Manager</option>

            @foreach($managers as $manager)
                <option
                    value="{{ $manager->id }}"
                    {{ old('manager_id', $department->manager_id) == $manager->id ? 'selected' : '' }}
                >
                    {{ $manager->user->name }}
                </option>
            @endforeach
        </select>

        @error('manager_id')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-end">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary me-2">
            Cancel
        </a>

        <button type="submit" class="btn btn-purple">
            Save Changes
        </button>
    </div>

</form>

</div>
</div>
@endsection