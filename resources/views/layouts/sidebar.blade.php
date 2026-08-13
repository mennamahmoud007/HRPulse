<div class="col-md-2 sidebar d-flex flex-column">
    <!-- Brand Logo -->
    <div class="brand mb-3 px-2 d-flex align-items-center gap-2">
        <div class="brand-icon"><i class="fa-solid fa-layer-group"></i></div>
        <div>
            <div class="text-white fw-bold" style="font-size: 1.1rem;">HRPulse</div>
            <span class="brand-badge">ENGINEERING MANAGER</span>
        </div>
    </div>

    <div class="menu-title">MENU</div>

    <!-- Navigation Links -->
    <div class="nav flex-column">
        <a href="{{ route('manager.dashboard') }}" 
           class="nav-link {{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-border-all"></i> Dashboard
        </a>

        <a href="{{ route('manager.team-employees') }}" 
           class="nav-link {{ request()->routeIs('manager.team-employees') ? 'active' : '' }}">
            <i class="fa-regular fa-user"></i> Team Employees
        </a>

        <a href="{{ route('manager.attendance') }}" 
           class="nav-link {{ request()->routeIs('manager.attendance') ? 'active' : '' }}">
            <i class="fa-regular fa-clock"></i> Attendance
        </a>

        <a href="{{ route('manager.leave-requests') }}" 
           class="nav-link {{ request()->routeIs('manager.leave-requests') ? 'active' : '' }}">
            <i class="fa-regular fa-envelope"></i> Leave Requests
        </a>
    </div>

    <!-- User Profile & Logout Section -->
    <div class="mt-auto pt-3 border-top border-secondary-subtle">
        <div class="d-flex align-items-center gap-2 mb-3 px-1">
            <div class="avatar-circle">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
            </div>
            <div class="overflow-hidden">
                <div class="text-white fw-medium text-truncate" style="font-size: 0.85rem;">
                    {{ auth()->user()->name ?? 'User' }}
                </div>
                <div class="text-muted text-truncate" style="font-size: 0.75rem;">
                    {{ auth()->user()->email ?? 'user@corp.io' }}
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-danger text-decoration-none nav-link w-100 p-0 border-0">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</div>