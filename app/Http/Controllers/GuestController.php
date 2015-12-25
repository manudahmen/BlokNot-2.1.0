<?php
/**
 * Created by PhpStorm.
 * User: mary
 * Date: 25-12-15
 * Time: 04:30
 */

namespace App\Http\Controllers;


use App\BlokNot\Guest;

class GuestController extends Controller

{
    function requestGuest()
    {
        print_r(new Guest(Input::all()));
    }


}