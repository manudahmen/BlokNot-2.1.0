<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 27-09-15
 * Time: 21:47
 */
namespace App\BlokNot;

use Illuminate\Database\Eloquent\Model;


class Tree extends Model
{
    private $owner;
    private $rootId;
    private $node;
    public function __construct($noteId = NULL)
    {
        if ($noteId == NULL) {
            $noteId = getRootForUser($this->owner = Auth::user()->email);
        }
        $this->rootId = $noteId;

        $this->node = new Node($noteId);

        $this->node->chargerEnfants();
    }

    public function json()
    {

    }
}
