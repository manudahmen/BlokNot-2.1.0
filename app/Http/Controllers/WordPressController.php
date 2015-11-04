<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 04-11-15
 * Time: 06:44
 */

namespace App\BlokNot\WordPress;


use App\Http\Controllers\Controller;

class WordPressController extends Controller
{
    public function __construct($noteId = 0, $url = NULL, $data = NULL)
    {

    }

    function parseAndInsert()
    {
        $movies = new SimpleXMLElement();
        echo $movies->movie[0]->plot;
    }


}