@extends('layouts.app')

@section('content')

<!DOCTYPE html><html>
    <head>
        <title>Departments</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <style>
            body {
                background-color: #0f172a;
                color: white;
            }

            .card {
        background-color: #1e293b;
        border: none;
        border-radius: 15px;
    }

    .table {
        --bs-table-bg: #1e293b;
        --bs-table-color: white;
        --bs-table-border-color: #334155;
    }

    .table th,
    .table td {
        color: white;
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

</head><body class="p-5"><div class="container"><div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Departments</h2>
    
    <a href="{{ route('departments.create') }}" class="btn btn-purple">
        + Add Department
    </a>
</div>

<div class="card p-4">
    <table class="table text-white">
        
        <thead>
            <tr>
                
                <th>Department Name</th>
                <th>Manager</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            
            @foreach($departments as $department)
            
            <tr>
                
                
                <td>{{ $department->name }}</td>

                <td>
                    {{ $department->manager?->user?->name ?? 'No Manager' }}
                </td>
                
                <td>
                    
                    <!-- Edit -->
                    <a href="{{ route('departments.edit', $department->id) }}"
                    class="btn btn-sm btn-warning"
                    title="Edit">
                    
                    <i class="bi bi-pencil"></i>
                    
                </a>
                
                <!-- Delete -->
                <form action="{{ route('departments.destroy', $department->id) }}"
                method="POST"
                style="display:inline;">
                
                @csrf
                @method('DELETE')
                
                <button type="submit"
                class="btn btn-sm btn-danger"
                title="Delete">

                            <i class="bi bi-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
</div>

</div></body>
</html>
@endsection