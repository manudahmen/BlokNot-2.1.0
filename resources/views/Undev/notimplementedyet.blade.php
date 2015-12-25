<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 25-12-15
 * Time: 04:27
 */
?>
@extends('master')
@section('header')
    <script language="JavaScript">
        mixpanel.track("Inviter une personne", {"User": "{{  Auth::user()->email }}", "note": noteId});
    </script>
@stop

@section('title', 'Inviter une personne')

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


    ?>
    <h1>La fonctionnalité invoquée n'est pas encore démarrée au stade l'oeuf cuit jaune</h1>


@stop

