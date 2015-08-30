<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     * Search ajax method with get
     */
    public function search()
    {
        $searchTerms = Input::get("search");

        $result = "";


        $response = new Response($result);

        return Redirect::to("search");

    }
}
