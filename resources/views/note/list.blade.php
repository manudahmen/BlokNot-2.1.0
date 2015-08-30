@extends('master')
@section('title', 'Note browser')

@section('sidebar')
    @parent
    @include("menu", ["noteId", $noteId])


@stop

@section('content')
<?php
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 20-08-15
 * Time: 13:42
 */


require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));

   listerNotesFromDB("%%", FALSE, $noteId, Auth::user()->email);
    ?>

    @stop
