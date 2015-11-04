<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

require_once(realpath(base_path("main_functions.php")));

class NoteController extends Controller
{

    function display($noteId)
    {
        $doc = mysqli_fetch_assoc(getDocRow($noteId));
        return view("note/view")->with("note", $doc);
    }

    function edit($noteId)
    {
        $doc = mysqli_fetch_assoc(getDocRow($noteId));
        return view("note/edit")->with("noteId", $doc);
    }

    function index()
    {
        return view('actionOnNote');
    }

    function newnote()
    {
        return view("note/new/0")->with("noteId", 0);
    }

    function postSaveTxt(Request $request)
    {
        $note = Note::findOrNew($request->get("noteId"));

        $note->load($request->get("noteId"));

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

        $note->save();
        echo "<p> Note saved</p>";


        return Redirect::to('note/edit/' . $note->id)->with(["Message" => "Sauvegardé"]);
    }

    function saveImg(Request $request)
    {
        $note = Note::findOrNew($request->get("noteId"));

        $note->load($request->get("noteId"));

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

        $note->load($request->get("noteId"));

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

    function uploadOnce(Request $request, $folderId)
    {
        $text = "<h1>Result</h1>";


        var_dump(Input::all());

        $data = Input::all();
        $file = $data['file'];


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

            $text .= "<a href='" . asset("note/view/" . $note->getAttribute("id")) . "'>" . $note->getAttribute("filename") . "</a> (saved)<br/>";

        }

        return "<h2>Notes saved and uploaded</h2>" . $text;
    }

    function uploadMultiple(Request $request, $folderId)
    {


        $data = Input::all();

        $filesystem = Input::get('filesystem') != "";
        $files = $data['file'];

        $text = array("count" => sizeof($data["file"]));

        foreach ($files as $file) {
            if ($file->isValid()) {
                $note = Note::findOrNew(0);
                $note->save();

                $mime = $file->getClientMimeType();
                $filename = $file->getClientOriginalName();


                $dstName = "FICHIER.DAT" . rawurlencode(Auth::user()->email . "/" . $folderId + "/" . $note->getAttribute('id'));

                $fullPath = base_path('') . "/datafiles/$folderId/";

                $totalName = $fullPath . "/" . $dstName;

                $file->move($fullPath, $dstName);

                if (!Input::get("filesystem")) {
                    $content_file = file_get_contents($totalName);
                    $note->setAttribute("content_file", $content_file);
                    unlink($totalName);

                } else {
                    $note->setAttribute("filename_on_disk", $dstName);
                }

                $note->setAttribute("mime", $mime);
                $note->setAttribute("username", Auth::user()->email);
                $note->setAttribute("filename", $filename);
                $note->setAttribute("folder_id", $folderId);

                $note->save();

                $text["notes"][$note->getAttribute('id')] = $note->toArray();
                $text["urls"][$note->getAttribute('id')] = asset("note/view/" . $note->getAttribute("id"));


            }
        }


        return $text;
    }

    function delete(Request $request, $noteId)
    {
        echo "NoteId : " . $noteId . "<br/>";


        $note = Note::findOrFail($noteId);

        $note->load($noteId);

        //$note->delete();

        deleteDBDoc($noteId);

        echo "<p> Note deleted</p>";


        return Redirect::to('note/list/' . $note->folder_id . '/1');
    }

    function createFolder($folderId)
    {
        if ($folderId <= 0) {
            $folderId = Input::get("folder_id");
            if ($folderId <= 0) {
                $folderId = getRootForUser(Auth::user()->email);
            }
        }
        $note = Note::findOrNew(0);
        $note->setAttribute("filename", Input::get("folderName"));
        $note->setAttribute("folder_id", $folderId);
        $note->setAttribute("mime", "directory");
        $note->setAttribute("isDirectory", "1");
        $note->setAttribute("username", Auth::user()->email);

        $note->save();

        return Redirect::to(asset("note/list/" . $note->getAttribute('id') . "/1"));


    }

    function search(Request $request)
    {
        $expression = Input::get('search');
        $dbresult = NULL;


        $dbresult = search($expression, NULL, Auth::user()->email, NULL);

        echo $dbresult == NULL;
        $data = array();
        if ($dbresult != NULL) {
            while (($row = mysqli_fetch_assoc($dbresult)) != NULL) {
                $data[$row['id']] = $row;
            }
        }
        print_r($data);
        return $data;

    }
}

?>