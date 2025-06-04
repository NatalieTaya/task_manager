@extends('layouts.app')

@section('title', 'Edit Task')
@section('content')
    <form method="POST" action="{{ route('tasks.update', ['id'=>$task->id]) }}">
        @csrf
        @method('PUT')
        <label for="">Title</label>
        <input type="text" name="title" value="{{ $task->title }}">
        @error('title')
            <p>{{ $message }}</p>
        @enderror
        <label for="">Description</label>
        <textarea name="description">{{ $task->description }}</textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
        <label for="">Importance</label>
        <input type="text" name="importance"  value="{{ $task->importance }}">
        @error('importance')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">Edit task</button>
    </form>
@endsection