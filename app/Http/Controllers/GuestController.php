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
        $this->request = Input::all();
        print_r($this->request);
    }

    public function postGuest()
    {
        $request = $this->request;

        $guest = new Guest($request);
        $guest->sendRequest($request);
    }


}