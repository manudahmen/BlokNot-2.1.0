<?php

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Using A Controller...

Route::get('profile', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@show'
]);
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get("note/view/{id}", [
       'middleware' => "auth",
    'uses' => "NoteController@display"
    ]
        )->where('id', '[0-9]+');

Route::get('note/edit/{id}', function($id) { 
    return view('note/edit')->with('id', $id); 
})->where('id', '[0-9]+');


Route::get("/", function()
{
    return view("home");
});
Route::get("about", function()
{
    return view("about");
});

Route::get("home", function ()
{

    return view("home");
	
});

Route::get("freezer", function ()
{
    return View::make("freezer");
});

Route::get("notes", ["as" => "notes", "uses" => function ()
{
    return View::make("notes");
}
]);
