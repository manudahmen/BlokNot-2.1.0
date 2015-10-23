<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

Class FileSystemController extends Controller
{
    private $rootPath = "datafiles";
    private $user_id;

    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    /**méthodes:
     * En cas d'upload
     */
    public function postAddFile($filename, $mime, $tempFile, $folderId, $forceContentToDatabase = FALSE)
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
     * En cas d'utilisation du navigateur Vérifier qu'on ne déplace ou copie le fichier /
     * A priori: move, copy: on déplace de db à db et de fs à fs.
     *
     * /**
     * //getId(???)
     * copy($fileOrDirectory_id, $directory_id)
     * move($fileOrDirectory_id, $directory_id)
     * /*
     * Actions multi-utilisateurs
     **/
    public function postCopyTo($fileOrDirectory_id, $user_id)
    {

    }

    public function postDelete($fileOrDirectory_id)
    {

    }
}