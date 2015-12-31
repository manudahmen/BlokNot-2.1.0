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
    function requestGuest($request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique|max:255',
            'body' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        new Guest($request->all())->sendRequest();
    }


}