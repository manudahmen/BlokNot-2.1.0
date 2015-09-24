@extends('master')
@section('title', 'Accueil -- Welcome to my apps')

@section('sidebar')
    @parent
@stop

@section('content')<h2>Notes sur l'état de l'application</h2>
<tt>

    TODO Itérer sur les éléments de getDocuments();
    TODO0) Authentification des utilisateurs.
</tt>
    <?php
    require_once(realpath(base_path("lib/bloc-notes2/all-configured-and-secured-included.php")));   ?>
@stop