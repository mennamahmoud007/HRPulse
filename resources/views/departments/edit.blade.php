@extends('layouts.app')

@section('content')


<!DOCTYPE html><html>
    <head>
        <title>Edit Department</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            body {
        background-color: #0f172a;
        color: white;
    }
    
    .card {
        background-color: #1e293b;
        border-radius: 15px;
        padding: 30px;
    }
    
    .btn-purple {
        background: linear-gradient(to right, #7c3aed, #9333ea);
        color: white;
        border: none;
    }

    .btn-purple:hover {
        opacity: 0.9;
    }
    
    label {
        margin-bottom: 8px;
    }
    </style>

</head><body class="d-flex justify-content-center align-items-center vh-100"><div class="card col-md-6"><h3 class="mb-4 text-white">Edit Department</h3>

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

</div></body>
</html>
@endsection