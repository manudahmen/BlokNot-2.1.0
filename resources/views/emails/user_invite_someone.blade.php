<p>Hello {{ $guest->lastname . ' ' . $guest->firsthame }}, and welcome to Ibiteria, social network <i>in herbs</i></p>

<p>Quelqu'un {{ Auth::user()->email }} vous a invité à collaborer, ou partager avec lui des documents.</p>

<p>Voulez-vous accéder à cette demande en cliquant sur le lien pré-validé ci-dessous?</p>

<p>Ou décliner l'offre (ignorer ce message)</p>

<p><a href="{{ asset("guests/invite_ok?action=approve") }}">Approuver</a></p>
<p><a href="{{ asset("guests/invite_ok?action=decline") }}">Décliner</a></p>
<p><a href="{{ asset("guests/invite_ok?action=review") }}">Revoir</a></p>

<?php
/**
 * Created by PhpStorm.
 * User: mary
 * Date: 25-12-15
 * Time: 21:49
 */