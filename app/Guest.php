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
namespace App\BlocNotes;


use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

    public $incrementing = true;
    protected $table = "guests";
    protected $primaryKey = 'id';
    protected $timestamps = true;
    private $id;
    private $user_owner_id;
    private $user_guest_id;
    private $confirmed_email;

    private $fillable = ["id",
        "user_owner_id",
        "user_guest_id",
        "confirmed_email"
    ];
}