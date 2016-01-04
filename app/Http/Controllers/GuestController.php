<?php
/**
 * Created by PhpStorm.
 * User: mary
 * Date: 25-12-15
 * Time: 04:30
 */

namespace App\Http\Controllers;


use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GuestController extends Controller

{
    public function __construct()
    {
    }

    public function postGuest(Request $request)
    {
        $guest = new Guest($request->input("firstname"),
            $request->input("lastname"),
            $request->input("email"),
            $request->input("phonenumber"),
            $request->input("quota"));
        $guest->getInvitationFrom(Auth::user()->email);
    }


}