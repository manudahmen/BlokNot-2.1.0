<!-- resources/views/auth/login.blade.php -->
@extends('master')
@section('content')

<div id="login_form">
    <form method="POST" action="{{ route("login_form") }}">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
    <div>
        <a href="{{ route("register") }}">Register</a>
    </div>
</form>
</div>
@stop