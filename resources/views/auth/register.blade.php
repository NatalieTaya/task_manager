@extends('layouts.welcome')

@section('header')
    <div class="header">
    </div>
@endsection

@section('main_head')
        <div class="main_head">Hi!   <br> 
            Enter your login and password
        </div>
@endsection

@section('content')
    <form method="POST" class="m-10 w-full "
                        action="{{ route('register') }}">
        @csrf
        <label for="" class="m-2">Name</label>
        <input type="text" name="name" class="input_title">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        <label for="" class="m-2">Username</label>
        <input type="text" name="username" class="input_title">
        @error('username')
            <p>{{ $message }}</p>
        @enderror
        <label for="" class="m-2">Email</label>
        <input type="text" name="email" class="input_title">
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        <label for="" class="m-2">Password</label>
        <input type="text" name="password" class="input_title">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <label for="" class="m-2">Confirm password</label>
        <input type="text" name="password_confirmation" class="input_title">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit" class="btn m-2"> 
            Register
        </button>
    </form>
@endsection

@section('footer')
    <div class="footer">
    </div>
@endsection