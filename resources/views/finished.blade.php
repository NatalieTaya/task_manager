@extends('layouts.app')


@section('title', "Finished tasks")

@section('content')
    <div class="mx-auto flex flex-col items-center">
    @forelse ($tasks as $task)
        <a href="{{ route('tasks.show', $task -> id) }}" class="m-1 p-5 rounded bg-pink-500 w-3/4"> 
            {{ $task -> title}} 
        </a>
    @empty
        <p> There are no tasks </p> 
    @endforelse
    </div>
@endsection