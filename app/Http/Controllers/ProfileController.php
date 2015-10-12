<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 12-10-15
 * Time: 13:01
 */

namespace App\Http\Controllers;


class ProfileController extends Controller
{
    public function save(Request $request)
    {

        $currentPassword = Input::get('email');
        $newPassword = Input::get('password');
        $newPasswordCoofirm = Input::get('password2');
        $username = Input::get('email');
        $fullName = Input::get('fullname');

        $user = Auth()::user();

        //if (Hash::check(Auth::user()->password, Hash::make(Input::get('currentPassword2'))))
        //{
        // The passwords match...
        if (Auth::attempt(array('email' => $username, 'password' => $currentPassword))) {

            $user = Auth::user();

            echo "Non enregistréé!!";
        }
    }
}
