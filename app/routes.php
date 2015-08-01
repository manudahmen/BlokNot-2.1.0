<?php
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Using A Route Closure...

Route::get('profile', ['middleware' => 'auth', function() {
    // Only authenticated users may enter...
}]);

// Using A Controller...

Route::get('profile', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@show'
]);
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


get('note/view/{id}', function($id) { 
    view('note')->with('id', $id); 
})->where('n', '[0-9]+');

get("about", function()
{
    view("about");
});


get("home", function ()
{

    view("home");
	
});