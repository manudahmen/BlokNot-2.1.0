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

    public function chargerChemin($noteId)
    {

    }

    public function chargerEnfants()
    {
        $this->children = Note::find()->xhere(['folder_id', $this->nodeId])->get();
    }

    public function chercherDansChemin($expression, $title = "", $withMedia = FALSE)
    {

    }

}