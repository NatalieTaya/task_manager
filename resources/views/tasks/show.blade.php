@extends('layouts.app')

@section('header')
    <div class="header">
    </div>
@endsection

@section('content')
    <div class="m-4 text-lg">
        {{ "Task ". $task->id }}
    </div>
    <div class="m-4">
        {{$task->title}}
    </div>
    <div class="m-4">
        {{$task->description}} 
    </div>

        <form action="{{ route('tasks.edit', ['task' => $task->id]) }}" method="get">
           @csrf
           <button class="btn m-4" type="submit">Edit</button>
        </form>

        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post">
           @csrf
           @method('DELETE') 
           <button class="btn m-4" type="submit">Delete</button>
        </form>
        
@endsection

@section('footer')
    <div class="footer">
    </div>
@endsection