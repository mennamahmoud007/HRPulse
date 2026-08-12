<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - HR Management System</title>

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

    .login-card {
        width: 100%;
        max-width: 430px;
        background: #1e293b;
        padding: 35px;
        border-radius: 12px;
        border: 1px solid #334155;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35);
    }

    .login-card h1 {
        font-weight: 700;
        color: #ffffff;
    }

    .login-card .text-muted {
        color: #94a3b8 !important;
    }

    .form-label {
        color: #e2e8f0;
        font-weight: 500;
    }

    .form-control {
        padding: 12px;
        border-radius: 8px;
        background-color: #263449;
        border: 1px solid #334155;
        color: #ffffff;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus {
        background-color: #263449;
        color: #ffffff;
        border-color: #9333ea;
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.2);
    }

    .btn-login {
        background-color: #9333ea;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        color: #ffffff;
        transition: 0.2s;
    }

    .btn-login:hover {
        background-color: #7e22ce;
        color: #ffffff;
    }

    .register-link {
        color: #c084fc;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link:hover {
        color: #d8b4fe;
        text-decoration: underline;
    }

    .alert-success {
        background-color: #052e16;
        border: 1px solid #166534;
        color: #bbf7d0;
    }

    .alert-danger {
        background-color: #450a0a;
        border: 1px solid #7f1d1d;
        color: #fecaca;
    }
</style>
</head>

<body>

    <div class="login-card">

        <div class="text-center mb-4">

            <h1>Welcome Back 👋</h1>

            <p class="text-muted">
                Login to your HR Management account
            </p>

        </div>


        {{-- Success Message --}}

        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


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


        <form method="POST" action="{{ route('login') }}">

            @csrf


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

            <div class="mb-4">

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


            <button
                type="submit"
                class="btn btn-primary btn-login w-100">
                Login
            </button>

        </form>


        <div class="text-center mt-4">

            <span class="text-muted">
                Don't have an account?
            </span>

            <a
                href="{{ route('register') }}"
                class="register-link">
                Create Account
            </a>

        </div>

    </div>

</body>

</html>