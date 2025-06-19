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
        <div class="sidebar">
            <h1 class="main_title">Task manager</h1>
            <li class="li"> 
                <svg width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" >
                    <rect x="0" y="0" width="30" height="40" fill="none" stroke="rgb(200,183,235)" stroke-width="2" rx="5"  ry="5"/>
                    <rect x="2"  y="3"  width="12" height="16" fill="none" stroke="rgb(200,183,235)" stroke-width="2" rx="2"  ry="2"/>
                    <rect x="2"  y="21" width="12" height="16" fill="none" stroke="rgb(200,183,235)" stroke-width="2" rx="2"  ry="2"/>
                    <rect x="17" y="3"  width="12" height="16" fill="none" stroke="rgb(200,183,235)" stroke-width="2" rx="2"  ry="2"/>
                    <rect x="17" y="21" width="12" height="16" fill="none" stroke="rgb(200,183,235)" stroke-width="2" rx="2"  ry="2"/>
                </svg>
                <a class="sidebar_item" href="{{ route('tasks.index') }}">Dashboard</a>
            </li>
            <li class="li">
                <svg width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="0" width="30" height="40" fill="none" stroke="rgb(200,183,235)" stroke-width="2" rx="5"  ry="5"/>
                    <circle cx="5" cy="8" r="2" fill="rgb(200,183,235)"  />
                    <circle cx="5" cy="17" r="2" fill="rgb(200,183,235)"   />
                    <circle cx="5" cy="26" r="2" fill="rgb(200,183,235)"   />
                    <line x1="10" y1="8" x2="25" y2="8" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                    <line x1="10" y1="17" x2="25" y2="17" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                    <line x1="10" y1="26" x2="25" y2="26" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                </svg>
                <a class="sidebar_item" href="{{ route('tasks.current') }}">My tasks</a>
            </li>
            <li class="li">
                <svg width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="0" width="30" height="40" fill="none" stroke="rgb(200,183,235)" stroke-width="2" rx="5"  ry="5"/>
                    <line x1="5" y1="12" x2="8" y2="22" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                    <line x1="8" y1="22" x2="13" y2="3" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                    <line x1="15" y1="8" x2="25" y2="8" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                    <line x1="15" y1="17" x2="25" y2="17" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                    <line x1="15" y1="26" x2="25" y2="26" stroke="rgb(200,183,235)" stroke-width="3"  stroke-linecap="round" />
                </svg>
                <a class="sidebar_item" href="{{ route('tasks.finished') }}">Completed</a>
            </li>
        </div>
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