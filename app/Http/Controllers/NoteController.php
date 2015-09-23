<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

require_once(realpath(base_path("lib/bloc-notes/all-configured-and-secured-included.php")));

class NoteController extends Controller
{

    function display($noteId)
    {
        $doc = mysqli_fetch_assoc(getDBDocument($noteId));
        return view("note/view")->with("note", $doc);
    }

    function edit($noteId)
    {
        $doc = mysqli_fetch_assoc(getDBDocument($noteId));
        return view("note/edit")->with("note", $doc);
    }

    function index()
    {
        return view('actionOnNote');
    }

    function newnote()
    {
        return view("note/edit")->with("note", 0);
    }

    function saveTxt(Request $request)
    {
        $note = Note::findOrNew($request->get("noteId"));

        $note->setAttribute("id", $request->get("noteId"));
        $note->setAttribute("folder_id", $request->get("folder_id"));
        $note->setAttribute("filename", $request->get("filename"));
        $note->setAttribute("username", Auth::user()->email);
        $note->setAttribute("content_file", $request->get("content_file"));
        $note->setAttribute("mime", $request->get("mime"));
        $note->fillable(["id" => $note->noteId,
            "folder_id" => $note->folder_id,
            "filename" => $note->filename,
            "content_file" => $note->content_file,
            "mime" => $note->mime
        ]);

        //print_r($note);

        $note->save();
        echo "<p> Note saved</p>";


        return Redirect::to('note/edit/' . $note->id)->with(["Message" => "Sauvegardé"]);
    }

    function saveImg(Request $request)
    {
        $note = Note::findOrNew($request->get("noteId"));

        $note->setAttribute("id", $request->get("noteId"));
        $note->setAttribute("folder_id", $request->get("folder_id"));
        $note->setAttribute("filename", $request->get("filename"));
        $note->setAttribute("username", Auth::user()->email);

        $note->save();


        return Redirect::to('note/edit/' . $note->id)->with(["Message" => "Sauvegardé"]);

    }

    function saveOther(Request $request)
    {
        $note = Note::findOrNew($request->get("noteId"));

        $note->setAttribute("id", $request->get("noteId"));
        $note->setAttribute("folder_id", $request->get("folder_id"));
        $note->setAttribute("filename", $request->get("filename"));
        $note->setAttribute("username", Auth::user()->email);

        $note->save();

        return Redirect::to('note/edit/' . $note->id)->with(["Message" => "Sauvegardé"]);
    }

    function linkFile($noteId)
    {

    }

    /**
     * Envoie un fichier morceau par morceau pour éviter les
     * limitations mémoire php ou mysql.
     *
     * @param type $fileId
     * @param type $dataChunk morceau du fichier
     */
    function addData($fileId, $dataChunk)
    {

    }

    function upload($folderId)
    {
        $text = "<h1>Result</h1>";

        $files = Input::file('file');
        foreach ($files as $file) {
            if ($file->isValid()) {
                $mime = $file->getClientMimeType();
                $filename = $file->getClientOriginalName();

                $dstName = "FICHIER.DAT" . rawurlencode(Auth::user()->email);

                $fullPath = __DIR__ . "datafiles/";

                $totalName = $fullPath . "/" . $dstName;

                $file->move($fullPath, $dstName);

                $content_file = file_get_contents($totalName);


                $note = Note::findOrNew(0);
                $note->setAttribute("mime", $mime);
                $note->setAttribute("username", Auth::user()->email);
                $note->setAttribute("content_file", $content_file);
                $note->setAttribute("filename", $filename);
                $note->setAttribute("folder_id", $folderId);

                $note->save();


                unlink($totalName);

                $text .= $note->getAttribute("filename") . " (saved)<br/>";

            }

        }
        return "<h2>Notes saved and uploaded</h2>" . $text;
    }

    function delete(Request $request, $noteId)
    {
        echo "NoteId : " . $noteId . "<br/>";


        $note = Note::findOrFail($noteId);


        $note->delete();

        echo "<p> Note deleted</p>";


        return Redirect::to('note/list/0/1');
    }


}

?>