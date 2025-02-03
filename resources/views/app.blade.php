<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Inertia</title>

    @routes {{-- Pastikan ini ada agar Ziggy bisa membaca route Laravel --}}
    @vite('resources/js/app.js')
</head>
<body>
    @inertia
</body>
</html>
