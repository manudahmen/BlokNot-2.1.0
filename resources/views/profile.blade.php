<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 04-10-15
 * Time: 08:04
 */
        ?>
@extends('master)
@section('title', 'My settings')

@section('content')
    @parent
    <form action="profile/save" method="POST">
    <table>
        <tr>
            <td><label for="username">Username</label></td>
            <td><input name="username" value="{{ Auth::user()->email }}"/></td>
        </tr>
        <tr>
            <td><label for="password">Password (<a href="{{asset("change-password")}}">change</a></label></td>
            <td><input name="password" value="{{ Auth::user()->email }}"/></td>
        </tr>
        <tr><td><label for="fullname">Full Name</label></td>
        <td><input name="fullname" value="Not defined"/></td></tr>
        <tr><td><label for="rdio_username">rdio.com login</label></td>
            <td><input name="rdio_username" value="Not defined"/></td></tr>
    </table>
    </form>
    @stop
