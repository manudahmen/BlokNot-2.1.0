<?php

namespace App\Http\Controllers;


Class FileSystemController extends Controller
{
    private $rootPath = "datafiles";
    private $user_id;

    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    /**methods:
     * En cas d'upload
     */
    public function postAddFile($filename, $folderId, $mime, $tempFile = null, $forceContentToDatabase = FALSE)
    {

    }

    public function postAddFolder($filename, /* $mime='directory', isDirectory*/
                                  $folderId)
    {

    }

    public function postCreateRoot($filename)
    {

    }

    /**
     * En cas d'utilisation du navigation Verify qu'on ne déplace ou copie le fichier /
     * A priority: move, copy: on move de db à db et de fs à fs.
     *
     * /**
     * //getId(???)
     * copy($fileOrDirectory_id, $directory_id)
     * move($fileOrDirectory_id, $directory_id)
     * /*
     * Actions multi-users
     **/

    public function getCopy($fileOrDirectory_id, $directory_id)
    {

    }

    public function getMove($fileOrDirectory_id, $directory_id)
    {

    }
    public function postCopyTo($fileOrDirectory_id, $user_id)
    {

    }

    public function postDelete($fileOrDirectory_id)
    {

    }
}
