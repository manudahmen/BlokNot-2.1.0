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
    protected $table = 'reminderpwd';
    public $timestamps = true;
    private $id;
    private $username;
    private $hasBeenUsed;
    private $hache;

    /**
     * @param array $username
     */
    function __construct($username = NULL)
    {
        parent::__construct();
        if ($username == NULL) {
        } else {
            $this->hache = md5(date(time()) . "" . pi() . "Manuel Dahmen est très intelligent, beau, fort, et ... inquiet!");
            $this->username = $username;
            $this->setAttribute('username', $username);
            $this->setAttribute('hache', $this->hache);
            $this->save();
        }
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
        return asset('password/newpassword/' . $this->hache);
    }

    function getUserFromLink($hache)
    {

        return Reminder::where("hache", "like", $hache)->get()->username;
    }
}