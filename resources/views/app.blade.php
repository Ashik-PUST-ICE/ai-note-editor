<!DOCTYPE html>
<html>
<head>
    <title>AI Note Editor</title>

    <!-- CSRF Token, যা fetch / form এর নিরাপত্তার জন্য দরকার -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Ziggy: Laravel routes কে JavaScript-এ ব্যবহারযোগ্য করে -->
    @routes

    <!-- Vite React Refresh (Hot Reload) -->
    @viteReactRefresh

    <!-- তোমার মূল React App: `resources/js/app.jsx` -->
    @vite(['resources/js/app.jsx'])
</head>

<body>
    <!-- Inertia.js SPA rendering entry point -->
    @inertia
</body>
</html>
