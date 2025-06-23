@extends('layouts.app')


@section('main_head')
        <div class="main_head">Hi, {{ $user = auth()->user()->name }}!   <br> 
            Here are your current tasks:
        </div>
@endsection

@section('content')
<div class="flex py-5 px-5 w-1/2">
    <a href="{{ route('tasks.create') }}" class="btn m-1">Create task</a>
</div>

<div class="flex">
        <div id="zone-0" class=" drop-zone  ">
            <h2 class="title">Not sorted tasks</h2>
            @foreach($tasks_0 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item">
                    {{ $task->title }}
                </li>
            @endforeach
        </div>
        <div  id="zone-1" class="drop-zone  bg-red-400 bg-opacity-20 relative ">
            <h2 class="title">   Urgent tasks</h2>   
            @foreach($tasks_1 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item">
                    {{ $task->title }}
                </li>
            @endforeach         
        </div>
        <div  id="zone-2" class="drop-zone  bg-amber-200 bg-opacity-20 relative ">
            <h2 class="title">So-so important tasks</h2>
            @foreach($tasks_2 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item">
                    {{ $task->title }}
                </li>
            @endforeach
        </div>
        <div  id="zone-3" class="drop-zone  bg-green-300 bg-opacity-20 relative ">
            <h2 class="title">Not important tasks</h2>
            @foreach($tasks_3 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item bg-violet-700">
                    {{ $task->title }}
                </li>
            @endforeach
        </div>
</div>
@endsection

@section('footer')
    <div class="footer">
    </div>
@endsection