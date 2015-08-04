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
}
?>