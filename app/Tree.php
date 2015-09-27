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

    public function __construct($noteId = NULL)
    {

    }

}
