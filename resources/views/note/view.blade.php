@extends('master')
@section('title', 'Note viewer')

@section('sidebar')
    @parent


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

    $mime = getMimeType($noteId);
    if(strchr($mime, "image") >= 0)
    {
    ?><img src="{{ asset("file/view/".$noteId) }}"/><?php
    }
    else if(strchr($mime, "text") >= 0)
    {
    ?>{{ file_get_contents(asset("file/view/".$noteId)) }}<?php
    } else if ($mime == "directory") {
        echo "Répertoire";

    }
    ?>
@stop