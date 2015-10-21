<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Reminder;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postReset()
    {
        $password = Input::only('pass1');
        $user = Input::only('email');

            $user->password = Hash::make($password);

            $user->save();

            $reminder = Reminder::findByUserId($user->id)->get()->first();
            $reminder->setAttribute('hasBeenUsed', 1);
        });

    }
}
