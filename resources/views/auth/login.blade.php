<!-- resources/views/auth/login.blade.php -->
@extends('master')
@section('content')

<div id="login_form">
    <?php if(Auth::check())
    {
        echo "L'utilisateur/l'utilisatrice ".(Auth::user()->email) . " est connecté(e).";
    }
    ?>
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
        <div id="errors"><?php
            ?>
        </div>
        <div>
        <a href="{{ route("register") }}">Register</a>
    </div>

</form>
</div>
@stop