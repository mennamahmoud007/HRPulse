<aside class="sidebar">

    {{-- Logo --}}
    <div class="sidebar-logo">

        <div class="brand-icon">
            <i class="fa-solid fa-layer-group"></i>
        </div>

        <div>
            <h2>HRPulse</h2>

            <span class="brand-badge">
                {{ strtoupper(auth()->user()->role->name) }}
            </span>
        </div>

    </div>


    {{-- Navigation --}}
    <nav class="sidebar-nav">

        @if(auth()->user()->role->name === 'employee')

            <a href="{{ route('employee.dashboard') }}">
                <i class="fa-solid fa-border-all"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('profile') }}">
                <i class="fa-regular fa-circle-user"></i>
                <span>My Profile</span>
            </a>

            <a href="{{ route('salaries') }}">
                <i class="fa-solid fa-dollar-sign"></i>
                <span>My Salary</span>
            </a>

            <a href="{{ route('attendance') }}">
                <i class="fa-regular fa-clock"></i>
                <span>Attendance History</span>
            </a>

            <a href="{{ route('leave-requests') }}">
                <i class="fa-regular fa-envelope"></i>
                <span>Leave Requests</span>
            </a>


        @elseif(auth()->user()->role->name === 'hr')

            <a href="{{ route('hr.dashboard') }}">
                <i class="fa-solid fa-border-all"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('employees.index') }}">
                <i class="fa-regular fa-user"></i>
                <span>Employees</span>
            </a>

            <a href="{{ route('departments.index') }}">
                <i class="fa-regular fa-building"></i>
                <span>Departments</span>
            </a>

            <a href="{{ route('positions.index') }}">
                <i class="fa-solid fa-briefcase"></i>
                <span>Positions</span>
            </a>

            <a href="{{ route('hr.salaries') }}">
                <i class="fa-solid fa-dollar-sign"></i>
                <span>Salaries</span>
            </a>

            <a href="{{ route('hr.attendance') }}">
                <i class="fa-regular fa-clock"></i>
                <span>Attendance</span>
            </a>

            <a href="{{ route('hr.leave-requests') }}">
                <i class="fa-regular fa-envelope"></i>
                <span>Leave Requests</span>
            </a>

            <a href="{{ route('reports') }}">
                <i class="fa-solid fa-chart-simple"></i>
                <span>Reports</span>
            </a>

            <a href="{{ route('profile') }}">
                <i class="fa-regular fa-circle-user"></i>
                <span>My Profile</span>
            </a>


        @elseif(auth()->user()->role->name === 'manager')

            <a href="{{ route('manager.dashboard') }}">
                <i class="fa-solid fa-border-all"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('manager.attendance') }}">
                <i class="fa-regular fa-clock"></i>
                <span>Attendance</span>
            </a>

            <a href="{{ route('manager.leave-requests') }}">
                <i class="fa-regular fa-envelope"></i>
                <span>Leave Requests</span>
            </a>

            <a href="{{ route('performance') }}">
                <i class="fa-solid fa-chart-simple"></i>
                <span>Performance</span>
            </a>

            <a href="{{ route('profile') }}">
                <i class="fa-regular fa-circle-user"></i>
                <span>My Profile</span>
            </a>

        @endif

    </nav>


    {{-- User + Logout --}}
    <div class="sidebar-bottom">

        <div class="sidebar-user">

            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>

            <div class="user-details">

                <div class="user-name">
                    {{ auth()->user()->name }}
                </div>

                <div class="user-email">
                    {{ auth()->user()->email }}
                </div>

            </div>

        </div>


        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>

        </form>

    </div>

</aside>