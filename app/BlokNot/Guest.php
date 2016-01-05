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

class Guest extends Model
{

    public $incrementing = true;
    public $table = "guests";
    public $primaryKey = 'id';
    public $timestamps = true;
    //public $id;
    //public $user_owner_id;
    //public $user_guest_id;
    //public $confirmed_email_guest_ref;
    protected $guarded = array('id', 'persona');
    protected $fillable = ["id",
        "user_owner_id",
        "user_guest_id",
        "confirmed_email_guest_ref"
    ];

    public function __construct($email, $persona, $state)
    {


        $this->user_owner_id = Auth::user()->email;
        if (($user = User::where("email", $email)->get()->first()) != null) {
            $this->user_guest_id = $user->id;
        } else {
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

        $mail = \Illuminate\Support\Facades\View::make("emails/invite_persona", $data);

        if (mail($data["guestPersona"]["email"], "Invitation from", $mail)) {
            $message_err = "OK";
            $ret = true;

        } else {
            $message_err = "Erreur lors de l'envoi du mail";
            $ret = false;
        }

        echo $message_err;
        return $ret;
    }
}