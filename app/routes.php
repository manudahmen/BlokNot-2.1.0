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


get('note/view/{id}', function($id) { 
    return View::make('note')->with('id', $id); 
})->where('id', '[0-9]+');

get('note/edit/{id}', function($id) { 
    return View::make('note')->with('id', $id); 
})->where('id', '[0-9]+');

get('note/edit/{id}', function($id) { 
    return view('note-edit')->with('id', $id); 
})->where('id', '[0-9]+');

get("about", function()
{
    return View::make("about");
});


get("home", function ()
{

    return View::make("home");
	
});

get("freezer", function ()
{
    return View::make("freezer");
});

get("blocnotes", function ()
{
    return View::make("blocnotes");
});