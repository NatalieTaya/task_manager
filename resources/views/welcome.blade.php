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
                        action="{{ route('login') }}">
        @csrf
        <label for="" class="m-2">Username</label>
        <input type="text" name="username" class="input_title">
        @error('username')
            <p>{{ $message }}</p>
        @enderror
        <label for="" class="m-2">Password</label>
        <input type="text" name="password" class="input_title">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit" class="btn m-2"> 
            Enter
        </button>
    </form>
    <div class="m-10 w-full ">
        <a href="{{ route('register') }}" class="btn m-2">
            Register
        </a>
    </div>
@endsection

@section('footer')
    <div class="footer">
    </div>
@endsection