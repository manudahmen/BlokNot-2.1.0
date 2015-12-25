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
    mixpanel.track("Inviter une personne", {"User": "{{  Auth::user()->email }}", "note" : noteId });
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
<h1>Votre email: <input type="text" value="<?php echo Aht:user->email(); ?>" >
<script language=javascript>
    $( "#form_invit_1" ).submit(function( event ) {

      event.preventDefault();

    });


</script>
<div class="formulaire_invitation">
<form id="form_invit_1" class="formulaire" onsubmit="validate()">
    <fieldset class="identity">
        <label for="lastname"/>
        <input type="text" name="lastname"/>
    </fieldset>
    <fieldset class="identity">
        <label for="firstname"/>
        <input type="text" name="firstname"/>
    </fieldset>
    <fieldset class="identity">
        <label for="email"/>
            <input type="text name="email"/>
    </fieldset>
    <fieldset class="identity">
        <label for="phonenumber"/>
        <input type="text name="phonenumber"/>NOT AVAILABLE
    </fieldset>
    <fieldset class="identity">
        <label for="Quota"/>
        <input type="text name="phonenumber"/>k kilobyte, m megabyte, g gygabyte, t terabyte
    </fieldset>

</form>
</div>



@stop

