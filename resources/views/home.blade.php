@extends('master')
@section('title', 'Accueil -- Welcome to my apps')

@section('sidebar')
    @parent


@stop

@section('content')
<h1>Applications</h1>
   <ul>
       <li><a href="{{route("notes")}}">Bloc-notes, gestionnaire de fichiers en ligne</a></li>
       <li><a href="{{route("freezer") }}">Freezer</a></li>
   </ul>
@stop<div>
</div>