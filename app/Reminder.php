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
    private $userId;
    private $hasBeenUsed;
    private $hache;

    /**
     * @param array $username
     */
    function __construct($userId = NULL)
    {
        parent::__construct();
        if ($userId == NULL) {
        } else {
            $this->hache = md5(date(time()) . "" . pi() . "Manuel Dahmen est très intelligent, beau, fort, et ... inquiet!");
            $this->userId = $userId;
            $this->setAttribute('user_id', $userId);
            $this->setAttribute('hache', $this->hache);
            $this->save();
        }
    }

    function isValidToken()
    {
        if (($this->getAttribute('id') > 0) and ($this->getAttribute('hasBeenUsed') == 0)) {

            return true;
        } else {
            return false;
        }
    }

    static function findByHache($hache)

    {
        return Reminder::where('hache', 'like', $hache)->get()->first();
    }

    static function findByUserId($uid)

    {
        return Reminder::where('user_id', 'like', $uid)->get();
    }

    function getLink()
    {
        return asset('password/newpassword/' . $this->hache);
    }

    function getUserFromLink($hache)
    {

        return Reminder::where("hache", "like", $hache)->get()->first();
    }
}