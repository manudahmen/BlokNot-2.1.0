<?php

require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));

Route::get('/auth/login', ["as" => "login_form", "uses" => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Using A Controller...

Route::get('profile', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@show'
]);
// Registration routes...
Route::get('auth/register', ["as" => "register", "uses" => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'register_submit', 'uses' => 'Auth\AuthController@postRegister']);


Route::get("note/view/{noteId}", [
    'middleware' => "auth",
    "uses" => function ($noteId) {
        return view('note/view', ["noteId" => $noteId]);
    }])->where('noteId', '[0-9]+');


Route::get('note/edit/{noteId}', ['middleware' => "auth", "uses" => function ($noteId) {
    return view('note/edit', ["noteId" => $noteId]);
}])->where('id', '[0-9]+');

Route::post("note/save", [
        'middleware' => "auth",
        'uses' => "NoteController@save"
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
    'uses' => function ($id)
    {
        require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));
        $user = Auth::user()->email;
        $result = getDBDocument(Input::get("id", 0) != "" ? Input::get("id", 0) != "" : $id, $user);
        if ($result != NULL) {
            if (($doc = mysqli_fetch_assoc($result)) != NULL) {
                $mime = $doc['mime'];


                $response = Response::make($mime, 200);
                $response->header('Content-Type', "text/plain");
                return $response;
            }
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
'uses' => function ($id)
{
$user = Auth::user()->email;
$result = getDBDocument(Input::get("id", 0) != "" ? Input::get("id", 0) != "" : $id, $user);
if ($result != NULL) {
    if (($doc = mysqli_fetch_assoc($result)) != NULL) {
        $filename = $doc['filename'];
        $content = $doc['content_file'];
        $ext = getExtension($filename);


        if (isImage($ext, $doc['mime'])) {
            $response = Response::make($content, 200);
            $response->header('Content-Type', imgSelf($content, $filename));
            return $response;
    } else if (isTexte($ext, $doc["mime"])) {
            //preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] )
            //$content =  htmlspecialchars($content);
            //$content = "<p>".$content."</p>";
            //$content = str_replace("\n", "</p>\n<p>", $content);
            $content = str_replace("[[", "<a target='NEW' href='", $content);
            $content = str_replace("]]", "'>Lien</a>", $content);
            $content = str_replace("{{", "<img src='composant/display/contents.php?id=", $content);
            $content = str_replace("}}", "'/>", $content);
            // Following lines... Mmmh seems search another method?
            $content = str_replace("((", "<span class'included_doc'>include doc n0", $content);
            $content = str_replace("))", "</span>", $content);

            $response = Response::make("<p><em>" . $filename . "</em></p>".$content, 200);
            $response->header('Content-Type', "text/plain");
            return $response;

        } else {
            $response = Response::make($content, 200);
            $response->header('Content-Type', $doc["mime"]);
            return $response;

        }
    }
} else {
    $response = Response::make("404 NOT FOUND ...", 404);
    return $response;
}



}]);

Route::get("file/download/{noteId}",[
    "middleware" =>"auth",
    "uses" => function ($noteId)
{
    $result = getDBDocument($noteId);
    if($result!=NULL)
    {
        $doc = mysqli_fetch_assoc($result);
        $doc_content = getField($doc, "content_file");
        $response = Response::make($doc_content, 200);
        $response->header('Content-Type', $doc["mime"]);
             $response->header("Content-Disposition", "attachment; filename=\"".$doc["filename"]."\"");
            $response->header("Content-length", strlen($doc_content));
            $response->header("Cache-control", "private");
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


    echo $content;

}

Route::get("note/save/txt/{noteId}", ["middleware" => "auth",
    "uses" => function($noteId)
    {
        return "Save note txt(TODO)";
    }] );
Route::get("note/save/img/{noteId}", ["middleware" => "auth",
    "uses" => function($noteId)
    {
        return "Save note img(TODO)";
    }] );
Route::get("note/save/other/{noteId}", ["middleware" => "auth",
    "uses" => function($noteId)
    {
        return "Save note else types (no txt, no img) (TODO)";
    }] );