<div class="col-md-2 sidebar d-flex flex-column" style="background-color: #121625; min-height: 100vh; padding: 24px 16px; border-right: 1px solid #1a1f33;">
    <!-- Brand Logo -->
    <div class="brand mb-3 px-2 d-flex align-items-center gap-2">
        <div class="brand-icon" style="background: #6366f1; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff;">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div>
            <div class="text-white fw-bold" style="font-size: 1.1rem;">HRPulse</div>
            <span class="brand-badge" style="color: #6366f1; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;">HR ADMINISTRATOR</span>
        </div>
    </div>

    <div class="menu-title" style="color: #475569; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-top: 20px; margin-bottom: 10px; padding-left: 12px;">MENU</div>

    <!-- Navigation Links -->
    <div class="nav flex-column">
        <!-- Dashboard -->
        <a href="{{ Route::has('hr.dashboard') ? route('hr.dashboard') : (Route::has('dashboard') ? route('dashboard') : '#') }}" 
           class="nav-link {{ request()->routeIs('*dashboard*') ? 'active' : '' }}">
            <i class="fa-solid fa-border-all"></i> Dashboard
        </a>

        <!-- Employees -->
        <a href="{{ Route::has('employees.index') ? route('employees.index') : (Route::has('hr.employees') ? route('hr.employees') : '#') }}" 
           class="nav-link {{ request()->routeIs('*employee*') ? 'active' : '' }}">
            <i class="fa-regular fa-user"></i> Employees
        </a>

        <!-- Departments -->
        <a href="{{ Route::has('departments.index') ? route('departments.index') : (Route::has('hr.departments') ? route('hr.departments') : '#') }}" 
           class="nav-link {{ request()->routeIs('*department*') ? 'active' : '' }}">
            <i class="fa-regular fa-building"></i> Departments
        </a>

        <!-- Positions -->
        <a href="{{ Route::has('positions.index') ? route('positions.index') : (Route::has('hr.positions') ? route('hr.positions') : '#') }}" 
           class="nav-link {{ request()->routeIs('*position*') ? 'active' : '' }}">
            <i class="fa-solid fa-briefcase"></i> Positions
        </a>

        <!-- Salaries -->
        <a href="{{ Route::has('salaries.index') ? route('salaries.index') : (Route::has('hr.salaries') ? route('hr.salaries') : '#') }}" 
           class="nav-link {{ request()->routeIs('*salar*') ? 'active' : '' }}">
            <i class="fa-solid fa-dollar-sign"></i> Salaries
        </a>

        <!-- Attendance -->
        <a href="{{ Route::has('attendance.index') ? route('attendance.index') : (Route::has('hr.attendance') ? route('hr.attendance') : '#') }}" 
           class="nav-link {{ request()->routeIs('*attendance*') ? 'active' : '' }}">
            <i class="fa-regular fa-clock"></i> Attendance
        </a>

        <!-- Leave Requests -->
        <a href="{{ Route::has('leave-requests.index') ? route('leave-requests.index') : (Route::has('hr.leave-requests') ? route('hr.leave-requests') : '#') }}" 
           class="nav-link {{ request()->routeIs('*leave*') ? 'active' : '' }}">
            <i class="fa-regular fa-envelope"></i> Leave Requests
        </a>

        <!-- Reports -->
        <a href="{{ Route::has('reports.index') ? route('reports.index') : (Route::has('hr.reports') ? route('hr.reports') : '#') }}" 
           class="nav-link {{ request()->routeIs('*report*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-simple"></i> Reports
        </a>

        <!-- Profile -->
        <a href="{{ Route::has('profile.show') ? route('profile.show') : (Route::has('profile.index') ? route('profile.index') : '#') }}" 
           class="nav-link {{ request()->routeIs('profile*') ? 'active' : '' }}">
            <i class="fa-regular fa-circle-user"></i> Profile
        </a>
    </div>

    <!-- User Profile & Logout Section -->
    <div class="mt-auto pt-3 border-top border-secondary-subtle">
        <div class="d-flex align-items-center gap-2 mb-3 px-1">
            <div class="avatar-circle" style="background: #6366f1; width: 36px; height: 36px; border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem;">
                {{ strtoupper(substr(auth()->user()->name ?? 'YA', 0, 2)) }}
            </div>
            <div class="overflow-hidden">
                <div class="text-white fw-medium text-truncate" style="font-size: 0.85rem;">
                    {{ auth()->user()->name ?? 'yasmin' }}
                </div>
                <div class="text-muted text-truncate" style="font-size: 0.75rem;">
                    {{ auth()->user()->email ?? 'yt1110@fayoum.edu.eg' }}
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-danger text-decoration-none nav-link w-100 p-0 border-0" style="color: #ef4444 !important;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</div>