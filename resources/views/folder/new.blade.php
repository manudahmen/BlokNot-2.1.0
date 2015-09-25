<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 25-09-15
 * Time: 19:01
 */

?>
@extends("master"))

@section('header')
    @parent
@stop

@section("content")
    <form action="{{ asset("folder/create/$folderId") }}" method="POST">
        <input type="text" name="folderName" value="Nouveau dossier"/>
        <input type="hidden" name="folder_id" value="{{ $folderId }}"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        {!! method_field('POST') !!}
        <input type="submit" value="Cr&eacute;er dossier"/>
    </form>
@stop