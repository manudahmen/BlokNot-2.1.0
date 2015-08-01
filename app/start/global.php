<?php

$logFile = 'laravel.log';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);
        
App::error(function(Exception $exception)
{
    Log::error($exception);
});

App::abort(404);
//ptionally, you may provide a response:

App::abort(403, 'Unauthorized action.');

App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});

