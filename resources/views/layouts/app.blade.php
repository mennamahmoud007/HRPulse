<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRPulse</title>

     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <x-sidebar />

    <main class="main-content">
        @yield('content')
    </main>

</body>

</html>