<?php

namespace App\BlokNot;


Class FileSystem
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
    public function addFile($filename, $mime, $tempFile, $folderId, $forceContentToDatabase = FALSE)
    {

    }

    public function addFolder($filename, /* $mime='directory', isDirectory*/
                              $folderId)
    {

    }

    public function createRoot($filename)
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
    public function copyTo($fileOrDirectory_id, $user_id)
    {

    }

    public function delete($fileOrDirectory_id)
    {

    }
}