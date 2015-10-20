@extends('master')
<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 20-10-15
 * Time: 03:47
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 20-10-15
 * Time: 03:30
 */
?>
@section('content')
@show
<form action="{{asset("password/reset') }}" method="POST">
    <input type="email" name="email" value=""/>
    <input type="submit" name="sauvegarder" value="Sauvergarder" class="button btn btn-primary btn-success bg-success"/>
</form>
@end