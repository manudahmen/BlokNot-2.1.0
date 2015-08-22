@extends('master')
@section('title', 'Note browser')

@section('sidebar')
    @parent


@stop

@section('content')
<?php
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 20-08-15
 * Time: 13:42
 */

require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));

?>
<div class="container">
    <label for="noteView">Note</label>
            <textarea id="noteView">

            </textarea>
</div>
{{ isset($noteId) ? "<p>NoteId: " .$noteId."</p>" : 'Variable NoteId non définie' }}
{{ isset($noteId) ? "<p>Page: " .$page ."</p>": 'Variable page non définie' }}
<?php
echo "#".$monutilisateur."#";

listerNotesFromDB("*%", FALSE, 0, $monutilisateur);

$root = getRootForUser($monutilisateur);

        echo "<p>Root Id : ";
print_r($root);
        echo "</p>"
?>

@stop

