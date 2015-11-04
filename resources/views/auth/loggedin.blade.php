<?php
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 11/08/2015
 * Time: 13:53
 */
?>
<!-- resources/views/auth/loggedin.blade.php -->
@extends('master')
@section('header')
    <script language="JavaScript">
        mixpanel.track("Connect&eacute;");
    </script>
@stop
@section('content')

<div class="btn-success success" id="success">
    <h1>Login success.
    </h1>
    <a href="{{ route("notes") }}">Vers l'application</a>
</div>
@stop