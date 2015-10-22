@extends('master')
<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 20-10-15
 * Time: 03:30
 */
?>
@section('content')
    <form action="{{asset('password/reset') }}" method="POST" onsubmit="checkPass12();" id="pass12">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="text" name="email" value="{{ $user->getAttribute('email') }}" id="email"/>
        <input type="hidden" name="id" value="{{ $user->getAttribute('id') }}" id="userId"/>
        <input type="password" name="password1" value="" id="pass1"/>
        <input type="password" name="password2" value="" id="pass2"/>

        <div id="errors"></div>
        <input type="submit" name="sauvegarder" value="Sauvergarder"
               class="button btn btn-primary btn-success bg-success"/>
    </form>

    <script language="JavaScript">
        $("#pass12").submit(function (event) {
            // Vérifications
            var pass1 = ('#pass1').val();
            var pass2 = ('#pass2').val();

            if (("" + pass1).length >= 8 && "" + ("" + pass2).length >= 8) {
                if (pass1 != pass2) {
                    $('#errors').html("<span style='color: red;'>Les mots de passe ne correspondent pas</span>")
                }
                else {
                    ('#pass12').submit();
                }
            }
            else {
                $('#errors').html("<span style='color: red;'>Les mots de passe doivent faire au moins 8 caract&egrave;res</span>")
            }

            event.preventDefault();
        });
        function check_pass12() {

        }
    </script>
@stop