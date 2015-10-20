@extends('master')
<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 20-10-15
 * Time: 03:30
 */
?>
@section('content')
    <form action="{{asset("password/reset') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" id="note_id" name="note_id" value="{{$joint->note_id}}">
        <input type="password" name="password1" value=""/>
        <input type="password" name="password2" value=""/>
        <input type="submit" name="sauvegarder" value="Sauvergarder"
               class="button btn btn-primary btn-success bg-success"/>
    </form>
@stop