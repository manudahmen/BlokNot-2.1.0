<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 30-08-15
 * Time: 12:05
 */

namespace App\Http\Controllers;
use App\Note;


/**
 * Class ExtraRegisterOperations
 * @package App\Http\Controllers
 *
 * App specific . For register user operation.
 */
class ExtraRegisterOperations
{
    public function createRootFolder()
    {
        $note = new Note();
        $note->setAttribute("filename", "Dossier racine");
        $note->setAttribute("folder_id", 0);
        $note->setAttribute("mime", "directory");
        $note->setAttribute("isFolder", 1);

        $note->save();


    }
}