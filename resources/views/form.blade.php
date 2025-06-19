@extends('layouts.app')

@section('title', isset($task) ? 'Edit task' :'Create Task')

@section('content')
    <form method="POST" class="m-10 w-full"
                        action="{{  isset($task) 
                                    ? route('tasks.update', ['task'=>$task->id]) 
                                    : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <label for="" class="m-2">Title</label>
        <input type="text" name="title" class="input_title">
        @error('title')
            <p>{{ $message }}</p>
        @enderror
        <label for="" class="m-2">Description</label>
        <textarea name="description" class="input_description"></textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
        <label for="" class="m-2">Importance</label>
        <select id="importance" name="importance" class="border p-2 m-2 rounded block">
            <option value="0">Not sorted</option>
            <option value="1">Urgent</option>
            <option value="2">So-so urgent</option>
            <option value="2">Not urgent</option>
        </select>
        @error('importance')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit" class="btn m-2"> 
            @isset($task)
                Update Task
            @else
                Create Task
            @endisset
        </button>
    </form>
@endsection

