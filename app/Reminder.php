<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 21-10-15
 * Time: 01:39
 */
namespace App;

class Reminder extends \Illuminate\Database\Eloquent\Model
{
    private $table = 'reminderpwd';
    private $timestamps = true;
    private $id;
    private $username;
    private $hasBeenUsed;
    private $hache;


    function __construct__($username)
    {
        $this->hache = md5(date(time()) . "" . pi() . "Manuel Dahmen est très intelligent, beau, fort, et ... inquiet!");
        $this->username = $username;


    }

    function isValid()
    {
        if ($this->id > 0 && !$this->hasBeenUsed) {

        }
    }

    static function findByHache($hache)

    {
        return Reminder::where('hache', 'like', $hache)->get();
    }

    function getLink()
    {
        return url() . '/' . asset('password/newpassword/' . $this->hache);
    }


}