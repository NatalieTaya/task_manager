@extends('layouts.app')

@section('header')
    <div class="header">
    </div>
@endsection

@section('title', "Current tasks")

@section('content')
    <div class="mx-auto ">
    @forelse ($tasks as $task)
        <a href="{{ route('tasks.show', $task -> id) }}" class="task_item"> 
            {{ $task -> title}} 
        </a>
    @empty
        <p> There are no tasks </p> 
    @endforelse
    </div>
@endsection

@section('footer')
    <div class="footer">
    </div>
@endsection