<?php
/**
 * Created by PhpStorm.
 * User: mary
 * Date: 25-12-15
 * Time: 04:37
 */

/***
 *
 * #
 *
 * 1
 * id
 * int(11)   No None AUTO_INCREMENT Change Change  Drop Drop  Browse distinct values Browse distinct values  Show more actions More
 * 2
 * user_owner_id
 * int(11)   No None  Change Change  Drop Drop  Browse distinct values Browse distinct values  Show more actions More
 * 3
 * user_guest_id
 * int(11)   No None  Change Change  Drop Drop  Browse distinct values Browse distinct values  Show more actions More
 * 4
 * confirmed_email
 */
namespace App\BlokNot;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class Guest extends Model
{

    public $incrementing = true;
    public $table = "guests";
    public $primaryKey = 'id';
    public $timestamps = true;
    public $id;
    public $user_owner_id;
    public $user_guest_id;
    public $confirmed_email_guest_ref;

    public $fillable = ["id",
        "user_owner_id",
        "user_guest_id",
        "confirmed_email_guest_ref"
    ];

    public function __construct($email, $persona)
    {
        $this->persona = $persona;
        if (($user = User::where("email", $email)->get()->first()) != null) {
            $this->user_guest_id = $user->id;
            $this->getInvitationFor();
        } else {
            $this->getInvitationFor();
        }
    }


    public function getInvitationFor($persona = null)
    {
        if (!isset($persona)) {
        $firstname = Input::get("firstname");
        $lastname = Input::get("lastname");
        $phonenumber = Input::get("phonenumber");
        $email = Input::get("email");

        $persona = new Persona(["firstname"=>$firstname, "lastname"=>$lastname, "phonenumber"=>$phonenumber, "email"=>$email]);
        }


        $persona->loadsIfExists();
        $persona->save();


        global $data;

        $data = ["guestPersona" => $persona, "hostId" => Auth::user()->email];

        Mail::send("emails/invite_persona", $data, function (\Illuminate\Mail\Message $message) {
            global $data;
            /* "Required" (It's self explaining ;)) */
            $message->to($data["guestPersona"]["email"],
                $data["guestPersona"]["firstname"] . " " .
                $data["guestPersona"]["lastname"]
            );

            /* Optional */
            $message->from(Auth::user()->email, 'ibiteria User');
            $message->sender('no-reply@ibiteria.com', 'Ibiteria Company');
            $message->replyTo('noreply@ibiteria.com');
            $message->subject('Invitation to your workspace');
        });
    }
}