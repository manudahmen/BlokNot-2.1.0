<!-- resources/views/auth/login.blade.php -->
@extends('master')
@section('content')

    <div id="login_form">
        <?php if (Auth::check()) {
            echo "Vous &ecirc; - " . (Auth::user()->email) . " -  connect&eacute;(e)s.";
        }
        ?>
        <form method="POST" action="{{ route("login_form") }}">
            {!! csrf_field() !!}
<table>
            <tr>
            <td>Email</td>
            <td><input type="email" name="email" value="{{ old('email') }}"></td>
            </tr>

            <tr>
                <td>Password</td>
                <td><input type="password" name="password" id="password"></td>
            </tr>

            <tr>
                <td>Remember Me</td>
                <td><input type="checkbox" name="remember"></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit">Login</button>
                </td>
            </tr>
            <tr>
                <td><a href="{{ route("register") }}">Register</a></td>
                <td><a href="{{ asset('email/password') }}">Oubli? Mot de passe?</td>
            </tr>
</table>
        </form>
    </div>
@stop