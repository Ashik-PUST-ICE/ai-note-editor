<!DOCTYPE html>
<html>

<head>
    <title>AI Note Editor</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @routes

    @viteReactRefresh

    @vite(['resources/js/app.jsx'])
</head>

<body>

    @inertia
</body>

</html>
