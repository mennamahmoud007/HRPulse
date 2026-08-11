<aside class="sidebar">

    <div class="sidebar-logo">
        <h2>HRPulse</h2>
    </div>

    <nav class="sidebar-nav">

        @if(auth()->user()->role->name === 'employee')

            <a href="{{ route('employee.dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('profile') }}">
                My Profile
            </a>

            <a href="{{ route('salaries') }}">
                My Salary
            </a>

            <a href="{{ route('attendance') }}">
                Attendance History
            </a>

            <a href="{{ route('leave-requests') }}">
                Leave Requests
            </a>

        @elseif(auth()->user()->role->name === 'hr')

            <a href="{{ route('hr.dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('employees.index') }}">
                Employees
            </a>

            <a href="{{ route('departments.index') }}">
                Departments
            </a>

            <a href="{{ route('positions.index') }}">
                Positions
            </a>

            <a href="{{ route('hr.salaries') }}">
                Salaries
            </a>

            <a href="{{ route('hr.attendance') }}">
                Attendance
            </a>

            <a href="{{ route('hr.leave-requests') }}">
                Leave Requests
            </a>

            <a href="{{ route('reports') }}">
                Reports
            </a>

            <a href="{{ route('profile') }}">
                My Profile
            </a>

        @elseif(auth()->user()->role->name === 'manager')

            <a href="{{ route('manager.dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('manager.attendance') }}">
                Attendance
            </a>

            <a href="{{ route('manager.leave-requests') }}">
                Leave Requests
            </a>

            <a href="{{ route('performance') }}">
                Performance
            </a>

            <a href="{{ route('profile') }}">
                My Profile
            </a>

        @endif

    </nav>

    <div class="sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="logout-button">
                Logout
            </button>
        </form>
    </div>

</aside>