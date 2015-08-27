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
}
