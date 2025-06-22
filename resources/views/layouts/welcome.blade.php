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
<body>
    
    @yield('header')
    <div class="w-[100vw] flex">
        <div class="w-full">
            @yield('main_head')
            @yield('content')
        </div>
    </div>
        @if (session()->has('success'))
           <div>{{ session('success') }}</div>
        @endif

    @yield('footer')

</body>
</html>