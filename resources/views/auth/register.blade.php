<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Register - HR Management System</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 15px;
    }

    .register-card {
        width: 100%;
        max-width: 450px;
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .register-card h1 {
        font-weight: 700;
        color: #333;
    }

    .form-control,
    .form-select {
        padding: 12px;
        border-radius: 10px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    }

    .form-select {
        cursor: pointer;
    }

    .btn-register {
        background-color: #667eea;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-register:hover {
        background-color: #5568d9;
    }

    .login-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .login-link:hover {
        text-decoration: underline;
    }
</style>
```

</head>

<body>

<div class="register-card">

```
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
```

</div>

</body>

</html>
