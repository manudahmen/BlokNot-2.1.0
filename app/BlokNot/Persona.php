<?php
/**
 * Created by PhpStorm.
 * User: Win
 * Date: 04-01-16
 * Time: 16:12
 */

namespace App\BlokNot;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model


{
    public $incrementing = true;
    public $table = "persona";
    public $primaryKey = 'id';
    public $timestamps = true;
    /* protected $id;
     protected $firstname;
     protected $lastname;
     protected $phonenumber;
     protected $email;
     protected $quota = PHP_INT_MAX;
 */
    public $fillable = ["id", "firstname", "lastname", "phonenumber", "email", "quota"
    ];

    public function __construct($dataArray)
    {
        $this->firstname = $dataArray["firstname"];
        $this->lastname = $dataArray["lastname"];
        $this->phonenumber = $dataArray["phonenumber"];
        $this->email = $dataArray["email"];
        if (isset($dataArray["quota"])) {
            $this->quota = $dataArray["quota"];
        }
    }

    public function loadsIfExists()
    {
        // Checking email unique and if present from user, load ??? user
        // Checking phone number is the same or exception "User unknown (from you! :-)"

    }
}