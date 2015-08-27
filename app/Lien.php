<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    public $id;
    public $note_id;
    public $linked_note_id;
    public $name;
    protected $fillable = array('note_id', 'id', 'linked_note_id', 'name');

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

    }

}


