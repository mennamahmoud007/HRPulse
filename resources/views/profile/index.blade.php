@extends('layouts.app')

@section('content')
<style>
    /* =========================
   Profile Page
========================= */

.profile-page {
    max-width: 1000px;
    margin: 0 auto;
}


/* Page Header */

.profile-page .page-header {
    margin-bottom: 25px;
}

.profile-page .page-header h1 {
    margin: 0 0 6px;
    font-size: 28px;
    color: #F8FAFC;
}

.profile-page .page-header p {
    margin: 0;
    color: #94A3B8;
}


/* Main Profile Card */

.profile-card {
    background-color: #1F2937;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}


/* Profile Header */

.profile-header {
    display: flex;
    align-items: center;
    gap: 20px;

    padding: 28px;

    border-bottom: 1px solid #374151;
}


.profile-avatar {
    width: 90px;
    height: 90px;

    border-radius: 50%;

    object-fit: cover;

    border: 3px solid #7C3AED;
}


.profile-avatar.placeholder {
    display: flex;
    align-items: center;
    justify-content: center;

    background-color: #7C3AED;

    color: #F8FAFC;

    font-size: 25px;
    font-weight: 700;
}


.profile-info h2 {
    margin: 0 0 6px;

    font-size: 22px;

    color: #F8FAFC;
}


.profile-info p {
    margin: 0 0 10px;

    color: #94A3B8;

    font-size: 14px;
}


.role-badge {
    display: inline-block;

    padding: 5px 11px;

    border-radius: 20px;

    background-color: rgba(124, 58, 237, 0.15);

    color: #A78BFA;

    font-size: 12px;
    font-weight: 600;
}


/* Sections */

.profile-section {
    padding: 28px;

    border-bottom: 1px solid #374151;
}


.profile-section:last-child {
    border-bottom: none;
}


.profile-section h3 {
    margin: 0 0 20px;

    font-size: 17px;

    color: #F8FAFC;
}


/* Personal Information */

.profile-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 18px;
}


.profile-field {
    display: flex;
    flex-direction: column;

    gap: 7px;
}


.profile-field label {
    font-size: 13px;

    font-weight: 600;

    color: #94A3B8;
}


.field-value {
    min-height: 42px;

    display: flex;
    align-items: center;

    padding: 10px 13px;

    border-radius: 8px;

    background-color: #111827;

    border: 1px solid #374151;

    color: #E2E8F0;

    font-size: 14px;
}


/* Photo Upload */

.photo-upload {
    margin-bottom: 15px;
}


.photo-upload input {
    width: 100%;

    padding: 10px;

    border-radius: 8px;

    border: 1px solid #475569;

    background-color: #111827;

    color: #CBD5E1;
}


/* Password */

.password-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 18px;

    margin-bottom: 20px;
}


.password-grid input {
    width: 100%;

    padding: 11px 13px;

    border-radius: 8px;

    border: 1px solid #475569;

    background-color: #111827;

    color: #F8FAFC;

    outline: none;
}


.password-grid input:focus {
    border-color: #7C3AED;
}


.password-grid input::placeholder {
    color: #64748B;
}


/* Buttons */

.profile-section .btn-primary {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 11px 18px;

    border: none;
    border-radius: 8px;

    background-color: #7C3AED;

    color: #F8FAFC;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;

    transition: 0.2s;
}


.profile-section .btn-primary:hover {
    background-color: #8B5CF6;
}


/* Errors */

.error-message {
    margin-top: 5px;

    color: #EF4444;

    font-size: 12px;
}


/* Responsive */

@media (max-width: 800px) {

    .profile-grid,
    .password-grid {
        grid-template-columns: 1fr;
    }

    .profile-header {
        align-items: flex-start;
    }

}


@media (max-width: 600px) {

    .profile-page {
        width: 100%;
    }

    .profile-header {
        flex-direction: column;
    }

    .profile-section {
        padding: 20px;
    }

}
</style>

<div class="profile-page">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1>My Profile</h1>
            <p>Manage your account settings</p>
        </div>
    </div>


    {{-- Profile Card --}}
    <div class="profile-card">

        {{-- Profile Header --}}
        <div class="profile-header">

            @if($user->employee?->photo)

                <img
                    src="{{ asset('storage/' . $user->employee->photo) }}"
                    alt="{{ $user->name }}"
                    class="profile-avatar"
                >

            @else

                <div class="profile-avatar placeholder">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>

            @endif


            <div class="profile-info">

                <h2>{{ $user->name }}</h2>

                <p>{{ $user->email }}</p>

                <span class="role-badge">
                    {{ ucfirst($user->role->name) }}
                </span>

            </div>

        </div>


        {{-- Personal Information --}}
        <div class="profile-section">

            <h3>Personal Information</h3>

            <div class="profile-grid">

                {{-- Name --}}
                <div class="profile-field">
                    <label>Full Name</label>

                    <div class="field-value">
                        {{ $user->name }}
                    </div>
                </div>


                {{-- Email --}}
                <div class="profile-field">
                    <label>Email</label>

                    <div class="field-value">
                        {{ $user->email }}
                    </div>
                </div>


                {{-- Role --}}
                <div class="profile-field">
                    <label>Role</label>

                    <div class="field-value">
                        {{ ucfirst($user->role->name) }}
                    </div>
                </div>

            </div>

        </div>


        {{-- Employee Photo --}}
        @if($user->role->name === 'employee')

            <div class="profile-section">

                <h3>Profile Photo</h3>

                <form
                    method="POST"
                    action="{{ route('profile.update') }}"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PUT')

                    <div class="photo-upload">

                        <input
                            type="file"
                            name="photo"
                            accept="image/*"
                        >

                    </div>

                    @error('photo')
                        <small class="error-message">
                            {{ $message }}
                        </small>
                    @enderror


                    <button type="submit" class="btn-primary">
                        Save Photo
                    </button>

                </form>

            </div>

        @endif


        {{-- Change Password --}}
        <div class="profile-section">

            <h3>Change Password</h3>

            <form
                method="POST"
                action="{{ route('profile.password') }}"
            >

                @csrf
                @method('PUT')


                <div class="password-grid">

                    <div class="profile-field">

                        <label>Current Password</label>

                        <input
                            type="password"
                            name="current_password"
                            placeholder="Current password"
                        >

                        @error('current_password')
                            <small class="error-message">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="profile-field">

                        <label>New Password</label>

                        <input
                            type="password"
                            name="password"
                            placeholder="New password"
                        >

                        @error('password')
                            <small class="error-message">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="profile-field">

                        <label>Confirm New Password</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirm new password"
                        >

                    </div>

                </div>


                <button type="submit" class="btn-primary">
                    Update Password
                </button>

            </form>

        </div>

    </div>

</div>

@endsection