<!-- resources/views/guests/offer_place.blade.php -->
@extends('master')
@section('header')
@parent
<script language="JavaScript">
    mixpanel.track("Inviter une personne", {"User": "{{ Auth::user()->email }}"});
</script>
@stop

<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 25-12-15
 * Time: 04:27
 */
?>
@section('title', 'Inviter une personne')

@section('sidebar')
@parent


@stop

@section('content')

@parent

<?php
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 20-08-15
 * Time: 13:42
 */


?>
<h1>Votre email:<td><input type="text" value="{{ Auth::user()->email }}"/>
<script language="javascript">
    $( "#form_invit_1" ).submit(function( event ) {

      event.preventDefault();

    });

    function methFormInvit() {
        return false;
    }


</script>
<div class="formulaire_invitation">
    <form id="form_invit_1" class="formulaire" method="POST" action="{{ asset("guests/offer_place_submitting") }}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
        <input type="hidden" name="_method" value="POST"/>

        <table>
    <tr class="identity">
        <td><label for="lastname">Nom de famille</label></td>
       <td><input type="text" name="lastname"/>
    </td></tr>
    <tr class="identity">
        <td><label for="firstname">Prénom</label></td>
       <td><input type="text" name="firstname"/>
    </td></tr>
    <tr class="identity">
        <td><label for="email">Adresse e-mail</label></td>
        <td><input type="text" name="email"/>
    </td></tr>
    <tr class="identity">
        <td><label for="phonenumber">Numéro de téléphone</label></td>
        <td><input type="text" name="phonenumber"/>NOT AVAILABLE
    </td></tr>
    <tr class="identity">
        <td><label for="quota">requested Space or Ratio of user's space</label></td>
        <td><input type="text" name="quota"/>k kilobyte, m megabyte, g gygabyte, t terabyte
    </td></tr>
    <tr class="submit">
        <td><label for="submit">Soumettre la requête</label></td>
        <td><input type="submit" name="query_for_guest" onsubmit="return methFormInvit();"/></td>
    </tr>
        </table>
</form>
</div>



@stop

