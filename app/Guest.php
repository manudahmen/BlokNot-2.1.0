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
namespace App;


use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

    public $incrementing = true;
    public $table = "guests";
    public $primaryKey = 'id';
    public $timestamps = true;
    public $id;
    public $user_owner_id;
    public $user_guest_id;
    public $confirmed_email;

    public $fillable = ["id",
        "user_owner_id",
        "user_guest_id",
        "confirmed_email"
    ];

    public function __construct($input)
    {
    }

    public function sendRequest()
    {

        $userGuest = User::findOrFail($input::get("email"));
        $user_owner_id = Auth::user()->email;
        $user_guest_id = $userGuest->getAttr("id");

        $confirmedEmail = $userGuest->email;
    }
}