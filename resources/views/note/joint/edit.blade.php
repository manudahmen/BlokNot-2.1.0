<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 25-08-15
 * Time: 23:01
 */
$joint = \App\Lien::findOrFail($jointId);
$noteId = $joint->getAttribute("note_id");
$user = Auth::user()->email;
$directoryList = getFolderList(Auth::user()->email);

$notesList = getDocumentsFiltered("", FALSE, 0, $user);
?>
@extends("master")
@section("title", "Edition de joints")
@section("sidebar")
    @parent
    @include("note.joint.menu", ["jointId",  $jointId])
@stop

@section("content")
<form action="{{asset("note/joint/save/0")}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <input type="hidden" id="note_id" name="note_id" value="{{$joint->note_id}}">
    <label for="directory">Choisir un répertoire</label>
    <select id="directory" name="folder_id" id="folder_id" onchange="populateNotes()">
        <?php
        foreach ($directoryList as $folderId) {
            echo "<option value='" . $folderId["folder_id"] . "'>" . $folderId["filename"] . "</option>";
        }

        ?>
    </select>
    <label for="file">Choisir un fichier</label>
    <select id="file" name="linked_note_id">
        <?php
        foreach ($notesList as $note) {
            echo "<option value='" . $note["id"] . "' " . (($note["id"] == $joint->getAttribute("linked_note_id")) ? "selected='selected'" : "") . ">" . $note["filename"] . "</option>";
        }

        ?>

    </select>
    <label for="name">Entrer un nom pour ce lien (facultatif)</label>
    <input type="text" id="name" name="name" value=""/>
    <input type="hidden" name="user_id" value="{{$user}}"/>
    <input type="submit" name="submit" value="Enregistrer"/>
</form>
<script>
    function populateNotes() {
        $dirId = $("#folder_id").val();


    }
</script>

@stop
