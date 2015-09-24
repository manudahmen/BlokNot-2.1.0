<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'filesdata';
    public $noteId;
    public $folder_id ;
    public $filename;
    public $content_file;
    public $mime;

    function __construct()
    {
    }
    function load($noteId)
    {
        global $mysqli;
        $this->id = $this->noteId = $noteId;
        $res = getDocRow($noteId);
        if(($res!=NULL) && (($row=mysqli_fetch_assoc($res))!=NULL))
        {
            $this->folder_id = $row["folder_id"];
            $this->filename = $row["filename"];
            $this->content_file = $row["content_file"];
            $this->mime = $row["mime"];

            $this->setAttribute("folder_id", $row["folder_id"]);
            $this->setAttribute("filename", $row["filename"]);
            $this->setAttribute("content_file", $row["content_file"]);
            $this->setAttribute("mime", $row["mime"]);

        } else {
            $this->id = 0;
            $this->folder_id = getRootForUser(Auth::user()->email);
            $this->filename = "Nouveau fichier";
            $this->content_file = "Nouvelle note";
            $this->mime = "text/plain";

            $this->setAttribute('id', 0);
            $this->setAttribute("folder_id", $this->folder_id);
            $this->setAttribute("filename", $this->filename);
            $this->setAttribute("content_file", $this->content_file);
            $this->setAttribute("mime", $this->mime);

        }

    }

}
