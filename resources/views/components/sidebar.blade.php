<aside class="sidebar">
    @php
        $currentUser = auth()->user();
        $roleName = $currentUser?->role?->name ?? 'user';
        $userName = $currentUser?->name ?? 'User';
        $userEmail = $currentUser?->email ?? 'user@corp.io';
        $userInitials = strtoupper(substr($userName, 0, 2));

        $roleLabel = match ($roleName) {
            'employee' => 'EMPLOYEE',
            'hr' => 'HR ADMINISTRATOR',
            'manager' => 'ENGINEERING MANAGER',
            default => strtoupper($roleName),
        };
    @endphp

    {{-- Logo --}}
    <div class="sidebar-logo">

        <div class="brand-icon">
            <i class="fa-solid fa-layer-group"></i>
        </div>

        <div>
            <h2>HRPulse</h2>

            <span class="brand-badge">
                {{ $roleLabel }}
            </span>
        </div>

    </div>


    {{-- Navigation --}}
    <nav class="sidebar-nav">

        @if($roleName === 'employee')

            <a href="{{ route('employee.dashboard') }}" class="{{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-border-all"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fa-regular fa-circle-user"></i>
                <span>My Profile</span>
            </a>

            <a href="{{ route('employee.salary') }}" class="{{ request()->routeIs('employee.salary') ? 'active' : '' }}">
                <i class="fa-solid fa-dollar-sign"></i>
                <span>My Salary</span>
            </a>

            <a href="{{ route('employee.attendance') }}" class="{{ request()->routeIs('employee.attendance') ? 'active' : '' }}">
                <i class="fa-regular fa-clock"></i>
                <span>Attendance History</span>
            </a>

            <a href="{{ route('employee.leaves') }}" class="{{ request()->routeIs('employee.leaves') ? 'active' : '' }}">
                <i class="fa-regular fa-envelope"></i>
                <span>Leave Requests</span>
            </a>


        @elseif($roleName === 'hr')

            <a href="{{ route('hr.dashboard') }}" class="{{ request()->routeIs('hr.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-border-all"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                <i class="fa-regular fa-user"></i>
                <span>Employees</span>
            </a>

            <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}">
                <i class="fa-regular fa-building"></i>
                <span>Departments</span>
            </a>

            <a href="{{ route('positions.index') }}" class="{{ request()->routeIs('positions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i>
                <span>Positions</span>
            </a>

            <a href="{{ route('hr.salaries') }}" class="{{ request()->routeIs('hr.salaries') ? 'active' : '' }}">
                <i class="fa-solid fa-dollar-sign"></i>
                <span>Salaries</span>
            </a>

            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fa-regular fa-circle-user"></i>
                <span>My Profile</span>
            </a>


        @elseif($roleName === 'manager')

            <a href="{{ route('manager.dashboard') }}" class="{{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-border-all"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('manager.team-employees') }}" class="{{ request()->routeIs('manager.team-employees') ? 'active' : '' }}">
                <i class="fa-regular fa-user"></i>
                <span>Team Employees</span>
            </a>

            <a href="{{ route('manager.attendance') }}" class="{{ request()->routeIs('manager.attendance') ? 'active' : '' }}">
                <i class="fa-regular fa-clock"></i>
                <span>Attendance</span>
            </a>

            <a href="{{ route('manager.leave-requests') }}" class="{{ request()->routeIs('manager.leave-requests') ? 'active' : '' }}">
                <i class="fa-regular fa-envelope"></i>
                <span>Leave Requests</span>
            </a>

            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fa-regular fa-circle-user"></i>
                <span>My Profile</span>
            </a>

        @endif

    </nav>


    {{-- User + Logout --}}
    <div class="sidebar-bottom">

        <div class="sidebar-user">

            <div class="user-avatar">
                {{ $userInitials }}
            </div>

            <div class="user-details">

                <div class="user-name">
                    {{ $userName }}
                </div>

                <div class="user-email">
                    {{ $userEmail }}
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