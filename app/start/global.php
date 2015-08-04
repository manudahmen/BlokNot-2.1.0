<?php

$logFile = 'laravel.log';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);
        
App::error(function(Exception $exception)
{
    Log::error($exception);
});

App::abort(403, 'Not found url -- Abort');

App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});

