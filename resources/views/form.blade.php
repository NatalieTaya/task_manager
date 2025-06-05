@extends('layouts.app')

@section('title', isset($task) ? 'Edit task' :'Create Task')

@section('content')
    <form method="POST" action="{{  isset($task) 
                                    ? route('tasks.update', ['task'=>$task->id]) 
                                    : route('tasks.create') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <label for="">Title</label>
        <input type="text" name="title">
        @error('title')
            <p>{{ $message }}</p>
        @enderror
        <label for="">Description</label>
        <textarea name="description"></textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
        <label for="">Importance</label>
        <input type="text" name="importance">
        @error('importance')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit"> 
            @isset($task)
                Update Task
            @else
                Create Task
            @endisset
        </button>
    </form>
@endsection

