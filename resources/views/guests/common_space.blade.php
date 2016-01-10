<?php
/**
 * Created by PhpStorm.
 * User: Win
 * Date: 10-01-16
 * Time: 15:03
 */
?>
<p><input type="checkbox" name="autocopy"/>Copie automatique vers mes fichiers et protection</p>
<h2>Liste des fichiers partagés avec {{ $guest->hasOne('user')->hasOne('persona') }}</h2>

<h2>Partager des fichiers avec</h2>
<p><a href="{{ asset("guests/offer_place")  }}">Quelqu'un</a></p>

<?php $browser->show(); ?>