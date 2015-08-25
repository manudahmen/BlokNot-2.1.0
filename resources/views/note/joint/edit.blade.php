<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 25-08-15
 * Time: 23:01
 */
require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));

$joint = new \App\Joint();

$joint->findOrFail($jointId);
?>
<form action="{{asset("note/joint/save/$noteId")}}" method="POST">
    <label for="directory">Choisir un répertoire</label>
    <select id="directory" name="folder_id" ></select>

    <label for="file">Choisir un fichier</label>
    <select id="file" name="note_id" ></select>
    <textarea name="text">Entrer une description</textarea>
    <input type="submit" name="" value="Enregistrer"/>
</form>
