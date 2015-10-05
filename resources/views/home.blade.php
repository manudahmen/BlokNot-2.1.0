@extends('master')
@section('title', 'Accueil mon BLOC NOTES')

@section('sidebar')
    @parent


@stop

@section('content')
<h1>Applications mon bloc-notes</h1>
   <ul>
       <li><a class="btn btn-large btn-primary openbutton app" href="{{URL::to("note/list/0/1")}}">Bloc-notes,
               gestionnaire de fichiers en ligne</a></li>
       <li><a class="btn btn-large btn-primary openbutton app" href="{{route("freezer") }}">Freezer</a></li>
   </ul>
@stop