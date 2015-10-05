<?php

namespace App\BlocNotes;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    private $table = "share";
    private $timestamps = true;

    private $id;
    private $noteId;
    private $user;
    private $public = false;

    public function __construct__($shareId, $noteId, $username, $public = false)
    {
        $this->id = $shareId;
        $this->noteId = $noteId;
        $this->username = $username;
        $this->public = $public;
        if($shareId!=NULL && $shareId!=0
        )
        {
            $this->load($shareId);
        }

    }

    public function load($shareId)
    {
        $this->setAttribute('id', $this->id = $shareId);
        $row = getShareRow($shareId);
        if ($row != FALSE)
        {
            $this->noteId = $row["note_id"];
            $this->username = $row["username"];
            $this->public = $row["public"];

            $this->setAttribute("note_id", $row["note_id"]);
            $this->setAttribute("username", $row["username"]);
            $this->setAttribute("public", $row["public"]);

        } else {
            $this->id = 0;
        }
    }




}
