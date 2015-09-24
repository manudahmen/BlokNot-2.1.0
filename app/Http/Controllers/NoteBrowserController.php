<?php


namespace App\Http\Controllers;

require_once(realpath(base_path("lib/bloc-notes2/all-configured-and-secured-included.php")));

class NoteBrowserController extends Controller {

    public function display($noteId, $page) {
        $doc = mysqli_fetch_assoc(getDocuments());
        return view("notes/list")->with(["page" => $page]);
    }

}
?>