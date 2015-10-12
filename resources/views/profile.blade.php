<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 04-10-15
 * Time: 08:04
 */
?>
@extends('master')
@section('title', 'My settings')

@section('content')
    <h2>Editer les informations de profil</h2>
    @parent
    <form action="{{asset('profile/save')}}" method="POST">
    <table>
        <tr>
            <td><label for=currentPassword2">Entrez &agrave; nouveau votre mot de passe pour modifier</label></td>
            <td><input class="required"name="currentPassword2" value=""/></td>
        </tr>
        <tr>
            <td><label for="username">Nom d'utilisateur</label></td>
            <td><input name="username" value="{{ Auth::user()->email }}"/></td>
        </tr>0
        <tr>
            <td><label for="password">Mot de passe</label></td>
            <td><input name="password" value=""/></td>
        </tr>
        <tr>
            <td><label for="password2">Mot de passe</label></td>
            <td><input name="password2" value=""/></td>
        </tr>
        <tr><td><label for="fullname">Nom complet</label></td>
        <td><input name="fullname" value="Not defined"/></td></tr>
        <tr><td><label for="rdio_username">rdio.com login</label></td>
            <td><input name="rdio_username" value="Not defined"/></td></tr>
        <tr>
            <td>Enregistrer</td>
            <td><input type="submit" name="Envoyer" class="btn-large btn-primary openbutton"/></td>
        </tr>
    </table>
    </form>
    @stop
