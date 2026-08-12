<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Register - HR Management System</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>
    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        background: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 15px;
        color: #ffffff;
    }

    .register-card {
        width: 100%;
        max-width: 450px;
        background: #1e293b;
        padding: 35px;
        border-radius: 12px;
        border: 1px solid #334155;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35);
    }

    .register-card h1 {
        font-weight: 700;
        color: #ffffff;
    }

    .register-card .text-muted {
        color: #94a3b8 !important;
    }

    .form-label {
        color: #e2e8f0;
        font-weight: 500;
    }

    .form-control,
    .form-select {
        padding: 12px;
        border-radius: 8px;
        background-color: #263449;
        border: 1px solid #334155;
        color: #ffffff;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #263449;
        color: #ffffff;
        border-color: #9333ea;
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.2);
    }

    .form-select {
        cursor: pointer;
    }

    .form-select option {
        background-color: #1e293b;
        color: #ffffff;
    }

    .btn-register {
        background-color: #9333ea;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        color: #ffffff;
        transition: 0.2s;
    }

    .btn-register:hover {
        background-color: #7e22ce;
        color: #ffffff;
    }

    .login-link {
        color: #c084fc;
        text-decoration: none;
        font-weight: 600;
    }

    .login-link:hover {
        color: #d8b4fe;
        text-decoration: underline;
    }

    .alert-danger {
        background-color: #450a0a;
        border: 1px solid #7f1d1d;
        color: #fecaca;
    }
</style>

</head>

<body>

<div class="register-card">

<div class="text-center mb-4">
    <h1>Create Account</h1>

    <p class="text-muted">
        Create your employee account
    </p>
</div>


{{-- Validation Errors --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


<form method="POST" action="{{ route('register') }}">

    @csrf


    {{-- Name --}}
    <div class="mb-3">

        <label class="form-label">
            Name
        </label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name') }}"
            placeholder="Enter your name"
            required
        >

    </div>


    {{-- Email --}}
    <div class="mb-3">

        <label class="form-label">
            Email
        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email') }}"
            placeholder="Enter your email"
            required
        >

    </div>


    {{-- Password --}}
    <div class="mb-3">

        <label class="form-label">
            Password
        </label>

        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Enter your password"
            required
        >

    </div>


    {{-- Confirm Password --}}
    <div class="mb-3">

        <label class="form-label">
            Confirm Password
        </label>

        <input
            type="password"
            name="confirm_password"
            class="form-control"
            placeholder="Confirm your password"
            required
        >

    </div>


    {{-- Role --}}
    <div class="mb-4">

        <label for="role_id" class="form-label">
            Role
        </label>

        <select name="role_id" id="role_id" class="form-select" required>

            <option value="">
                -- Select Role --
            </option>

            @foreach ($roles as $role)

                <option
                    value="{{ $role->id }}"
                    {{ old('role_id') == $role->id ? 'selected' : '' }}
                >
                    {{ ucfirst($role->name) }}
                </option>

            @endforeach

        </select>

    </div>


    {{-- Register Button --}}
    <button
        type="submit"
        class="btn btn-primary btn-register w-100"
    >
        Register
    </button>

</form>


<div class="text-center mt-4">

    <span class="text-muted">
        Already have an account?
    </span>

    <a href="{{ route('login') }}" class="login-link">
        Login
    </a>

</div>


</div>

</body>

</html>
