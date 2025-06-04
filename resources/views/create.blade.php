@extends('layouts.app')

@section('title', 'Create Task')
@section('content')
<form method="POST" action="{{ route('tasks.create') }}">
    @csrf
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
    <button type="submit">Create task</button>
</form>
@endsection
