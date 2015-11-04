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
    private $rawData = "";

    private $folderId = 0;


    public function getUrl($url = NULL)
    {
        if ($url != null) {
            $this->rawXml = file_get_contents($url);
        }


    }

    public function insert($data, $folderId)
    {
        $this->rawData = $data;
        $this->folderId = $folderId;
        $this->parseAndInsert($data);
    }

    private function parseAndInsert()
    {
        $blog = new SimpleXMLElement($this->rawData);

        print_r($blog);


    }

    public function display($noteId = 0)
    {
        if ($noteId > 0) {
            $noteRow = getDocRow($noteId);
            display($noteId, $noteRow['mime']);
        }
    }

}