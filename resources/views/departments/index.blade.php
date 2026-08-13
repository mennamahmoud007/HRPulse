@extends('layouts.app')

@section('content')
<style>
    .custom-card {
        background-color: #1e293b !important;
        border: 1px solid #334155 !important;
        border-radius: 12px;
    }

    .table-dark-custom {
        background-color: #1e293b !important;
        color: #f8fafc !important;
        margin-bottom: 0;
    }

    .table-dark-custom thead th {
        background-color: #1a2333 !important;
        color: #64748b !important;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #334155 !important;
        padding: 16px 20px;
    }

    .table-dark-custom tbody tr {
        background-color: #1e293b !important;
        border-bottom: 1px solid #334155 !important;
    }

    .table-dark-custom tbody tr:hover {
        background-color: #26334d !important;
    }

    .table-dark-custom td {
        padding: 16px 20px;
        vertical-align: middle;
        background-color: transparent !important;
        color: #e2e8f0 !important;
    }

    .btn-purple {
        background: linear-gradient(to right, #7c3aed, #9333ea);
        color: white;
        border: none;
    }

    .btn-purple:hover {
        color: white;
        opacity: 0.9;
    }

    .action-btn {
        background: transparent;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }

    .action-btn:hover {
        background-color: #334155;
    }

    .manager-badge {
        background-color: rgba(99, 102, 241, 0.15);
        color: #818cf8;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .no-manager-badge {
        background-color: rgba(100, 116, 139, 0.2);
        color: #94a3b8;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
    }
</style>

<div class="container-fluid py-2">
    {{-- رسالة النجاح --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0 mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- الهيدر الرئيسي --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-white fw-bold mb-1" style="font-size: 1.75rem;">Departments</h2>
            <span style="color: #64748b; font-size: 0.9rem;">Manage company departments and managers</span>
        </div>
        <a href="{{ route('departments.create') }}" class="btn btn-purple">
            + Add Department
        </a>
    </div>

    {{-- جدول الأقسام --}}
    <div class="card custom-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark-custom align-middle">
                <thead>
                    <tr>
                        <th>DEPARTMENT NAME</th>
                        <th>MANAGER</th>
                        <th class="text-end">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $department)
                        <tr>
                            <td class="fw-semibold text-white fs-6">{{ $department->name }}</td>
                            <td>
                                <span class="{{ $department->manager?->name ? 'manager-badge' : 'no-manager-badge' }}">
    {{ $department->manager?->name ?? 'No Manager' }}
</span>
                            </td>
                            <td class="text-end">
                                {{-- زر التعديل --}}
                                <a href="{{ route('departments.edit', $department->id) }}" class="action-btn" title="Edit">
                                    ✏️
                                </a>

                                {{-- زر الحذف --}}
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this department?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn text-danger" title="Delete">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4" style="color: #64748b;">
                                No departments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection