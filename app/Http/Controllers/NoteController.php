<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

require_once(realpath(base_path("public/lib/bloc-notes/all-configured-and-secured-included.php")));

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

        print_r($note);

        $note->save();

        return "Save note txt(TODO)";

    }

    function saveImg()
    {
        $note = Note::findOrNew($request->get("noteId"));

        $note->setAttribute("id", $request->get("noteId"));
        $note->setAttribute("folder_id", $request->get("folder_id"));
        $note->setAttribute("filename", $request->get("filename"));
        $note->setAttribute("username", Auth::user()->email);

        $note->save();

        return "Save note img(TODO)";
    }

    function saveOther()
    {
        $note = Note::findOrNew($request->get("noteId"));

        $note->setAttribute("id", $request->get("noteId"));
        $note->setAttribute("folder_id", $request->get("folder_id"));
        $note->setAttribute("filename", $request->get("filename"));
        $note->setAttribute("username", Auth::user()->email);

        $note->save();

        return "Save note else types (no txt, no img) (TODO)";
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

    function upload(Request $request)
    {
        $files = $request->file('file');
        foreach ($files as $file) {
            if ($file->isValid()) {
            }
            $mime = $file->getClientMimeType();
            $filename = $file->getClientOriginalName();

            $dstName ="FICHIER.DAT".rawurlencode(Auth::user()->email);

            $fullPath = __DIR__."datafiles/";

            $totalName  = $fullPath . "/" . $dstName;

            $file->move($fullPath, $dstName);

            $content_file = file_get_contents($totalName);


            $note = Note::findOrNew(0);
            $note->setAttribute("mime", $mime);
            $note->setAttribute("username", Auth::user()->email);
            $note->setAttribute("content_file", $content_file);
            $note->setAttribute("filename", $filename);
            $note->setAttribute("folder_id", $request->get("folder_id"));

            $note->save();

            print_r($note);


            return "Note saved and uploaded";
        }
    }
}

?>