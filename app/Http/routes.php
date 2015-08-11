<?php

// Authentication routes...
Route::get('auth/login', ["as" => "login_form" , "uses" =>'Auth\AuthController@getLogin']);
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


Route::get("note/view/{id}", [
    'middleware' => "auth",
    'uses' => "NoteController@display"
        ]
)->where('id', '[0-9]+');

Route::get('note/edit/{id}', ['middleware' => "auth", "uses" => function($id) {
        return view('note/edit')->with('id', $id);
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

Route::get("/", ["as" => "root", "uses" => function() {
        return view("home");
    }
        ]
);
Route::get("about", function() {
    return view("about");
});

Route::get("home", function () {

    return view("home");
});

Route::get("freezer", function () {
    return View::make("freezer");
});

Route::get("notes", ["as" => "notes", "uses" => function () {
        return View::make("notes");
    }
]);
Route::get("notes/list", function()
{
    return View::;make("notes/list");
});