<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRPulse - HR Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #0f172a;
            color: #ffffff;
            overflow-x: hidden;
        }


        /* =========================
           Navbar
        ========================= */

        .navbar {
            background: rgba(30, 41, 59, 0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #334155;
            transition: 0.3s ease;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-size: 24px;
            font-weight: 700;
            transition: 0.3s ease;
        }

        .navbar-brand:hover {
            color: #c084fc !important;
            transform: scale(1.05);
        }

        .nav-link {
            color: #cbd5e1 !important;
            transition: 0.3s ease;
        }

        .nav-link:hover {
            color: #c084fc !important;
        }


        /* =========================
           Background Effects
        ========================= */

        .background-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            pointer-events: none;
            animation: float 8s ease-in-out infinite;
        }

        .circle-one {
            width: 300px;
            height: 300px;
            background: #9333ea;
            top: 100px;
            left: -100px;
        }

        .circle-two {
            width: 250px;
            height: 250px;
            background: #6366f1;
            top: 350px;
            right: -80px;
            animation-delay: 2s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-25px);
            }
        }


        /* =========================
           Hero
        ========================= */

        .hero {
            min-height: 78vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            padding: 80px 20px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            animation: heroFade 1s ease forwards;
        }

        @keyframes heroFade {

            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: clamp(40px, 6vw, 65px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #a855f7;
            text-shadow: 0 0 30px rgba(168, 85, 247, 0.35);
        }

        .hero p {
            color: #94a3b8;
            font-size: 18px;
            max-width: 650px;
            margin: 0 auto 30px;
            line-height: 1.7;
            animation: fadeUp 1s ease 0.3s both;
        }


        /* =========================
           Buttons
        ========================= */

        .btn-primary-custom {
            background: #9333ea;
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(147, 51, 234, 0.25);
        }

        .btn-primary-custom:hover {
            background: #7e22ce;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(147, 51, 234, 0.4);
        }

        .btn-outline-custom {
            border: 1px solid #9333ea;
            color: #c084fc;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: #9333ea;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3);
        }


        /* =========================
           Features
        ========================= */

        .features-section {
            position: relative;
            z-index: 2;
            padding-bottom: 70px;
        }

        .feature-card {
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid #334155;
            border-radius: 14px;
            padding: 28px;
            height: 100%;
            transition: all 0.35s ease;
            animation: fadeUp 0.8s ease both;
        }

        .feature-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .feature-card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .feature-card:nth-child(3) {
            animation-delay: 0.6s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            border-color: #9333ea;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .feature-icon {
            font-size: 35px;
            margin-bottom: 15px;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.15) rotate(3deg);
        }

        .feature-card h5 {
            color: #ffffff;
            font-weight: 600;
        }

        .feature-card p {
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 0;
        }


        /* =========================
           Animation
        ========================= */

        @keyframes fadeUp {

            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =========================
           Footer
        ========================= */

        footer {
            border-top: 1px solid #334155;
            color: #64748b;
            padding: 22px;
            text-align: center;
            background: #0b1120;
        }

    </style>
</head>


<body>

    <!-- Background Effects -->

    <div class="background-circle circle-one"></div>
    <div class="background-circle circle-two"></div>


    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                HRPulse
            </a>

            <div>

                <a href="{{ route('login') }}"
                   class="nav-link d-inline-block me-3">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="btn btn-primary-custom">
                    Get Started
                </a>

            </div>

        </div>

    </nav>


    <!-- Hero Section -->

    <section class="hero">

        <div class="container hero-content">

            <h1>
                Smart
                <span>HR Management</span>
                System
            </h1>

            <p>
                Manage employees, attendance, leaves, salaries,
                departments and reports easily in one place.
            </p>

            <div>

                <a href="{{ route('login') }}"
                   class="btn btn-primary-custom me-2">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="btn btn-outline-custom">
                    Create Account
                </a>

            </div>

        </div>

    </section>


    <!-- Features -->

    <section class="features-section">

        <div class="container">

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="feature-card">

                        <div class="feature-icon">
                            👥
                        </div>

                        <h5>
                            Employee Management
                        </h5>

                        <p>
                            Manage employee information,
                            profiles and organizational data
                            efficiently.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="feature-card">

                        <div class="feature-icon">
                            📊
                        </div>

                        <h5>
                            Attendance Tracking
                        </h5>

                        <p>
                            Track employee attendance and
                            monitor daily records easily.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="feature-card">

                        <div class="feature-icon">
                            📅
                        </div>

                        <h5>
                            Leave Management
                        </h5>

                        <p>
                            Manage leave requests and approvals
                            quickly and efficiently.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->

    <footer>

        © 2026 HRPulse. All Rights Reserved.

    </footer>


</body>

</html>