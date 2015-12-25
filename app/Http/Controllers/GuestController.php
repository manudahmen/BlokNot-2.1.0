<?php
/**
 * Created by PhpStorm.
 * User: mary
 * Date: 25-12-15
 * Time: 04:30
 */

namespace App\Http\Controllers;


use App\Guest;
use Illuminate\Support\Facades\Input;

class GuestController extends Controller

{
    function requestGuest()
    {
        new Guest(Input::all())->sendRequest();
    }


}