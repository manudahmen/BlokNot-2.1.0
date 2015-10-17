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
    public $LongData;
    public $username;
    public $isDirectory = 0;
    function __construct($noteId = 0)
    {
        parent::__construct();
        $this->load($noteId);
    }
    function load($noteId)
    {
        global $mysqli;
        $this->id = $this->noteId = $noteId;
        $row = getDocRow($noteId);
        if ($row != FALSE)
        {
            $this->folder_id = $row["folder_id"];
            $this->filename = $row["filename"];
            $this->content_file = $row["content_file"];
            $this->mime = $row["mime"];
            $this->username = $row["username"];

            $this->setAttribute("folder_id", $row["folder_id"]);
            $this->setAttribute("filename", $row["filename"]);
            $this->setAttribute("content_file", $row["content_file"]);
            $this->setAttribute("mime", $row["mime"]);
            $this->setAttribute("username", $row["username"]);

        } else {
            $this->id = 0;
            $this->folder_id = Auth::check() ? getRootForUser(Auth::user()->email) : 0;
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


    function initGetData()
    {
        $sql = "select content_file from bn2_filesdata where id=" . ((int)$this->id);
        $stmt = mysqli_stmt_init();
        $this->LongData = $stmt->prepare($sql);
    }

    function getDataInPieces($offset)
    {
        return mysqli_stmt_fetch($this->LongData);

        /*
         * int mysql_stmt_fetch_column(MYSQL_STMT *stmt, MYSQL_BIND *bind, unsigned int column, unsigned long offset)

Description

Fetch one column from the current result set row. bind provides the buffer where data should be placed. It should be set up the same way as for mysql_stmt_bind_result(). column indicates which column to fetch. The first column is numbered 0. offset is the offset within the data value at which to begin retrieving data. This can be used for fetching the data value in pieces. The beginning of the value is offset 0.

Return Values

Zero for success. Nonzero if an error occurred.
         */
    }

    function initSetData()
    {
        $sql = "update bn2_filesdata set content_file='?'";
        $stmt = mysqli_stmt_init();
        $this->LongData = $stmt->prepare($sql);


    }

    function setDataInPieces($data)
    {
        return ($this->LongData->send_long_data($this->LongData, 0, $data));

        /*
         * my_bool mysql_stmt_send_long_data(MYSQL_STMT *stmt, unsigned int parameter_number, const char *data, unsigned long length)

    Description

    Enables an application to send parameter data to the server in pieces (or “chunks”). Call this function after mysql_stmt_bind_param() and before mysql_stmt_execute(). It can be called multiple times to send the parts of a character or binary data value for a column, which must be one of the TEXT or BLOB data types.

    parameter_number indicates which parameter to associate the data with. Parameters are numbered beginning with 0. data is a pointer to a buffer containing data to be sent, and length indicates the number of bytes in the buffer.

    Note
    The next mysql_stmt_execute() call ignores the bind buffer for all parameters that have been used with mysql_stmt_send_long_data() since last mysql_stmt_execute() or mysql_stmt_reset().

    If you want to reset/forget the sent data, you can do it with mysql_stmt_reset(). See Section 20.6.11.21, “mysql_stmt_reset()”.

    Return Values

    Zero for success. Nonzero if an error occurred.
         */

    }
}
