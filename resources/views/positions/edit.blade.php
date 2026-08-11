@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html>
    <head>
        <title>Edit Position</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
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

        .form-label {
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
        
        .form-control,
        .form-select {
            background-color: #334155;
            color: white;
            border: 1px solid #475569;
        }
        
        .form-select option {
            background-color: #334155;
            color: white;
        }
        </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card col-md-6">
        
        <h3 class="mb-4">Edit Position</h3>

        <form action="{{ route('positions.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Position Title -->
            <div class="mb-3">
                <label class="form-label">Position Title</label>
                
                <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $position->name) }}"
                >
                
                @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
        <!-- Department -->
        <div class="mb-3">
            <label class="form-label">Department</label>
            
            <select name="department_id" class="form-select">
                
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
                <div class="text-danger mt-1">{{ $message }}</div>
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

</body>
</html>
@endsection