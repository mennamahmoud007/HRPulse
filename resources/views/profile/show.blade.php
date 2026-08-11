<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - HRPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0b0d17; color: #94a3b8; font-family: 'Inter', sans-serif; }
        .sidebar { background-color: #111322; min-height: 100vh; padding: 20px 15px; border-right: 1px solid #1a1d33; }
        .brand { color: #fff; font-weight: 700; font-size: 1.25rem; display: flex; align-items: center; gap: 10px; }
        .brand-icon { background: #6366f1; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; }
        .brand-badge { color: #818cf8; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px; }
        .nav-section-title { font-size: 0.7rem; text-transform: uppercase; color: #475569; margin: 25px 0 10px 10px; font-weight: 700; letter-spacing: 0.5px; }
        .nav-link { color: #94a3b8; padding: 12px 16px; border-radius: 10px; font-size: 0.9rem; margin-bottom: 4px; display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500; }
        .nav-link:hover, .nav-link.active { background-color: #6366f1; color: #fff; }
        .user-profile-bottom { margin-top: auto; padding-top: 15px; border-top: 1px solid #1a1d33; }

        /* Profile Cards styling */
        .card-custom { background-color: #13172b; border: 1px solid #1e243d; border-radius: 14px; padding: 24px; }
        .avatar-circle { width: 90px; height: 90px; background: #6366f1; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; margin: 0 auto 15px auto; }
        .info-label { font-size: 0.725rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 6px; }
        .info-value { font-size: 0.95rem; color: #f1f5f9; font-weight: 600; margin-bottom: 20px; }
        .badge-role { background-color: #1e293b; color: #94a3b8; font-size: 0.75rem; padding: 4px 10px; border-radius: 6px; font-weight: 500; }
        .btn-purple { background-color: #6366f1; color: #fff; border: none; font-weight: 600; padding: 10px; border-radius: 8px; width: 100%; }
        .btn-purple:hover { background-color: #4f46e5; color: #fff; }
        .btn-dark-subtle { background-color: #1e243d; color: #e2e8f0; border: 1px solid #2d3559; font-weight: 600; padding: 8px 18px; border-radius: 8px; }
        .btn-dark-subtle:hover { background-color: #2b3356; color: #fff; }

        .custom-input { background-color: #1b2038 !important; border: 1px solid #2a3254 !important; color: #ffffff !important; border-radius: 8px; padding: 10px 14px; }
        .custom-input:focus { border-color: #6366f1 !important; box-shadow: none !important; }
        
        /* التحكم بالظهور والإخفاء */
        .is-hidden { display: none !important; }
    </style>
</head>
<body>

@php
    $user = auth()->user();
    $userName = $user?->name ?? 'N/A';
    $userEmail = $user?->email ?? 'N/A';
    $userInitials = strtoupper(substr($userName, 0, 2));
    
    // تجنب طباعة الـ Role كـ JSON وتحديد الاسم مباشرة
    $userRole = is_object($user?->role) ? ($user->role->name ?? 'Employee') : ($user?->role ?? 'Employee');
    
    $department = $user?->department?->name ?? 'Not Assigned';
    $position = $user?->position?->title ?? $user?->job_title ?? 'Not Assigned';
    $phone = $user?->phone ?? 'N/A';
    $address = $user?->address ?? 'N/A';
    $joinedDate = $user?->created_at ? $user->created_at->format('M d, Y') : 'N/A';
@endphp

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-flex flex-column">
            <div>
                <div class="brand mb-4 px-2">
                    <div class="brand-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <div>
                        HRPulse
                        <span class="brand-badge d-block mt-1">{{ strtoupper($userRole) }}</span>
                    </div>
                </div>

                <div class="nav-section-title">MENU</div>
                <div class="nav flex-column">
                    <a href="{{ url('/employee/dashboard') }}" class="nav-link {{ request()->is('employee/dashboard*') ? 'active' : '' }}">
                        <i class="fa-solid fa-border-all"></i> Dashboard
                    </a>
                    <a href="{{ url('/profile') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                        <i class="fa-regular fa-user"></i> My Profile
                    </a>
                    <a href="{{ url('/employee/salary') }}" class="nav-link {{ request()->is('employee/salary*') ? 'active' : '' }}">
                        <i class="fa-solid fa-dollar-sign"></i> My Salary
                    </a>
                    <a href="{{ url('/employee/attendance') }}" class="nav-link {{ request()->is('employee/attendance*') ? 'active' : '' }}">
                        <i class="fa-regular fa-clock"></i> Attendance History
                    </a>
                    <a href="{{ url('/employee/leave-requests') }}" class="nav-link {{ request()->is('employee/leave-requests*') ? 'active' : '' }}">
                        <i class="fa-regular fa-folder-open"></i> Leave Requests
                    </a>
                </div>
            </div>

            <div class="user-profile-bottom">
                <div class="d-flex align-items-center gap-2 mb-3 px-1">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px; font-size: 0.8rem; flex-shrink: 0;">
                        {{ $userInitials }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="text-white fw-medium text-truncate" style="font-size: 0.85rem;">{{ $userName }}</div>
                        <div class="text-muted text-truncate" style="font-size: 0.725rem;">{{ $userEmail }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger text-decoration-none nav-link w-100 p-0 border-0"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary border-opacity-25">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-secondary btn-sm border-0"><i class="fa-solid fa-bars text-white"></i></button>
                    <h5 class="text-white mb-0 fw-bold">My Profile</h5>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-regular fa-bell text-secondary fs-5"></i>
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                        {{ $userInitials }}
                    </div>
                    <span class="text-white fw-medium" style="font-size: 0.9rem;">{{ $userName }}</span>
                </div>
            </div>

            <h3 class="text-white fw-bold mb-1">My Profile</h3>
            <p class="text-secondary small mb-4">View and update your personal information</p>

            <div class="row g-4">
                <!-- Left Column: Profile Card -->
                <div class="col-md-4">
                    <div class="card-custom text-center h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="avatar-circle">{{ $userInitials }}</div>
                            <h4 class="text-white fw-bold mb-1">{{ $userName }}</h4>
                            <div class="text-indigo fw-semibold mb-1" style="color: #818cf8;">{{ $position }}</div>
                            <div class="text-secondary small mb-4">{{ $department }}</div>

                            <div class="border-top border-secondary border-opacity-25 pt-3 mt-3 text-start">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-secondary small">Member since</span>
                                    <span class="text-white fw-medium small">{{ $joinedDate }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <span class="text-secondary small">Role</span>
                                    <span class="badge-role">{{ ucfirst($userRole) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- أزرار التبديل -->
                        <div id="btn-show-edit">
                            <button type="button" class="btn btn-purple" onclick="toggleProfileEdit(true)">Edit Profile</button>
                        </div>
                        <div id="btn-cancel-edit" class="is-hidden">
                            <button type="button" class="btn btn-dark-subtle w-100" onclick="toggleProfileEdit(false)">Cancel Edit</button>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-8 d-flex flex-column gap-4">
                    <!-- Personal Info Card -->
                    <div class="card-custom">
                        <h5 class="text-white fw-bold mb-4">Personal Information</h5>

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="info-label">FULL NAME</div>
                                    <div class="info-value view-mode">{{ $userName }}</div>
                                    <input type="text" name="name" class="form-control custom-input edit-mode is-hidden" value="{{ $userName }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="info-label">EMAIL</div>
                                    <div class="info-value view-mode">{{ $userEmail }}</div>
                                    <input type="email" name="email" class="form-control custom-input edit-mode is-hidden" value="{{ $userEmail }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="info-label">PHONE</div>
                                    <div class="info-value view-mode">{{ $phone }}</div>
                                    <input type="text" name="phone" class="form-control custom-input edit-mode is-hidden" value="{{ $phone === 'N/A' ? '' : $phone }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="info-label">ADDRESS</div>
                                    <div class="info-value view-mode">{{ $address }}</div>
                                    <input type="text" name="address" class="form-control custom-input edit-mode is-hidden" value="{{ $address === 'N/A' ? '' : $address }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="info-label">DEPARTMENT</div>
                                    <div class="info-value">{{ $department }}</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="info-label">POSITION</div>
                                    <div class="info-value">{{ $position }}</div>
                                </div>
                            </div>

                            <!-- أزرار Save و Cancel مع مخفية افتراضياً بـ is-hidden -->
                            <div id="profile-edit-actions" class="justify-content-end gap-2 mt-3 edit-mode is-hidden">
                                <button type="button" class="btn btn-dark-subtle px-4" onclick="toggleProfileEdit(false)">Cancel</button>
                                <button type="submit" class="btn btn-purple px-4" style="width: auto;">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password Card -->
                    <div class="card-custom">
                        <h5 class="text-white fw-bold mb-3">Change Password</h5>

                        <div id="password-view-mode">
                            <button type="button" class="btn btn-dark-subtle" onclick="togglePasswordEdit(true)">Change Password</button>
                        </div>

                        <div id="password-edit-mode" class="is-hidden">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <label class="info-label">CURRENT PASSWORD</label>
                                    <input type="password" name="current_password" class="form-control custom-input" placeholder="••••••••" required>
                                </div>

                                <div class="mb-3">
                                    <label class="info-label">NEW PASSWORD</label>
                                    <input type="password" name="password" class="form-control custom-input" placeholder="••••••••" required>
                                </div>

                                <div class="mb-4">
                                    <label class="info-label">CONFIRM NEW PASSWORD</label>
                                    <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="••••••••" required>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-dark-subtle px-4" onclick="togglePasswordEdit(false)">Cancel</button>
                                    <button type="submit" class="btn btn-purple px-4" style="width: auto;">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleProfileEdit(showEdit) {
        const viewModes = document.querySelectorAll('.view-mode');
        const editModes = document.querySelectorAll('.edit-mode');
        const actionRow = document.getElementById('profile-edit-actions');

        if (showEdit) {
            viewModes.forEach(el => el.classList.add('is-hidden'));
            editModes.forEach(el => el.classList.remove('is-hidden'));
            actionRow.style.display = 'flex';

            document.getElementById('btn-show-edit').classList.add('is-hidden');
            document.getElementById('btn-cancel-edit').classList.remove('is-hidden');
        } else {
            viewModes.forEach(el => el.classList.remove('is-hidden'));
            editModes.forEach(el => el.classList.add('is-hidden'));
            actionRow.style.display = 'none';

            document.getElementById('btn-show-edit').classList.remove('is-hidden');
            document.getElementById('btn-cancel-edit').classList.add('is-hidden');
        }
    }

    function togglePasswordEdit(showForm) {
        const viewContainer = document.getElementById('password-view-mode');
        const editContainer = document.getElementById('password-edit-mode');

        if (showForm) {
            viewContainer.classList.add('is-hidden');
            editContainer.classList.remove('is-hidden');
        } else {
            viewContainer.classList.remove('is-hidden');
            editContainer.classList.add('is-hidden');
        }
    }
</script>
</body>
</html>