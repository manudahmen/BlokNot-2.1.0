<?php

require_once("../../Libs/all-configured-and-secured-included.php");

namespace App\Http\Controllers;

class NoteController extends Controller {

    public function display($noteId) {
        $doc = mysqli_fetch_assoc(getDBDocument($noteId));
        return view("note/view")->with("note", $doc);
    }

    public function edit($noteId) {
        $doc = mysqli_fetch_assoc(getDBDocument($noteId));
        return view("note/edit")->with("note", $doc);
    }

    public function index() {
        return view('actionOnNote');
    }
    public function newnote()
    {
        return view("note/edit")->with("note", 0);
    }

    public function save($noteId)
    {
        
    }
    public function linkFile($noteId)
    {
        
    }
    /**
     * Envoie un fichier morceau par morceau pour éviter les 
     * limitations mémoire php ou mysql.
     * 
     * @param type $fileId 
     * @param type $dataChunk morceau du fichier
     */
    public function addData($fileId, $dataChunk)
    {
        
    }
}
?>