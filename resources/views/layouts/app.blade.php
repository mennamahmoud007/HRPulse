<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRPulse</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a !important; color: #f8fafc; font-family: system-ui, -apple-system, sans-serif; }
        .main-wrapper { display: flex; min-height: 100vh; }
        .content-area { flex-grow: 1; padding: 20px; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <!-- استدعاء السايدبار الخاص بكِ بطريقة نظيفة -->
        @if(view()->exists('layouts.hr-sidebar'))
            @include('layouts.hr-sidebar')
        @elseif(view()->exists('hr.hr-sidebar'))
            @include('hr.hr-sidebar')
        @endif

        <main class="content-area">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS (ضروري جدا لتشغيل المودالات Modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>