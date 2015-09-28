<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 27-09-15
 * Time: 21:57
 */

namespace App\BlokNot;


use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    private $nodeId;
    private $children = array();

    public function __construct($tree, $noteId)
    {
        $this->tree = $tree;
        $this->nodeId = $noteId;
    }

    public function chargerChemin($noteId)
    {

    }

    public function chargerEnfants()
    {
        $res = getDocumentsFiltered('%', FALSE, $this->nodeId, $this->tree->owner);

        while (($doc = mysqli_fetch_assoc($res)) != NULL) {
            $noteId = $doc['id'];
            $this->children[sizeof($this->children)] = new Node($this->tree, $noteId);
        }

    }

    public function chercherDansChemin($expression, $title = "", $withMedia = FALSE)
    {

    }

}