<?php

require_once(realpath(base_path("main_functions.php")));

App::bind('path.public', function () {
    return base_path() . '/';
});

Route::get('profile', ["middleware" => "auth", "uses" => function ()
{

    return view("profile");
}]);

Route::controller('filesystem', 'FileSystemController');
Route::get('profile/save', ["middleware" => "auth", "uses" => 'ProfileController@save']);

Route::get('auth/login', ["as" => "login_form", "uses" => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::post('post_images', function () {
    require_once("<../app_tinymce_file_acceptor.php");
});



// Registration routes...
Route::get('auth/register', ["as" => "register", "uses" => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'register_submit', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('radio', ['middleware' => "auth", "uses" => function () {
    return view('radio.index');
}]);

Route::get("note/view/{noteId}", [
    'middleware' => "auth",
    "uses" => function ($noteId) {
        return View::make('note/view', ["noteId" => $noteId]);
    }])->where('noteId', '[0-9]+');


Route::get('note/edit/{noteId}', ['middleware' => "auth", "uses" => function ($noteId) {
    return view('note/edit', ["noteId" => $noteId]);
}])->where('id', '[0-9]+');
Route::get('note/joint/new/{noteId}', ['middleware' => "auth", "uses" => function ($noteId) {
    return view('note/joint/new', ["noteId" => $noteId]);
}])->where('id', '[0-9]+');
Route::get('note/new/{folderId}', ['middleware' => "auth",
    "uses" => function ($folderId) {
        return view('note/new', ["folderId" => $folderId]);
    }])->where('id', '[0-9]+');

Route::post("note/save/txt/{noteId}", [
        'middleware' => "auth",
        'uses' => "NoteController@postSaveTxt",
        "before", "csrf"
    ]
);
Route::post("note/media", [
        'middleware' => "auth",
        'uses' => "NoteController@addMedia"
    ]
);

Route::post("note/addData", [
        'middleware' => "auth",
        'uses' => "NoteController@addData"
    ]
);

Route::get("/", ["as" => "root", "uses" => function () {
        return view("home");
    }
    ]
);
Route::get("about", function () {
    return view("about");
});
Route::get("apropos", function () {
    return view("about");
});

Route::get("home", function () {

    return view("home");
});

Route::get("freezer", ["as" => "freezer", "uses" => function () {
    return View::make("freezer");
}]);

Route::get("note/list/{noteId}/{page}", [
    'middleware' => "auth",
    'uses' => function ($noteId = 0, $page = 1) {
        return View::make("note/list", ["noteId" => $noteId, "page" => $page]);
    }
]);
Route::get("note/ed_browser", [
    'middleware' => "auth",
    'uses' => function () {
        return View::make("note/ed_browser");
    }
]);
Route::get("notes", ["as" => "notes", "uses" => function () {
    return View::make("notes");
}
]);
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 20-08-15
 * Time: 13:42
 */
Route::get("file/mime-type/{id}", ['middleware' => "auth",
        'uses' => function ($id) {
            $user = Auth::user()->email;
            $doc = getDocRow(Input::get("id", 0) != "" ? Input::get("id", 0) != "" : $id, $user);
            if ($doc != FALSE) {
                $mime = $doc['mime'];


                $response = Response::make($mime, 200);
                $response->header('Content-Type', "text/plain");
                return $response;
            }
        }
    ]
);
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 20-08-15
 * Time: 13:42
 */
Route::get("file/view/{id}", ['middleware' => "auth",
    'uses' => function ($id) {
        $user = Auth::user()->email;
        $note = getDBDocument(Input::get("id", 0) != "" ? Input::get("id", 0) != "" : $id);
        //if ($result != NULL) {
        if ($note->id != 0) {
            $filename = $note->filename;
            if ($note->filename_on_disk != "") {
                $filenameOnDisk = $note->filename_on_disk;
                $content = file_get_contents(asset("datafiles/" . $note->folder_id . "/" . $filenameOnDisk));
                $ext = getExtension($note->filename);
            } else {
                $content = $note->content_file;
                $ext = getExtension($filename);
            }


            if (isImage($ext, $note->mime)) {
                $response = Response::make($content, 200);
                $response->header('Content-Type', imgSelf($content, $filename));
                return $response;
            } else if (isVideo($ext, $note->mime)) {
                $response = Response::make($content, 200);
                $response->header('Content-Type', vidSelf($content, $filename));
                $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
                return $response;
            } else if (isAudio($ext, $note->mime)) {
                $response = Response::make($content, 200);
                $response->header('Content-Type', audioSelf($content, $filename));
                $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
                return $response;
            } else if (isTexte($ext, $note->mime)) {
                $content = str_replace("[[", "<a target='NEW' href='", $content);
                $content = str_replace("]]", "'>Lien</a>", $content);
                $content = str_replace("{{", "<img src='" . asset("file/view/"), $content);
                $content = str_replace("}}", "'/>", $content);
                $content = str_replace("((", "<span class='included_doc'>include doc n0", $content);
                $content = str_replace("))", "</span>", $content);

                $response = Response::make("<p><em>" . $filename . "</em></p>" . $content, 200);
                $response->header('Content-Type', "text/html");
                return $response;

            } else {
                $response = Response::make($content, 200);
                $response->header('Content-Type', $note->mime);
                return $response;

            }
        }
        //} else {
        $response = Response::make("404 NOT FOUND ...", 404);
        return $response;
        //}


    }]);
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 20-08-15
 * Time: 13:42
 */
Route::get("icone/{id}/{taille}", ['middleware' => "auth",
    'uses' => function ($id, $taille) {
        $user = Auth::user()->email;
        $note = getDBDocument(Input::get("id", 0) != "" ? Input::get("id", 0) != "" : $id);
        if ($note->id != 0) {
            $filename = $note->filename;
            $content = $note->content_file;
            $ext = getExtension($filename);
            $mime = $note->mime;


            if (isImage($ext, $mime)) {
                // Output and free from memory
                header('Content-Type: ' . $mime . "\n");
                $res = redimAndDisplay($content, $mime, $taille);
            } else if (isTexte($ext, $mime)) {
                // TODO
                $content = str_replace("[[", "<a target='NEW' href='", $content);
                $content = str_replace("]]", "'>Lien</a>", $content);
                $content = str_replace("{{", "<img src='" . asset("file/view/"), $content);
                $content = str_replace("}}", "'/>", $content);
                $content = str_replace("((", "<span class='included_doc'>include doc n0", $content);
                $content = str_replace("))", "</span>", $content);

                $response = Response::make("<p><em>" . $filename . "</em></p>" . $content, 200);
                $response->header('Content-Type', "text/plain");
                return $response;

            } else {
                //TODO
                $response = Response::make($content, 200);
                $response->header('Content-Type', $mime);
                return $response;

            }
        } else {
            $response = Response::make("404 NOT FOUND ...", 404);
            return $response;
        }


    }]);

Route::get("file/download/{noteId}", [
    "middleware" => "auth",
    "uses" => function ($noteId) {
        $doc = getDocRow($noteId);
        if ($doc != FALSE) {
            $doc_content = getField($doc, "content_file");
            $response = Response::make($doc_content, 200);
            $response->header('Content-Type', $doc["mime"]);
            $response->header("Content-Disposition", "attachment; filename=" . $doc["filename"] . "");
            $response->header("Content-length", strlen($doc_content));
            $response->header("Cache-control", "private.php");
            return $response;
        }

    }]);


function echoImgSelf($content, $filename)
{
    header('Content-type:image/' . getExtension($filename));


    echo $content;
}

function ImgSelf($content, $filename)
{
    return 'image/' . getExtension($filename);

//    echo $content;

}

function vidSelf($content, $filename)
{
    return 'video/' . getExtension($filename);

//    echo $content;

}

function audioSelf($content, $filename)
{
    return 'audio/' . getExtension($filename);

//    echo $content;

}

Route::get("note/save/txt/{noteId}", ['before' => 'csrf',
    "middleware" => "auth",
    "uses" => "NoteController@saveTxt"]);
Route::get("note/save/img/{noteId}", ['before' => 'csrf',
    "middleware" => "auth",
    "uses" => "NoteController@saveImg"]);
Route::get("note/save/other/{noteId}", [
    "middleware" => "auth",
    "uses" => "NoteController@saveOther"]);
Route::get("note/delete/{noteId}", ['before' => 'csrf',
    "middleware" => "auth",
    "uses" => "NoteController@delete"]);

Route::get("file/uploadform/{folderId}", ["middleware" => "auth",
    "uses" => function ($folderId) {
        return View::make("file/uploadform", ["folderId" => $folderId]);
    }]);
Route::post("file/upload/{folderId}", ['before' => 'csrf',
    "middleware" => "auth",
    "uses" => "NoteController@uploadMultiple"]);

Route::get("note/joint/new/{noteId}", ["middleware" => "auth",
    "uses" => function ($noteId) {
        return View::make("note/joint/new")->with("noteId", $noteId);
    }]);

Route::get("note/joint/edit/{jointId}", ["middleware" => "auth",
    "uses" => function ($jointId) {
        return View::make("note/joint/edit", ["jointId" => $jointId]);
    }]);
Route::get("note/joint/list/{noteId}", ["middleware" => "auth",
    "uses" => function ($noteId) {
        return View::make("note/joint/list", ["noteId" => $noteId]);
    }]);
Route::post("note/joint/save/{jointId}", ["middleware" => "auth",
    "uses" => "LienController@save"]);
Route::get("search", [
    'middleware' => "auth",
    "uses" => "NoteController@search"
]);
Route::get("folder/new/{folderId}", ["middleware" => "auth",
    "uses" => function ($folderId) {
        return View::make("folder/new", ["folderId" => $folderId]);
    }]);
Route::post("folder/create/{folderId}", ["middleware" => "auth",
    "uses" => "NoteController@createFolder"]);

Route::get("email/lost", ['uses' => function ()
{
    return View::make("auth/lost");
}]);
Route::post("email/reset", ['before' => 'csrf', 'uses' => function (Request $request) {
    $user = \App\User::where('email', 'like', Input::get('email'))->firstOrFail();

    $ret = $user->sendEmailReminder($user->getAttribute('id'));

    return View::make('email/resetlinksent')->with('email', $user->email)->with('msg_res', $ret);
}]);

Route::get('password/newpassword/{hache}', function ($hache) {
    $reminder = \App\Reminder::findByHache($hache);
    if ($reminder->isValidToken()) {
        $userId = $reminder->findUserByHache($hache);
        $user = \App\User::findOrFail($userId);
        return View::make("password/newpassword")->with('user', $user);
    } else {
        return View::make('password/invalidtoken');
    }
});

Route::post('password/reset',
    ['before' => 'csrf',
        "uses" => "\\App\\Http\\Controllers\\Auth\\PasswordController@postReset"]


);
Route::get("guests/offer_place", [
        "middleware" => "auth",
        'uses' => function () {
            return View::make("guests/offer_place");
        }
    ]
);
/*
Route::get("guest_offer_pieces", []
);
*/

Route::get("guests/offer_place_submitting", [
        "middleware" => "auth",
        'before' => 'csrf',
        "uses" => "\\App\\Http\\Controellers\\GuestController@requestGuest"
    ]
);


/*
Route::controller("wppost");
Route::controller("wordpressInstallation");
*/
?>