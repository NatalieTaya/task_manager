<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Подключаем js коды --}}
    @vite(['resources/js/pages/drag_drop.js']) 
</head>
<body class="bg-slate-900">
    
    @yield(section: 'title')
    @if (session()->has('success'))
    <div>{{ session('success') }}</div>
    
    @endif
    @yield('content')

</body>
</html>