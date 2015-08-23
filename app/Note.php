<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
class Note extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
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
        $this->id = $this->noteId = $noteId;
        $res = getDBDocument($noteId);
        if(($res!=NULL) && (($row=mysqli_fetch_assoc($res))!=NULL))
        {
            $this->folder_id = $row["folder_id"];
            $this->filename = $row["filename"];
            $this->content_file = $row["content_file"];
            $this->mime = $row["mime"];

        }

    }

}
