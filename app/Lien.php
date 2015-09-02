<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

require_once(realpath(base_path("lib/bloc-notes/composant/browser/listesItem.php")));

class Lien extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lien';
    protected $id;
    protected $note_id;
    protected $linked_note_id;
    protected $name;
    protected $fillable = array('note_id', 'id', 'linked_note_id', 'name', 'user_id');

    function __construct()
    {
    }

    function load($lienId)
    {
        $this->id = $this->lienId = $lienId;
        $lien = Lien::find($lienId);
        $this->note_id = $lien->note_id;
        $this->linked_note_id = $lien->linked_note_id;
        $this->user_id = $lien->user_id;
        $this->name = $lien->name;

        return $this;
    }

    public function search($text, $options = array())
    {
        $text = $text??"";

        getDocumentsFiltered($text);
    }
}


