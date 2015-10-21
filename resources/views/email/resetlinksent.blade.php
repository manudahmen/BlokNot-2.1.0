<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 21-10-15
 * Time: 04:27
 */?>
@extends('master')
@section('title','Pouvoir changer son mot de passe')

@section('sidebar')
    @parent


@stop
@section("content")
    @parent
    <script language="JavaScript">
        mixpanel.track("Demande de nouveau mot de passe");
    </script>
    @
    <?php
    if($msg_res == true)
    {
?>
    <div class="specialActionsContainer">
        <p>Le mail a été envoyé à
    <button class="btn-success">{{ $email }}</button>
</p>
<p>V&eacute;rifier votre bo&icirc;te mail...</p>
<p style="background-color: gray; color: {{ $msg_res==true?"green":"red" }}; padding: 20pt;">
    <?php } ?>
    Erreur? {{ $msg_res==true?"OK":"Une ERREUR s'est produite lors de l'envoi du mail" }}</p>
    </div>

@stop