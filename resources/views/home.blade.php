@extends('master')
@section('title', 'Accueil -- Welcome to my apps')

@section('sidebar')
    @parent


@stop

@section('content')
<h1>Applications</h1>
   <ul>
       <li><a class="btn btn-large btn-primary openbutton" href="{{URL::to("note/list/0/1")}}">Bloc-notes, gestionnaire de fichiers en ligne</a></li>
       <li><a class="btn btn-large btn-primary openbutton" href="{{route("freezer") }}">Freezer</a></li>
   </ul>
@stop