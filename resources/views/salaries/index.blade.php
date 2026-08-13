@extends('layouts.app')
@section('content')
<style>
    .card {
        background-color: #1e293b;
        border: none;
        border-radius: 15px;
    }

    .salary-card {
        background-color: #1e293b;
        border-radius: 15px;
        padding: 20px;
        height: 100%;
    }

    .salary-label {
        color: #94a3b8;
        font-size: 14px;
    }

    .salary-value {
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    .table {
        --bs-table-bg: #1e293b;
        --bs-table-color: white;
        --bs-table-border-color: #334155;
    }

    .table th,
    .table td {
        color: white;
        vertical-align: middle;
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

    .search-box {
        background-color: #334155;
        color: white;
        border: 1px solid #475569;
    }

    .search-box::placeholder {
        color: #cbd5e1;
    }
</style>

<div class="container-fluid py-2">

    <div class="d-flex justify-content-between align-items-center mb-2">

        <div>
            <h2>Salaries</h2>
        
        </div>

    </div>


    <!-- Summary Cards -->
    <div class="row g-4 my-3">

        <!-- Total Payroll -->
        <div class="col-md-4">
            <div class="salary-card">

                <div class="salary-label">
                    Total Payroll
                </div>

                <div class="salary-value">
                    ${{ number_format($salaries->sum('net_salary'), 2) }}
                </div>

            </div>
        </div>


        <!-- Total Bonuses -->
        <div class="col-md-4">
            <div class="salary-card">

                <div class="salary-label">
                    Total Bonuses
                </div>

                <div class="salary-value">
                    ${{ number_format($salaries->sum('bonus'), 2) }}
                </div>

            </div>
        </div>


        <!-- Total Deductions -->
        <div class="col-md-4">
            <div class="salary-card">

                <div class="salary-label">
                    Total Deductions
                </div>

                <div class="salary-value">
                    ${{ number_format($salaries->sum('deduction'), 2) }}
                </div>

            </div>
        </div>

    </div>


    <!-- Search -->
    <div class="card p-3 mb-4">

        <input
            type="text"
            id="salarySearch"
            class="form-control search-box"
            placeholder="Search employee..."
        >

    </div>


    <!-- Salaries Table -->
    <div class="card p-4">

        <table class="table">

            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Basic Salary</th>
                    <th>Bonus</th>
                    <th>Deduction</th>
                    <th>Net Salary</th>
                </tr>
            </thead>

            <tbody id="salaryTable">

                @forelse($salaries as $salary)

                    <tr>

                        <td>
                           {{ $salary->employee?->user?->name ?? 'Unknown Employee' }}
                        </td>

                        <td>
                            {{ $salary->employee?->department?->name ?? 'No Department' }}
                        </td>

                        <td>
                            ${{ number_format($salary->basic, 2) }}
                        </td>

                        <td>
                            ${{ number_format($salary->bonus, 2) }}
                        </td>

                        <td>
                            ${{ number_format($salary->deduction, 2) }}
                        </td>

                        <td>
                            <strong>
                                ${{ number_format($salary->net_salary, 2) }}
                            </strong>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No salaries found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    </div>

    <!-- Search Script -->
<script>

    document.getElementById('salarySearch').addEventListener('keyup', function () {

        let searchValue = this.value.toLowerCase();

        let rows = document.querySelectorAll('#salaryTable tr');

        rows.forEach(function (row) {

            let employeeName = row.cells[0]?.textContent.toLowerCase();

            if (employeeName && employeeName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

</script>

@endsection