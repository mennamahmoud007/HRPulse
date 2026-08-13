@extends('layouts.app')

@section('content')

<style>
    .create-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 40px);
        padding: 30px;
    }

    .create-card {
        background-color: #1e293b;
        border-radius: 15px;
        padding: 30px;
        width: 100%;
        max-width: 650px;
    }

    .create-card label {
        color: white;
        margin-bottom: 8px;
    }

    .create-card .form-control,
    .create-card .form-select {
        background-color: #334155;
        color: white;
        border: 1px solid #475569;
    }

    .create-card .form-select option {
        background-color: #334155;
        color: white;
    }

    .btn-purple {
        background: linear-gradient(to right, #7c3aed, #9333ea);
        color: white;
        border: none;
    }

    .btn-purple:hover {
        opacity: 0.9;
        color: white;
    }
</style>

<div class="create-container">

    <div class="create-card">

        <h3 class="mb-4 text-white">Edit Position</h3>

        <form action="{{ route('positions.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Position Title -->
            <div class="mb-3">
                <label>Position Title</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $position->name) }}"
                >

                @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Department -->
            <div class="mb-3">
                <label>Department</label>

                <select name="department_id" class="form-select">

                    <option value="">Select Department</option>

                    @foreach($departments as $department)
                        <option
                            value="{{ $department->id }}"
                            {{ old('department_id', $position->department_id) == $department->id ? 'selected' : '' }}
                        >
                            {{ $department->name }}
                        </option>
                    @endforeach

                </select>

                @error('department_id')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-end">

                <a href="{{ route('positions.index') }}"
                   class="btn btn-secondary me-2">
                    Cancel
                </a>

                <button type="submit" class="btn btn-purple">
                    Update Position
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
