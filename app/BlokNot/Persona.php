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
    public $id;
    public $firstname;
    public $lastname;
    public $phonebumber;
    public $email;
    public $quota = PHP_INT_MAX;

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
}