@extends('master')
@section('content')
    <form action="{{asset('email/reset') }}" method="POST">
        <label for="email">Email de connexion:</label>
    <input type="email" name="email" value=""/>
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="submit" name="sauvegarder" value="Envoyer un mail de &eacute;cup&eacute;ration"
               class="button btn btn-primary btn-success bg-success"/>
</form>
@stop

