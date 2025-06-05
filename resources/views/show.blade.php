@extends('layouts.app')

@section('header')
    <div class="header">
    </div>
@endsection

@section('main_head', "Task ". $task->id )
@section('content')
    {{$task->title}}
        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post">
           @csrf
           @method('DELETE') 
           <button class="btn" type="submit">Delete</button>
        </form>
@endsection

@section('footer')
    <div class="footer">
    </div>
@endsection