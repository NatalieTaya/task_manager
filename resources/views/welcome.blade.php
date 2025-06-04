@extends('layouts.app')


<div class="flex py-5 px-5 w-1/2">
    <a href="{{ route('tasks.create') }}" class="btn flex-1 m-1 ">Create task</a>
    <a href="{{ route('tasks.finished') }}" class="btn flex-1 m-1 ">Show all finished tasks</a>
</div>

<div class="flex">
        <div id="zone-0" class=" drop-zone  task_block flex-1 ">
            <h2 class="title">Not sorted tasks</h2>
            @foreach($tasks_0 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item bg-violet-700">
                    {{ $task->title }}
                </li>
            @endforeach
        </div>
        <div  id="zone-1" class="drop-zone  task_block task_block_im flex-1">
            <h2 class="title">   Important tasks</h2>   
            @foreach($tasks_1 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item  bg-violet-700">
                    {{ $task->title }}
                </li>
            @endforeach         
        </div>
        <div  id="zone-2" class="drop-zone task_block task_block_ss flex-1">
            <h2 class="title">So-so important tasks</h2>
            @foreach($tasks_2 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item bg-violet-700">
                    {{ $task->title }}
                </li>
            @endforeach
        </div>
        <div  id="zone-3" class="drop-zone  task_block task_block_ni flex-1">
            <h2 class="title">Not important tasks</h2>
            @foreach($tasks_3 as $task)
                <li id="{{ $task->id }}" draggable="true" class="drag-item bg-violet-700">
                    {{ $task->title }}
                </li>
            @endforeach
        </div>
</div>