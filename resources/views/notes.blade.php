@extends('master')
@section('title', 'Accueil -- Welcome to my apps')

@section('sidebar')
    @parent

    <p><a href="{{ url("auth/login") }}">Page de login</a>
</p>
@stop

@section('content')<h2>Notes sur l'état de l'application</h2>
<tt>

    TODO Itérer sur les éléments de getDocuments();
    TODO0) Authentification des utilisateurs.
</tt>
    <?php
    require_once(realpath(base_path("public/lib/bloc-notes/all-configured-and-secured-included.php")));   ?>
@stop