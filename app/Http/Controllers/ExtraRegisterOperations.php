<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 30-08-15
 * Time: 12:05
 */

namespace App\Http\Controllers;
use App\Note;


/**
 * Class ExtraRegisterOperations
 * @package App\Http\Controllers
 *
 * App specific . For register user operation.
 */
class ExtraRegisterOperations
{
    public static function createRootFolder($email)
    {
        $note = new Note();
        $note->setAttribute("username", $email);
        $note->setAttribute("filename", "Dossier racine");
        $note->setAttribute("folder_id", 0);
        $note->setAttribute("mime", "directory");
        $note->setAttribute("isFolder", 1);
        $note->setAttribute("isRoot", 1);

        $note->save();


    }

    public static function sendRegisteredUserEmail($email)
    {
        Mail::send('emails.welcome', ['email' => $email, 'password' => Auth::user()->password], function ($message) {
            $email = Auth::user()->email;
            $message->to($email, $email, $message)->subject("Welcome $email!");
        });
    }
}